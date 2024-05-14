@extends('layouts.main')

@section('content')
    <x-rooms.Form_create :roomOptions="$roomOptions" />
@endsection
