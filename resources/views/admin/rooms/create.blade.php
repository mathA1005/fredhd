@extends('admin.layout')
@section('content')
    <x-rooms.Form_create :roomOptions="$roomOptions" />
@endsection
