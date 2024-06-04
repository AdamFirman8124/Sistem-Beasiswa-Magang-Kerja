@extends('layouts.app_auth_nofooter')

@section('content')
    <div class="container-sm my-5">
        <form action="{{ route('admin.loker.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="p-5 container-card rounded-3 border col-xl-6 shadow">
                    <div class="mb-3 text-center">
                        <h4 class="fw-bold">Create Lowongan Kerja</h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                                id="nama" value="{{ old('nama') }}" placeholder="Isi Nama Lowongan Kerja">
                            @error('nama')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="persyaratan" class="form-label fw-bold">Persyaratan</label>
                            <textarea class="form-control @error('persyaratan') is-invalid @enderror" name="persyaratan" id="persyaratan"
                                placeholder="Isi Persyaratan">{{ old('persyaratan') }}</textarea>
                            @error('persyaratan')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi"
                                placeholder="Isi Deskripsi">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="foto" class="form-label fw-bold">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto">
                            @if ($errors->has('foto'))
                                <span class="text-danger">{{ $errors->first('foto') }}</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 d-grid">
                            <a href="{{ route('admin.loker') }}" class="btn btn-outline-dark btn-cancle btn-lg mt-3 fw-bold"><i
                                    class="bi-arrow-left-circle me-2"></i> Cancel</a>
                        </div>
                        <div class="col-md-6 d-grid">
                            <button type="submit" class="btn btn-outline-dark btn-save btn-lg mt-3 fw-bold"><i class="bi-check-circle me-2"></i>
                                Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
