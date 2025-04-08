import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Montserrat', 'Figtree', ...defaultTheme.fontFamily.sans],
                lora: ['Lora', 'cursive'],
            },
            colors: {
                primary: '#588157',
                accent: '#A3B18A',
                neutral: '#DAD7CD',
                'base-100': '#FFFFFF',
                info: '#3ABFF8',
                success: '#36D399',
                warning: '#FBBD23',
                error: '#F87272',
            },
        },
    },

    plugins: [forms],
};
