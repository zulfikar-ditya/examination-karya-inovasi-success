<x-form :action="$model ? route('admin.'.$title.'.update', $model) : route('admin.'.$title.'.store')" :model="$model ? true : false" class="mt-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class="">
            <x-input-group type="text" name="username" value="{{$model ? $model->username : ''}}" required autofocus />
        </div>
        <div class="">
            <x-input-group type="text" name="short_content" value="{{$model ? $model->username : ''}}" required autofocus />
        </div>
        <div class="">
            <x-select-form :name="'role_id'">
                @foreach ($categories as $item)
                    <option value="{{$item->id}}" {{$model && $model->role_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                @endforeach
            </x-select-form>
        </div>
        <div class="">
            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Content</label>
            <textarea id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=""></textarea>
        </div>
    </div>
</x-form>

@push('script')
    <script>
        tinymce.init({
            selector: '#content'
        });
    </script>
@endpush