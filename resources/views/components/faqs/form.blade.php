<!-- FAQ -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Title -->
    <div class="max-w-2xl mx-auto mb-10 lg:mb-14">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">You might be wondering...</h2>
    </div>
    <!-- End Title -->

    <div class="max-w-2xl mx-auto divide-y divide-gray-200 dark:divide-neutral-700">
        @foreach ($faqs as $faq)
            <div class="py-8 first:pt-0 last:pb-0">
                <div class="flex gap-x-5">
                    <svg class="flex-shrink-0 mt-1 size-6 text-gray-500 dark:text-neutral-500"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                        <path d="M12 17h.01"/>
                    </svg>

                    <div>
                        <h3 class="md:text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            {{ $faq->question }}
                        </h3>
                        <p class="mt-1 text-gray-500 dark:text-neutral-500">
                            {{ $faq->answer }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- End FAQ -->
