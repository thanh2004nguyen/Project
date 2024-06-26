@extends('layouts.app')
@section('title', 'View Product')
@section('content')


    @include('profile.partials.update-profile-information-form')

    @if (!(Auth::user()->provider))
        @include('profile.partials.update-password-form')
    @endif
    {{-- @include('profile.partials.delete-user-form') --}}
    {{-- <div class="">
        <div class="">
            <div class="">
                <div class="">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800  sm:rounded-lg">
                <div class="max-w-xl">
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800  sm:rounded-lg">
                <div class="max-w-xl">
                </div>
            </div>
        </div>
    </div> --}}

@endsection
