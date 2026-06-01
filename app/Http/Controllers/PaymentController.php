<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use App\Models\Setting;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Webhook;

class PaymentController extends Controller
{
    public function checkout(Application $application)
    {
        abort_unless($application->user_id === Auth::id(), 403);
        abort_unless($application->requiresPayment(), 403);

        Stripe::setApiKey(Setting::get('stripe_secret', config('services.stripe.secret')));

        $amount = $application->payment_amount
            ?? Setting::get('default_application_fee', 150);

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency'     => config('services.stripe.currency', 'usd'),
                    'product_data' => [
                        'name'        => 'Application Processing Fee',
                        'description' => 'ITEA EduAbroad — ' . $application->program_name,
                    ],
                    'unit_amount' => (int)($amount * 100),
                ],
                'quantity' => 1,
            ]],
            'mode'        => 'payment',
            'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}&app=' . $application->id,
            'cancel_url'  => route('portal.application', $application->id),
            'metadata'    => [
                'application_id' => $application->id,
                'user_id'        => Auth::id(),
            ],
        ]);

        $application->update(['stripe_session_id' => $session->id]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        Stripe::setApiKey(Setting::get('stripe_secret', config('services.stripe.secret')));

        try {
            $session     = StripeSession::retrieve($request->session_id);
            $application = Application::findOrFail($request->app);

            if ($session->payment_status === 'paid' && $application->stripe_session_id === $session->id) {
                $application->update([
                    'payment_status'    => 'paid',
                    'stripe_payment_id' => $session->payment_intent,
                    'paid_at'           => now(),
                ]);
            }
        } catch (\Exception $e) {
            // Session retrieval failed — webhook will handle it
        }

        return redirect()->route('payment.thankyou', $request->app);
    }

    public function webhook(Request $request)
    {
        $webhookSecret = config('services.stripe.webhook_secret');
        $payload       = $request->getContent();
        $sigHeader     = $request->header('Stripe-Signature');

        try {
            if ($webhookSecret) {
                $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
            } else {
                $event = json_decode($payload);
            }

            if ($event->type === 'checkout.session.completed') {
                $session     = $event->data->object;
                $application = Application::where('stripe_session_id', $session->id)->first();

                if ($application && $session->payment_status === 'paid') {
                    $application->update([
                        'payment_status'    => 'paid',
                        'stripe_payment_id' => $session->payment_intent,
                        'paid_at'           => now(),
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response('Webhook error', 400);
        }

        return response('OK', 200);
    }
}
