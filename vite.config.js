import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/service.js',
                'resources/js/order-now.js',
                'resources/js/menu.js',
                'resources/js/home.js',
                'resources/js/contact-us.js',
                'resources/js/about-us.js',
                'resources/js/login.js',
                'resources/js/register.js',
                
                // Components
                'resources/js/components/sidebar-cust.js',
                'resources/js/components/header-cust.js',
                'resources/js/components/modal-logout.js',
                'resources/js/components/modal-delete-account.js',
                'resources/js/components/header.js',
                'resources/js/components/sidebar-admin.js',
                'resources/js/components/header-admin.js',

                // Customer
                'resources/js/customer/profile.js',
                'resources/js/customer/profile-edit.js',
                'resources/js/customer/pesanan-detail.js',
                'resources/js/customer/order-history.js',
                'resources/js/customer/keranjang.js',
                'resources/js/customer/detail-pembayaran.js',
                'resources/js/customer/dashboard.js',

                // Admin
                'resources/js/admin/data-pesanan.js',
                'resources/js/admin/edit-pesanan.js',
                'resources/js/admin/dashboard-admin.js',
                'resources/js/admin/edit-menu.js',
                'resources/js/admin/setting-admin.js',
                'resources/js/admin/edit-pelanggan.js',
                'resources/js/admin/data-penjualan.js',
                'resources/js/admin/data-menu.js',
                'resources/js/admin/create-menu.js',
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
});
