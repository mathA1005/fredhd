@extends('admin.layout')
@section('content')
    <div class="container">
        <h1>Editer la chambre</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="label">Nom de la chambre :</label>
                <input type="text" name="label" class="form-control" value="{{ old('label', $room->label) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" class="form-control" required>{{ old('description', $room->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price_per_night">Prix par nuit (€) :</label>
                <input type="number" name="price_per_night" class="form-control" step="0.01" value="{{ old('price_per_night', $room->price_per_night) }}" required>
            </div>

            <div class="form-group">
                <label for="picture">Photo :</label>
                @if($room->picture)
                    <div>
                        <img src="{{ Storage::url($room->picture) }}" alt="Photo actuelle" width="200">
                    </div>
                @endif
                <input type="file" name="picture" class="form-control">
            </div>

            <div class="form-group">
                <label for="roomOptions">Options de la chambre :</label>
                @foreach($roomOptions as $option)
                    <div class="form-check">
                        <input type="checkbox" name="roomOptions[]" value="{{ $option->id }}" class="form-check-input" id="option-{{ $option->id }}"
                               @if(in_array($option->id, array_keys($roomOptionsValues))) checked @endif>
                        <label class="form-check-label" for="option-{{ $option->id }}">{{ $option->label }}</label>
                        <input type="text" name="roomOptionsValues[{{ $option->id }}]" class="form-control" value="{{ $roomOptionsValues[$option->id] ?? '' }}" placeholder="Valeur">
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour la chambre</button>
        </form>
    </div>
@endsection
