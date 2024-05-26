@extends('admin.layout')

@section('content')
    <div class="max-w-lg mx-auto">
        <form action="{{ route('admin.reservation.storeFromAdmin') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <h1 class="text-2xl font-bold mb-4">Client déjà existant</h1>
            <select name="user_id" class="mb-4">
                <option value="" selected="selected">Non</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <span class="text-2xl font-bold my-4 block">OU</span>
            <hr>
            <h1 class="text-2xl font-bold mb-4">Créer un nouveau client</h1><br>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nom et prénom
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" placeholder="Nom et prénom">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" name="email" placeholder="Email">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="room_id">
                    Nom de la chambre
                </label>
                <select name="room_id" id="room_id" class="w-full py-2 px-3 border rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" data-reservations="{{ json_encode($room->reservations) }}">{{ $room->label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="dates">
                    Date de la réservation
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="dates" id="datepicker" placeholder="Sélectionner une date">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Créer
                </button>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
    <script type="text/javascript">
        $(function() {
            const DateTime = easepick.DateTime;

            function createDatePicker(reservations) {
                const bookedDates = reservations.map(reservation => [
                    new DateTime(reservation.start_date, 'YYYY-MM-DD'),
                    new DateTime(reservation.end_date, 'YYYY-MM-DD')
                ]);

                if (window.picker) {
                    window.picker.destroy();
                }

                window.picker = new easepick.create({
                    element: document.getElementById('datepicker'),
                    css: ['https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css'],
                    plugins: ['RangePlugin', 'LockPlugin'],
                    RangePlugin: {
                        tooltipNumber(num) {
                            return num - 1;
                        },
                        locale: {
                            one: 'nuit',
                            other: 'nuits',
                        },
                    },
                    LockPlugin: {
                        minDate: new Date(),
                        minDays: 2,
                        inseparable: true,
                        filter(date, picked) {
                            if (picked.length === 1) {
                                const incl = date.isBefore(picked[0]) ? '[)' : '(]';
                                return !picked[0].isSame(date, 'day') && date.inArray(bookedDates, incl);
                            }
                            return date.inArray(bookedDates, '[)');
                        },
                    },
                    setup(picker) {
                        picker.on('select', (evt) => {
                            const startDate = evt.detail.start;
                            const endDate = evt.detail.end;
                            const nightsCount = endDate.diff(startDate, 'days');

                            document.getElementById('nightsCount').value = nightsCount;
                        });
                    }
                });
            }

            $('#room_id').on('change', function() {
                const selectedRoom = $(this).find(':selected');
                const reservations = selectedRoom.data('reservations');
                createDatePicker(reservations);
            });

            // Initial load
            const initialReservations = $('#room_id').find(':selected').data('reservations');
            createDatePicker(initialReservations);
        });
    </script>
@endsection
