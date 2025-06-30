@extends('pelanggan.layouts.app')

@section('contents')
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Login!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

   <div class="row card-dashboard justify-content-center">
    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3 text-center">
        <div class="card card-reservasi shadow h-100 py-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="mb-4 mt-2">Jumlah Anak</div>
                        <div class="h5 mb-2" style="font-size: 28px;">{{ $jumlahAnak}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3 text-center">
        <div class="card card-konfirmasi shadow h-100 py-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="mb-4 mt-2">Total Reservasi</div>
                        <div class="h5 mb-2" style="font-size: 28px;">{{ $totalReservasi }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="text-center mt-4 mb-4" style="color: #7D65EC; font-weight: 700;">
        <h3>Data Anak</h3>
    </div>
       <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama Anak</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Alergi</th>
                        {{-- <th>Aksi</th> --}}
                    </tr>
                </thead>
                <tbody>
                @if ($anakList->count() > 0)
                    @foreach ($anakList as $an)
                        <tr class="text-center">
                            <td class="align-middle">{{ $loop->iteration + ($anakList->currentPage()-1)*$anakList->perPage() }}</td>
                            <td class="align-middle">{{ $an->nama_anak }}</td>
                            <td class="align-middle">{{ $an->tempat_lahir }}</td>
                            <td class="align-middle">{{ $an->tanggal_lahir }}</td>
                            <td class="align-middle">{{ $an->jenis_kelamin }}</td>
                            <td class="align-middle">{{ $an->hitungUsia() }}</td>
                            <td class="align-middle">{{ $an->alergi }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="9">Data Tidak Ditemukan</td>
                    </tr>
                @endif
            </tbody>

        </table>
    </div>






@endsection
