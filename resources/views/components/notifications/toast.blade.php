@props(['type', 'message'])

@switch($type)
    @case('success')
    <div class="max-w-xs bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500" role="alert">
        <div class="flex p-4">
            {{ Session::get('success') }}
        </div>
    </div>
    @break
    @case('error')
    <div id="dismiss-toast"
         class="max-w-xs bg-red-100 border border-red-200 text-sm text-red-800 rounded-lg dark:bg-red-800/10 dark:border-red-900 dark:text-red-500"
         role="alert">
        <div class="flex p-4">
            {{ Session::get('error') }}
            <div class="ms-auto">
                <button type="button"
                        class="inline-flex flex-shrink-0 justify-center items-center size-5 rounded-lg text-gray-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100"
                        data-hs-remove-element="#dismiss-toast">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @break
@endswitch

