@extends('admin.layout')
@section('content')

<div class="max-w-lg mx-auto">
    <form action="{{ route('admin.reservation.storeFromAdmin') }}" method="POST" enctype="multipart/form-data"
          class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <h1 class="text-2xl font-bold mb-4">Client déjà existant</h1>
        <select name="user_id">
            <option value="" selected="selected">Non</option>
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <span class="text-2xl font-bold my-4 block">OU</span>
        <hr>
        <h1 class="text-2xl font-bold mb-4">Créer un nouveau client</h1><br>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="label">
                Nom et prénom
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="label" type="text" name="name" placeholder="Nom de la chambre">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="label">
                Email
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="label" type="email" name="email" placeholder="Nom de la chambre">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="label">
                Nom de la chambre
            </label>
            <select name="room_id">
                @foreach($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->label }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <x-form.input type="text" name="dates" label="Date de la réservation" placeholder="test"
                          id="daterange"/>
        </div>
        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Créer
            </button>
        </div>
    </form>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
<script type="text/javascript">
    // $().isInvalidDate({
    //     "19-05-2024",
    // });
    $('input[name="dates"]').daterangepicker({
        minDate: moment(),
        isInvalidDate: function (date) {
            console.log(date);
            if (date === "19/05/2024") {
                return true;
                console.log("test");
                // return true;
            }
        },
        "locale":
            {
                "autoApply": true,
                "applyLabel": "Appliquer",
                "cancelLabel": "Annuler",
                "fromLabel": "DE",
                "toLabel": "A",
                "format": "DD/MM/YYYY",
                "daysOfWeek": [
                    "Di",
                    "Lu",
                    "Ma",
                    "Me",
                    "Je",
                    "Ve",
                    "Sa"
                ],
                "monthNames": [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"
                ],
                "firstDay": 1
            }
    });
</script>
@endsection
