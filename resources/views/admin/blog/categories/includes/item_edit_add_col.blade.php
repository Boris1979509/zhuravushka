@php /** @var App\Models\Blog\BlogPost $item */@endphp
<div>
    <button type="submit" class="btn btn-outline btn-go-on">{{ __('Save') }}</button>
</div>
@if($item->exists)
    <div class="mt-1">
        <p>{{ __('ID') }}: {{ $item->id }}</p>
        <div class="form-input">
            <label for="" class="form-input-label">{{ __('Created') }}</label>
            <input type="text" class="input" value="{{ parseDate(carbon($item->created_at))->format('j F, Y') }}"
                   disabled="disabled">
        </div>
        <div class="form-input">
            <label for="" class="form-input-label">{{ __('Updated') }}</label>
            <input type="text" class="input" value="{{ parseDate(carbon($item->updated_at))->format('j F, Y') }}"
                   disabled="disabled">
        </div>
        @if($item->deleted_at)
            <div class="form-input">
                <label for="" class="form-input-label">{{ __('Deleted') }}</label>
                <input type="text" class="input" value="{{ parseDate(carbon($item->deleted_at))->format('j F, Y') }}"
                       disabled="disabled">
            </div>
        @endif
    </div>
@endif
