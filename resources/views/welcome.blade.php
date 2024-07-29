<!DOCTYPE html>
<html>
<head>
    <title>Online Ordering System</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: "Inter", sans-serif;
            background-color: F3F3F6;
        }
        .auth-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
            background-color: #F5F5F5;
            padding: 2rem;
            border-radius: 0.5rem;
            width: 300px;
        }
    </style>
</head>
<body class="bg-gray-100">
    @if (Route::has('login'))
        <nav class="auth-links">
            @auth
                <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ms-3">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</body>
</html>