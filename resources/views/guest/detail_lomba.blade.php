@extends('layouts.app_guest')

@section('content')
    <div class="container-sm my-5">

        {{-- Tittle --}}
        <div class="d-flex">
            <div class="text-body-secondary fw-bold">Lomba, </div>
            <div class="fw-bold" style="margin-left: 5px; color: #219CB3">{{ $lomba->created_at }}</div>
        </div>
        <div class="fw-bold" style="font-size: 35px">{{ $lomba->name }}</div>
        <hr class="line-hr">
        {{-- Content --}}
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ asset($lomba->image) }}"
                    class="img-fluid rounded shadow p-3 rounded rounded-4 bg-white" alt="..." style="max-width: 100%;">
            </div>

            <div class="col-md-8">
                <div class="rounded shadow p-3 rounded rounded-4 bg-white">
                    <div class="contain-detail px-3 py-3 rounded rounded-3">
                        <span class="fw-bold">Deskripsi</span>
                        <textarea class="form-control text-area-detail mb-3" id="exampleFormControlTextarea1" rows="6" readonly>{{ $lomba->description }}</textarea>
                        <hr class="line-hr">
                        <span class="fw-bold">Persyaratan</span>
                        <textarea class="form-control text-area-detail mb-3" id="exampleFormControlTextarea1" rows="6" readonly>{{ $lomba->requirement }}</textarea>
                        <hr class="line-hr">
                    </div>
                </div>
            </div>
        </div>
        <hr class="line-hr">
    </div>
@endsection
