@extends('layouts.app')

@section('contents')
<div class="container mt-5" data-aos="fade-up" data-aos-delay="100">

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle table-jadwal">
            <thead class="table-jadwal">
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Jam Layanan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($jadwal as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->hari }}</td>
                        <td>{{ $item->jam_layanan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            Belum ada jadwal layanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
