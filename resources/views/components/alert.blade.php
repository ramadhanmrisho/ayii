@if ($errors->any())
    <div class="rounded-md border border-ayii-orange/40 bg-white p-4 text-sm text-ayii-navy">
        <ul class="list-disc space-y-1 pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@elseif (session('status'))
    <noscript>
        <div class="rounded-md border border-ayii-orange/40 bg-white p-4 text-sm text-ayii-navy">
            <p>{{ session('status') }}</p>
        </div>
    </noscript>
@endif
