/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        fontFamily: {
            'titlefont': ['Montserrat'],
            'subtitlefont': ['Lora'],
            'contentfont': ['Hind Madurai'],
        },
        extend: {
            colors: {
                accentcolor: '#EAD07F',
                backgroundcolor: '#060606',
            },

            height: {
                '128' : '28rem',
            },

            width: {
                'custom-width': 'calc(100% - 100px)',
            },

            maxWidth: {
                '40': '40px',
                '60': '60px',
            },

            minWidth: {
                '40': '40px',
                '60': '60px',
            },
        },
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}

