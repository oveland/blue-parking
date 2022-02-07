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

    // safelist: [/^bg-/, /^text-/, /^h-/, /^w-/, /^top-/],
    safelist: [
        // 'bg-gray-700',
        {
            pattern: /(bg-|text-|h-|w-|top-)/,
            variants: ['sm', 'md', 'lg', 'xl', '2xl', 'hover'],
        }
    ],

    theme: {
        extend: {
            screens: {
                'sm': '640px',
                // => @media (min-width: 640px) { ... }

                'md': '768px',
                // => @media (min-width: 768px) { ... }

                'lg': '1024px',
                // => @media (min-width: 1024px) { ... }

                'xl': '1280px',
                // => @media (min-width: 1280px) { ... }

                '2xl': '1536px',
                // => @media (min-width: 1536px) { ... }
            },
            colors: {
                gray: colors.slate,
                green: colors.lime,
                blue: {
                    50: '#cfcde5',
                    100: '#aeaae5',
                    200: '#554cde',
                    300: '#3629e9',
                    400: '#2115e3',
                    500: '#2116d0',
                    600: '#180cc8',
                    700: '#180cb7',
                    800: '#0e067c',
                    900: '#070341',
                },
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],

    separator: ':',
};
