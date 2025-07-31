@extends('frontend.layouts.app')

@section('title')
    Daftar Anggota
@endsection

@push('css')
@endpush

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card card-outline rounded-web card-secondary">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <h3 class="card-title">Daftar Anggota</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="anggotaTable" class="table table-bordered text-nowrap text-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th style="width: 5%">
                                            Status
                                        </th>
                                        <th style="width: 5%">
                                            Level
                                        </th>
                                        <th style="width: 10%">
                                            Tanggal Daftar
                                        </th>
                                        <th style="width: 5%">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->is_active == false)
                                                    Pending
                                                @else
                                                    Aktif
                                                @endif
                                            </td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-danger rounded-web"
                                                    onclick="deleteAnggota({{ $user->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('anggota.destroy', $user->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                @if ($user->is_active == false)
                                                    <a href="{{ route('anggota.approve', $user->id) }}"
                                                        class="btn btn-sm btn-success rounded-web"><i
                                                            class="fa-solid fa-circle-check"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#anggotaTable').DataTable({
                "paging": true,
                'processing': true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        function deleteAnggota(id) {
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe !',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
