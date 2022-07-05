@props(['title'])

<div class="">
    <div class="flex justify-between items-end flex-wrap">
        <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ Str::headline($title) }}</h5>
            <div class="flex">
                <x-btn-link href="{{ route('admin.'.$title.'.create') }}" class="bg-gradient-to-br from-cyan-500 to-teal-500 hover:from-teal-500 hover:to-cyan-500 w-auto">Create</x-btn-link>
            </div>
        </div>
        <div class="w-full md:w-6/12 lg:w-4/12 xl:w-3/12">
            <form class="flex items-center">   
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="text" name="search" value="{{ request()->search }}" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search">
                </div>
                <x-btn type="submit" class="bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </x-btn>
            </form>
        </div>
    </div>
</div>