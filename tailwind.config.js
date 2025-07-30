import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                'expand-border': {
                    '0%': {
                        'border-left-width': '0px',
                        opacity: '0',
                        transform: 'translateX(-10px)',
                    },
                    '100%': {
                        'border-left-width': '4px',
                        opacity: '1',
                        transform: 'translateX(0px)',
                    },
                },
            },
            animation: {
                'expand-border': 'expand-border 0.5s ease-out forwards',
            },
        },
    },

    plugins: [forms],
};
