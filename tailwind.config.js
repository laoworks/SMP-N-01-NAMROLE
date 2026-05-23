/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/filament/**/*.blade.php",
        "./app/Filament/**/*.php",
        "./app/Livewire/**/*.php",
    ],
    theme: {
        extend: {
            colors: {
                'school-primary': '#1e40af',
                'school-secondary': '#d97706',
            },
            fontFamily: {
                'sans': ['Inter', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [],
}
