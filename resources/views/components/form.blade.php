@props(['action', 'model'])
<form action="{{ $action }}" method="post" enctype="multipart/form-data" {{ $attributes->merge(['class' => '']) }}>
    <x-validation-error class="mb-4" />
    @csrf
    @if ($model)
        @method('PUT')
    @endif

    {{ $slot }}

    <x-btn type="submit" class="bg-gradient-to-br from-cyan-500 to-teal-500 hover:from-teal-500 hover:to-cyan-500 w-auto">
        Submit
    </x-btn>
    <x-btn type="reset" class="bg-gradient-to-br from-amber-500 to-orange-500 hover:from-amber-500 hover:to-orange-500">
        Reset
    </x-btn>
</form>