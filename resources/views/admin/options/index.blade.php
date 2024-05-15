@extends('admin.layout')
@section('content')

<body>
<h1>Admin - Options de Salle</h1>
<ul>
    @foreach ($roomOptions as $option)
        <li>{{ $option->label }} ({{ $option->icon }})</li>
    @endforeach
</ul>
<a href="{{ route('admin.options.create') }}">Ajouter une nouvelle option</a>
</body>
@endsection

