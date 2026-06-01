<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('offer_letter_path')->nullable()->after('admin_notes');
            $table->string('payment_status')->default('unpaid')->after('offer_letter_path'); // unpaid, paid, waived
            $table->decimal('payment_amount', 10, 2)->nullable()->after('payment_status');
            $table->string('stripe_session_id')->nullable()->after('payment_amount');
            $table->string('stripe_payment_id')->nullable()->after('stripe_session_id');
            $table->timestamp('paid_at')->nullable()->after('stripe_payment_id');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['offer_letter_path','payment_status','payment_amount','stripe_session_id','stripe_payment_id','paid_at']);
        });
    }
};
