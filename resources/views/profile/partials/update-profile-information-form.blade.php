<section>
    <header class="mb-6">
        <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
            {{ __('Información del Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza la información de tu cuenta, datos personales y número de teléfono.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Fila: Nombre y Apellido -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="apellido" :value="__('Apellido')" />
                <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full" :value="old('apellido', $user->apellido)" required autocomplete="family-name" />
                <x-input-error class="mt-2" :messages="$errors->get('apellido')" />
            </div>
        </div>

        <!-- Fila: DNI y Fecha de Nacimiento -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="dni" :value="__('DNI / Identificación')" />
                <x-text-input id="dni" name="dni" type="text" class="mt-1 block w-full" :value="old('dni', $user->dni)" required />
                <x-input-error class="mt-2" :messages="$errors->get('dni')" />
            </div>

            <div>
                <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')" />
                <x-text-input id="fecha_nacimiento" name="fecha_nacimiento" type="date" class="mt-1 block w-full" :value="old('fecha_nacimiento', $user->fecha_nacimiento)" required />
                <x-input-error class="mt-2" :messages="$errors->get('fecha_nacimiento')" />
            </div>
        </div>

        <!-- Fila: Teléfono y Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="telefono" :value="__('Número de Teléfono')" />
                <x-text-input id="telefono" name="telefono" type="tel" class="mt-1 block w-full" :value="old('telefono', $user->telefono)" placeholder="+54 9 ..." />
                <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Correo Electrónico')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-800 dark:text-gray-200">
                            {{ __('Tu dirección de correo no está verificada.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Haz clic aquí para re-enviar el correo de verificación.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('Un nuevo enlace de verificación ha sido enviado a tu correo.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 transition-colors">
                {{ __('Guardar Cambios') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium"
                >
                    <i class="bi bi-check-circle-fill me-1"></i> {{ __('Guardado correctamente.') }}
                </p>
            @endif
        </div>
    </form>
</section>