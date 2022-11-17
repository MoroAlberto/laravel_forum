@if($message)
    <div id="alert-border-2"
         class="flex p-4 mt-2 border-t-4
         @switch($type)
            @case('error')
               bg-red-100 border-red-500 dark:bg-red-200
            @break
            @case('success')
                bg-blue-100 border-blue-500 dark:bg-blue-200
            @break
            @default
               bg-yellow-100 border-yellow-500 dark:bg-yellow-200
         @endswitch "
         role="alert" x-data="{show:true}" x-show="show">
        <svg class="flex-shrink-0 w-5 h-5
        @switch($type)
            @case('error')
               text-red-700
            @break
            @case('success')
               text-blue-700
            @break
            @default
               text-yellow-700
         @endswitch" fill="currentColor" viewBox="0 0 20 20"
             xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                  clip-rule="evenodd"></path>
        </svg>
        <div class="ml-3 text-sm font-medium
        @switch($type)
            @case('error')
               text-red-700
            @break
            @case('success')
               text-blue-700
            @break
            @default
               text-yellow-700
         @endswitch ">
            {!! $message !!}
        </div>
        <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2  p-1.5  inline-flex h-8 w-8
                @switch($type)
                    @case('error')
                     bg-red-100 dark:bg-red-200 text-red-500 focus:ring-red-400 hover:bg-red-200 dark:hover:bg-red-300
                    @break
                    @case('success')
                     bg-blue-100 dark:bg-blue-200 text-blue-500 focus:ring-blue-400 hover:bg-blue-200 dark:hover:bg-blue-300
                    @break
                    @default
                     bg-yellow-100 dark:bg-yellow-200 text-yellow-500 focus:ring-yellow-400 hover:bg-yellow-200 dark:hover:bg-yellow-300
                 @endswitch "
                data-dismiss-target="#alert-border-2" aria-label="Close">
            <span class="sr-only">Dismiss</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg" x-on:click="show=false">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
@endif
