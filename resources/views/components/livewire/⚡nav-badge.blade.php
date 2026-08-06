<?php

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\Message;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public string $type;

    #[Computed]
    public function count(): int
    {
        return match ($this->type) {
            'adoptions' => Adoption::pending()->count(),
            'messages' => Message::unread()->count(),
            'animals' => Animal::pending()->count(),
            default => 0,
        };
    }

};
?>

<span
    wire:poll.30s
    class="inline-flex min-w-[1.375rem] items-center justify-center rounded-full bg-red-500 px-1.5 py-0.5 text-xs font-bold leading-none text-white {{ $this->count === 0 ? 'hidden' : '' }}">
    {{ $this->count }}
</span>
