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
                    <a href="{{ route('admin.beasiswa.create') }}" class="btn btn-dark">
                        <i class="bi bi-plus-circle me-1"></i> Create Beasiswa
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        @foreach ($beasiswas as $beasiswa)
        <div class="card mb-3 px-3 py-2" style="max-width: 540px; margin: 10px">
            <div class="row g-0">
                <div class="col-md-4 d-flex justify-content-center align-items-center">
                    <img src="{{ asset($beasiswa->image) }}" class="img-fluid rounded shadow" alt="..." style="max-height: 180px;">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text"><small class="text-body-secondary">Beasiswa, {{ $beasiswa->created_at }}</small></p>
                        <h2 class="card-title" style="font-weight: bold">{{ $beasiswa->name }}</h2>
                        <p class="card-text overflow-hidden" style="max-height: 50px; height:50px">{{ $beasiswa->description }}</p>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.beasiswa.show', ['id' => $beasiswa->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi bi-info-circle"></i></a>
                            <a href="{{ route('admin.beasiswa.edit', ['id' => $beasiswa->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>
                            <form action="{{ route('admin.beasiswa.destroy', ['id' => $beasiswa->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-dark btn-sm me-2 btn-delete" data-name="{{ $beasiswa->name }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
