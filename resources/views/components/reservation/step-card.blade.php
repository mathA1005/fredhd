@switch($stepNumber)
    @case(1)
    <div class="p-4 grid grid-cols-4 gap-x-9 items-center border border-solid border-gray-200 rounded-xl">
        <h3 class="text-gray-800 dark:text-neutral-800 col-span-4 py-8 text-center">
            Plus que quelques détails supplémentaires pour confirmer votre réservation
        </h3>
        <x-form.input type="hidden" name="room" value="{{ $room->id }}"/>
        <div class="space-y-3">
            <x-form.input type="number" name="nb_person" label="nombre de personnes" placeholder="Nombre de personnes"/>
        </div>
        <div class="space-y-3">
            <x-form.input type="text" name="dates" label="Date de la réservation" placeholder="Dates de réservation" id="daterange"/>
        </div>
    </div>
    @break
    @case(2)
    <div class="p-4 grid grid-cols-4 gap-x-9 items-center border border-solid border-gray-200 rounded-xl">
        <h3 class="text-gray-800 dark:text-neutral-800 col-span-4 py-8 text-center">
            Détails de votre réservation
        </h3>
        <div class="space-y-3 col-span-2">
        </div>
        <div class="space-y-3 col-span-2">
            <x-form.input type="text" id="nightsCount" name="nightsCount" label="Nombre de nuits" readonly/>
        </div>
        <div class="space-y-3 col-span-4">
            <x-form.input type="text" id="totalPrice" name="totalPrice" label="Prix total" readonly/>
        </div>
    </div>
    @break
@endswitch
