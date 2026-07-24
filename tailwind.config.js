import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    daisyui: {
        themes: [
            {
                skalsa: {
                    'primary': '#4f46e5',
                    'primary-content': '#ffffff',
                    'secondary': '#0ea5e9',
                    'secondary-content': '#ffffff',
                    'accent': '#f59e0b',
                    'accent-content': '#ffffff',
                    'neutral': '#1e293b',
                    'neutral-content': '#f8fafc',
                    'base-100': '#ffffff',
                    'base-200': '#f1f5f9',
                    'base-300': '#e2e8f0',
                    'base-content': '#0f172a',
                    'info': '#3b82f6',
                    'info-content': '#ffffff',
                    'success': '#10b981',
                    'success-content': '#ffffff',
                    'warning': '#f59e0b',
                    'warning-content': '#ffffff',
                    'error': '#ef4444',
                    'error-content': '#ffffff',
                    '--rounded-box': '0.75rem',
                    '--rounded-btn': '0.5rem',
                    '--rounded-badge': '1.9rem',
                    '--animation-btn': '0.25s',
                    '--animation-input': '0.2s',
                    '--btn-focus-scale': '0.95',
                    '--tab-radius': '0.5rem',
                },
            },
            {
                'skalsa-dark': {
                    'primary': '#818cf8',
                    'primary-content': '#000000',
                    'secondary': '#38bdf8',
                    'secondary-content': '#000000',
                    'accent': '#fbbf24',
                    'accent-content': '#000000',
                    'neutral': '#0f172a',
                    'neutral-content': '#e2e8f0',
                    'base-100': '#0f172a',
                    'base-200': '#1e293b',
                    'base-300': '#334155',
                    'base-content': '#f1f5f9',
                    'info': '#60a5fa',
                    'info-content': '#000000',
                    'success': '#34d399',
                    'success-content': '#000000',
                    'warning': '#fbbf24',
                    'warning-content': '#000000',
                    'error': '#f87171',
                    'error-content': '#000000',
                    '--rounded-box': '0.75rem',
                    '--rounded-btn': '0.5rem',
                    '--rounded-badge': '1.9rem',
                    '--animation-btn': '0.25s',
                    '--animation-input': '0.2s',
                    '--btn-focus-scale': '0.95',
                    '--tab-radius': '0.5rem',
                },
            },
        ],
    },

    plugins: [forms, require('daisyui')],
};
