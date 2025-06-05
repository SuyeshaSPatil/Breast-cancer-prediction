@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">

    <h1 class="text-4xl font-bold text-pink-700 mb-6">Dashboard for {{ $user->name }}</h1> 

    {{-- Show error if file is not readable --}}
    @if (isset($error))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-6">
            {{ $error }}
        </div>
    @endif

    {{-- Show charts if data is available --}}
    @if (isset($data) && count($data) > 1)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Bar Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <canvas id="barChart"></canvas>
            </div>

            <!-- Pie Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <canvas id="pieChart"></canvas>
            </div>

            <!-- Line Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <canvas id="lineChart"></canvas>
            </div>

            <!-- Doughnut Chart -->
            <div class="bg-white rounded-lg shadow p-6">
                <canvas id="doughnutChart"></canvas>
            </div>

        </div>

        <!-- Upload CSV file section -->
<div class="bg-white p-6 rounded shadow mb-6">
    <form action="{{ route('dashboard.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="block text-sm font-medium text-gray-700">Upload Cancer Data CSV</label>
        <input type="file" name="file" accept=".csv" class="mt-2 p-2 border rounded w-full">
        <button type="submit" class="mt-4 px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-700">Upload</button>
    </form>
</div>
@if(isset($mlResult) && !isset($mlResult['error']))
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Model Accuracy</p>
            <h2 class="text-2xl font-bold text-green-600">{{ $mlResult['accuracy'] }}%</h2>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Stage I</p>
            <h2 class="text-2xl font-bold text-pink-500">{{ $mlResult['stage_1'] }}</h2>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Stage II</p>
            <h2 class="text-2xl font-bold text-purple-500">{{ $mlResult['stage_2'] }}</h2>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Stage III</p>
            <h2 class="text-2xl font-bold text-red-500">{{ $mlResult['stage_3'] }}</h2>
        </div>
    </div>
@elseif(isset($mlResult['error']))
    <p class="text-red-500 font-semibold">ML Error: {{ $mlResult['error'] }}</p>
@endif


@if (isset($data))
    <div class="mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Raw Cancer Dataset</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        @foreach ($data[0] as $header)
                            <th class="border px-4 py-2">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach (array_slice($data, 1) as $row)
                        <tr>
                            @foreach ($row as $cell)
                                <td class="border px-4 py-2">{{ $cell }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const rawData = @json($data);
            const headers = rawData[0];
            const rows = rawData.slice(1);

            const labels = rows.map(row => row[0]); // First column as labels

            const numericColumnIndex = headers.findIndex(h => h.toLowerCase().includes("run") || h.toLowerCase().includes("score") || h.toLowerCase().includes("marks") || h.toLowerCase().includes("value"));
            const values = rows.map(row => parseFloat(row[numericColumnIndex]) || 0);

            const chartData = {
                labels: labels,
                datasets: [{
                    label: headers[numericColumnIndex],
                    data: values,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                        '#9966FF', '#FF9F40', '#DCDCDC', '#4D5360'
                    ],
                    borderColor: '#ccc',
                    borderWidth: 1
                }]
            };

            const commonOptions = {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    title: { display: true }
                }
            };

            // Bar Chart
            new Chart(document.getElementById('barChart'), {
                type: 'bar',
                data: chartData,
                options: {
                    ...commonOptions,
                    title: { text: 'Bar Chart - Comparison', display: true },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Pie Chart
            new Chart(document.getElementById('pieChart'), {
                type: 'pie',
                data: chartData,
                options: {
                    ...commonOptions,
                    title: { text: 'Pie Chart - Distribution', display: true }
                }
            });

            // Line Chart
            new Chart(document.getElementById('lineChart'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: headers[numericColumnIndex],
                        data: values,
                        borderColor: '#36A2EB',
                        fill: false,
                        tension: 0.3
                    }]
                },
                options: {
                    ...commonOptions,
                    title: { text: 'Line Chart - Trend Analysis', display: true },
                    scales: { y: { beginAtZero: true } }
                }
            });

            // Doughnut Chart
            new Chart(document.getElementById('doughnutChart'), {
                type: 'doughnut',
                data: chartData,
                options: {
                    ...commonOptions,
                    title: { text: 'Doughnut Chart - Distribution', display: true }
                }
            });
        </script>
    @elseif (!isset($error))
        <p class="text-gray-600">No data available in the attachment.</p>
    @endif

</div>
@endsection
