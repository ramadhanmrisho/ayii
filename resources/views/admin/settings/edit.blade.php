<x-layouts.admin title="Settings - Ayii">
    <h1 class="font-display text-3xl font-extrabold">Settings</h1>
    <form method="POST" action="{{ route('admin.settings.update') }}" class="mt-6 grid gap-6">
        @csrf
        @method('PUT')
        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="font-display text-xl font-bold">General</h2>
            <div class="mt-5 grid gap-4 md:grid-cols-3">
                <input name="general[company_name]" value="{{ old('general.company_name', $settings->get('general.company_name')) }}" class="rounded-md border border-slate-300 px-4 py-3" placeholder="Company name">
                <input name="general[tagline]" value="{{ old('general.tagline', $settings->get('general.tagline')) }}" class="rounded-md border border-slate-300 px-4 py-3" placeholder="Tagline">
                <input name="general[industry]" value="{{ old('general.industry', $settings->get('general.industry')) }}" class="rounded-md border border-slate-300 px-4 py-3" placeholder="Industry">
            </div>
        </section>
        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="font-display text-xl font-bold">Contact</h2>
            <div class="mt-5 grid gap-4 md:grid-cols-2">
                <input name="contact[phone]" value="{{ old('contact.phone', $settings->get('contact.phone')) }}" class="rounded-md border border-slate-300 px-4 py-3" placeholder="Phone">
                <input name="contact[whatsapp]" value="{{ old('contact.whatsapp', $settings->get('contact.whatsapp')) }}" class="rounded-md border border-slate-300 px-4 py-3" placeholder="WhatsApp">
                <input name="contact[email]" value="{{ old('contact.email', $settings->get('contact.email')) }}" class="rounded-md border border-slate-300 px-4 py-3" placeholder="Email">
                <textarea name="contact[address]" rows="4" class="rounded-md border border-slate-300 px-4 py-3" placeholder="Address">{{ old('contact.address', $settings->get('contact.address')) }}</textarea>
            </div>
        </section>
        <section class="rounded-md bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h2 class="font-display text-xl font-bold">SEO</h2>
            <div class="mt-5 grid gap-4">
                <input name="seo[default_title]" value="{{ old('seo.default_title', $settings->get('seo.default_title')) }}" class="rounded-md border border-slate-300 px-4 py-3" placeholder="Default title">
                <textarea name="seo[default_meta_description]" rows="3" class="rounded-md border border-slate-300 px-4 py-3" placeholder="Default meta description">{{ old('seo.default_meta_description', $settings->get('seo.default_meta_description')) }}</textarea>
            </div>
        </section>
        <div class="flex justify-end">
            <x-button type="submit" class="w-fit">Save Settings</x-button>
        </div>
    </form>
</x-layouts.admin>
