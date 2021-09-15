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

                    @role('admin')
                    <form method="post" action="{{ route('search') }}">
                        @csrf
                        <div
                            class="inline-flex items-center bg-white rounded-lg overflow-hidden px-2 py-1 justify-between">
                            <input id="input_filter" name="input_filter"
                                   class="w-full text-base text-gray-400 flex-grow outline-none px-2 border-2 px-4 py-2 rounded-lg"
                                   type="text" placeholder="Поиск"/>
                            <select id="select_filter" name="select_filter"
                                    class="text-base text-gray-800 outline-none border-2 py-2 rounded-lg ml-3">
                                <option value="fio" selected>ФИО</option>
                                <option value="address">Адрес</option>
                                <option value="email">Почта</option>
                                <option value="phone">Телефон</option>
                                <option value="created_at">Дата заказа</option>
                            </select>
                            <div class="ms:flex items-center px-2 rounded-lg space-x-4">
                                <button class="bg-indigo-500 text-white text-base rounded-lg px-4 py-2 font-thin">
                                    Найти
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="flex flex-col mt-4">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ФИО
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Адрес
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Телефон
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Дата заказа
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($bids as $bid)
                                            <tr>
                                                <td class="px-2 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{$bid->last_name}} {{$bid->first_name}} {{$bid->patronymic}}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{$bid->email}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$bid->address}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{$bid->phone}}
                                                </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{$bid->created_at}}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endrole
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
                    @role ('user')


                    <form method="POST" action="{{ route('post') }}" class="max-w-2xl mt-4 mx-auto">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                        <p class="text-2xl font-semibold">
                            Заполнить заявку
                        </p>
                        @csrf

                        <div class="mt-4">
                            <x-label for="last_name" :value="__('Фамилия')"/>

                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                     :value="old('last_name')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="first_name" :value="__('Имя')"/>

                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                     :value="old('first_name')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="patronymic" :value="__('Отчество')"/>

                            <x-input id="patronymic" class="block mt-1 w-full" type="text" name="patronymic"
                                     :value="old('patronymic')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="address" :value="__('Адрес')"/>

                            <x-input id="address" class="block mt-1 w-full" type="text" name="address"
                                     :value="old('address')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="phone" :value="__('Телефон')"/>

                            <x-input id="phone" class="block mt-1 w-full" type="number" name="phone"
                                     :value="old('phone')" required
                                     autofocus/>
                        </div>
                        <div class="mt-4">
                            <x-label for="email" :value="__('Почта')"/>

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                     :value="old('email')" required
                                     autofocus/>
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
