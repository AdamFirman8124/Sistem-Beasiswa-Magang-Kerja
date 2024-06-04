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
            <h4 class="mb-3">Statistik Lomba</h4>
            <canvas id="lombaChart"></canvas>
        </div>
        {{-- Mahasiswa Berprestasi --}}
        <div class="mb-5">
            <hr class="line-hr">
            <h4 class="mb-3">Mahasiswa Berprestasi</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 25%;" scope="col">Kode Serial</th>
                            <th style="width: 25%;" scope="col">Nama lomba</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Juara</th>
                            <th style="width: 10%;" scope="col">Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lombaUsers as $lombaUser)
                            <tr>
                                <td>{{ $lombaUser->serial }}</td>
                                <td>{{ $lombaUser->lomba->name }}</td>
                                <td>{{ $lombaUser->nama }}</td>
                                <td>{{ $lombaUser->juara }}</td>
                                <td>
                                    <a href="{{ asset($lombaUser->bukti) }}" target="_blank">
                                        <img src="{{ asset($lombaUser->bukti) }}" alt="..." style="height: 40px;">
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


        // Data for Lomba Chart
        const lombaData = @json(array_values($lombaCount));
        const lombaLabels = @json(array_keys($lombaCount));


        // Lomba Chart
        const lombaCtx = document.getElementById('lombaChart').getContext('2d');
        const lombaChart = new Chart(lombaCtx, {
            type: 'bar',
            data: {
                labels: lombaLabels,
                datasets: [{
                    label: 'Pemenang Lomba',
                    data: lombaData,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
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

        // Magang Chart
        const magangCtx = document.getElementById('magangChart').getContext('2d');
        const magangChart = new Chart(magangCtx, {
            type: 'bar',
            data: {
                labels: magangLabels,
                datasets: [{
                    label: 'Mahasiswa Magang',
                    data: magangData,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
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

