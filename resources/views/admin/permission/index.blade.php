@extends('layouts.app')

@php
    $title = "permission";
@endphp

@section('title', Str::headline($title).' ')

@section('content')
<x-card-crud>

    <x-slot name="header">
        <x-card-crud-index-header :title="$title"></x-card-crud-index-header>
    </x-slot>

    
    <div class="main-table mt-10">
        <table>
            <thead>
                <tr class="bg-slate-900 text-white">
                    <th>#</th>
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Last Modified</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model as $model_key => $model_value)
                <tr>
                    <td>{{ $model_key + 1 }}</td>
                    <td>{{ $model_value->name }}</td>
                    <td>{{ $model_value->created_at->diffForHumans() }}</td>
                    <td>{{ $model_value->updated_at->diffForHumans() }}</td>
                    {{-- <td>
                        <x-btn-link href="{{ route('admin.'.$title.'.show', $model_value) }}" class="bg-gradient-to-br from-cyan-500 to-teal-500 hover:from-teal-500 hover:to-cyan-500 w-auto">Detail</x-btn-link>
                        <x-btn-link class="bg-gradient-to-br from-amber-500 to-orange-500 hover:from-amber-500 hover:to-orange-500" href="{{ route('admin.'.$title.'.edit', $model_value) }}" >Edit</x-btn-link>
                        <x-btn-link class="bg-gradient-to-br from-red-500 to-rose-500 hover:from-rose-500 hover:to-red-500" href="#" data-modal-toggle="modal-{{$model_value->id}}">Delete</x-btn-link>
                        <x-modal-delete id="{{$model_value->id}}" route="{{ route('admin.'.$title.'.destroy', $model_value)}}" />
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-10">
            {{ $model->links() }}
        </div>
    </div>

</x-card-crud>

@endsection 