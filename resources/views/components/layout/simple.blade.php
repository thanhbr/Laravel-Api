<!DOCTYPE html>
<html class="loading"  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('meta')
    <title>@yield('page-title', 'TekTop')</title>
    @livewireStyles
    <link href="{{url('theme/css/app.css')}}" rel="stylesheet">
    @stack('css')
  </head>

  <body {{ $attributes }} >
    @yield('header')
    @yield('body')
    @yield('footer')
    @stack('outer')
    <x-script />
    <script src="{{asset('theme/js/summernote/summernote.js')}}" ></script>
    <script src="{{asset('theme/js/extensions/toastr.min.js')}}" ></script>
    <script src="{{asset('theme/js/pickers/dateTime/moment-with-locales.min.js')}}" ></script>
    <script src="{{asset('theme/js/pickers/dateTime/bootstrap-datetimepicker.min.js')}}" ></script>
    <script src="{{asset('theme/js/pickers/pickadate/picker.js')}}" ></script>
    <script src="{{asset('theme/js/pickers/pickadate/picker.date.js')}}" ></script>
    <script src="{{asset('theme/js/pickers/pickadate/picker.time.js')}}" ></script>
    <script src="{{asset('theme/js/forms/select/select2.full.min.js')}}" ></script>
    @livewireScripts
    @stack('script')

  </body>
</html>
