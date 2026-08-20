<nav
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
    class="w-full bg-[#BC8451] px-4 py-4 shadow-md sm:px-8 sm:py-5"
    itemscope itemtype="https://schema.org/SiteNavigationElement"
>
    <h2 class="sr-only">Navigation principale</h2>

    <div class="max-w-7xl mx-auto flex items-center justify-between">

        <a href="{{route('home')}}" itemprop="url" class="text-xl font-bold text-white sm:text-2xl">
            <span itemprop="name">Les pattes heureuses</span>
        </a>

        <div class="hidden items-center gap-4 lg:flex">

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

            <a
                href="{{ route('public.membre') }}"
                itemprop="url"
                @class([
                    'px-6 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('public.membre'),
                    'text-white hover:bg-white/15' => !request()->routeIs('public.membre'),
                ])>
                <span itemprop="name">Devenir membre</span>
            </a>

        </div>

        <button
            type="button"
            @click="open = !open"
            :aria-expanded="open.toString()"
            aria-controls="mobile-menu"
            aria-label="Ouvrir le menu de navigation"
            class="relative z-50 shrink-0 text-white lg:hidden"
        >
            <svg
                x-show="!open"
                xmlns="http://www.w3.org/2000/svg"
                width="28"
                height="28"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
            </svg>

            <svg
                x-show="open"
                xmlns="http://www.w3.org/2000/svg"
                width="28"
                height="28"
                fill="none"
                viewBox="0 0 24 24"
            >
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M6 18 18 6M6 6l12 12"/>
            </svg>
        </button>

    </div>

    <div
        id="mobile-menu"
        x-show="open"
        x-cloak
        @click.outside="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="max-w-7xl mx-auto overflow-hidden lg:hidden"
    >
        <div class="mt-4 flex flex-col gap-2 border-t border-white/20 pt-4">

            <a
                href="{{route('home')}}"
                itemprop="url"
                @click="open = false"
                @class([
                    'px-4 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('home'),
                    'text-white hover:bg-white/15' => !request()->routeIs('home'),
                ])
            >
                <span itemprop="name">Accueil</span>
            </a>

            <a
                href="{{route('animal')}}"
                itemprop="url"
                @click="open = false"
                @class([
                    'px-4 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('animal'),
                    'text-white hover:bg-white/15' => !request()->routeIs('animal'),
                ])
            >
                <span itemprop="name">Animaux</span>
            </a>

            <a
                href="{{ route('public.contact') }}"
                itemprop="url"
                @click="open = false"
                @class([
                    'px-4 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('public.contact'),
                    'text-white hover:bg-white/15' => !request()->routeIs('public.contact'),
                ])>
                <span itemprop="name">Contact</span>
            </a>

            <a
                href="{{ route('public.membre') }}"
                itemprop="url"
                @click="open = false"
                @class([
                    'px-4 py-3 rounded-xl font-semibold transition-all duration-200',
                    'bg-white text-[#BC8451] shadow-md' => request()->routeIs('public.membre'),
                    'text-white hover:bg-white/15' => !request()->routeIs('public.membre'),
                ])>
                <span itemprop="name">Devenir membre</span>
            </a>

        </div>
    </div>
</nav>
