@extends('layouts.app_user_nofooter')

@section('content')
    <div class="container mt-4">
        <div class="row mb-0">
            <div class="col-lg-9 col-xl-6">
                <h4 class="mb-3">{{ $pageTitle }}</h4>
            </div>
        </div>
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
                                    <a href="{{ route('admin.lomba.show', ['id' => $lomba->id]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi bi-info-circle"></i></a>
                                    @if(\App\Models\LombaUser::where('nama', session('name'))->where('lomba_id', $lomba->id)->exists())
                                        <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="editLomba('{{ $lomba->id }}', '{{ session('name') }}')" disabled>
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="editLomba('{{ $lomba->id }}', '{{ session('name') }}')">
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
        function editLomba(id, name) {
            const randomSerial = 'L' + Math.random().toString().substr(2, 8); // Generates random 8 digits

            Swal.fire({
                title: 'Apakah Anda peraih lomba ini?',
                html: `
                <p>Silahkan masukkan Juara dan bukti keikutsertaan</p>
                    <input id="nama" class="swal2-input" name="nama" value="${name}" hidden>
                    <input id="id_lomba" type="text" value="${id}" name="lomba_id" hidden>
                    <input id="juara" class="swal2-input" name="juara" placeholder="Juara">
                    <input id="serial" class="swal2-input" name="serial" value="${randomSerial}" hidden readonly>
                    <input type="file" id="bukti" class="form-control" name="bukti" placeholder="Bukti keikutsertaan">
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const nama = Swal.getPopup().querySelector('#nama').value;
                    const juara = Swal.getPopup().querySelector('#juara').value;
                    const lomba_id = Swal.getPopup().querySelector('#id_lomba').value;
                    const serial = Swal.getPopup().querySelector('#serial').value;
                    const bukti = Swal.getPopup().querySelector('#bukti').files[0];

                    if (!juara) {
                        Swal.showValidationMessage('Juara harus diisi');
                        return false;
                    }
                    return { name: nama, juara: juara, lomba_id: lomba_id, serial: serial, bukti: bukti };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('nama', result.value.name);
                    formData.append('juara', result.value.juara);
                    formData.append('lomba_id', result.value.lomba_id);
                    formData.append('serial', result.value.serial);
                    formData.append('bukti', result.value.bukti);

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('user.lomba.update') }}',
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
