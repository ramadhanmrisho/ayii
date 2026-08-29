<x-layouts.app title="Contact Ayii">
    <section class="bg-white px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto grid max-w-7xl gap-10 lg:grid-cols-2">
            <div>
                <x-section-heading class="text-left" eyebrow="Contact Us" title="Talk to Ayii" />
                <div class="mt-8 space-y-4 text-slate-700">
                    <p><strong>Phone:</strong> {{ $settings->get('contact.phone') }}</p>
                    <p><strong>Email:</strong> {{ $settings->get('contact.email') }}</p>
                    <p><strong>Address:</strong><br>{!! nl2br(e($settings->get('contact.address'))) !!}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('contact.store') }}" class="rounded-md bg-ayii-off-white p-6">
                @csrf
                <x-alert />
                <div class="grid gap-4">
                    <input name="full_name" value="{{ old('full_name') }}" required placeholder="Full name" class="rounded-md border border-slate-300 px-4 py-3">
                    <input name="organization" value="{{ old('organization') }}" placeholder="Organization" class="rounded-md border border-slate-300 px-4 py-3">
                    <input name="phone" value="{{ old('phone') }}" placeholder="Phone" class="rounded-md border border-slate-300 px-4 py-3">
                    <input name="email" value="{{ old('email') }}" type="email" required placeholder="Email" class="rounded-md border border-slate-300 px-4 py-3">
                    <input name="subject" value="{{ old('subject') }}" required placeholder="Subject" class="rounded-md border border-slate-300 px-4 py-3">
                    <textarea name="message" rows="5" required placeholder="Message" class="rounded-md border border-slate-300 px-4 py-3">{{ old('message') }}</textarea>
                    <x-button type="submit">Send Enquiry</x-button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
