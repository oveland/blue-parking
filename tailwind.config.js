const defaultTheme = require('tailwindcss/defaultTheme');

const colors = require('tailwindcss/colors')

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            screens: {
                'sm': '376px',
                // 'md': '768px',
                // 'lg': '1024px',
                // 'xl': '1280px',
                // '2xl': '1536px',
                // 'sm': {'min': '0px', 'max': '767px'},
                // 'md': {'min': '768px', 'max': '1023px'},
                // 'lg': {'min': '1024px', 'max': '1279px'},
                // 'xl': {'min': '1280px', 'max': '1535px'},
                // '2xl': {'min': '1536px'},
            },
            colors: {
                gray: colors.blueGray,
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

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
