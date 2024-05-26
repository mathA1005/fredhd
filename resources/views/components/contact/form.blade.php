<!-- Contact Us -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="mt-12 max-w-lg mx-auto">
        <!-- Card -->
        <div class="flex flex-col border rounded-xl p-4 sm:p-6 lg:p-8 dark:border-neutral-700">
            <form method="POST" action="/contact">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="grid gap-4 lg:gap-6">
                    <!-- Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm text-gray-700 font-medium ">Prénom</label>
                            <input type="text" id="first_name" name="first_name" required class="py-3 px-4 block w-full  rounded-lg text-sm ">
                        </div>

                        <div>
                            <label for="last_name" class="block mb-2 text-sm text-gray-700 font-medium ">Nom</label>
                            <input type="text" id="last_name" name="last_name" required class="py-3 px-4 block w-full  rounded-lg text-sm ">
                        </div>
                    </div>
                    <!-- End Grid -->

                    <!-- Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:gap-6">
                        <div>
                            <label for="email" class="block mb-2 text-sm text-gray-700 font-medium ">Email</label>
                            <input type="email" id="email" name="email" required class="py-3 px-4 block w-full  rounded-lg text-sm ">
                        </div>

                        <div>
                            <label for="phone" class="block mb-2 text-sm text-gray-700 font-medium ">Téléphone</label>
                            <input type="text" id="phone" name="phone" class="py-3 px-4 block w-full  rounded-lg text-sm ">
                        </div>
                    </div>
                    <!-- End Grid -->

                    <div>
                        <label for="description" class="block mb-2 text-sm text-gray-700 font-medium ">Description</label>
                        <textarea id="description" name="description" required rows="4" class="py-3 px-4 block w-full  rounded-lg text-sm "></textarea>
                    </div>
                </div>
                <!-- End Grid -->

                <div class="mt-6 grid">
                    <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">Soumettre</button>
                </div>

                <div class="mt-3 text-center">
                    <p class="text-sm text-gray-500 dark:text-neutral-500">
                        Nous vous répondrons dans 1-2 jours ouvrables.
                    </p>
                </div>
                @if(session('success'))
                    <div class="mt-3 text-center text-green-600">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>
        <!-- End Card -->
    </div>


    <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 items-center gap-4 lg:gap-8">
        <!-- Example links or blocks can go here, if needed -->
    </div>

</div>
<!-- End Contact Us -->
