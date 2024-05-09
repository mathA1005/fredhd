@extends('layouts.main')
@section('content')
    <h1>Nos Chambres</h1>
    <x-rooms.index :rooms="$chambres"/>

@endsection
