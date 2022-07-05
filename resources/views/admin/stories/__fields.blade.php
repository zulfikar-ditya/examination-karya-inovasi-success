<x-form :action="$model ? route('admin.'.$title.'.update', $model) : route('admin.'.$title.'.store')" :model="$model ? true : false" class="mt-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class="">
            <x-input-group type="text" name="title" value="{{$model ? $model->title : ''}}" required autofocus />
        </div>
        <div class="">
            <x-input-group type="text" name="short_content" value="{{$model ? $model->short_content : ''}}" required />
        </div>
        <div class="">
            <x-select-form :name="'category_id'" required>
                @foreach ($categories as $item)
                <option value="{{$item->id}}" {{$model && $model->role_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                @endforeach
            </x-select-form>
        </div>
        <div class="">
            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Content</label>
            <textarea name="content" id="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                {{$model ? $model->content : ''}}
            </textarea>
        </div>
        <div class="">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">Image</label>
            <input class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" name="image">
        </div>
    </div>
</x-form>

@push('script')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#content'
        });
    </script>
@endpush