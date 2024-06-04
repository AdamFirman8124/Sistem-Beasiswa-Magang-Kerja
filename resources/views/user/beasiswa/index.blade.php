@extends('layouts.app_user_nofooter')

@section('content')
<div class="container mt-4">
    <div class="row mb-0">
        <div class="col-lg-9 col-xl-6">
            <h4 class="mb-3">{{ $pageTitle }}</h4>
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
                            <a href="{{ route('user.beasiswa.show', ['id' => $beasiswa->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi bi-info-circle"></i></a>
                            @if(\App\Models\BeasiswaUser::where('nama', session('name'))->where('beasiswa_id', $beasiswa->id)->exists())
                                <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="confirmBeasiswa('{{ $beasiswa->id }}')" disabled>
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            @else
                                <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="confirmBeasiswa('{{ $beasiswa->id }}')">
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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    function confirmBeasiswa(id) {
        const randomSerial = 'B' + Math.random().toString().substr(2, 8); // Generates random 8 digits

        Swal.fire({
            title: 'Apakah Anda menerima beasiswa ini?',
            html: `
            <p>Silahkan masukkan bukti penerimaan beasiswa</p>
                <input id="nama" class="swal2-input" name="nama" value="{{ session('name') }}" hidden>
                <input id="beasiswa_id" type="text" value="${id}" name="beasiswa_id" hidden>
                <input id="serial" class="swal2-input" name="serial" value="${randomSerial}" hidden readonly>
                <input type="file" id="bukti" class="form-control" name="bukti" placeholder="Bukti penerimaan">
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, Saya Terima',
            cancelButtonText: 'Batal',
            focusConfirm: false,
            preConfirm: () => {
                const nama = Swal.getPopup().querySelector('#nama').value;
                const beasiswa_id = Swal.getPopup().querySelector('#beasiswa_id').value;
                const serial = Swal.getPopup().querySelector('#serial').value;
                const bukti = Swal.getPopup().querySelector('#bukti').files[0];

                return { name: nama, beasiswa_id: beasiswa_id, serial: serial, bukti: bukti };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('nama', result.value.name);
                formData.append('beasiswa_id', result.value.beasiswa_id);
                formData.append('serial', result.value.serial);
                formData.append('bukti', result.value.bukti);

                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.beasiswa.update') }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            html: 'Data berhasil disimpan. Berikut adalah kode referal Anda: <strong>' + result.value.serial + '</strong>. Jangan dihilangkan, kalau bisa di screenshot.',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        Swal.fire(
                            'Error!',
                            xhr.responseJSON.error || 'Terjadi kesalahan saat menambahkan data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>

@endsection
