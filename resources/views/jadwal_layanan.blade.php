@extends('layouts.app')

@section('contents')
<div class="container mt-1" data-aos="fade-up" data-aos-delay="100">

    <div class="table-responsive rounded ">
        <table class="table table-hover table-bordered">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse ($jadwal as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->hari }}</td>
                        <td class="align-middle">{{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}</td>
                        <td class="align-middle">{{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}</td>
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
