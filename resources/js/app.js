import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// jquery
import jQuery from 'jquery';
window.$ = jQuery;

// Import components
import './components/header';
import './components/header-cust';
import './components/header-admin';
import './components/sidebar-cust';
import './components/sidebar-admin';
import './components/modal-logout';
import './components/modal-delete-account';

