@extends('layouts.app')

@section('title', Str::headline($story->title). ' ')

@section('content')
<form class="">   
    <div class="container mx-auto mt-20">
        <div class="flex justify-between flex-wrap">
            <div class="w-full md:w-8/12">

                <div class="p-5">
                    <div class="">
                        <div class="flex">
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
                        </div>
                    </div>

                    <div class="mt-10">

                        <div class="mb-10">
                            <h4 class="text-3xl font-bold tracking-wide mb-3">{{ Str::headline($story->title) }}</h4>
                            <div class="flex gap-4">
                                <span class="text-slate-500">{{ $story->created_at->diffForHumans() }}</span>
                                <span class="text-slate-500">By {{ $story->user->username }}</span>

                                <button type="submit" class="bg-blue-100 text-blue-800 text-md font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{ $story->category->name }}</button>
                                <input type="hidden" name="category_id" value="{{ $story->category_id }}">
                            </div>
                        </div>

                        <img class="rounded fir" src="{{ $story->image ? url('storage/' . $story->image) : asset('image/pexels-alexas-fotos-2255441.jpg') }}" alt="{{ $story->title }}">

                        <span class="mt-10">
                            {!!$story->content!!}
                        </span>
                    </div>

                    <div class="mt-10">
                        <h5 class="text-xl font-bold">Related Stories</h5>
                        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mt-10">
                        @foreach ($related_stories as $item)
                            <div class="bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <a href="{{ route('detail-stories', ['slug' => $item->slug]) }}">
                                    <img class="rounded-t-lg fir" src="{{ $item->image ? url('storage/' . $item->image) : asset('image/pexels-alexas-fotos-2255441.jpg')}}" alt="{{ $item->title }}">
                                </a>
                                <div class="p-5">
                                    <a href="{{ route('detail-stories', ['slug' => $item->slug]) }}">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ Str::limit($item->title, 50) }}</h5>
                                    </a>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($item->short_content, 100) }}.</p>
                                    <a href="{{ route('detail-stories', ['slug' => $item->slug]) }}" class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Read more
                                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-full md:w-4/12 self-start sticky top-0 mt-20">
                <div class="p-5">

                    <div class="flex flex-col">

                        <div class="">
                            <h5 class="text-xl font-bold">My Stories</h5>
                            @foreach ($my_stories as $item)
                            <div class="flex flex-col mt-5">
                                <div class="bg-white rounded-lg border border-gray-200">
                                    <div class="flex flex-wrap">
                                        <div class="w-full md:w-4/12">
                                            <a href="#">
                                                <img class="rounded-t-lg fit" src="{{ $item->image ? url('storage/' . $item->image) : asset('image/pexels-alexas-fotos-2255441.jpg')}}" alt="{{ $item->title }}">
                                            </a>
                                        </div>
                                        <div class="w-full md:w-8/12">
                                            <div class="p-5">
                                                <h5 class="text-xl font-bold tracking-tighter">{{ Str::limit($item->title, 50) }}</h5>
                                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 mt-5">{{ Str::limit($item->short_content, 50) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-10">
                            <h5 class="text-xl font-bold mb-5">Categoriess</h5>
                            <div class="flex flex-wrap">
                                @foreach ($categories as $item)
                                    <input type="hidden" name="category_id" value="{{$item->id}}">
                                    <button type="submit" class="bg-blue-100 text-blue-800 text-md font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">{{$item->name}}</button>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</form>
@endsection
