@props(['type', 'message'])

@switch($type)
    @case('success')
    <div class="max-w-xs bg-teal-100 border border-teal-200 text-sm text-teal-800 rounded-lg dark:bg-teal-800/10 dark:border-teal-900 dark:text-teal-500 shadow-lg transition-transform transform duration-300 ease-in-out translate-y-0" role="alert">
        <div class="flex p-4">
            <svg class="flex-shrink-0 w-5 h-5 text-teal-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="ml-3">{{ Session::get('success') }}</span>
        </div>
    </div>
    @break
    @case('error')
    <div id="dismiss-toast" class="max-w-xs bg-red-100 border border-red-200 text-sm text-red-800 rounded-lg dark:bg-red-800/10 dark:border-red-900 dark:text-red-500 shadow-lg transition-transform transform duration-300 ease-in-out translate-y-0" role="alert">
        <div class="flex p-4">
            <svg class="flex-shrink-0 w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="ml-3">{{ Session::get('error') }}</span>
            <div class="ml-auto">
                <button type="button" class="inline-flex items-center justify-center w-5 h-5 text-gray-800 opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100" data-hs-remove-element="#dismiss-toast">
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @break
@endswitch
