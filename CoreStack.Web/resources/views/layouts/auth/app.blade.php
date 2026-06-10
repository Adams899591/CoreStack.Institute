<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - CoreStack Institute</title>
    <!-- Tailwind CSS -->
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js for dropdowns and interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @livewireStyles
</head>
<body class="antialiased font-sans flex items-center justify-center min-h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1498243639359-2830bcb3c15d?q=80&w=1600&auto=format&fit=crop');">
    {{ $slot }}

    @livewireScripts
</body>
</html>