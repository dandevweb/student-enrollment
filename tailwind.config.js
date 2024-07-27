import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wire-elements/modal/resources/views/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    safelist: [
        'sm:w-full',
        'sm:align-middle',
        'sm:max-w-md',
        'md:max-w-xl',
        'lg:max-w-3xl',
        'xl:max-w-5xl',
        '2xl:max-w-7xl',
      ],

    plugins: [forms],
};
