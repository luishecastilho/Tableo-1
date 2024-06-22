<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tableo 1</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <script defer>
            function toggleTablesList(restaurantId, list) {
                const tablesButton = document.querySelector(`#tables-${restaurantId}`);
                const tablesContainer = document.querySelector(`.tables-container[data-restaurant-id="${restaurantId}"]`);
                const activeTablesButton = document.querySelector(`#active-tables-${restaurantId}`);
                const activeTablesContainer = document.querySelector(`.active-tables-container[data-restaurant-id="${restaurantId}"]`);

                if (list === 'tables') {
                    if (tablesContainer.style.display != 'block') {
                        tablesContainer.style.display = 'block';
                        tablesButton.innerHTML = 'Hide Tables';
                    } else {
                        tablesContainer.style.display = 'none';
                        tablesButton.innerHTML = 'Tables';
                    }

                    activeTablesButton.innerHTML = 'Active Tables';
                    activeTablesContainer.style.display = 'none';
                } else {
                    if (activeTablesContainer.style.display != 'block') {
                        activeTablesContainer.style.display = 'block';
                        activeTablesButton.innerHTML = 'Hide Active Tables';
                    } else {
                        activeTablesContainer.style.display = 'none';
                        activeTablesButton.innerHTML = 'Active Tables';
                    }

                    tablesButton.innerHTML = 'Tables';
                    tablesContainer.style.display = 'none';
                }
            }
        </script>
    </head>
    <body class="antialiased">
        <div class="container mx-auto mt-6">
            <h1 class="text-2xl font-bold mb-4">Restaurants</h1>
            @foreach ($restaurants as $restaurant)
                <div class="border rounded-lg shadow-lg mb-4">
                    <div class="bg-gray-200 px-4 py-2 flex justify-between">
                        <h2 class="text-xl">{{ $restaurant->name }}</h2>
                        <div class="flex gap-x-2 mb-4">
                            <button
                                id="tables-{{$restaurant->id}}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-xl"
                                onclick="toggleTablesList({{$restaurant->id}}, 'tables')"
                            >Tables</button>
                            <button
                                id="active-tables-{{$restaurant->id}}"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-xl"
                                onclick="toggleTablesList({{$restaurant->id}}, 'active-tables')"
                            >Active Tables</button>
                        </div>
                    </div>
                    <div class="">
                        <div class="tables-container hidden m-4" data-restaurant-id="{{ $restaurant->id }}">
                            <h2 class="text-lg font-bold">Tables</h2>
                            <ul class="grid grid-cols-3 grid-flow-row mt-2 gap-y-3">
                                @foreach ($restaurant->tables as $table)
                                <li>
                                        <div class="flex flex-row items-center gap-2">
                                            @if ($table->active) <img class="w-4 h-4" src="{{ asset('svg/active.svg') }}" /> @else <img class="w-4 h-4" src="{{ asset('svg/not-active.svg') }}" /> @endif
                                            <h4>{{ $table->name }}</h4>
                                        </div>
                                        <div class="flex flex-col ml-6 text-sm">
                                            <span>Min. Capacity: {{ $table->minimum_capacity }}</span>
                                            <span>Max. Capacity: {{ $table->maximum_capacity }}</span>
                                        </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="active-tables-container hidden m-4" data-restaurant-id="{{ $restaurant->id }}">
                            <h2 class="text-lg font-bold">Active Tables by Dining Areas</h2>
                            <ul class="grid grid-cols-3 grid-flow-row mt-2 gap-y-3">
                                @foreach ($restaurant->tables->where('active', true)->groupBy('dining_area_id') as $dining_area_id => $dining_area_tables)
                                <li>
                                    <h3 class="font-bold">{{ $dining_area_tables->first()->diningArea->name }}</h3>
                                    <ul class="ml-4">
                                        @foreach ($dining_area_tables as $table)
                                            <li>- {{ $table->name }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </body>
