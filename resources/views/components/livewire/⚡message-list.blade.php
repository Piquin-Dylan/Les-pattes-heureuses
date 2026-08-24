<?php

use App\Models\Message;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public function getMessagesProperty()
    {
        return Message::query()
            ->latest()
            ->paginate(10);
    }

};
?>

<div class="w-full px-0 py-6 sm:px-4">

    <section class="mb-8">

        <div class="mb-6">
            <x-page-header
                title="Messages"
                description="Consultez les messages envoyés depuis le formulaire de contact"
            />
        </div>

        @if($this->messages->isEmpty())

            <x-message_empty></x-message_empty>
        @else
            <div class="space-y-4">
                @foreach($this->messages as $message)
                    <x-message_card :message="$message"></x-message_card>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $this->messages->links('components.custom') }}
            </div>
        @endif

    </section>

</div>
