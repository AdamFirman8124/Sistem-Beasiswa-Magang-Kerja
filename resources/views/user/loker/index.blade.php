@extends('layouts.app_user_nofooter')

@section('content')
    <div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-6">
                <h4 class="mb-3">{{ $pageTitle }}</h4>
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
                                    <a href="{{ route('user.loker.show', ['id' => $loker->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi bi-info-circle"></i></a>
                                    @if(\App\Models\MagangUser::where('nama', session('name'))->where('magang_id', $loker->id)->exists())
                                        <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="addMagangUser('{{ $loker->id }}', '{{ $loker->name }}')" disabled><i class="bi bi-plus"></i></button>
                                    @else
                                        <button type="button" class="btn btn-outline-dark btn-sm" onclick="addMagangUser('{{ $loker->id }}',  '{{ session('name') }}')"><i class="bi bi-plus"></i></button>
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
        function addMagangUser(id, name) {
            const randomSerial = 'M' + Math.random().toString().substr(2, 8); // Generates random 8 digits

            Swal.fire({
                title: 'Apakah anda pernah magang di perusahaan ini?',
                html: `
                    <p>Silahkan masukkan Durasi dan bukti keikutsertaan</p>
                    <input id="nama" class="swal2-input" name="nama" value="${name}" hidden>
                    <input id="id_loker" type="text" value="${id}" name="magang_id" hidden>
                    <input id="durasi" class="swal2-input" name="durasi" placeholder="Durasi">
                    <input id="serial" class="swal2-input" name="serial" value="${randomSerial}" hidden readonly>
                    <input type="file" id="bukti" class="form-control" name="bukti" placeholder="Bukti penerimaan">
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const nama = Swal.getPopup().querySelector('#nama').value;
                    const durasi = Swal.getPopup().querySelector('#durasi').value;
                    const magang_id = Swal.getPopup().querySelector('#id_loker').value;
                    const serial = Swal.getPopup().querySelector('#serial').value;
                    const bukti = Swal.getPopup().querySelector('#bukti').files[0];

                    if (!durasi) {
                        Swal.showValidationMessage('Durasi harus diisi');
                        return false;
                    }
                    return { nama: nama, durasi: durasi, magang_id: magang_id, serial: serial, bukti: bukti };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('nama', result.value.nama);
                    formData.append('durasi', result.value.durasi);
                    formData.append('magang_id', result.value.magang_id);
                    formData.append('serial', result.value.serial);
                    formData.append('bukti', result.value.bukti);

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('user.loker.update') }}',
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
