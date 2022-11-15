<?php

namespace App\View\Components;

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
    public function __construct(?string $message = null, ?string $type = 'error')
    {
        $this->message= $message;
        $this->type= $type;
    }

    public function backgroundColorClass() :string
    {
        return [
            'error' => 'red',
            'success' => 'blue',
            'warning' => 'yellow',
        ][$this->type];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
