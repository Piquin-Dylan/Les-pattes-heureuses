<nav class="w-full bg-[#BC8451] px-8 py-5 shadow-md" itemscope itemtype="https://schema.org/SiteNavigationElement">
    <h2 class="sr-only">Navigation principale</h2>

    <div class="max-w-7xl mx-auto flex items-center justify-between">

        <a href="{{route('home')}}" itemprop="url" class="text-2xl font-bold text-white">
            <span itemprop="name">Les pattes heureuses</span>
        </a>

        <div class="flex items-center gap-4">

            <a
                href="{{route('home')}}"
                itemprop="url"
                @class([
                    'px-6 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('home'),
                    'text-white hover:bg-white/15' => !request()->routeIs('home'),
                ])
            >
                <span itemprop="name">Accueil</span>
            </a>

            <a
                href="{{route('animal')}}"
                itemprop="url"
                @class([
                    'px-6 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('animal'),
                    'text-white hover:bg-white/15' => !request()->routeIs('animal'),
                ])
            >
                <span itemprop="name">Animaux</span>
            </a>

            <a
                href="{{ route('public.contact') }}"
                itemprop="url"
                @class([
                    'px-6 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('public.contact'),
                    'text-white hover:bg-white/15' => !request()->routeIs('public.contact'),
                ])>
                <span itemprop="name">Contact</span>
            </a>


        </div>

    </div>
</nav>
