@props(['stepNumber', 'room' => null, 'roomOptions' => null])

@switch($stepNumber)
    @case(1)
    <div class="p-4 grid grid-cols-4 gap-x-9 items-center border border-solid border-gray-200 rounded-xl">
        <h3 class="text-gray-800 dark:text-neutral-800 col-span-4 py-8 text-center">
            Plus que quelques détails supplémentaires pour confirmer votre réservation
        </h3>
        <x-form.input type="hidden" name="room" value="{{ $room->id }}"/>
        <div class="space-y-3">
            <x-form.input type="number" name="nb_person" label="nombre de personnes" placeholder="test"/>
        </div>
        <div class="space-y-3">
            <x-form.input type="text" name="dates" label="Date de la réservation" placeholder="test" id="daterange"/>
        </div>
    </div>
    @break
    @case(2)
    <div class="p-4 gap-x-9 items-center border border-solid border-gray-200 rounded-xl">
        <h3 class="text-gray-800 dark:text-neutral-800 col-span-4 py-8 text-center">
            Veuillez sélection les options que vous voulez dans votre chambre
        </h3>
        <div class="grid grid-cols-4 w-1/2 mx-auto">
            @foreach($roomOptions as $roomOption)
                <x-form.checkbox name="roomOptions[]" value="{{$roomOption->id}}" label="{{$roomOption->label}}" icon="{{ $roomOption->icon }}"/>
            @endforeach
        </div>
    </div>
    @break
@endswitch
