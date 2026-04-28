import './bootstrap';
import './frontend/footer.js';

import AOS from 'aos';
import 'aos/dist/aos.css';

window.addEventListener('load', function () {
    AOS.init({
        duration: 1000,
        offset: 120,
        once: true
    });
});
