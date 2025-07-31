@extends('frontend.layouts.app')

@section('title')
    Daftar Berita
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
                                    <h3 class="card-title">Daftar Berita</h3>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('posts.create') }}"
                                        class="float-end btn btn-sm btn-danger rounded-web">
                                        <i class="fas fa-plus"></i> Buat
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="postTable" class="table table-bordered text-nowrap text-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>
                                            Judul
                                        </th>
                                        <th>
                                            Thumbnail
                                        </th>
                                        <th style="width: 5%">
                                            Status
                                        </th>
                                        <th style="width: 10%">
                                            Tanggal Terbit
                                        </th>
                                        <th style="width: 10%">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->title }}</td>
                                            <td>
                                                <img src="{{ asset('storage/post/' . $post->image) }}" alt="Gambar"
                                                    width="50">
                                            </td>
                                            <td>
                                                @if ($post->is_approved == false)
                                                    Pending
                                                @else
                                                    Terbit
                                                @endif
                                            </td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-danger rounded-web"
                                                    onclick="deletePost({{ $post->id }})"><i
                                                        class="fas fa-trash"></i></button>
                                                <form id="delete-form-{{ $post->id }}"
                                                    action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a class="btn btn-sm btn-warning rounded-web"
                                                    href="{{ route('posts.edit', $post->id) }}"><i
                                                        class="fas fa-pencil"></i></a>
                                                @if ($post->is_approved == false)
                                                    <a href="{{ route('posts.approve', $post->id) }}"
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
            $('#postTable').DataTable({
                "paging": true,
                'processing': true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                // "scrollX": true,
                // width: "700px",
                // columnDefs: [{
                //     className: 'dtr-control',
                //     orderable: false,
                //     targets: -8
                // }]
            });
        });

        function deletePost(id) {
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
