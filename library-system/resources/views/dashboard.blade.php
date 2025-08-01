@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    @hasanyrole('admin|librarian')
                        <div class="mt-4">
                            Hello Sir, You Can Manage The Library.
                        </div>
                    @endhasanyrole
                </div>
            </div>
        </div>
    </div>
@endsection
