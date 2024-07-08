<div class="form-group mb-3">
    <label for="{{ $name }}" class="mb-2">
        {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <textarea
        class="form-control"
        name="{{ $name }}"
        id="{{ $name }}"
        cols="30"
        rows="10"
    >
        {{ old($name, $value) }}
    </textarea>

    @error($name)
        <p class="text-danger text-sm mt-1">{{ $message }}</p>
    @enderror
</div>