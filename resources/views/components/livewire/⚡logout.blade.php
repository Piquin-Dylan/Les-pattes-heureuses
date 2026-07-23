<?php

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;


new class extends Component {
    public function logout(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
};
?>

<div>
    <form wire:submit="logout" method="POST" class="mt-auto px-5 pb-6">
        <button
            type="submit"
            class="cursor-pointer w-full rounded-xl px-4 py-3 text-left font-medium text-white/90 transition hover:bg-white/10 hover:text-white">

            Déconnexion

        </button>
    </form>
</div>
