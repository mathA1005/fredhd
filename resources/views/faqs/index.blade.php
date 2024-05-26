@extends('layouts.main')

@section('content')
        <x-faqs.header/>
<x-faqs.form :faqs="$faqs"/>
@endsection
