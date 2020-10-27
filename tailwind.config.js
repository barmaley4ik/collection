const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        zIndex: {
            '0': 0,
            '10': 10,
            '20': 20,
            '30': 30,
            '40': 40,
            '50': 50,
            '25': 25,
            '50': 50,
            '75': 75,
            '100': 100,
            'auto': 'auto',
        },
        extend: {
            width: {
                '1/7': '14.2857143%',
                '2/7': '28.5714286%',
                '3/7': '42.8571429%',
                '4/7': '57.1428571%',
                '5/7': '71.4285714%',
                '6/7': '85.7142857%',
                '8/9': '88.8888889%',
                '7/8': '87.5%',
                '6/13': '46.153846%',
                '7/15': '46.666667%',
            },
            fontFamily: {
                sans: ['Cerebri Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                indigo: {
                    '900': '#191e38',
                    '800': '#2f365f',
                    '600': '#5661b3',
                    '500': '#6574cd',
                    '400': '#7886d7',
                    '300': '#b2b7ff',
                    '100': '#e6e8ff',
                },
            },
            boxShadow: theme => ({
                outline: '0 0 0 2px ' + theme('colors.indigo.500'),
                my: '0px -9px 20px 0px rgba(0, 0, 0, 0.67), 0px 20px 20px 1px rgba(0, 0, 0, 0.51)',
            }),
            inset: {
                '-16': '-4rem',
                '-32': '-8rem',
            },
            fill: theme => theme('colors'),
        },
        customForms: theme => ({
            default: {

                checkbox: {

                    '&:focus': {
                        backgroundColor: theme('colors.indigo.600'),
                        borderColor: theme('colors.indigo.600'),
                        boxShadow: 'none',
                    }
                },
            },
        })
    },
    variants: {
        fill: ['responsive', 'hover', 'focus', 'group-hover'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        backgroundColor: ['responsive', 'hover', 'focus', 'active', 'visited', 'odd', 'even'],
        zIndex: ['responsive', 'hover', 'focus'],

    },
    plugins: [
        require('@tailwindcss/custom-forms'),
    ],
}