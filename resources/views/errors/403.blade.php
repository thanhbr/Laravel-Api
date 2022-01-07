@extends('layouts.app')

@section('template_title', __('Forbidden'))
@section('code', '403')
@section('content')
	<div class="alert alert-info">
		<span>Chúng tôi có thể giúp gì cho bạn ? </span>
	</div>
		<hr>
		<a href="/">Trở về trang chính</a>
@endsection
