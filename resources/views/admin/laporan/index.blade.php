@extends('layouts.app_auth_nofooter')

@section('content')
<div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-6">
                <h4 class="mb-3">{{ $pageTitle }}</h4>
            </div>
            <div class="col-lg-3 col-xl-6">
                <ul class="list-inline mb-0 float-end">
                    <li class="list-inline-item">
                        <a href="{{ route('admin.laporan') }}" class="btn btn-primary">
                         Data Beasiswa
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('admin.laporan.datalomba') }}" class="btn btn-secondary">
                         Data Lomba
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('admin.laporan.dataloker') }}" class="btn btn-success">
                         Data Magang
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <div class="container-sm my-5">
    {{-- Histograms --}}
        <div class="mb-5">
            <hr class="line-hr">
            <h4 class="mb-3">Statistik Beasiswa</h4>
            <canvas id="beasiswaChart"></canvas>
        </div>

        {{-- Penerima Beasiswa --}}
        <div class="mb-5">
            <h4 class="mb-3">Penerima Beasiswa</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 25%;" scope="col">Kode Serial</th>
                            <th style="width: 25%;" scope="col">Nama Beasiswa</th>
                            <th scope="col">Nama Penerima</th>
                            <th style="width: 10%;" scope="col">Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beasiswaUsers as $beasiswaUser)
                            <tr>
                                <td>{{ $beasiswaUser->serial }}</td>
                                <td>{{ $beasiswaUser->beasiswa->name }}</td>
                                <td>{{ $beasiswaUser->nama }}</td>
                                <td>
                                    <a href="{{ asset($beasiswaUser->bukti) }}" target="_blank">
                                        <img src="{{ asset($beasiswaUser->bukti) }}" alt="..." style="height: 40px;">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for Beasiswa Chart
        const beasiswaData = @json(array_values($beasiswaCount));
        const beasiswaLabels = @json(array_keys($beasiswaCount));
        const beasiswaCtx = document.getElementById('beasiswaChart').getContext('2d');
        const beasiswaChart = new Chart(beasiswaCtx, {
            type: 'bar',
            data: {
                labels: beasiswaLabels,
                datasets: [{
                    label: 'Penerima Beasiswa',
                    data: beasiswaData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

