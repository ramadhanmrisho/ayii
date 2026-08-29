@inject('settings', 'App\Services\Settings')

<footer class="bg-ayii-navy text-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 md:grid-cols-4 lg:px-8">
        <div class="md:col-span-2">
            <h2 class="font-display text-3xl font-extrabold">Ayii</h2>
            <p class="mt-2 text-ayii-orange">{{ $settings->get('general.tagline') }}</p>
            <p class="mt-5 max-w-md text-sm leading-7 text-slate-300">{{ $settings->get('general.industry') }}</p>
        </div>
        <div>
            <h3 class="font-bold text-ayii-orange">Company</h3>
            <div class="mt-4 grid gap-2 text-sm text-slate-300">
                <a href="{{ route('about.index') }}">About Us</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('solutions.index') }}">Solutions</a>
                <a href="{{ route('projects.index') }}">Projects</a>
                <a href="{{ route('quote.index') }}">Request a Quote</a>
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
        <div>
            <h3 class="font-bold text-ayii-orange">Contact</h3>
            <div class="mt-4 space-y-2 text-sm leading-6 text-slate-300">
                <p>{{ $settings->get('contact.phone') }}</p>
                <p>{{ $settings->get('contact.email') }}</p>
                <p>{!! nl2br(e($settings->get('contact.address'))) !!}</p>
            </div>
        </div>
    </div>
    <div class="border-t border-white/10 py-4 text-center text-xs text-slate-400">© {{ date('Y') }} Ayii. All rights reserved.</div>
</footer>
