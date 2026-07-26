<nav class="w-full bg-[#BC8451] px-8 py-5  shadow-md">
    <div class="max-w-7xl mx-auto flex items-center justify-between">

        <a href="{{route('home')}}" class="text-2xl font-bold text-white">
            Les pattes heureuses
        </a>

        <div class="flex items-center gap-4">

            <a
                href="{{route('home')}}"
                @class([
                    'px-6 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('home'),
                    'text-white hover:bg-white/15' => !request()->routeIs('home'),
                ])
            >
                Accueil
            </a>

            <a
                href="{{route('animal')}}"
                @class([
                    'px-6 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('animal'),
                    'text-white hover:bg-white/15' => !request()->routeIs('animal'),
                ])
            >
                Animaux
            </a>

            <a
                href="{{ route('public.contact') }}"
                @class([
                    'px-6 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('public.contact'),
                    'text-white hover:bg-white/15' => !request()->routeIs('public.contact'),
                ])>
                Contact
            </a>


        </div>

    </div>
</nav>
