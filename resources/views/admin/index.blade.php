@extends('admin.layout')
@section('content')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Liste des Réservations</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">ID Chambre</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Nom Chambre</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Utilisateur</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Date de Début</th>
                    <th class="py-2 px-4 border-b-2 border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Date de Fin</th>
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
