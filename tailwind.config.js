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
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            dropShadow: {
                'autocomplete': '3px 3px 2px rgba(0, 0, 0, .5)',
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
