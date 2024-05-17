@extends('admin.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Tous les Contacts</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <form action="{{ route('admin.contacts.index') }}" method="GET" class="mb-4">
                <div class="flex items-center mb-4">
                    <label for="search" class="mr-2">Rechercher par nom:</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" class="border rounded p-2 mr-4">
                    <label for="status" class="mr-2">Filtrer par statut:</label>
                    <select name="status" id="status" class="border rounded p-2 mr-4">
                        <option value="">Tous</option>
                        <option value="untreated" {{ request('status') == 'untreated' ? 'selected' : '' }}>Untreated</option>
                        <option value="in process" {{ request('status') == 'in process' ? 'selected' : '' }}>In process</option>
                        <option value="treated" {{ request('status') == 'treated' ? 'selected' : '' }}>Treated</option>
                        <option value="close" {{ request('status') == 'close' ? 'selected' : '' }}>Close</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filtrer</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-md p-4">
            <table class="table-auto w-full">
                <thead>
                <tr>
                    <th class="px-4 py-2">Prénom</th>
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Téléphone</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Statut</th>
                    <th class="px-4 py-2">
                        <a href="{{ route('admin.contacts.index', ['sort' => 'created_at', 'order' => ($sort == 'created_at' && $order == 'asc') ? 'desc' : 'asc']) }}">
                            Date
                            @if ($sort == 'created_at')
                                @if ($order == 'asc')
                                    &#9650; <!-- Ascending -->
                                @else
                                    &#9660; <!-- Descending -->
                                @endif
                            @endif
                        </a>
                    </th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $contact)
                    @php
                        $rowClass = '';
                        switch ($contact->status) {
                            case 'untreated':
                                $rowClass = 'bg-red-100';
                                break;
                            case 'in process':
                                $rowClass = 'bg-yellow-100';
                                break;
                            case 'treated':
                                $rowClass = 'bg-blue-100';
                                break;
                            case 'close':
                                $rowClass = 'bg-green-100';
                                break;
                        }
                    @endphp
                    <tr class="{{ $rowClass }}">
                        <td class="border px-4 py-2">{{ $contact->first_name }}</td>
                        <td class="border px-4 py-2">{{ $contact->last_name }}</td>
                        <td class="border px-4 py-2">{{ $contact->email }}</td>
                        <td class="border px-4 py-2">{{ $contact->phone }}</td>
                        <td class="border px-4 py-2">{{ $contact->description }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('admin.contacts.updateStatus', $contact->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="untreated" {{ $contact->status == 'untreated' ? 'selected' : '' }}>Untreated</option>
                                    <option value="in process" {{ $contact->status == 'in process' ? 'selected' : '' }}>In process</option>
                                    <option value="treated" {{ $contact->status == 'treated' ? 'selected' : '' }}>Treated</option>
                                    <option value="close" {{ $contact->status == 'close' ? 'selected' : '' }}>Close</option>
                                </select>
                            </form>
                        </td>
                        <td class="border px-4 py-2">{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        <td class="border px-4 py-2">
                            <a href="mailto:{{ $contact->email }}?subject=Re: Votre demande" class="bg-blue-500 text-white px-4 py-2 rounded">Répondre</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
