@extends('layouts.main')
@section('content')
    <x-rooms.header/>

    <div class="max-w-5xl mx-auto px-4">
        <x-rooms.index :rooms="$rooms"/>
    </div>

@endsection
