<?php

use App\Enums\AdoptionStatus;
use App\Models\Adoption;
use App\Models\Animal;
use App\Notifications\AdoptionInProgressNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;


new class extends Component {
    public Adoption $adoption;


    public \App\Livewire\Form\CreateNote $form;


    public $requestAdoption;
    public $requestAnimal;
    public bool $showNotifyPrompt = false;

    public function mount(): void
    {
        $this->requestAdoption = $this->adoption->status;
        $this->requestAnimal = $this->adoption->animal->status;
        $this->showNotifyPrompt = $this->adoption->status === AdoptionStatus::InProgress->value
            && ! $this->adoption->notified_at;
    }

    public function save(): void
    {
        $this->form->submit($this->adoption);
    }


    public function updateStatusAdoption(): void
    {
        $wasInProgress = $this->adoption->status === AdoptionStatus::InProgress->value;

        $this->adoption->update([
            'status' => $this->requestAdoption,
        ]);

        $this->showNotifyPrompt = $this->adoption->status === AdoptionStatus::InProgress->value
            && ! $wasInProgress
            && ! $this->adoption->notified_at;
    }

    public function updateStatusAnimal(): void
    {
        $this->adoption->animal->update([
            'status' => $this->requestAnimal,
        ]);
    }

    public function notifyApplicant(): void
    {
        Notification::route('mail', $this->adoption->email)
            ->notify(new AdoptionInProgressNotification($this->adoption));

        $this->adoption->update(['notified_at' => now()]);

        $this->showNotifyPrompt = false;

        session()->flash('success', 'Un e-mail a été envoyé à ' . $this->adoption->firstName . ' pour l’informer de la prise en compte de sa demande.');
    }

    public function dismissNotifyPrompt(): void
    {
        $this->showNotifyPrompt = false;
    }

};
?>

<div>

    @if (session()->has('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if ($showNotifyPrompt)
        <div class="mb-6 flex flex-col gap-4 rounded-2xl border border-[#EADED4] bg-[#FAF6F2] p-5 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-start gap-3">
                <span class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#C67C47]/10 text-[#C67C47]">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0a2.25 2.25 0 00-2.25-2.25H4.5A2.25 2.25 0 002.25 6.75m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                </span>
                <div>
                    <p class="font-semibold text-[#171C2B]">
                        Notifier {{ $adoption->firstName }} par e-mail ?
                    </p>
                    <p class="mt-1 text-sm text-gray-500">
                        La demande est passée « en cours ». Vous pouvez l’informer que sa demande a été prise en compte
                        et qu’elle sera prochainement recontactée.
                    </p>
                </div>
            </div>

            <div class="flex shrink-0 gap-2">
                <button
                    type="button"
                    wire:click="dismissNotifyPrompt"
                    class="cursor-pointer rounded-xl border border-gray-300 px-4 py-2.5 text-sm font-semibold text-gray-600 transition hover:bg-gray-100">
                    Plus tard
                </button>
                <button
                    type="button"
                    wire:click="notifyApplicant"
                    class="cursor-pointer rounded-xl bg-[#C67C47] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b56f3c] active:scale-95">
                    Envoyer l’e-mail
                </button>
            </div>

        </div>
    @endif

    <x-fiche_adoption :adoption="$adoption"></x-fiche_adoption>

    <div class="mt-6">
        <x-add_note
            function="save"
            model="form.message"
            :notes="$adoption->notes"
        />
    </div>

</div>
