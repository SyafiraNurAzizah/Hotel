@extends('admin.layouts.app')

@section('content')
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                </svg></div>
                            Data Ruangan Meeting
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="container mt-6">
            <a href="{{ route('admin.meeting.create') }}"
                class="btn btn-outline-secondary w-35 gmail-btn d-flx align-items-center mb-2">
                <i class="icon_phone fs-2 me-2"></i> <!-- fs-2 memperbesar ukuran ikon -->
                Tambah Ruangan
            </a>


            <table class="table table-custom">
                <thead class="thead-custom">
                    <tr>
                            <th>No</th>
                            <th>Nama Ruang</th>
                            <th>Harga per Jam</th>
                            <th>Jumlah Ruang Tersedia</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                    </tr>
                    <tbody>
                        @forelse($meetings as $meeting)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $meeting->nama_ruang }}</td>
                                <td>{{ number_format($meeting->harga_per_jam, 2) }}</td>
                                <td>{{ $meeting->jumlah_ruang_tersedia }}</td>
                                <td>
                                    <img src="{{ $meeting->foto }}" alt="{{ $meeting->nama_ruang }}" width="100">
                                </td>
                                <td>{{ $meeting->status }}</td>
                                <td>{{ $meeting->kapasitas }} guests</td>
                                <td>
                                    <a href="{{ route('admin.meeting.edit', $meeting->id) }}" class="btn btn-outline-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.meeting.destroy', $meeting->id) }}" method="POST"
                                        style="display:inline;" id="delete-form-{{ $meeting->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="fa fa-trash btn btn-outline-danger"
                                            onclick="confirmDelete({{ $meeting->id }})"></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(meetingId) {
            Swal.fire({
                title: 'Kamu yakin?',
                text: 'Aksi ini akan menghapus data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + meetingId).submit();
                }
            });
        }
    </script>
@endpush
