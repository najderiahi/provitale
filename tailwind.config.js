module.exports = {
    theme: {
        extend: {
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
            },
            height: {
                "1/2": "50%",
                "3/4": "75%",
                "5/6": "83.333333%",
            },
            width: {
                "1/2": "50%",
                "3/4": "75%",
            },
            fontFamily: {
                'display': ['Poppins', 'sans-serif'],
            }
        },
        pagination: theme=> ({
            color: theme('colors.indigo.800'),
        })
    },
    variants: {},
    plugins: [
        require('@tailwindcss/custom-forms'),
        require('tailwindcss-plugins/pagination')
    ]
}

