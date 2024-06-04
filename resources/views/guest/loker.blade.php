@extends('layouts.app_guest')

@section('content')
    <div class="container mt-5 mb-5">
        <span class="h1 fw-bold">
            List Lowongan Kerja
        </span>
        <p class="mt-3">
            Kesempatan Kerja Terbaik
        </p>
        <hr class="line-hr">

        {{-- loker --}}
        <div class="row d-flex justify-content-center">
            {{-- DATA --}}
            @foreach ($lokers as $loker)
                <div class="card mb-3 px-3 py-2 hover-card" style="max-width: 640px;  margin: 10px">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <a href="{{ asset($loker->image) }}" target="_blank">
                                <img src="{{ asset($loker->image) }}" class="img-fluid rounded shadow"
                                    alt="..." style="max-height: 180px;">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text"><small class="text-body-secondary">Loker,
                                        {{ $loker->created_at }}</small></p>
                                <h2 class="card-title" style="font-weight: bold">{{ $loker->name }}</h2>
                                <p class="card-text overflow-hidden" style="max-height: 50px; height:50px">
                                    {{ $loker->description }}</p>

                                {{-- Action --}}
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('guest.detail_loker', ['id' => $loker->id]) }}"class="baca-selengkapnya fw-bold">
                                        Baca selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
