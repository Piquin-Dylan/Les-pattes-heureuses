<?php

use App\Models\Message;
use Livewire\Component;

new class extends Component {

    public function getMessagesProperty()
    {
        return Message::query()
            ->latest()
            ->get();
    }

};
?>

<div class="w-full px-4 py-6">

    <section class="mb-8">

        <x-page-header
            title="Messages"
            description="Consultez les messages envoyés depuis le formulaire de contact"
        />

        @if($this->messages->isEmpty())

            <x-message_empty></x-message_empty>
        @else
            @foreach($this->messages as $message)
                <x-message_card :message="$message"></x-message_card>
            @endforeach
        @endif

    </section>

</div>
