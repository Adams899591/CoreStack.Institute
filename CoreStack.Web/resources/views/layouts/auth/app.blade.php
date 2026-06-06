<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - CoreStack Institute</title>
    <!-- Tailwind CSS (via CDN for demonstration) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkblue: {
                            DEFAULT: '#001F3F',
                            light: '#003366',
                        },
                        gold: {
                            DEFAULT: '#D4AF37',
                            dark: '#B8860B',
                        },
                    },
                    animation: {
                        'globe-rotate': 'globe-rotate 60s linear infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        'globe-rotate': {
                            '0%': { backgroundPosition: '0 0' },
                            '100%': { backgroundPosition: '200% 0' },
                        }
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js for dropdowns and interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>
<body class="antialiased font-sans bg-[#000814]">
    {{ $slot }}

    @livewireScripts
</body>
</html>