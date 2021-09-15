<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session('success'))
                        <div class="bg-teal-100 border-teal-500 rounded-b text-teal-900 px-4 py-3 mt-4" role="alert">
                            <div class="flex">
                                <div class="py-1">
                                    <svg class="fill-current h-6 w-6 text-teal-500 mr-4"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold">{{ session('success') }} </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @role ('admin')
                    <form method="POST" action="{{route('update', ['id'=>$bid->id])}}" class="max-w-2xl mt-4 mx-auto">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                        <p class="text-2xl font-semibold">
                            Редактировать заявку id:{{$bid->id}}
                        </p>
                        @csrf
                        <div class="mt-4">
                            <x-label for="last_name" :value="__('Фамилия')"/>

                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                     value="{{$bid->last_name}}" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="first_name" :value="__('Имя')"/>

                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                     value="{{$bid->first_name}}" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="patronymic" :value="__('Отчество')"/>

                            <x-input id="patronymic" class="block mt-1 w-full" type="text" name="patronymic"
                                     value="{{$bid->patronymic}}" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="address" :value="__('Адрес')"/>

                            <x-input id="address" class="block mt-1 w-full" type="text" name="address"
                                     value="{{$bid->address}}" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="phone" :value="__('Телефон')"/>

                            <x-input id="phone" class="block mt-1 w-full" type="number" name="phone"
                                     value="{{$bid->phone}}" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="email" :value="__('Почта')"/>

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                     value="{{$bid->email}}" required
                                     autofocus/>
                        </div>
                        <div class="flex items-center justify-around mt-4">
                            <x-button class="ml-3">
                                Обновить
                            </x-button>
                        </div>
                    </form>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
