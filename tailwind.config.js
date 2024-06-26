import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        'node_modules/preline/dist/*.js',
    ],


    theme: {
        extend: {
            colors: {
                customGreen: '#253c2f',
            },
        },
    },

    plugins: [
        forms,
        require('preline/plugin'),
    ],
};
