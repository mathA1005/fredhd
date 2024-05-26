@extends('layouts.main')
@section('content')

    <h1>Réservation</h1>

    <!-- Stepper -->
    <div data-hs-stepper="">
        <!-- Stepper Nav -->
        <ul class="relative flex flex-row gap-x-2">
            <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group" data-hs-stepper-nav-item='{"index": 1}'>
                <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                    <span class="size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 hs-stepper-active:bg-blue-600 hs-stepper-active:text-white hs-stepper-success:bg-blue-600 hs-stepper-success:text-white hs-stepper-completed:bg-teal-500 hs-stepper-completed:group-focus:bg-teal-600 dark:bg-neutral-700 dark:text-white dark:group-focus:bg-gray-600 dark:hs-stepper-active:bg-blue-500 dark:hs-stepper-success:bg-blue-500 dark:hs-stepper-completed:bg-teal-500 dark:hs-stepper-completed:group-focus:bg-teal-600">
                        <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">1</span>
                        <svg class="hidden flex-shrink-0 size-3 hs-stepper-success:block" xmlns="http://www.w3.org/2000/svg"
                             width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                             stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </span>
                    <span class="ms-2 text-sm font-medium text-gray-800 dark:text-neutral-200">Step 1</span>
                </span>
                <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-blue-600 hs-stepper-completed:bg-teal-600 dark:bg-neutral-700 dark:hs-stepper-success:bg-blue-600 dark:hs-stepper-completed:bg-teal-600"></div>
            </li>
            <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group" data-hs-stepper-nav-item='{"index": 2}'>
                <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                    <span class="size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 hs-stepper-active:bg-blue-600 hs-stepper-active:text-white hs-stepper-success:bg-blue-600 hs-stepper-success:text-white hs-stepper-completed:bg-teal-500 hs-stepper-completed:group-focus:bg-teal-600 dark:bg-neutral-700 dark:text-white dark:group-focus:bg-gray-600 dark:hs-stepper-active:bg-blue-500 dark:hs-stepper-success:bg-blue-500 dark:hs-stepper-completed:bg-teal-500 dark:hs-stepper-completed:group-focus:bg-teal-600">
                        <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">2</span>
                        <svg class="hidden flex-shrink-0 size-3 hs-stepper-success:block" xmlns="http://www.w3.org/2000/svg"
                             width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                             stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </span>
                    <span class="ms-2 text-sm font-medium text-gray-800 dark:text-neutral-200">Step 2</span>
                </span>
                <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-blue-600 hs-stepper-completed:bg-teal-600 dark:bg-neutral-700 dark:hs-stepper-success:bg-blue-600 dark:hs-stepper-completed:bg-teal-600"></div>
            </li>
        </ul>
        <!-- End Stepper Nav -->

        <!-- Stepper Content -->
        <form action="{{ route('reservation.store') }}" method="post">
            @csrf
            <div class="mt-5 sm:mt-8">
                <!-- First Content -->
                <div data-hs-stepper-content-item='{"index": 1 }'>
                    <x-reservation.step-card :stepNumber="1" :room="$room"/>
                </div>
                <!-- End First Content -->

                <!-- Second Content -->
                <div data-hs-stepper-content-item='{"index": 2}' style="display: none;">
                    <x-reservation.step-card :stepNumber="2" :room="$room"/>
                </div>
                <!-- End Second Content -->

                <!-- Button Group -->
                <div class="mt-5 flex justify-between items-center gap-x-2">
                    <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-stepper-back-btn="">
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6"></path>
                        </svg>
                        Précédent
                    </button>
                    <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-stepper-next-btn="">
                        Suivant
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </button>
                    <button type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            data-hs-stepper-finish-btn="" style="display: none;">
                        Confirmer
                    </button>
                </div>
                <!-- End Button Group -->
            </div>
        </form>
        <!-- End Stepper Content -->
    </div>
    <!-- End Stepper -->

    <!-- Inclure DateRangePicker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript">

        $(function() {
            // Récupérer les dates de réservation depuis le serveur
            const reservations = @json($reservations);

            // Transformer les dates de réservation en tableau de dates invalides pour les dates de séjour (excluant les dates de départ et d'arrivée)
            const invalidDates = reservations.map(reservation => {
                const startDate = moment(reservation.start_date, 'YYYY-MM-DD').add(1, 'days');
                const endDate = moment(reservation.end_date, 'YYYY-MM-DD').subtract(1, 'days');
                const dates = [];
                while (startDate <= endDate) {
                    dates.push(startDate.clone().format('DD/MM/YYYY'));
                    startDate.add(1, 'days');
                }
                return dates;
            }).flat();

            const departureDates = reservations.map(reservation => moment(reservation.end_date, 'YYYY-MM-DD').format('DD/MM/YYYY'));
            const arrivalDates = reservations.map(reservation => moment(reservation.start_date, 'YYYY-MM-DD').format('DD/MM/YYYY'));

            $('input[name="dates"]').daterangepicker({
                minDate: moment(),
                isInvalidDate: function(date) {
                    return invalidDates.includes(date.format('DD/MM/YYYY'));
                },
                isCustomDate: function(date) {
                    if (departureDates.includes(date.format('DD/MM/YYYY')) || arrivalDates.includes(date.format('DD/MM/YYYY'))) {
                        return 'barred-date';
                    }
                    return '';
                },
                locale: {
                    autoApply: true,
                    applyLabel: "Appliquer",
                    cancelLabel: "Annuler",
                    fromLabel: "De",
                    toLabel: "À",
                    format: "DD/MM/YYYY",
                    daysOfWeek: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
                    monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                    firstDay: 1
                }
            });

            $('<style>')
                .prop('type', 'text/css')
                .html(`
                .barred-date {
    background-color: #d3d3d3 !important; /* Gris */
    color: #000000 !important; /* Noir */
    text-decoration: line-through !important; /* Barré */
}
                }
            `)
                .appendTo('head');

            $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
                const startDate = picker.startDate;
                const endDate = picker.endDate;
                const roomPricePerNight = {{ $room->price_per_night }};
                const nights = endDate.diff(startDate, 'days');
                const totalPrice = roomPricePerNight * nights;

                $('#nightsCount').val(nights + ' nuits');
                $('#totalPrice').val(totalPrice + ' €');
            });
        });
    </script>

@endsection
