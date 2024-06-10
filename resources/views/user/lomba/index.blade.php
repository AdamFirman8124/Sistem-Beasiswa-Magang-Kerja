@extends('layouts.app_user_nofooter')

@section('content')
<div class="container">
    <h3 class="mt-4">{{ $pageTitle }}</h3>
    @if ($lombas->isEmpty())
        <p>Tidak ada data lomba yang tersedia.</p>
    @else
        <div class="row d-flex justify-content-center">
            @foreach ($lombas as $lomba)
            <div class="card mb-3 px-3 py-2" style="max-width: 540px; margin: 10px">
                <div class="row g-0">
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <img src="{{ asset($lomba->image) }}" class="img-fluid rounded shadow" alt="..." style="max-height: 180px;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text"><small class="text-body-secondary">Lomba, {{ $lomba->created_at }}</small></p>
                            <h2 class="card-title" style="font-weight: bold">{{ $lomba->name }}</h2>
                            <p class="card-text overflow-hidden" style="max-height: 50px; height:50px">{{ $lomba->description }}</p>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('user.lomba.show', ['id' => $lomba->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi bi-info-circle"></i></a>
                                @if(\App\Models\LombaUser::where('nama', session('name'))->where('lomba_id', $lomba->id)->exists())
                                    <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="confirmLomba('{{ $lomba->id }}')" disabled>
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                @else
                                    <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="confirmLomba('{{ $lomba->id }}')">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
