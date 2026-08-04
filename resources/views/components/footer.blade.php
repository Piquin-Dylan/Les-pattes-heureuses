<footer class="bg-[#BC8451] px-8 py-12 text-white">
    <div class="mx-auto max-w-7xl">
        <div class="grid gap-10 sm:grid-cols-3">
            <div>
                <p class="text-xl font-bold">Les pattes heureuses</p>
                <p class="mt-3 text-sm text-white/80">
                    Refuge animalier dédié au bien-être des chiens, chats et autres compagnons
                    en attente d'une famille aimante.
                </p>
            </div>

            <div>
                <p class="font-semibold">Navigation</p>
                <div class="mt-3 flex flex-col gap-2 text-sm text-white/80">
                    <a href="{{ route('home') }}" class="hover:text-white">Accueil</a>
                    <a href="{{ route('animal') }}" class="hover:text-white">Animaux</a>
                    <a href="{{ route('public.contact') }}" class="hover:text-white">Contact</a>
                </div>
            </div>

            <div>
                <p class="font-semibold">Contact</p>
                <div class="mt-3 flex flex-col gap-2 text-sm text-white/80">
                    <span>contact@lespatteheureuses.fr</span>
                    <span>01 23 45 67 89</span>
                </div>
            </div>
        </div>

        <div class="mt-10 border-t border-white/20 pt-6 text-center text-sm text-white/70">
            &copy; {{ date('Y') }} Les pattes heureuses. Tous droits réservés.
        </div>
    </div>
</footer>
