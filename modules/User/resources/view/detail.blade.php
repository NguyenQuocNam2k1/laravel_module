@extends('layouts.client')
@section('title' , 'Chi tiet nguoi dung')
@section('content')
    <h1>{{trans('User::custom.title', ['name' => 'DEMO'])}} : {{$id}}</h1>  
    {{-- Hàm tran sẽ tự gọi đến file customer.php trong folder lang/en --}}
@endsection