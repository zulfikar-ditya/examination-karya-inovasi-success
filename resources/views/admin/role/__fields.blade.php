<x-form :action="$model ? route('admin.'.$title.'.update', $model) : route('admin.'.$title.'.store')" :model="$model ? true : false" class="mt-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class="">
            <x-input-group type="text" name="name" value="{{$model ? $model->name : ''}}" required autofocus />
        </div>
    </div>
</x-form>
