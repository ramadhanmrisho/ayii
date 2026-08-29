<x-layouts.app title="Staff Login - Ayii">
    <section class="bg-ayii-off-white px-4 py-16 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-md rounded-md bg-white p-8 shadow-sm ring-1 ring-slate-200">
            <h1 class="font-display text-3xl font-extrabold">Staff Login</h1>
            <p class="mt-2 text-sm text-slate-600">Access the Ayii administration CMS.</p>
            <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5">
                @csrf
                <x-alert />
                <div>
                    <label for="email" class="text-sm font-semibold">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="mt-2 w-full rounded-md border border-slate-300 px-4 py-3 focus:border-ayii-orange focus:outline-none focus:ring-2 focus:ring-ayii-orange/30">
                </div>
                <div>
                    <label for="password" class="text-sm font-semibold">Password</label>
                    <input id="password" name="password" type="password" required class="mt-2 w-full rounded-md border border-slate-300 px-4 py-3 focus:border-ayii-orange focus:outline-none focus:ring-2 focus:ring-ayii-orange/30">
                </div>
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="remember" value="1" class="rounded border-slate-300 text-ayii-orange focus:ring-ayii-orange">
                    Remember me
                </label>
                <x-button type="submit" class="w-full">Login</x-button>
            </form>
        </div>
    </section>
</x-layouts.app>
