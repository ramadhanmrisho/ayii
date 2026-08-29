<x-layouts.admin title="Enquiries - Ayii">
    <h1 class="font-display text-3xl font-extrabold">Enquiries</h1>
    <div class="mt-6 space-y-4">
        @foreach ($enquiries as $enquiry)
            <form method="POST" action="{{ route('admin.enquiries.update', $enquiry) }}" class="rounded-md bg-white p-5 shadow-sm ring-1 ring-slate-200">
                @csrf @method('PUT')
                <div class="flex flex-col justify-between gap-4 md:flex-row"><div><p class="font-display text-lg font-bold">{{ $enquiry->subject }}</p><p class="text-sm text-slate-600">{{ $enquiry->full_name }} · {{ $enquiry->email }}</p><p class="mt-3 text-sm">{{ $enquiry->message }}</p></div><select name="status" class="h-fit rounded-md border border-slate-300 px-4 py-3">@foreach(App\Enums\EnquiryStatus::cases() as $status)<option value="{{ $status->value }}" @selected($enquiry->status === $status)>{{ ucfirst($status->value) }}</option>@endforeach</select></div>
                <button class="mt-3 font-semibold text-ayii-orange">Update</button>
            </form>
        @endforeach
    </div>
    <div class="mt-6">{{ $enquiries->links() }}</div>
</x-layouts.admin>
