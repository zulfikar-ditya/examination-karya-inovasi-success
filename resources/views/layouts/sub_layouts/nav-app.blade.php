@php
    $nav_menus = ['logout']
@endphp

<nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-800 shadow-md fixed top-0 left-0 right-0 z-50">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="{{ route('index') }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Karya Inovasi</span>
        </a>
        <button data-collapse-toggle="mobile-menu" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="mobile-menu">
            <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                <li>
                    <a href="{{ route('admin.category.index') }}" class="{{ Route::currentRouteName() == 'admin.category.index' || Route::currentRouteName() == 'admin.category.create' || Route::currentRouteName() == 'admin.category.edit' || Route::currentRouteName() == 'admin.category.show' ? "nav-active" : "nav" }}" id="">Category</a>
                </li>
                <li>
                    <a href="{{ route('admin.stories.index') }}" class="{{ Route::currentRouteName() == 'admin.stories.index' || Route::currentRouteName() == 'admin.stories.create' || Route::currentRouteName() == 'admin.stories.edit' || Route::currentRouteName() == 'admin.stories.show' ? "nav-active" : "nav" }}" id="">Stories</a>
                </li>
                <li>
                    <a href="{{ route('admin.role.index') }}" class="{{ Route::currentRouteName() == 'admin.role.index' || Route::currentRouteName() == 'admin.role.create' || Route::currentRouteName() == 'admin.role.edit' || Route::currentRouteName() == 'admin.role.show' ? "nav-active" : "nav" }}" id="">Role</a>
                </li>
                <li>
                    <a href="{{ route('admin.permission.index') }}" class="{{ Route::currentRouteName() == 'admin.permission.index' || Route::currentRouteName() == 'admin.permission.create' || Route::currentRouteName() == 'admin.permission.edit' || Route::currentRouteName() == 'admin.permission.show' ? "nav-active" : "nav" }}" id="">Permission</a>
                </li>
                <li>
                    <a href="{{ route('admin.user.index') }}" class="{{ Route::currentRouteName() == 'admin.user.index' || Route::currentRouteName() == 'admin.user.create' || Route::currentRouteName() == 'admin.user.edit' || Route::currentRouteName() == 'admin.user.show' ? "nav-active" : "nav" }}" id="">User</a>
                </li>
                @foreach ($nav_menus as $item)
                <li>
                    <a href="{{ route($item) }}" class="{{ Route::currentRouteName() == $item ? "nav-active" : "nav" }}" id="{{$item}}">{{Str::headline($item)}}</a>
                </li>
                @endforeach
                <form action="{{ route('logout') }}" method="post" id="logout-form">
                    @csrf
                </form>
            </ul>
        </div>
    </div>
</nav>


@push('script')
    <script>
        $('#logout').click((e) => {
            e.preventDefault();
            $('#logout-form').submit();
        });
    </script>
@endpush