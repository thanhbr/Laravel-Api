<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            @hasSection('template_title')
                @yield('template_title') | 
            @endif {{ config('app.name', Lang::get('titles.app')) }}
        </title>
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="/favicon.ico">
        {{-- Fonts --}}
        @yield('fonts')
        {{-- Style --}}
        @yield('css')
        @yield('css-theme')
        {{-- Javascript --}}
        @yield('script-head')
    </head>
    @yield('body')
</html>
