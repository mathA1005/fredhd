@extends('layouts.main')
@section('content')

    <x-rooms.card_show :room="$room" :roomOptions="$room->roomOptions" />

@endsection
