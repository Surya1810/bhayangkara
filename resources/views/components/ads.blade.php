@php
    $leftAds = \App\Models\Pengumuman::where('position', 'left')->latest()->first();
    $rightAds = \App\Models\Pengumuman::where('position', 'right')->latest()->first();
@endphp
@if ($leftAds || $rightAds)
    <div class="d-none d-lg-block">
        @if ($leftAds)
            <div class="position-fixed top-50 start-0 translate-middle-y ms-1">
                <img src="{{ asset('storage/' . $leftAds->image) }}" class="floating-ad shadow" alt="Left Ad">
            </div>
        @endif

        @if ($rightAds)
            <div class="position-fixed top-50 end-0 translate-middle-y me-1">
                <img src="{{ asset('storage/' . $rightAds->image) }}" class="floating-ad shadow" alt="Right Ad">
            </div>
        @endif
    </div>
@endif
