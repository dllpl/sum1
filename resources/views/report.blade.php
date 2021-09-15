<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Отчет
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

                    @role('admin')
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let days = <?php echo $days; ?>;
    let bid_in_days = <?php echo $bid_in_days ; ?>;

    let barChartData = {
        labels: days,
        datasets: [{
            label: 'Заказы',
            backgroundColor: "gray",
            data: bid_in_days
        }]
    };


    window.onload = function() {
        let ctx = document.getElementById("myChart").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
            }
        });
    };

</script>
