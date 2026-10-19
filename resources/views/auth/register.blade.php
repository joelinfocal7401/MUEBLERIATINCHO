<x-guest-layout>

    <h1 class="mb-5 text-center text-lg font-semibold text-[#3b3530]">
        Crear una cuenta
    </h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-3.5">
        @csrf

        <div>
            <x-input-label
                for="nombre"
                value="Nombre"
                class="text-[10px] font-bold uppercase tracking-wide text-[#625b55]"
            />

            <div class="relative mt-1">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-[#aaa39c]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M128,128a40,40,0,1,0-40-40A40,40,0,0,0,128,128Zm0-64a24,24,0,1,1-24,24A24,24,0,0,1,128,64Zm0,80a72.08,72.08,0,0,0-72,72,8,8,0,0,0,16,0,56,56,0,0,1,112,0,8,8,0,0,0,16,0A72.08,72.08,0,0,0,128,144Z"/>
                    </svg>
                </span>

                <x-text-input
                    id="nombre"
                    type="text"
                    name="nombre"
                    :value="old('nombre')"
                    required
                    autofocus
                    autocomplete="given-name"
                    placeholder="Ingresa tu nombre"
                    class="block w-full rounded-lg border border-[#ded9d3] bg-[#faf9f7] py-2 pl-9 pr-3 text-xs text-[#3b3530] placeholder:text-[#aaa39c] transition duration-200 hover:border-[#c9c1b9] focus:border-[#B07D3A] focus:bg-white focus:ring-2 focus:ring-[#B07D3A]/20"
                />
            </div>

            <x-input-error
                :messages="$errors->get('nombre')"
                class="mt-1 text-[10px]"
            />
        </div>

        <div>
            <x-input-label
                for="apellido"
                value="Apellido"
                class="text-[10px] font-bold uppercase tracking-wide text-[#625b55]"
            />

            <div class="relative mt-1">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-[#aaa39c]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M128,128a40,40,0,1,0-40-40A40,40,0,0,0,128,128Zm0-64a24,24,0,1,1-24,24A24,24,0,0,1,128,64Zm0,80a72.08,72.08,0,0,0-72,72,8,8,0,0,0,16,0,56,56,0,0,1,112,0,8,8,0,0,0,16,0A72.08,72.08,0,0,0,128,144Z"/>
                    </svg>
                </span>

                <x-text-input
                    id="apellido"
                    type="text"
                    name="apellido"
                    :value="old('apellido')"
                    required
                    autocomplete="family-name"
                    placeholder="Ingresa tu apellido"
                    class="block w-full rounded-lg border border-[#ded9d3] bg-[#faf9f7] py-2 pl-9 pr-3 text-xs text-[#3b3530] placeholder:text-[#aaa39c] transition duration-200 hover:border-[#c9c1b9] focus:border-[#B07D3A] focus:bg-white focus:ring-2 focus:ring-[#B07D3A]/20"
                />
            </div>

            <x-input-error
                :messages="$errors->get('apellido')"
                class="mt-1 text-[10px]"
            />
        </div>

        <div>
            <x-input-label
                for="telefono"
                value="Teléfono"
                class="text-[10px] font-bold uppercase tracking-wide text-[#625b55]"
            />

            <div class="relative mt-1">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-[#aaa39c]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M222.37,158.46l-47.11-21.11-.13-.06a16,16,0,0,0-15.18,1.4,8.12,8.12,0,0,0-.73.56L134.87,161a16,16,0,0,1-15.85-3.17l-20.4-20.4a16,16,0,0,1-3.17-15.85l21.75-24.35a8.12,8.12,0,0,0,.56-.73,16,16,0,0,0,1.4-15.18l-.06-.13L97.99,34.08A16,16,0,0,0,82.63,24.1,40,40,0,0,0,48,64c0,79.4,64.6,144,144,144a40,40,0,0,0,39.9-34.63A16,16,0,0,0,222.37,158.46ZM192,192C121.31,192,64,134.69,64,64a24,24,0,0,1,20.11-23.69l20.14,45.01-21.61,24.2A32,32,0,0,0,87.3,148.7l20.4,20.4a32,32,0,0,0,39.18,4.66l24.2-21.61,45.01,20.14A24,24,0,0,1,192,192Z"/>
                    </svg>
                </span>

                <x-text-input
                    id="telefono"
                    type="tel"
                    name="telefono"
                    :value="old('telefono')"
                    required
                    autocomplete="tel"
                    placeholder="Ej. 70000000"
                    class="block w-full rounded-lg border border-[#ded9d3] bg-[#faf9f7] py-2 pl-9 pr-3 text-xs text-[#3b3530] placeholder:text-[#aaa39c] transition duration-200 hover:border-[#c9c1b9] focus:border-[#B07D3A] focus:bg-white focus:ring-2 focus:ring-[#B07D3A]/20"
                />
            </div>

            <x-input-error
                :messages="$errors->get('telefono')"
                class="mt-1 text-[10px]"
            />
        </div>

        <div>
            <x-input-label
                for="email"
                value="Correo Electrónico"
                class="text-[10px] font-bold uppercase tracking-wide text-[#625b55]"
            />

            <div class="relative mt-1">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-[#aaa39c]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M224,48H32a8,8,0,0,0-8,8V192a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A8,8,0,0,0,224,48ZM203.43,64,128,133.15,52.57,64ZM216,192H40V74.19l82.59,75.71a8,8,0,0,0,10.82,0L216,74.19V192Z"/>
                    </svg>
                </span>

                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autocomplete="email"
                    placeholder="ejemplo@correo.com"
                    class="block w-full rounded-lg border border-[#ded9d3] bg-[#faf9f7] py-2 pl-9 pr-3 text-xs text-[#3b3530] placeholder:text-[#aaa39c] transition duration-200 hover:border-[#c9c1b9] focus:border-[#B07D3A] focus:bg-white focus:ring-2 focus:ring-[#B07D3A]/20"
                />
            </div>

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-1 text-[10px]"
            />
        </div>

        <div>
            <x-input-label
                for="password"
                value="Contraseña"
                class="text-[10px] font-bold uppercase tracking-wide text-[#625b55]"
            />

            <div class="relative mt-1">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-[#aaa39c]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M208,80H168V56a40,40,0,0,0-80,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM104,56a24,24,0,0,1,48,0V80H104ZM208,208H48V96H208V208Zm-80-48a16,16,0,1,1,16-16A16,16,0,0,1,128,160Z"/>
                    </svg>
                </span>

                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="block w-full rounded-lg border border-[#ded9d3] bg-[#faf9f7] py-2 pl-9 pr-10 text-xs text-[#3b3530] placeholder:text-[#aaa39c] transition duration-200 hover:border-[#c9c1b9] focus:border-[#B07D3A] focus:bg-white focus:ring-2 focus:ring-[#B07D3A]/20"
                />

                <button
                    type="button"
                    id="togglePwd"
                    aria-label="Mostrar contraseña"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-[#aaa39c] transition duration-200 hover:text-[#B07D3A] focus:outline-none focus:text-[#B07D3A]"
                >
                    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.48c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.36c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128a133.33,133.33,0,0,1,23.07-30.75C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"/>
                    </svg>
                </button>
            </div>

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-1 text-[10px]"
            />
        </div>

        <div>
            <x-input-label
                for="password_confirmation"
                value="Confirmar Contraseña"
                class="text-[10px] font-bold uppercase tracking-wide text-[#625b55]"
            />

            <div class="relative mt-1">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-[#aaa39c]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M208,80H168V56a40,40,0,0,0-80,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM104,56a24,24,0,0,1,48,0V80H104ZM208,208H48V96H208V208Zm-80-48a16,16,0,1,1,16-16A16,16,0,0,1,128,160Z"/>
                    </svg>
                </span>

                <x-text-input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••"
                    class="block w-full rounded-lg border border-[#ded9d3] bg-[#faf9f7] py-2 pl-9 pr-10 text-xs text-[#3b3530] placeholder:text-[#aaa39c] transition duration-200 hover:border-[#c9c1b9] focus:border-[#B07D3A] focus:bg-white focus:ring-2 focus:ring-[#B07D3A]/20"
                />

                <button
                    type="button"
                    id="togglePwdConfirmation"
                    aria-label="Mostrar confirmación de contraseña"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-[#aaa39c] transition duration-200 hover:text-[#B07D3A] focus:outline-none focus:text-[#B07D3A]"
                >
                    <svg id="eyeIconConfirmation" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 256 256" fill="currentColor">
                        <path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.48c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.36c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128a133.33,133.33,0,0,1,23.07-30.75C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"/>
                    </svg>
                </button>
            </div>

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-1 text-[10px]"
            />
        </div>

        <button
            type="submit"
            class="mt-2 w-full rounded-lg bg-[#B07D3A] px-4 py-2.5 text-xs font-semibold tracking-wide text-white shadow-[0_4px_18px_rgba(176,125,58,0.28)] transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#8A5E22] hover:shadow-[0_7px_22px_rgba(176,125,58,0.38)] active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-[#B07D3A]/30"
        >
            Crear mi cuenta
        </button>

        <div class="flex items-center gap-3 py-1">
            <div class="h-px flex-1 bg-[#e5e0da]"></div>
            <span class="text-[9px] font-medium uppercase tracking-wider text-[#aaa39c]">
                o continúa con
            </span>
            <div class="h-px flex-1 bg-[#e5e0da]"></div>
        </div>

        <a
            href="{{ route('google.login') }}"
            class="flex w-full items-center justify-center gap-2 rounded-lg border border-[#ded9d3] bg-white px-4 py-2.5 text-xs font-semibold text-[#514b46] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#c9c1b9] hover:bg-[#faf9f7] hover:shadow-md focus:outline-none focus:ring-2 focus:ring-[#B07D3A]/20"
        >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M21.35 12.27c0-.71-.06-1.39-.18-2.05H12v3.88h5.24a4.48 4.48 0 0 1-1.94 2.94v2.45h3.14c1.84-1.69 2.91-4.18 2.91-7.22Z"/>
                <path fill="#34A853" d="M12 21.75c2.63 0 4.84-.87 6.45-2.36l-3.14-2.45c-.87.58-1.98.92-3.31.92-2.54 0-4.69-1.72-5.46-4.03H3.3v2.53A9.75 9.75 0 0 0 12 21.75Z"/>
                <path fill="#FBBC05" d="M6.54 13.83A5.86 5.86 0 0 1 6.23 12c0-.64.11-1.26.31-1.83V7.64H3.3A9.75 9.75 0 0 0 2.25 12c0 1.57.38 3.05 1.05 4.36l3.24-2.53Z"/>
                <path fill="#EA4335" d="M12 6.14c1.43 0 2.71.49 3.72 1.45l2.79-2.79C16.84 3.25 14.63 2.25 12 2.25a9.75 9.75 0 0 0-8.7 5.39l3.24 2.53C6.31 7.86 8.46 6.14 12 6.14Z"/>
            </svg>

            Registrarse con Google
        </a>

        <div class="pt-1 text-center">
            <a
                href="{{ route('login') }}"
                class="text-[10px] font-semibold text-[#B07D3A] transition duration-200 hover:text-[#8A5E22] hover:underline"
            >
                ¿Ya tienes una cuenta? Inicia sesión
            </a>
        </div>
    </form>

    <script>
        const eyeOpen = `
            <path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.48c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.36c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128a133.33,133.33,0,0,1,23.07-30.75C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z"/>
        `;

        const eyeClosed = `
            <path d="M53.92,34.62A8,8,0,1,0,42.08,45.38L61.32,66.55C25,88.84,9.38,123.2,8.69,124.76a8,8,0,0,0,0,6.48c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208a127.11,127.11,0,0,0,52.07-10.83l22,24.21a8,8,0,1,0,11.84-10.76Zm47.33,75.84,41.67,45.85a16,16,0,0,1-21.43-23.57Zm51.4,56.56L110,119.88a32,32,0,0,0,42.61,47ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.16,133.16,0,0,1,25,128c4.69-8.79,19.66-33.19,47.35-49.21l18,19.8a48,48,0,0,0,63.66,70l14.73,16.2A112.31,112.31,0,0,1,128,192Zm119.31-61.24c-.35.79-8.82,19.57-27.65,38.4a8,8,0,0,1-11.31-11.31A133.88,133.88,0,0,0,231,128a133.46,133.46,0,0,0-23.12-30.75C185.67,75.19,158.78,64,128,64a115.22,115.22,0,0,0-23.43,2.38,8,8,0,1,1-3.26-15.65A131,131,0,0,1,128,48c34.88,0,66.57,13.26,91.66,38.35,18.83,18.83,27.3,37.62,27.65,38.41A8,8,0,0,1,247.31,130.76Z"/>
        `;

        function setupPasswordToggle(buttonId, inputId, iconId, showLabel, hideLabel) {
            const button = document.getElementById(buttonId);
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (!button || !input || !icon) return;

            button.addEventListener('click', () => {
                const isPassword = input.type === 'password';

                input.type = isPassword ? 'text' : 'password';
                icon.innerHTML = isPassword ? eyeClosed : eyeOpen;
                button.setAttribute('aria-label', isPassword ? hideLabel : showLabel);
            });
        }

        setupPasswordToggle(
            'togglePwd',
            'password',
            'eyeIcon',
            'Mostrar contraseña',
            'Ocultar contraseña'
        );

        setupPasswordToggle(
            'togglePwdConfirmation',
            'password_confirmation',
            'eyeIconConfirmation',
            'Mostrar confirmación de contraseña',
            'Ocultar confirmación de contraseña'
        );
    </script>

</x-guest-layout>
