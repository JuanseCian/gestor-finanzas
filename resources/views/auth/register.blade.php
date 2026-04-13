<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Crear Cuenta</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">Completa tus datos para empezar a gestionar tus finanzas.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Ej: Juan" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Apellido -->
            <div>
                <x-input-label for="apellido" :value="__('Apellido')" />
                <x-text-input id="apellido" class="block mt-1 w-full" type="text" name="apellido" :value="old('apellido')" required placeholder="Ej: Pérez" />
                <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- DNI -->
            <div>
                <x-input-label for="dni" :value="__('DNI / Identificación')" />
                <x-text-input id="dni" class="block mt-1 w-full" type="text" name="dni" :value="old('dni')" required placeholder="Número de documento" />
                <x-input-error :messages="$errors->get('dni')" class="mt-2" />
            </div>

            <!-- Fecha de Nacimiento -->
            <div>
                <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')" />
                <x-text-input id="fecha_nacimiento" class="block mt-1 w-full" type="date" name="fecha_nacimiento" :value="old('fecha_nacimiento')" required />
                <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="usuario@ejemplo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Contraseña')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-between mt-8">
            <a class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors" href="{{ route('login') }}">
                {{ __('¿Ya tienes cuenta?') }}
            </a>

            <x-primary-button class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>