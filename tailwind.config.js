import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                little: ['Little', 'cursive'],
                comicLight: ['Comic-Light', 'cursive'],
                comicRegular: ['Comic-Regular', 'cursive'],
                comicBold: ['Comic-Bold', 'cursive'],
            },
            colors: {
                primary: '#350B75'
            }
        },
    },

    plugins: [forms],
};
