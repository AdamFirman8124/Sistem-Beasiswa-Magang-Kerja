@extends('layouts.app_user_nofooter')

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
                        <div class="d-flex justify-content-end">
                            @if(\App\Models\MagangUser::where('nama', session('name'))->where('magang_id', $loker->id)->exists())
                                <button type="button" class="btn btn-outline-dark btn-sm me-2" disabled>Sudah Daftar</button>
                            @else
                                <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="addMagangUser('{{ $loker->id }}',  '{{ session('name') }}')">Daftar Kerja</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="line-hr">
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