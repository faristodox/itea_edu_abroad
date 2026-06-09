import './bootstrap';
import Alpine from 'alpinejs';
import Collapse from '@alpinejs/collapse';

Alpine.plugin(Collapse);

// Hero slider component
Alpine.data('heroSlider', () => ({
    current: 0,
    total: 4,
    timer: null,
    start() {
        this.timer = setInterval(() => this.next(), 30000);
    },
    stop() {
        clearInterval(this.timer);
    },
    next() {
        this.current = (this.current + 1) % this.total;
    },
    prev() {
        this.current = (this.current - 1 + this.total) % this.total;
    },
    goto(i) {
        this.current = i;
        this.stop();
        this.start();
    },
}));

// Countries tabs (Home page)
Alpine.data('countryTabs', () => ({
    active: 'china',
}));

// Programme filter (Programmes page)
Alpine.data('programmeFilter', () => ({
    active: 'all',
}));

window.Alpine = Alpine;
Alpine.start();
