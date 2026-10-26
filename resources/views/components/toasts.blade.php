{{-- Client side alerts, show one with: window.dispatchEvent(new CustomEvent('notify', { detail: { message, type } })) --}}
<div x-data="{
         toasts: [],
         nextId: 0,
         styles: @js(collect(['error', 'success', 'warning'])->mapWithKeys(fn ($type) => [$type => \App\View\Components\Alert::styles($type)])),
         fallback: @js(__('message.generic_error')),
         push(detail) {
             const id = this.nextId++;
             this.toasts.push({ id, message: detail.message || this.fallback, type: detail.type || 'error' });
             setTimeout(() => this.dismiss(id), 4000);
         },
         dismiss(id) {
             this.toasts = this.toasts.filter(toast => toast.id !== id);
         },
     }"
     x-on:notify.window="push($event.detail)"
     class="pointer-events-none fixed inset-x-0 top-4 z-50 mx-auto flex max-w-md flex-col gap-2 px-4">
    <template x-for="toast in toasts" :key="toast.id">
        <div role="alert" x-transition.opacity
             class="pointer-events-auto flex items-start gap-3 rounded-lg p-4 text-sm font-medium shadow-lg ring-1"
             :class="styles[toast.type] ?? styles.warning">
            <div class="flex-1" x-text="toast.message"></div>
            <button type="button" class="-m-1 rounded-md p-1 opacity-60 transition hover:opacity-100"
                    x-on:click="dismiss(toast.id)">
                <span class="sr-only">{{ __('message.dismiss') }}</span>
                <svg aria-hidden="true" class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </template>
</div>
