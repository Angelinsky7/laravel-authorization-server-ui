const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './resources/views/**/*.blade.php'
    ],

    // prefix: 'dlasu-',

    // safelist: [
    //     {
    //         pattern: /bg-(red|green|blue)-(100|200|300|400|500|600|700|800)/,
    //         variants: ['hover', 'focus'],
    //     },
    //     {
    //         pattern: /text-(red|green|blue)-(100|200|300|400|500|600|700|800)/,
    //         variants: ['hover', 'focus'],
    //     },
    // ],

    theme: {
        extend: {
            transitionProperty: {
                'width': 'width'
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            dropShadow: {
                'autocomplete': '3px 3px 2px rgba(0, 0, 0, .5)',
            },
            colors: {
                'policy-ui-basic': {
                    DEFAULT: 'var(--policy-ui-basic-500)',
                    100: 'var(--policy-ui-basic-100)',
                    200: 'var(--policy-ui-basic-200)',
                    300: 'var(--policy-ui-basic-300)',
                    400: 'var(--policy-ui-basic-400)',
                    500: 'var(--policy-ui-basic-500)',
                    600: 'var(--policy-ui-basic-600)',
                    700: 'var(--policy-ui-basic-700)',
                    800: 'var(--policy-ui-basic-800)',
                    900: 'var(--policy-ui-basic-900)',
                },
                'policy-ui-primary': {
                    DEFAULT: 'var(--policy-ui-primary-500)',
                    100: 'var(--policy-ui-primary-100)',
                    200: 'var(--policy-ui-primary-200)',
                    300: 'var(--policy-ui-primary-300)',
                    400: 'var(--policy-ui-primary-400)',
                    500: 'var(--policy-ui-primary-500)',
                    600: 'var(--policy-ui-primary-600)',
                    700: 'var(--policy-ui-primary-700)',
                    800: 'var(--policy-ui-primary-800)',
                    900: 'var(--policy-ui-primary-900)',
                },
                'policy-ui-secondary': {
                    DEFAULT: 'var(--policy-ui-secondary-500)',
                    100: 'var(--policy-ui-secondary-100)',
                    200: 'var(--policy-ui-secondary-200)',
                    300: 'var(--policy-ui-secondary-300)',
                    400: 'var(--policy-ui-secondary-400)',
                    500: 'var(--policy-ui-secondary-500)',
                    600: 'var(--policy-ui-secondary-600)',
                    700: 'var(--policy-ui-secondary-700)',
                    800: 'var(--policy-ui-secondary-800)',
                    900: 'var(--policy-ui-secondary-900)',
                },
                'policy-ui-alert': {
                    DEFAULT: 'var(--policy-ui-alert-500)',
                    100: 'var(--policy-ui-alert-100)',
                    200: 'var(--policy-ui-alert-200)',
                    300: 'var(--policy-ui-alert-300)',
                    400: 'var(--policy-ui-alert-400)',
                    500: 'var(--policy-ui-alert-500)',
                    600: 'var(--policy-ui-alert-600)',
                    700: 'var(--policy-ui-alert-700)',
                    800: 'var(--policy-ui-alert-800)',
                    900: 'var(--policy-ui-alert-900)',
                },
                'policy-ui-warning': {
                    DEFAULT: 'var(--policy-ui-warning-500)',
                    100: 'var(--policy-ui-warning-100)',
                    200: 'var(--policy-ui-warning-200)',
                    300: 'var(--policy-ui-warning-300)',
                    400: 'var(--policy-ui-warning-400)',
                    500: 'var(--policy-ui-warning-500)',
                    600: 'var(--policy-ui-warning-600)',
                    700: 'var(--policy-ui-warning-700)',
                    800: 'var(--policy-ui-warning-800)',
                    900: 'var(--policy-ui-warning-900)',
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
