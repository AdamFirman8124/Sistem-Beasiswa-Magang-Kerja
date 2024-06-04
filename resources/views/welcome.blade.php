@extends('layouts.app_guest')

@section('content')
    <div class="mb-3 mt-3 d-none d-md-block">
        <div class="text-center" style="position: relative;">
            {{-- Logo banner --}}
            <img class="img"
                style="width: 30%; position: absolute; top: 40%; left: 50%; transform: translateX(-50%); z-index: 10;"
                src="{{ asset('assets/logo-banner.webp') }}" alt="image">

            {{-- Search box pc --}}
            <div class="container">
                <form method="GET" action="{{ route('indexwelcome') }}">
                    <div class="input-group mb-3"
                        style="width: 60%; position: absolute; top: 65%; left: 50%; transform: translateX(-50%); z-index: 10;">
                        <input type="text" name="search" class="form-control rounded-start-4" placeholder="Search..." aria-label="Search"
                            aria-describedby="basic-addon2" value="{{ request()->query('search') }}">
                        <span class="input-group-text p-1 rounded-end-4" id="basic-addon2">
                            <button type="submit" class="btn btn-light text-dark">
                                <i class="bi bi-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            {{-- banner --}}
            <img class="img" style="width: 100%; z-index: 1;" src="{{ asset('assets/banner.webp') }}"
                alt="image">
        </div>
    </div>

    <div class="mb-3 mt-3 d-block d-md-none">
        {{-- Search box hp --}}
        <div class="container">
            <form method="GET" action="{{ route('indexwelcome') }}">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control rounded-start-4" placeholder="Search..." aria-label="Search"
                        aria-describedby="basic-addon2" value="{{ request()->query('search') }}">
                    <span class="input-group-text p-1 rounded-end-4" id="basic-addon2">
                        <button type="submit" class="btn btn-light">
                            <i class="bi bi-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <div class="col-12 col-md-9">
                <p class="h1 fw-bold">
                    Informasi Terbaru
                </p>
                <p class="fs-5">
                    Beasiswa, Lomba, dan Lowongan Kerja Terbaru
                </p>
            </div>
        </div>
        <hr class="line-hr">
        {{-- Beasiswa --}}
        <div class="row">
            {{-- DATA --}}
            @foreach ($beasiswas as $beasiswa)
                <div class="card mb-3 px-3 py-2 hover-card" style="max-width: 640px; margin: 10px">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <a href="{{ asset($beasiswa->image) }}" target="_blank">
                                <img src="{{ asset($beasiswa->image) }}" class="img-fluid rounded shadow"
                                    alt="..." style="max-height: 180px;">
                            </a>
                        </div>

                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text"><small class="text-body-secondary">Beasiswa,
                                        {{ $beasiswa->created_at }}</small></p>
                                <h2 class="card-title" style="font-weight: bold">{{ $beasiswa->name }}</h2>
                                <p class="card-text overflow-hidden" style="max-height: 50px; height:50px">
                                    {{ $beasiswa->description }}</p>

                                {{-- Action --}}
                                <div class="d-flex justify-content-end">
                                    @guest
                                        <a href="{{ route('login') }}" class="baca-selengkapnya fw-bold">Login untuk melihat</a>
                                    @else
                                        <a href="{{ route('guest.detail_beasiswa', ['id' => $beasiswa->id]) }}" class="baca-selengkapnya fw-bold">
                                            Baca selengkapnya
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- lomba --}}
        <div class="row">
            {{-- DATA --}}
            @foreach ($lombas as $lomba)
                <div class="card mb-3 px-3 py-2 hover-card" style="max-width: 640px; margin: 10px">
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
                                    @guest
                                        <a href="{{ route('login') }}" class="baca-selengkapnya fw-bold">Login untuk melihat</a>
                                    @else
                                        <a href="{{ route('guest.detail_lomba', ['id' => $lomba->id]) }}" class="baca-selengkapnya fw-bold">
                                            Baca selengkapnya
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- loker --}}
        <div class="row">
            {{-- DATA --}}
            @foreach ($lokers as $loker)
                <div class="card mb-3 px-3 py-2 hover-card" style="max-width: 640px; margin: 10px">
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
                                    @guest
                                        <a href="{{ route('login') }}" class="baca-selengkapnya fw-bold">Login untuk melihat</a>
                                    @else
                                        <a href="{{ route('guest.detail_loker', ['id' => $loker->id]) }}" class="baca-selengkapnya fw-bold">
                                            Baca selengkapnya
                                        </a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
