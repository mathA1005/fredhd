@props(['rooms'])

<div class="container mx-auto">
    @foreach ($rooms as $room)
        <a href="{{ route('chambre.show', ['id' => $room->id]) }}" class="block">
            <x-rooms.card
                id="{{ $room->id }}"
                picture="{{ $room->picture }}"
                room_name="{{ $room->label }}"
                area="120"
                nb_person="2"
                options="{{ json_encode($room->equipements) }}"
                room_description="{{ Str::limit($room->description, 150) }}"
                status="true"
            />
        </a>
    @endforeach
</div>
