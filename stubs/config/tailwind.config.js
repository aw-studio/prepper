const plugin = require('tailwindcss/plugin');

module.exports = {
    // mode: 'jit',
    variants: {
        extend: {
            backgroundColor: ['active'],
            textColor: ['active'],
        },
    },
    theme: {
        container: {
            center: true,
            padding: '20px',
        },
        borderRadius: {
            DEFAULT: '10px',
            full: '9999px',
        },
        colors: {
            white: 'white',
            primary: {
                50: '#EDE6F4',
                100: '#E6D8F5',
                300: '#6600CB',
                500: '#48008F',
                700: '#37006E',
                DEFAULT: '#48008F',
            },
            secondary: {
                500: '#FFB73B',
                DEFAULT: '#FFB73B',
            },
            gray: {
                50: '#F8F8F8',
                100: '#EDEDED',
                200: '#A1A1A1',
                300: '#7D7D7D',
                400: '#5E5E5E',
                500: '#4C4C4C',
                600: '#3E3E3E',
                700: '#2F2F2F',
                800: '#1F1F1F',
                900: '#111111',
                DEFAULT: '#4C4C4C',
            },
            green: {
                DEFAULT: '#35E376',
            },
            red: {
                DEFAULT: '#FF5050',
            },
            yellow: {
                DEFAULT: '#FFE146',
            },
        },
        fontFamily: {
            sans: ['Arial', 'sans-serif'],
        },
        fontSize: {
            xs: ['12px', '20px'],
            sm: ['14px', '24px'],
            base: ['18px', '30px'],
            lg: ['21px', '31px'],
            xl: ['25px', '35px'],
            '2xl': ['35px', '42px'],
        },
        boxShadow: {
            DEFAULT: '0px 28px 32px -22px rgba(0,0,0,0.15)',
        },
        extend: {},
    },
    plugins: [
        plugin(function ({ addBase }) {
            addBase({
                body: {
                    fontFamily: ['Arial', 'sans-serif'],
                    '@apply text-gray-900 text-base antialiased': {},
                },
                'h1, h2, h3, h4, p, ol, ul, .h1, .h2, .h3, .h4, blockquote': {
                    maxWidth: '630px',
                    '@apply mb-8': {},
                },
                'p + h1, p + h2, p + h3, p + h4': {
                    '@apply pt-8': {},
                },
                'h1, .h1': {
                    '@apply text-xl lg:text-2xl font-semibold': {},
                },
                'h2, .h2': {
                    paddingRight: '10%',
                    '@apply text-lg lg:text-xl font-semibold': {},
                },
                'h3, .h3': {
                    paddingRight: '10%',
                    '@apply text-base lg:text-lg font-semibold': {},
                },
                'h4, .h4': {
                    '@apply text-base font-semibold': {},
                },
                'main a': {
                    '@apply border-b border-primary text-primary hover:text-primary-500 hover:border-primary-500':
                        {},
                },
                ol: {
                    listStyle: 'none',
                    counterReset: 'li',
                },
                ul: {
                    listStyle: 'none',
                },
                'ol, ul': {
                    position: 'relative',
                    paddingLeft: '35px',
                },
                'ol>li::before': {
                    content: 'counter(li)',
                },
                'ul>li::before': {
                    content: '"•"',
                },
                'li::before': {
                    '@apply text-primary-700 text-right mr-3 w-5 inline-block absolute left-0':
                        {},
                },
                'ol li': {
                    counterIncrement: 'li',
                },
                li: {
                    '@apply pb-4': {},
                },
                'li *': {
                    '@apply pb-0 mb-0': {},
                },
                'blockquote::before, blockquote::after': {
                    content: "'\"'",
                    '@apply text-xl text-primary inline-block': {},
                },
                'blockquote *': {
                    '@apply text-xl text-primary inline': {},
                },
                blockquote: {
                    '@apply pb-8': {},
                },
                '.container .container': {
                    '@apply px-0': {},
                },
            });
        }),
    ],
};
