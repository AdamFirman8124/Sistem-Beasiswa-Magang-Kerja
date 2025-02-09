@extends('layouts.app_auth_nofooter')

@section('content')
    <div class="container-sm my-5">

        {{-- Tittle --}}
        <div class="d-flex">
            <div class="text-body-secondary fw-bold">Lowongan Kerja, </div>
            <div class="fw-bold" style="margin-left: 5px; color: #219CB3">{{ $loker->created_at }}</div>
        </div>
        <div class="fw-bold" style="font-size: 35px">{{ $loker->name }}</div>
        <hr class="line-hr">
        {{-- Content --}}
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ asset($loker->image) }}"
                    class="img-fluid rounded shadow p-3 rounded rounded-4 bg-white" alt="..." style="max-width: 100%;">
            </div>

            <div class="col-md-8">
                <div class="rounded shadow p-3 rounded rounded-4 bg-white">
                    <div class="contain-detail px-3 py-3 rounded rounded-3">
                        <span class="fw-bold">Deskripsi</span>
                        <textarea class="form-control text-area-detail mb-3" id="exampleFormControlTextarea1" rows="6" readonly>{{ $loker->description }}</textarea>
                        <hr class="line-hr">
                        <span class="fw-bold">Persyaratan</span>
                        <textarea class="form-control text-area-detail mb-3" id="exampleFormControlTextarea1" rows="6" readonly>{{ $loker->requirement }}</textarea>
                        <hr class="line-hr">
                        @if ($loker->link)
                            <span class="fw-bold">Link Pendaftaran</span>
                            <a href="{{ $loker->link }}" class="d-block mb-3" target="_blank">{{ $loker->link }}</a>
                        @endif
                        <hr class="line-hr">
                    </div>
                </div>
            </div>
        </div>
        <hr class="line-hr">
        {{-- Participant Info --}}
        <hr class="line-hr">
        <h4 class="mb-3">Data Magang</h4>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Kode Serial</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Durasi</th>
                        <th scope="col">Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lokerUsers as $lokerUser)
                        <tr>
                            <td>{{ $lokerUser->serial }}</td>
                            <td>{{ $lokerUser->nama }}</td>
                            <td>{{ $lokerUser->durasi }}</td>
                            <td>     <a href="{{ asset($lokerUser->bukti) }}" target="_blank">
                                    <img src="{{ asset($lokerUser->bukti) }}" alt="..." style="height: 40px;">
                                </a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
