<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-2xl font-semibold">
                        Заполнить заявку
                    </p>

                    @role ('user')
                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                    @csrf

                    <!-- Email Address -->
                        <div>
                            <x-label for="first_name" :value="__('Имя')"/>

                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="last_name" :value="__('Фамилия')"/>

                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="patronymic" :value="__('Отчество')"/>

                            <x-input id="patronymic" class="block mt-1 w-full" type="text" name="patronymic" :value="old('patronymic')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="address" :value="__('Адрес')"/>

                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="phone" :value="__('Телефон')"/>

                            <x-input id="phone" class="block mt-1 w-full" type="number" name="address" :value="old('phone')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="email" :value="__('Почта')"/>

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                                     autofocus/>
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox"
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                       name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>


                        <div class="flex items-center justify-around mt-4">
                            <x-button class="ml-3">
                                Отправить
                            </x-button>
                        </div>
                    </form>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
