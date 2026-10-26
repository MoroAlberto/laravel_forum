<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public ?string $message;

    public string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?string $message = null, string $type = 'error')
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Tailwind classes for each alert type, shared with the client side toasts.
     */
    public static function styles(string $type): string
    {
        return match ($type) {
            'error' => 'bg-red-50 text-red-800 ring-red-200',
            'success' => 'bg-emerald-50 text-emerald-800 ring-emerald-200',
            default => 'bg-amber-50 text-amber-800 ring-amber-200',
        };
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
