<x-layout>
    <x-slot:title>
        Sign In
    </x-slot:title>

    <div class="hero min-h-[calc(100vh-16rem)]">
        <div class="hero-content flex-col">
            <div class="card w-96 bg-base-100">
                <div class="card-body">
                    <h1 class="text-3xl font-bold text-center mb-6">Bem vindo de volta</h1>

                    <form method="POST" action="/login">
                        @csrf

                        <!-- Email -->
                        <label class="floating-label mb-6">
                            <input type="email"
                                   name="email"
                                   placeholder="mail@example.com"
                                   value="{{ old('email') }}"
                                   class="input [[data-theme=dark]_&]:bg-gray-700 input-bordered @error('email') input-error @enderror"
                                   required
                                   autofocus>
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

                        <!-- Remember Me -->
                        <div class="form-control mt-4">
                            <label class="label cursor-pointer justify-start">
                                <input type="checkbox"
                                       name="remember"
                                       class="checkbox">
                                <span class="label-text ml-2">Lembre-se de mim</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-control mt-8">
                            <button type="submit" class="btn btn-primary btn-sm w-full">
                                Sign In
                            </button>
                        </div>
                    </form>

                    <div class="divider">OU</div>
                    <p class="text-center text-sm">
                        Não tem conta?
                        <a href="/register" class="link link-primary">Registre-se</a>
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