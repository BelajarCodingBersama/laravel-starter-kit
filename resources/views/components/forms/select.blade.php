<div class="form-group mb-3">
    <label for="{{ $name }}" class="mb-2"> 
        {{ $label }}
        @if ($required)
            <span class="required">*</span>
        @endif
    </label>
    <select 
        name="{{ $name }}" 
        id="{{ $name }}" 
        class="form-select" 
        @if ($disabled)
            disabled
        @endif
    >
        <option selected disabled>Open this select menu</option>
        @foreach ($items as $item)
            <option 
                value="@if ($optionValue === null)
                    {{ $item }}
                @else
                    {{ $item->$optionValue }}
                @endif"

                @if ($optionValue === null)
                    {{ $item == $selectedItem ? 'selected' : '' }}
                @else
                    {{ $item->$optionValue == $selectedItem ? 'selected' : '' }}
                @endif
            >
                @if ($optionTitle === null)
                    {{ $item }}
                @else
                    {{ $item->$optionTitle }}
                @endif
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-danger text-sm mt-1">{{ $message }}</p>
    @enderror
</div>