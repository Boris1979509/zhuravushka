@if(auth()->user() && $compare)
    @foreach($productItem->favorites as $pivot)
        <div class="compare @if($pivot->pivot->product_id) compare__active @endif"
             data-id="{{ $productItem->id }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="11.5" stroke="#D5D5D5"/>
                <rect x="15" y="6" width="3" height="12" rx="0.5" fill="#E6E4E4"/>
                <rect x="10.5" y="8" width="3" height="10" rx="0.5" fill="#E6E4E4"/>
                <rect x="6" y="10" width="3" height="8" rx="0.5" fill="#E6E4E4"/>
                <line x1="6" y1="17.3" x2="18" y2="17.3" stroke="#E6E4E4"
                      stroke-width="1.4"/>
            </svg>
        </div>
    @endforeach
@else
    @if($compares = session('compares'))
        <div class="compare @if(in_array($productItem->id, $compares)) compare__active @endif"
             data-id="{{ $productItem->id }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="11.5" stroke="#D5D5D5"/>
                <rect x="15" y="6" width="3" height="12" rx="0.5" fill="#E6E4E4"/>
                <rect x="10.5" y="8" width="3" height="10" rx="0.5" fill="#E6E4E4"/>
                <rect x="6" y="10" width="3" height="8" rx="0.5" fill="#E6E4E4"/>
                <line x1="6" y1="17.3" x2="18" y2="17.3" stroke="#E6E4E4"
                      stroke-width="1.4"/>
            </svg>
        </div>
    @else
        <div class="compare" data-id="{{ $productItem->id }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="11.5" stroke="#D5D5D5"/>
                <rect x="15" y="6" width="3" height="12" rx="0.5" fill="#E6E4E4"/>
                <rect x="10.5" y="8" width="3" height="10" rx="0.5" fill="#E6E4E4"/>
                <rect x="6" y="10" width="3" height="8" rx="0.5" fill="#E6E4E4"/>
                <line x1="6" y1="17.3" x2="18" y2="17.3" stroke="#E6E4E4"
                      stroke-width="1.4"/>
            </svg>
        </div>
    @endif
@endif
