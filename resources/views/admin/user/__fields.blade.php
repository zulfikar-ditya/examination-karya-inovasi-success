<x-form :action="$model ? route('admin.'.$title.'.update', $model) : route('admin.'.$title.'.store')" :model="$model ? true : false" class="mt-10">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <div class="">
            <x-input-group type="text" name="username" value="{{$model ? $model->username : ''}}" required autofocus />
        </div>
        <div class="">
            <x-input-group type="email" name="email" value="{{$model ? $model->email : ''}}" required/>
        </div>
        <div class="">
            <x-input-group type="password" name="password" value="{{$model ? $model->name : ''}}"/>
        </div>
        <div class="">
            <x-input-group type="password" name="password_confirmation" value="{{$model ? $model->name : ''}}"/>
        </div>
        @if ($model)
        <div class="">
            <x-input-group type="password" name="old_password" value="{{$model ? $model->name : ''}}"/> 
        </div>
        @endif
        <div class="">
            <x-select-form :name="'role_id'">
                @foreach ($roles as $item)
                    <option value="{{$item->id}}" {{$model && $model->role_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                @endforeach
            </x-select-form>
        </div>
    </div>
</x-form>