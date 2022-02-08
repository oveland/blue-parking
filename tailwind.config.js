const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors')

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    safelist: [
        {
            pattern: /(bg-|text-|h-|w-|top-)/,
            variants: ['sm', 'md', 'lg', 'xl', '2xl', 'hover'],
        }
    ],

    theme: {
        extend: {
            colors: {
                gray: colors.slate,
                green: colors.lime,
                blue: {
                    50: '#cfcde5',
                    100: '#aeaae5',
                    200: '#7c73f5',
                    300: '#6961e8',
                    400: '#5951e0',
                    500: '#3025de',
                    600: '#150ab4',
                    700: '#1006a0',
                    800: '#09017f',
                    900: '#05004c',
                },
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('flowbite/plugin')
    ],

    separator: ':',
};
