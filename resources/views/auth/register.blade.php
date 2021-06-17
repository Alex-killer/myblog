@extends('layouts.blog')

@section('title', 'Регистрация')

@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
        </x-slot>

        <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="card-body">
                                    <div >
                                        <x-label for="name" :value="__('Name')" />

                                        <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
                                    </div>

                                <!-- Email Address -->
                                    <div class="mt-3">
                                        <x-label for="email" :value="__('Email')" />

                                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                                    </div>

                                <!-- Password -->
                                    <div class="mt-3">
                                        <x-label for="password" :value="__('Password')" />

                                        <x-input id="password" class="form-control"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="new-password" />
                                    </div>

                                <!-- Confirm Password -->
                                    <div class="mt-3">
                                        <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                        <x-input id="password_confirmation" class="form-control"
                                                        type="password"
                                                        name="password_confirmation" required />
                                    </div>
                                    <div class="block mt-3">
                                        <div class="d-grid gap-2 d-md-flex">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>

                                        <x-button class="btn btn-primary">
                                            {{ __('Register') }}
                                        </x-button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </x-auth-card>
</x-guest-layout>
@endsection
