@extends('admin.layout')
@section('content')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Liste des Réservations</h1>

        <!-- Barre de recherche -->
        <form method="GET" action="{{ route('admin.index') }}" class="mb-4">
            <div class="flex items-center gap-4 mb-4">
                <input type="text" name="search" placeholder="Rechercher par nom de chambre ou d'utilisateur"
                       value="{{ request('search') }}"
                       class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                       class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring">
                    Rechercher
                </button>
                <a href="{{ route('admin.index', array_merge(request()->query(), ['next_7_days' => 'true'])) }}"
                   class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600 focus:outline-none focus:ring">
                    Réservations des 7 prochains jours
                </a>
            </div>
            <div class="px-4 py-2 bg-blue-500 text-white w-1/4 rounded-md text-center inline hover:bg-blue-600">
                <a href="{{ route('admin.reservation.createFromAdmin') }}">Créer une nouvelle réservation</a>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <a href="{{ route('admin.index', array_merge(request()->query(), ['sort_by' => 'room_id', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                            ID Chambre
                            @if (request('sort_by') == 'room_id')
                                @if (request('order') == 'asc')
                                    &#9650;
                                @else
                                    &#9660;
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        Nom Chambre
                    </th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <a href="{{ route('admin.index', array_merge(request()->query(), ['sort_by' => 'user_name', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                            Utilisateur
                            @if (request('sort_by') == 'user_name')
                                @if (request('order') == 'asc')
                                    &#9650;
                                @else
                                    &#9660;
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <a href="{{ route('admin.index', array_merge(request()->query(), ['sort_by' => 'start_date', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                            Date de Début
                            @if (request('sort_by') == 'start_date')
                                @if (request('order') == 'asc')
                                    &#9650;
                                @else
                                    &#9660;
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <a href="{{ route('admin.index', array_merge(request()->query(), ['sort_by' => 'end_date', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}">
                            Date de Fin
                            @if (request('sort_by') == 'end_date')
                                @if (request('order') == 'asc')
                                    &#9650;
                                @else
                                    &#9660;
                                @endif
                            @endif
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reservations as $reservation)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $reservation->room->id ?? 'ID non disponible' }}</td>
                        <td class="px-4 py-2">{{ $reservation->room->label ?? 'Chambre non spécifiée' }}</td>
                        <td class="px-4 py-2">{{ $reservation->user->name }}</td>
                        <td class="px-4 py-2">{{ $reservation->start_date ? $reservation->start_date->format('Y-m-d') : 'Date non disponible' }}</td>
                        <td class="px-4 py-2">{{ $reservation->end_date ? $reservation->end_date->format('Y-m-d') : 'Date non disponible' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
