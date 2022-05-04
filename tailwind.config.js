const { fontFamily } = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vue-tailwind-components.js",
        "node_modules/vue-tailwind/dist/*.js",
    ],

    theme: {
        fontSize: {
            tiny: "0.65rem",
            xs: "0.75rem",
            sm: "0.85rem",
            base: "1rem",
            lg: "1.125rem",
            xl: "1.25rem",
            "2xl": "1.5rem",
            "3xl": "1.875rem",
            "4xl": "2.25rem",
            "5xl": "3rem",
            "6xl": "4rem",
            "7xl": "5rem",
        },
        extend: {
            fontFamily: {
                sans: [
                    "Inter",
                    "system-ui",
                    "-apple-system",
                    ...fontFamily.sans,
                ],
            },
            opacity: ["disabled"],
            cursor: ["disabled"],
            // border: ['focus'],
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
