<div class="container mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Liste des FAQs</h1>
        <a href="{{ route('admin.faqs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter une FAQ</a>
    </div>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white">
        <thead>
        <tr>
            <th class="py-2">Question</th>
            <th class="py-2">Réponse</th>
            <th class="py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($faqs as $faq)
            <tr>
                <td class="border px-4 py-2">{{ $faq->question }}</td>
                <td class="border px-4 py-2">{{ $faq->answer }}</td>
                <td class="border px-4 py-2 flex space-x-2">
                    <a href="{{ route('admin.faqs.edit', $faq->id) }}"
                       class="bg-yellow-500 text-white px-4 py-2 rounded">Modifier</a>
                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
