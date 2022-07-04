@extends('layouts.guest')

@section('title', 'Login ')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center items-center min-h-screen">
            <div class="w-full md:w-4/12 lg:w-3/12">
                <div class="bg-white shadow-md rounded-md p-10">
                    <h5 class="text-center text-2xl font-bold">Login</h5>
                    <div class="mt-5">
                        <x-validation-error class="mb-4" />
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <x-input-group type="email" name="email" required autofocus/>
                            <x-input-group type="password" name="password" required/>
                            
                            <div class="flex justify-center flex-col mt-7">
                                <x-btn type="submit">
                                    Login
                                </x-btn>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection