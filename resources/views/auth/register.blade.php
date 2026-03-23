<x-layouts.app :title="'Register | TaskFlow'">
    <div class="mx-auto max-w-md">
        <div class="rounded-3xl border border-white/70 bg-white/90 p-8 shadow-lg shadow-slate-200/70 backdrop-blur">
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-orange-600">Get started</p>
                <h1 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Create your account</h1>
                <p class="mt-2 text-sm text-slate-500">Your projects and tasks stay private to your own login.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">Name</span>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-orange-500 focus:bg-white">
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">Email address</span>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-orange-500 focus:bg-white">
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">Password</span>
                    <input type="password" name="password" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-orange-500 focus:bg-white">
                </label>

                <label class="block">
                    <span class="mb-2 block text-sm font-medium text-slate-700">Confirm password</span>
                    <input type="password" name="password_confirmation" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 outline-none transition focus:border-orange-500 focus:bg-white">
                </label>

                <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
                    Register
                </button>
            </form>

            <p class="mt-6 text-sm text-slate-500">
                Already registered?
                <a href="{{ route('login') }}" class="font-semibold text-orange-600 hover:text-orange-700">Login here</a>
            </p>
        </div>
    </div>
</x-layouts.app>
