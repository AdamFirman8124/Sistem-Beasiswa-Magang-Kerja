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
                        <a href="{{ route('admin.loker.create') }}" class="btn btn-dark">
                            <i class="bi bi-plus-circle me-1"></i> Create Lowongan Kerja
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            {{-- DATA --}}
            @foreach ($lokers as $loker)
                <div class="card mb-3 px-3 py-2" style="max-width: 540px; margin: 10px;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <img src="{{ asset($loker->image) }}" class="img-fluid rounded shadow" alt="{{ $loker->name }}" style="max-height: 180px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text"><small class="text-body-secondary">Lowongan Kerja, {{ $loker->created_at->format('d M Y') }}</small></p>
                                <h2 class="card-title" style="font-weight: bold">{{ $loker->name }}</h2>
                                <p class="card-text overflow-hidden" style="max-height: 50px; height:50px;">{{ $loker->description }}</p>

                                {{-- Action --}}
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.loker.show', ['id' => $loker->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi bi-info-circle"></i></a>
                                    <a href="{{ route('admin.loker.edit', ['id' => $loker->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>
                                    <div>
                                        <form action="{{ route('admin.loker.destroy', ['id' => $loker->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete {{ $loker->name }}?');">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-dark btn-sm"><i class="bi-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
