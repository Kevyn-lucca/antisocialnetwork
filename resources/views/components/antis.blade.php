@props(['antis'])

<article class="group card rounded-2xl border border-base-200 bg-base-100 transition hover:border-base-300 hover:shadow-md">
    <div class="card-body gap-3 p-5">
        <header class="flex items-center gap-3">
            <div class="avatar">
                <div class="size-11 rounded-full ring-2 ring-base-200 ring-offset-2 ring-offset-base-100">
                    @if ($antis->user)
                        <img src="https://avatars.laravel.cloud/{{ urlencode($antis->user->email) }}"
                             alt="Avatar de {{ $antis->user->name }}"
                             loading="lazy" />
                    @else
                        <img src="https://avatars.laravel.cloud/36520b41-b2f6-4a02-8682-92754171553a?vibe=sunset"
                             alt="Avatar de usuário anônimo"
                             loading="lazy" />
                    @endif
                </div>
            </div>

            <div class="min-w-0 flex-1 leading-tight">
                <div class="flex items-center gap-2">
                    <span class="truncate font-semibold">
                        {{ $antis->user?->name ?? 'Anônimo' }}
                    </span>
                    @unless ($antis->user)
                        <span class="badge badge-ghost badge-sm">anon</span>
                    @endunless
                </div>
                <time class="text-xs text-base-content/60"
                      datetime="{{ $antis->created_at->toIso8601String() }}"
                      title="{{ $antis->created_at->format('d/m/Y H:i') }}">
                    {{ $antis->created_at->diffForHumans() }}
                </time>
            </div>

            @can('delete', $antis)
                <div class="dropdown dropdown-end">
                    <button type="button"
                            tabindex="0"
                            aria-label="Opções do anti"
                            class="btn btn-ghost btn-circle btn-sm opacity-60 transition group-hover:opacity-100 focus:opacity-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <circle cx="5" cy="12" r="1.8" />
                            <circle cx="12" cy="12" r="1.8" />
                            <circle cx="19" cy="12" r="1.8" />
                        </svg>
                    </button>
                    <ul tabindex="0" class="menu dropdown-content z-10 mt-1 w-44 rounded-xl border border-base-200 bg-base-100 p-1.5 shadow-lg">
                        <li>
                            <button type="button"
                                    class="text-error"
                                    onclick="document.activeElement.blur(); document.getElementById('delete-anti-{{ $antis->id }}').showModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6M10 11v6M14 11v6" />
                                </svg>
                                Excluir
                            </button>
                        </li>
                    </ul>
                </div>
            @endcan
        </header>

        <p class="whitespace-pre-line wrap-break-word leading-relaxed text-base-content/90">{{ $antis->message }}</p>
    </div>

    @can('delete', $antis)
        <dialog id="delete-anti-{{ $antis->id }}" class="modal modal-bottom sm:modal-middle">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Excluir este anti?</h3>
                <p class="py-3 text-base-content/70">Essa ação não pode ser desfeita.</p>
                <div class="modal-action">
                    <form method="dialog">
                        <button class="btn btn-ghost">Cancelar</button>
                    </form>
                    <form method="POST" action="{{ route('antis.destroy', $antis) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error">Excluir</button>
                    </form>
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button aria-label="Fechar">fechar</button>
            </form>
        </dialog>
    @endcan
</article>