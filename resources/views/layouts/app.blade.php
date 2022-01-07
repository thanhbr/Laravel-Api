@extends('layouts.default')
@section('css')
    @parent
    <style>
        .container {width: 100%!important; padding: 10px}
        .container .card .btn{max-width: 160px;}
        #post_card {padding: 0 1.5rem}
        #post_card .card-header{padding: 1.5rem .5rem}
        #post_card .card-body .row{max-width: 1140px;}
        #post_card .card-body .form-group {padding: 0px 10px}
        #post_card .card-body .form-control {max-width: 600px;}
        #post_card .card-footer{

        }
        #post_card .card-footer .btn{
            max-width: 160px;
        }
        #post_card .select2.select2-container{min-width: 200px;}
    </style>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#post_card select').select2();
        });
    </script>
@endsection
