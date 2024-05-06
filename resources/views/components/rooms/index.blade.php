@props(['rooms'])

<div class="container mx-auto">
    @foreach ($rooms as $room)
        <x-rooms.card
            id="{{ $room->id }}"
            picture="{{ $room->photo }}"
            room_name="{{ $room->nom }}"
            area="120"
            nb_person="2"
            options="{{ json_encode($room->equipements) }}"
            room_description="{{ Str::limit($room->description, 150) }}"
            status="true"
        />
    @endforeach
</div>
