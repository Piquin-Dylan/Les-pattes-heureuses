<footer class="bg-[#BC8451] px-8 py-12 text-white" itemscope itemtype="https://schema.org/AnimalShelter">
    <h2 class="sr-only">Navigation de bas de page</h2>
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col gap-10 sm:flex-row sm:flex-wrap sm:justify-between">
            <div class="sm:max-w-xs">
                <span class="text-xl font-bold" itemprop="name">Les pattes heureuses</span>
                <p class="mt-3 text-sm text-white/80" itemprop="description">
                    Refuge animalier dédié au bien-être des chiens, chats et autres compagnons
                    en attente d'une famille aimante.
                </p>
            </div>

            <div>
                <h3 class="font-semibold">Navigation</h3>
                <div class="mt-3 flex flex-col gap-2 text-sm text-white/80">
                    <a href="{{ route('home') }}" class="hover:text-white">Accueil</a>
                    <a href="{{ route('animal') }}" class="hover:text-white">Animaux</a>
                    <a href="{{ route('public.contact') }}" class="hover:text-white">Contact</a>
                </div>
            </div>

            <div>
                <h3 class="font-semibold">Contact</h3>
                <div class="mt-3 flex flex-col gap-2 text-sm text-white/80">
                    <a href="mailto:contact@lespatteheureuses.fr" itemprop="email" class="hover:text-white">contact@lespatteheureuses.fr</a>
                    <a href="tel:+33123456789" itemprop="telephone" class="hover:text-white">01 23 45 67 89</a>
                </div>
            </div>
        </div>

        <div class="mt-10 border-t border-white/20 pt-6 text-center text-sm text-white/70">
            &copy; {{ date('Y') }} Les pattes heureuses. Tous droits réservés.
        </div>
    </div>
</footer>
