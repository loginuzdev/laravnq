<div x-show="modal_open" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
     aria-modal="true">
    <div class="flex items-center justify-center md:px-4 text-center w-full">
        <div x-cloak x-on:click="modal_open = false" x-show="modal_open"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
        ></div>

        <div class="flex items-center justify-center md:h-screen w-full">
            <div x-cloak x-show="modal_open"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="h-screen md:h-auto w-full md:max-w-xl p-8 overflow-hidden text-left transition-all transform bg-opacity-90 bg-slate-900 md:rounded-lg"
            >

                <div class="flex items-center justify-end space-x-4">
                    <button x-on:click="modal_open = false"
                            class="text-slate-200 focus:outline-none hover:text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </button>
                </div>

                <form class="space-y-2" method="POST" x-on:submit.prevent="auth">
                    <div class="w-full text-2xl text-center font-bold py-4 text-slate-200">Login</div>
                    <div>
                        <input x-model="auth_form.username" id="username" placeholder="Username" type="text" autocapitalize="off" autocomplete="off"
                               autocorrect="off"
                               class="w-full px-3 py-2 border rounded focus:outline-none focus:border-sky-500  bg-slate-900 border-slate-800 text-slate-200">
                    </div>

                    <div>
                        <input x-model="auth_form.password" id="password" placeholder="Password" type="password" autocapitalize="off"
                               autocomplete="off"
                               autocorrect="off"
                               class="w-full px-3 py-2 border rounded focus:outline-none focus:border-sky-500  bg-slate-900 border-slate-800 text-slate-200">
                    </div>

                    <div x-show="auth_form.error.length === 0" class="text-sm text-red-800 tracking-wide text-left">&nbsp;</div>
                    <div class="text-sm text-red-800 tracking-wide text-left" x-text="auth_form.error"></div>
                    <div>
                        <button type="submit"
                                class="px-3 py-2 text-sm border rounded w-full bg-sky-500 text-white tracking-wide border-sky-500 hover:opacity-90">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
