@extends('layouts.app')

@php
    $title = "stories";
@endphp

@section('title', 'Edit '.Str::headline($title).' ')

@section('content')
<x-card-crud>

    <x-slot name="header">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Edit {{ Str::headline($title) }}</h5>
    </x-slot>

    <div class="">
        @include('admin.'.$title.'.__fields')
    </div>
</x-card-crud>