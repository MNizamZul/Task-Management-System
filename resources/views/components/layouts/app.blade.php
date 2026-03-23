<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Task Management System' }}</title>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-stone-100 text-slate-900">
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-x-0 top-0 h-72 bg-[radial-gradient(circle_at_top_left,_rgba(14,116,144,0.2),_transparent_45%),radial-gradient(circle_at_top_right,_rgba(249,115,22,0.22),_transparent_40%)]"></div>

            <header class="relative border-b border-white/60 bg-white/85 backdrop-blur">
                <div class="mx-auto flex w-full max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <div>
                        <a href="{{ route('dashboard') }}" class="text-lg font-semibold tracking-tight text-slate-900">Task Management System</a>
                        @auth
                            {{-- <p class="text-sm text-slate-500">Focused project and task tracking for {{ auth()->user()->name }}</p> --}}
                        @else
                            <p class="text-sm text-slate-500">Assessment-ready Laravel task management system</p>
                        @endauth
                    </div>

                    @auth
                        <nav class="flex items-center gap-3 text-sm font-medium text-slate-600">
                            <a href="{{ route('dashboard') }}" class="rounded-full px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Dashboard</a>
                            <a href="{{ route('projects.index') }}" class="rounded-full px-3 py-2 transition hover:bg-slate-100 hover:text-slate-900">Projects</a>
                            <span class="rounded-full bg-slate-100 px-4 py-2 text-slate-700">
                                {{ auth()->user()->name }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="rounded-full border border-rose-600 bg-rose-600 px-4 py-2 text-white transition hover:border-rose-700 hover:bg-rose-700">
                                    Logout
                                </button>
                            </form>
                        </nav>
                    @else
                        <nav class="flex items-center gap-3 text-sm font-medium">
                            <a href="{{ route('login') }}" class="rounded-full px-3 py-2 text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">Login</a>
                            <a href="{{ route('register') }}" class="rounded-full bg-slate-900 px-4 py-2 text-white transition hover:bg-slate-700">Register</a>
                        </nav>
                    @endauth
                </div>
            </header>

            <main class="relative mx-auto w-full max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                        <p class="font-semibold">Please fix the following issues:</p>
                        <ul class="mt-2 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
