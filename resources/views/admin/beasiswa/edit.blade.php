@extends('layouts.app_auth_nofooter')

@section('content')
    <div class="container-sm my-5">
        <form action="{{ route('admin.beasiswa.update', ['id' => $beasiswa->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row justify-content-center">
                <div class="p-5 container-card shadow rounded-3 col-xl-6">
                    <div class="mb-3 text-center">
                        <h4 class="fw-bold">Edit Beasiswa</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="nama" value="{{ old('nama', $beasiswa->name) }}">
                            @error('nama')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="persyaratan" class="form-label fw-bold">Persyaratan</label>
                            <textarea class="form-control @error('persyaratan') is-invalid @enderror" name="persyaratan" id="persyaratan" rows="4">{{ old('persyaratan', $beasiswa->requirement) }}</textarea>
                            @error('persyaratan')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi', $beasiswa->description) }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="foto" class="form-label fw-bold">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('admin.beasiswa') }}" class="btn btn-outline-dark btn-cancle btn-lg mt-3 fw-bold"><i class="bi-arrow-left-circle me-2"></i> Cancel</a>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-save btn-outline-dark fw-bold btn-lg mt-3"><i class="bi-check-circle me-2"></i> Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
