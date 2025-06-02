@extends('layouts.app')

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
                        <div class="mb-4 mt-2">Reservasi Hari Ini</div>
                        <div class="h5 mb-2" style="font-size: 28px;">{{ $totalReservasiHariIni }}</div>
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
                        <div class="mb-4 mt-2">Menunggu Konfirmasi</div>
                        <div class="h5 mb-2" style="font-size: 28px;">{{ $totalReservasiPending }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-xl-3 mb-3 text-center">
        <div class="card card-jumlah shadow h-100 py-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <div class="mb-4 mt-2">Jumlah Anak Hari Ini</div>
                        <div class="h5 mb-2" style="font-size: 28px;">{{ $jumlahAnakHariIni }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="text-center mt-4 mb-4" style="color: #7D65EC; font-weight: 700;">
        <h3>Reservasi Terbaru</h3>
    </div>
    <div class="table-responsive mb-4">
        <table class="table table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Anak</th>
                    <th>Nama Orang Tua</th>
                    <th>Jenis Layanan</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($reservasi->count() > 0)
                    @foreach ($reservasi as $rs)
                        <tr class="text-center">
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $rs->anak->nama_anak ?? '-' }}</td>
                            <td class="align-middle">{{ $rs->pengguna->name ?? '-' }}</td>
                            <td class="align-middle">{{ $rs->layanan->jenis_layanan ?? '-' }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($rs->tgl_masuk)->format('d-m-Y') }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($rs->tgl_keluar)->format('d-m-Y') }}</td>
                            <td class="align-middle">{{ $rs->status }}</td>
                            <td class="align-middle">
                                @if ($rs->status == 'Pending')
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('reservasis.konfirmasi', $rs->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Diterima">
                                            <button type="submit" class="btn btn-success btn-sm mr-2">Terima</button>
                                        </form>

                                        <form action="{{ route('reservasis.konfirmasi', $rs->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Ditolak">
                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted">Sudah dikonfirmasi</span>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="15" style="background-color: white;">Data Tidak Ditemukan</td>
                    </tr>
                @endif
            </tbody>

        </table>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Bar Chart: Reservasi per Bulan -->
            <div class="col-12 col-md-6 style="background: rgba(0,0,255,0.1);">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Jumlah Reservasi per Bulan</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="reservasiChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart: Jenis Kelamin -->
            <div class="col-12 col-md-6 ">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold">Perbandingan Jenis Kelamin Anak</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dataReservasi = @json(array_values($dataReservasiPerBulan));
        const jumlahLaki = {{ $jumlahLaki }};
        const jumlahPerempuan = {{ $jumlahPerempuan }};

        // Bar Chart
        const ctxBar = document.getElementById('reservasiChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Reservasi Per Bulan',
                    data: dataReservasi,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        // Pie Chart
        const ctxPie = document.getElementById('genderChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    label: 'Jumlah Anak',
                    data: [jumlahLaki, jumlahPerempuan],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

@endsection
