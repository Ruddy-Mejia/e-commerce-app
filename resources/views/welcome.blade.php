<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Welcome') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<div class="h-screen w-screen dark:bg-slate-800 flex justify-center items-center">
    <div class="flex flex-col items-center justify-center">
        <p class="text-2xl font-semibold mb-6 text-gray-800 dark:text-gray-100">Welcome to rmejiam's users-crud</p>

        <div class="relative inline-flex  group">
            <div
                class="absolute transitiona-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-[#44BCFF] via-[#FF44EC] to-[#FF675E] rounded-xl blur-lg group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200 animate-tilt">
            </div>
            <a href="{{ route('login') }}" title="Get quote now"
                class="relative inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-gray-100 dark:text-gray-100 transition-all duration-200 bg-indigo-600 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900"
                role="button">Let's check it out!
            </a>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const theme = localStorage.getItem("theme");
        if (theme === "dark") {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    });
</script>



</html>
