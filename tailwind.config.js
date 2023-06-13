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
            }
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

