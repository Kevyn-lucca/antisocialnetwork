<x-layout>
    <x-slot:title>
        Resumo
    </x-slot:title>

    <section class="min-h-screen bg-base-200 px-4 py-12">
        <div class="mx-auto max-w-2xl">

            <header class="mb-8">
                <p class="text-sm font-medium capitalize text-primary">
                    {{ now()->translatedFormat('l, d \d\e F') }}
                </p>
                <h1 class="mt-1 text-3xl font-bold tracking-tight text-base-content">
                    Resumo do dia
                </h1>
            </header>

            <article class="overflow-hidden rounded-3xl bg-base-100 shadow-xl ring-1 ring-base-content/10">
                <div class="h-1.5 bg-gradient-to-r from-primary via-secondary to-accent"></div>

                <div class="p-8">
                    <div class="mb-6 inline-flex items-center gap-2 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary">
                        <span class="h-1.5 w-1.5 rounded-full bg-primary"></span>
                        Gerado por IA
                    </div>

                    <div class="space-y-4 text-[15px] leading-7 text-base-content/70
                                [&>p:first-child]:text-lg [&>p:first-child]:leading-8 [&>p:first-child]:text-base-content
                                [&_h3]:mt-8 [&_h3]:border-t [&_h3]:border-base-content/10 [&_h3]:pt-6 [&_h3]:text-xs [&_h3]:font-bold [&_h3]:uppercase [&_h3]:tracking-widest [&_h3]:text-base-content/50
                                [&_ul]:space-y-3
                                [&_li]:relative [&_li]:pl-6
                                [&_li]:before:absolute [&_li]:before:left-0 [&_li]:before:top-3 [&_li]:before:h-2 [&_li]:before:w-2 [&_li]:before:rounded-full [&_li]:before:bg-primary [&_li]:before:content-['']
                                [&_strong]:rounded [&_strong]:bg-warning/20 [&_strong]:px-1 [&_strong]:font-semibold [&_strong]:text-base-content">
                        {!! $data !!}
                    </div>
                </div>
            </article>

        </div>
    </section>
</x-layout>