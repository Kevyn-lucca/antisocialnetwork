<!DOCTYPE html>
<html lang="pt-BR" data-theme="light" class="scroll-smooth scroll-pt-20">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>{{ isset($title) ? $title . ' | Antis' : 'Antis' }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('images/alien-svgrepo-com.svg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    {{-- Aplica o tema antes de pintar a tela, para nao piscar --}}
    <script>
        (function () {
            var theme = null;
            try { theme = localStorage.getItem('theme'); } catch (e) {}
            if (!theme) {
                theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col bg-base-200 font-sans text-base-content antialiased transition-colors duration-200">

    <a href="#conteudo"
       class="btn btn-primary btn-sm absolute left-4 top-2 z-50 -translate-y-16 focus:translate-y-0">
        Ir para o conteúdo
    </a>

    {{-- Navegacao --}}
    <header class="sticky top-0 z-40 border-b border-base-300/70 bg-base-100/75 backdrop-blur-md">
        <nav class="navbar mx-auto min-h-16 max-w-2xl gap-2 px-4" aria-label="Navegação principal">

            <div class="navbar-start">
                <a href="/"
                   class="group flex items-center gap-2.5 rounded-lg py-1 pr-2 transition"
                   aria-label="Antis, página inicial">
                    <span class="grid size-9 place-items-center transition group-hover:ring-primary">
                        <img class="size-6 [[data-theme=dark]_&]:brightness-0 [[data-theme=dark]_&]:invert" src="{{ asset('images/alien-svgrepo-com.svg') }}" alt="">
                    </span>
                    <span class="text-lg font-bold tracking-tight">Antis</span>
                </a>
            </div>

            <div class="navbar-end gap-1.5">

                <a href="/ai/resume"
                   class="group flex items-center gap-2.5 rounded-lg py-1 pr-2 transition"
                   aria-label="Antis, página inicial">
                    <span class="grid size-9 place-items-center transition group-hover:ring-primary">
                        <img class="size-6 [[data-theme=dark]_&]:brightness-0 [[data-theme=dark]_&]:invert" src="{{ asset('images/comment-dots-svgrepo-com.svg') }}" alt="">
                    </span>
                </a>

                <label class="btn btn-ghost btn-circle btn-sm swap swap-rotate" title="Alternar tema claro e escuro">
                    <input type="checkbox" id="theme-toggle" aria-label="Ativar tema escuro" />
                    <svg class="swap-off size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <circle cx="12" cy="12" r="4" />
                        <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
                    </svg>
                    <svg class="swap-on size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z" />
                    </svg>
                </label>

                @auth
                    <div class="dropdown dropdown-end">
                  <button type="button"
                        class="btn btn-ghost btn-circle btn-xl avatar"
                        aria-label="Abrir menu da conta"
                        aria-haspopup="menu">
                    <span class="block w-10 rounded-full ring-2 ring-base-300  ring-offset-2 ring-offset-base-100">
                        <img class="rounded-full" src="https://avatars.laravel.cloud/{{ urlencode(auth()->user()->email) }}"
                            alt="Avatar de {{ auth()->user()->name }}"
                            width="40" height="40" />
                    </span>
                </button>

                        <ul tabindex="0" role="menu"
                            class="menu dropdown-content z-10 mt-3 w-64 rounded-box border border-base-300 bg-base-100 p-2 shadow-xl">
                            <li class="pointer-events-none px-3 py-2">
                                <div class="flex flex-col items-start gap-0 p-0">
                                    <span class="w-full truncate text-sm font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="w-full truncate text-xs text-base-content/60">{{ auth()->user()->email }}</span>
                                </div>
                            </li>
                            <li class="my-1 h-px bg-base-300 p-0"></li>
                            <li role="none">
                                <form method="POST" action="/logout" class="p-0">
                                    @csrf
                                    <button type="submit" role="menuitem" class="w-full gap-3 px-3 py-2 text-error">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9" />
                                        </svg>
                                        Sair
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="/login" class="btn btn-ghost btn-sm">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-full px-4">Criar conta</a>
                @endauth
            </div>
        </nav>
    </header>

    <main id="conteudo" class="mx-auto w-full max-w-2xl flex-1 px-4 py-8 sm:py-10">
        {{ $slot }}
    </main>
<footer class="border-t border-base-300 bg-base-100">
    <div class="mx-auto flex max-w-2xl flex-col items-center justify-between gap-1 px-4 py-2 text-xs text-base-content/60 sm:flex-row">
        <p>&copy; {{ now()->year }} Antis</p>

        <div class="flex items-center gap-2">
            <a href="https://www.linkedin.com/in/kevyn-lucca-vieira-de-almeida-813503232/"
               class="group flex items-center gap-2.5 rounded-lg pr-2 transition"
               aria-label="meu github">
                <span class="grid size-9 place-items-center transition group-hover:ring-primary">
                    <img class="size-6 [[data-theme=dark]_&]:brightness-0 [[data-theme=dark]_&]:invert" src="{{ asset('images/github-svgrepo-com.svg') }}" alt="">
                </span>
            </a>

            <a href="https://github.com/Kevyn-lucca"
               class="group flex items-center gap-2.5 rounded-lg pr-2 transition"
               aria-label="meu linkedin">
                <span class="grid size-9 place-items-center transition group-hover:ring-primary">
                    <img class="size-6 [[data-theme=dark]_&]:brightness-0 [[data-theme=dark]_&]:invert" src="{{ asset('images/linkedin-svgrepo-com.svg') }}" alt="">
                </span>
            </a>
        </div>
    </div>
</footer>
    @foreach (['success' => 'alert-success', 'error' => 'alert-error'] as $key => $style)
        @if (session($key))
            <div class="toast toast-top toast-center z-50 w-full max-w-sm px-4" data-flash>
                <div class="alert {{ $style }} w-full shadow-lg transition-all duration-300"
                     role="{{ $key === 'error' ? 'alert' : 'status' }}">
                    <span class="flex-1 text-sm">{{ session($key) }}</span>
                    <button type="button" class="btn btn-ghost btn-xs btn-circle" aria-label="Fechar aviso"
                            data-flash-close>
                        &times;
                    </button>
                </div>
            </div>
        @endif
    @endforeach

    <script>
        (function () {
            var LIGHT = 'light';
            var DARK = 'dark';
            var root = document.documentElement;

            var toggle = document.getElementById('theme-toggle');
            if (toggle) {
                toggle.checked = root.getAttribute('data-theme') === DARK;
                toggle.addEventListener('change', function () {
                    var theme = toggle.checked ? DARK : LIGHT;
                    root.setAttribute('data-theme', theme);
                    try { localStorage.setItem('theme', theme); } catch (e) {}
                });
            }

            document.querySelectorAll('[data-flash]').forEach(function (toast) {
                var alert = toast.firstElementChild;
                var timer;

                function dismiss() {
                    alert.classList.add('opacity-0', '-translate-y-2');
                    setTimeout(function () { toast.remove(); }, 300);
                }

                function start() { timer = setTimeout(dismiss, 5000); }

                toast.addEventListener('mouseenter', function () { clearTimeout(timer); });
                toast.addEventListener('mouseleave', start);
                toast.querySelector('[data-flash-close]').addEventListener('click', dismiss);
                start();
            });
        })();
    </script>
</body>

</html>