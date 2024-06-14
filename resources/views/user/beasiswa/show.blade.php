@extends('layouts.app_user_nofooter')

@section('content')
    <div class="container-sm my-5">

        {{-- Tittle --}}
        <div class="d-flex">
            <div class="text-body-secondary fw-bold">Beasiswa, </div>
            <div class="fw-bold" style="margin-left: 5px; color: #219CB3">{{ $beasiswa->created_at }}</div>
        </div>
        <div class="fw-bold" style="font-size: 35px">{{ $beasiswa->name }}</div>
        <hr class="line-hr">
        {{-- Content --}}
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="{{ asset($beasiswa->image) }}"
                    class="img-fluid rounded shadow p-3 rounded rounded-4 bg-white" alt="..." style="max-width: 100%;">
            </div>

            <div class="col-md-8">
                <div class="rounded shadow p-3 rounded rounded-4 bg-white">
                    <div class="contain-detail px-3 py-3 rounded rounded-3">
                        <span class="fw-bold">Deskripsi</span>
                        <textarea class="form-control text-area-detail mb-3" id="exampleFormControlTextarea1" rows="6" readonly>{{ $beasiswa->description }}</textarea>
                        <hr class="line-hr">
                        <span class="fw-bold">Persyaratan</span>
                        <textarea class="form-control text-area-detail mb-3" id="exampleFormControlTextarea1" rows="6" readonly>{{ $beasiswa->requirement }}</textarea>
                        <hr class="line-hr">
                        <div class="d-flex justify-content-end">
                            @if(!$isRegistered)
                                <button type="button" class="btn btn-outline-dark btn-sm me-2" onclick="confirmBeasiswa('{{ $beasiswa->id }}')">Daftar Beasiswa</button>
                            @else
                                <button type="button" class="btn btn-outline-dark btn-sm me-2" disabled>Sudah Terdaftar</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="line-hr">
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

            const formData = new FormData();
            formData.append('nama', nama);
            formData.append('beasiswa_id', beasiswa_id);
            formData.append('serial', serial);
            formData.append('bukti', bukti);
            formData.append('_token', '{{ csrf_token() }}');

            return fetch(`{{ route('user.beasiswa.update') }}`, {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText);
                }
                return response.json();
            }).then(data => {
                console.log(data); // Tambahkan ini untuk debugging
                Swal.fire('Berhasil!', 'Data berhasil disimpan. Berikut adalah serial number Anda: <strong>' + data.serial + '</strong>. Jangan dihilangkan, kalau bisa di screenshot.', 'success').then(() => {
                    location.reload();
                });
            }).catch(error => {
                Swal.showValidationMessage(`Request failed: ${error.message}`);
            });
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
                        html: 'Data berhasil disimpan. Berikut adalah kode referal Anda: <strong>' + response.serial + '</strong>. Jangan dihilangkan, kalau bisa di screenshot.',
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

