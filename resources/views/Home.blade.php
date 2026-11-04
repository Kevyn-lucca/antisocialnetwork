<x-layout>
    <x-slot:title>
        Início
    </x-slot:title>

    @auth
        <section class="card mt-6 rounded-2xl border border-base-200 bg-base-100" aria-label="Novo anti">
            <form method="POST" action="/antis" class="card-body gap-3 p-5">
                @csrf

                <label for="message" class="sr-only">Sua mensagem</label>
              <textarea
    id="message"
    name="message"
    placeholder="O que você está pensando?"
class="textarea w-full resize-none rounded-xl border-0 bg-gray-100 p-3 text-base leading-relaxed focus:outline-none [[data-theme=dark]_&]:bg-gray-700 @error('message') text-error @enderror"    rows="3"
    maxlength="255"
    required
    aria-describedby="message-counter @error('message') message-error @enderror"
    oninput="document.getElementById('message-count').textContent = this.value.length"
>{{ old('message') }}</textarea>

                @error('message')
                    <p id="message-error" class="text-sm text-error" role="alert">{{ $message }}</p>
                @enderror

                <div class="flex items-center justify-between border-t border-base-200 pt-3">
                    <span id="message-counter" class="text-xs text-base-content/60">
                        <span id="message-count">{{ strlen(old('message', '')) }}</span>/255
                    </span>
                    <button type="submit" class="btn btn-primary btn-sm rounded-full px-5">
                        Publicar
                    </button>
                </div>
            </form>
        </section>
    @else
        <div class="mt-6 flex flex-col items-start justify-between gap-3 rounded-2xl border border-base-200 bg-base-100 p-5 sm:flex-row sm:items-center">
            <p class="text-sm text-base-content/70">Entre para publicar o seu anti.</p>
            <div class="flex gap-2">
                <a href="/login" class="btn btn-ghost btn-sm">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Criar conta</a>
            </div>
        </div>
    @endauth

    <section class="mt-8 space-y-4" aria-label="Feed de antis">
        @forelse ($antis as $anti)
            <x-antis :antis="$anti" />
        @empty
            <div class="flex flex-col items-center py-16 text-center">
                <svg class="size-12 text-base-content/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p class="mt-4 font-medium">Nenhum anti por aqui ainda</p>
                <p class="mt-1 text-sm text-base-content/60">Seja a primeira pessoa a publicar.</p>
            </div>
        @endforelse
    </section>
</x-layout>