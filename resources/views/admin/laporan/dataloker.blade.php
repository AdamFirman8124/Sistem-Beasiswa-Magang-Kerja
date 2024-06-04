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
            <h4 class="mb-3">Statistik Magang</h4>
            <canvas id="magangChart"></canvas>
        </div>
        {{-- Mahasiswa yang Sudah Magang --}}
        <div class="mb-5">
            <hr class="line-hr">
            <h4 class="mb-3">Mahasiswa yang Sudah Magang</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 25%;" scope="col">Kode Serial</th>
                            <th style="width: 25%;" scope="col">Nama Loker</th>
                            <th style="width: 25%;" scope="col">Nama</th>
                            <th scope="col">Durasi Magang</th>
                            <th style="width: 10%;" scope="col">Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($magangUsers as $magangUser)
                            <tr>
                                <td>{{ $magangUser->serial }}</td>
                                <td>{{ $magangUser->loker->name }}</td>
                                <td>{{ $magangUser->nama }}</td>
                                <td>{{ $magangUser->durasi }}</td>
                                <td>
                                    <a href="{{ asset($magangUser->bukti) }}" target="_blank">
                                        <img src="{{ asset($magangUser->bukti) }}" alt="..." style="height: 40px;">
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

    
        const magangData = @json(array_values($magangCount));
        const magangLabels = @json(array_keys($magangCount));

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

