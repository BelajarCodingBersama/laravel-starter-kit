<div class="form-group mb-3">
    <label for="{{ $name }}" class="mb-2">
        {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <input
        type="{{ $type }}"
        class="form-control @error($name)
            is-invalid
        @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if ($disabled)
            disabled
        @endif
    />
    @if (!empty($formText))
        <div class="form-text">{{ $formText }}</div>
    @endif

    @error($name)
        <p class="text-danger text-sm mt-1">{{ $message }}</p>
    @enderror
</div>