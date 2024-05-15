@extends('admin.layout')
@section('content')

    <div class="container">
        <h1>Rooms</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Label</th>
                <th>Description</th>
                <th>Options</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($rooms as $room)
                <tr>
                    <td>{{ $room->label }}</td>
                    <td>{{ $room->description }}</td>
                    <td>
                        @foreach ($room->roomOptions as $option)
                            <span>{{ $option->name }}: {{ $option->pivot->value }}</span><br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-primary">Edit</a>

            @endforeach
            </tbody>
        </table>

        {{ $rooms->links() }}
    </div>
@endsection
