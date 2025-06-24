@extends('admin.layouts.app')

@section('contents')
    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2 mb-3">
        <h1 class="m-0 text-title text-md-left text-center text-md-h4">Data Layanan</h1>
        <a href="{{ route('layanans.create') }}" class="btn btn-tambah">Tambah Layanan</a>
    </div>
    <hr />

    @push('scripts')
    <script>
        @if (session('added'))
            Swal.fire({
                title: 'Berhasil',
                text: 'Data Berhasil Ditambahkan',
                icon: 'success'
            });
        @endif

        @if (session('edited'))
            Swal.fire({
                title: 'Berhasil',
                text: 'Data Berhasil Diubah',
                icon: 'success'
            });
        @endif

        @if (session('deleted'))
            Swal.fire({
                title: 'Hapus',
                text: 'Data Berhasil Dihapus',
                icon: 'success'
            });
        @endif

        // Harus tetap dimuat selalu
        function hapus(button) {
            Swal.fire({
                title: 'Apakah Anda Yakin Ingin Menghapus Data Ini?',
                text: 'Data Akan Benar Benar Terhapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        }

        // Function untuk menampilkan detail layanan
        function lihatDetail(id, jenisLayanan, biaya, fasilitas) {
            let fasilitasHtml = '';
            
            if (fasilitas && fasilitas.length > 0) {
                fasilitasHtml = '<div class="row mt-3">';
                fasilitas.forEach(function(item) {
                    fasilitasHtml += `
                        <div class="col-md-6 mb-2">
                            <div class="border rounded p-2 bg-light">
                                <h6 class="mb-1 text-success">
                                    <i class="fas fa-check-circle"></i> ${item.nama_fasilitas}
                                </h6>
                                <small class="text-muted">${item.deskripsi || ''}</small>
                            </div>
                        </div>
                    `;
                });
                fasilitasHtml += '</div>';
            } else {
                fasilitasHtml = '<p class="text-muted mt-3">Belum ada fasilitas untuk layanan ini.</p>';
            }

            Swal.fire({
                title: 'Detail Layanan',
                html: `
                    <div class="text-left">
                        <div class="mb-3">
                            <h5 class="text-primary">${jenisLayanan}</h5>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <strong>Biaya:</strong><br>
                                <span class="badge bg-success text-white">Rp ${new Intl.NumberFormat('id-ID').format(biaya)}</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <strong>Fasilitas yang Tersedia:</strong>
                            ${fasilitasHtml}
                        </div>
                    </div>
                `,
                width: '600px',
                showCloseButton: true,
                showConfirmButton: false,
                customClass: {
                    htmlContainer: 'text-left'
                }
            });
        }
    </script>
    @endpush

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Jenis Layanan</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($layanan->count() > 0)
                    @foreach ($layanan as $la)
                        <tr class="text-center">
                            <td class="align-middle">{{ $loop->iteration + ($layanan->currentPage()-1)*$layanan->perPage() }}</td>
                            <td class="align-middle">{{ $la->jenis_layanan }}</td>
                            {{-- <td class="align-middle">{{ $la->hitungDurasi() }}</td> --}}
                            <td class="align-middle">Rp {{ number_format($la->biaya, 0, ',', '.') }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center align-items-center gap-2" style="gap: 0.5rem;">
                                    <!-- Tombol Lihat Detail -->
                                    <button type="button" 
                                        onclick='lihatDetail(
                                            {{ $la->id }}, 
                                            @json($la->jenis_layanan), 
                                            {{ $la->biaya }}, 
                                            @json($la->fasilitas)
                                        )' 
                                        class="btn btn-info d-flex align-items-center justify-content-center" 
                                        title="Lihat Detail"
                                        style="margin-right: 0.5rem;"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                            <path fill="#fff" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/>
                                        </svg>
                                    </button>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('layanans.edit', $la->id) }}" class="btn btn-warning d-flex align-items-center justify-content-center" title="Edit"
                                       style="margin-right: 0.5rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                            <path fill="#fff" d="m21.561 5.318l-2.879-2.879A1.5 1.5 0 0 0 17.621 2c-.385 0-.768.146-1.061.439L13 6H4a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1v-9l3.561-3.561c.293-.293.439-.677.439-1.061s-.146-.767-.439-1.06M11.5 14.672L9.328 12.5l6.293-6.293l2.172 2.172zm-2.561-1.339l1.756 1.728L9 15zM16 19H5V8h6l-3.18 3.18c-.293.293-.478.812-.629 1.289c-.16.5-.191 1.056-.191 1.47V17h3.061c.414 0 1.108-.1 1.571-.29c.464-.19.896-.347 1.188-.64L16 13zm2.5-11.328L16.328 5.5l1.293-1.293l2.171 2.172z" />
                                        </svg>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('layanans.destroy', $la->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="hapus(this)" class="btn btn-danger d-flex align-items-center justify-content-center" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                                <path fill="#fff" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                        <tr>
                            <td class="text-center" colspan="5">Data Tidak Ditemukan</td>
                        </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-3 mb-4">
        @if ($layanan->hasPages())
            {{ $layanan->links('pagination::bootstrap-5') }}
        @else
            {{-- Paksa tampil pagination minimal --}}
            <nav>
                <ul class="pagination">
                    <li class="page-item active"><span class="page-link">1</span></li>
                </ul>
            </nav>
        @endif
    </div>
@endsection