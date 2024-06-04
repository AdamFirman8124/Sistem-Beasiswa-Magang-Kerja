@extends('layouts.app_guest')

@section('content')
    <div class="container mt-5 mb-5">
        <span class="h1 fw-bold">
            List Lomba
        </span>
        <p class="mt-3">
            Tunjukkan Bakat Terbaikmu!
        </p>
        <hr class="line-hr">

        {{-- lomba --}}
        <div class="row d-flex justify-content-center">
            {{-- DATA --}}
            @foreach ($lombas as $lomba)
                <div class="card mb-3 px-3 py-2 hover-card" style="max-width: 640px;  margin: 10px">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <a href="{{ asset($lomba->image) }}" target="_blank">
                                <img src="{{ asset($lomba->image) }}" class="img-fluid rounded shadow"
                                    alt="..." style="max-height: 180px;">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text"><small class="text-body-secondary">Lomba,
                                        {{ $lomba->created_at }}</small></p>
                                <h2 class="card-title" style="font-weight: bold">{{ $lomba->name }}</h2>
                                <p class="card-text overflow-hidden" style="max-height: 50px; height:50px">
                                    {{ $lomba->description }}</p>

                                {{-- Action --}}
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('guest.detail_lomba', ['id' => $lomba->id]) }}"class="baca-selengkapnya fw-bold">
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
