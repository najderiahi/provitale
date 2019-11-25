module.exports = {
    theme: {
        extend: {
            spacing: {
                '72': '18rem',
                '84': '21rem',
                '96': '24rem',
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

