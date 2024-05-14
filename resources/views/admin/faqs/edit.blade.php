<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Modifier une FAQ</h1>
    <form action="{{ route('admin.faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="question" class="block text-gray-700">Question</label>
            <input type="text" name="question" id="question" class="mt-2 p-2 border border-gray-300 rounded w-full"
                   value="{{ old('question', $faq->question) }}">
            @error('question')
            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="answer" class="block text-gray-700">Réponse</label>
            <textarea name="answer" id="answer"
                      class="mt-2 p-2 border border-gray-300 rounded w-full">{{ old('answer', $faq->answer) }}</textarea>
            @error('answer')
            <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Mettre à jour</button>
    </form>
</div>
