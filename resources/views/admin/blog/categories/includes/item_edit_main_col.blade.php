@php /** @var App\Models\Blog\BlogCategory $item */@endphp
<div>
    <div class="form-input">
        <label for="title" class="form-input-label">{{ __('Title') }}</label>
        <input type="text" name="title" id="title" value="{{ old('title', $item->title) }}"
               class="input">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-input">
        <label for="slug" class="form-input-label">{{ __('Slug') }}</label>
        <input type="text" name="slug" id="slug" class="input"
               value="{{ old('slug', $item->slug) }}">
    </div>
    <div class="form-input">
        <label for="parent_id" class="form-input-label">{{ __('Parent') }}</label>
        <select name="parent_id" id="parent_id"
                class="input">
            @php /** @var BlogCategory $categoryItem*/use App\Models\Blog\BlogCategory; @endphp
            <option>{{ __('No parent') }}</option>
            @foreach($categoryList as $categoryItem)
                <option value="{{ $categoryItem->id }}"
                        @if($item->parent_id === $categoryItem->id) selected="selected" @endif>{{
                    $categoryItem->id_title }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-input">
        <label for="description" class="form-input-label">{{ __('Description') }}</label>
        <textarea class="input" name="description"
                  id="description" cols="30"
                  rows="10">{{ old('description', $item->description) }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
