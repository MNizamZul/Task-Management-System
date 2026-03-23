<x-layouts.app :title="'Login | TaskFlow'">
    <div class="mx-auto max-w-md">
        <div class="rounded-3xl border border-white/70 bg-white/90 p-8 shadow-lg shadow-slate-200/70 backdrop-blur">
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-700">Welcome back</p>
                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Sign in to your workspace</h1>
                <p class="mt-2 text-sm text-slate-500">Use your account to manage your own projects and tasks securely.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">Email address</span>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white">
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">Password</span>
                    <input type="password" name="password" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-cyan-500 focus:bg-white">
                </label>

                <label class="flex items-center gap-3 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                    Remember me
                </label>

                <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                    Login
                </button>
            </form>

            <p class="mt-6 text-sm text-slate-500">
                Need an account?
                <a href="{{ route('register') }}" class="font-semibold text-cyan-700 hover:text-cyan-800">Create one here</a>
            </p>
        </div>
    </div>
</x-layouts.app>
