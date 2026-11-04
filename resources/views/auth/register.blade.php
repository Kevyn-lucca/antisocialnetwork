<x-layout>
    <x-slot:title>
        Register
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-3xl font-bold text-center mb-6">Criar conta</h1>

                    <form method="POST" action="/register">
                        @csrf

                        <!-- Name -->
                        <label class="floating-label mb-6">
                            <input type="text"
                                   name="name"
                                   placeholder="John Doe"
                                   value="{{ old('name') }}"
                                   class="input input-bordered [[data-theme=dark]_&]:bg-gray-700 bg-gray-100 @error('name') input-error @enderror"
                                   required>
                            <span>Nome</span>
                        </label>
                        @error('name')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Email -->
                        <label class="floating-label mb-6">
                            <input type="email"
                                   name="email"
                                   placeholder="mail@example.com"
                                   value="{{ old('email') }}"
                                   class="input [[data-theme=dark]_&]:bg-gray-700 input-bordered @error('email') input-error @enderror"
                                   required>
                            <span>E-mail</span>
                        </label>
                        @error('email')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Password -->
                        <label class="floating-label mb-6">
                            <input type="password"
                                   name="password"
                                   placeholder="••••••••"
                                   class="input [[data-theme=dark]_&]:bg-gray-700 input-bordered @error('password') input-error @enderror"
                                   required>
                            <span>Senha</span>
                        </label>
                        @error('password')
                            <div class="label -mt-4 mb-2">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror

                        <label class="floating-label mb-6">
                            <input type="password"
                                   name="password_confirmation"
                                   placeholder="••••••••"
                                   class="[[data-theme=dark]_&]:bg-gray-700 input input-bordered"
                                   required>
                            <span>Confirmar senha</span>
                        </label>

                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Registra-se
                            </button>
                        </div>
                    </form>

                    <div class="divider">OR</div>
                    <p class="text-center text-sm">
                        Já tem conta?
                        <a href="/login" class="link link-primary">Sign in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<style>
    [data-theme="light"] .input,
    [data-theme="light"] .textarea {
        background-color: #f3f4f6;
    }

    [data-theme="dark"] .input,
    [data-theme="dark"] .textarea {
        background-color: #374151;
        color: #f9fafb;
    }

    [data-theme="dark"] .input::placeholder,
    [data-theme="dark"] .textarea::placeholder {
        color: #9ca3af;
    }
</style>