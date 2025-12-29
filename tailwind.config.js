import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],

    theme: {
        extend: {
            container: {
                center: true,

            },
            firstLetter: ['responsive'],
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                inter: ['Inter', 'sans-serif'],
            },

            animation: {
                'bounce-up-down': 'bounceUpDown 1s ease-in-out infinite',
                'little-bounce-up-down': 'littleBounceUpDown 1s ease-in-out infinite',
                'little-bounce-up-down-delay': 'littleBounceUpDown 1s ease-in-out 0.5s infinite',
                'bounce-up-down-delay': 'bounceUpDown 1s ease-in-out 0.5s infinite', // Menambahkan delay 0.5 detik
                'waving-hello': 'waving 1s ease-in-out infinite',
            },

            keyframes: {
                bounceUpDown: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-5px)' }, // Gerak naik 5px
                },

                littleBounceUpDown: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-2px)' }, // Gerak naik 5px
                },

                waving: {
                    '0%, 100%': { transform: 'rotate(0deg)' },
                    '50%': { transform: 'rotate(-15deg)' },
                }
            },

            colors: {
                // warna slate semua ini
                primaryHovered: {
                    DEFAULT: '#1e293b',    // ketika warna primary di hover maka akan lebih gelap warnanya
                },

                primary: {
                    DEFAULT: '#334155',    // Primary utama, biasanya diambil dari tingkatan 700
                    700: '#334155',        // Primary gelap
                    600: '#475569',        // Primary tingkat sedang
                },
                secondary: {
                    DEFAULT: '#94a3b8',    // Secondary utama, diambil dari tingkatan 400
                    400: '#94a3b8',        // Secondary
                    300: '#cbd5e1',        // Secondary lebih terang
                },
                tertiary: {
                    DEFAULT: '#f1f5f9',    // Tertiary utama, diambil dari tingkatan yang sangat terang
                    100: '#f1f5f9',        // Tertiary
                    50: '#f8fafc',         // Tertiary paling terang
                },

                // button menu order
                orderDeactive: {
                    DEFAULT: "#10b981", // emerald-500 (was 400)
                },
                orderHovered: {
                    DEFAULT: "#059669", // emerald-600 (was 500)
                },
                orderClicked: {
                    DEFAULT: "#047857", // emerald-700 (was 600)
                    700: "#065f46",     // emerald-800 (was 700)
                },

                // untuk link
                active: {
                    DEFAULT: '#334155',
                },
            },

            ringWidth: {
                thin: '2px',
            },
            ringOffsetWidth: {
                thin: '2px',
            },

            corePlugins: {
                ring: false, // Menonaktifkan ring bawaan
            },
        },
    },

    plugins: [
        forms,
        require('daisyui'),
    ],
};
