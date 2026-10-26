@if($message)
    <div class="mb-4 flex items-start gap-3 rounded-lg p-4 text-sm font-medium ring-1 {{ \App\View\Components\Alert::styles($type) }}"
         role="alert" x-data="{ show: true }" x-show="show" x-transition.opacity>
        <svg class="h-5 w-5 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                  clip-rule="evenodd"></path>
        </svg>
        <div class="flex-1">{{ $message }}</div>
        <button type="button" class="-m-1 rounded-md p-1 opacity-60 transition hover:opacity-100"
                x-on:click="show = false">
            <span class="sr-only">{{ __('message.dismiss') }}</span>
            <svg aria-hidden="true" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
@endif
