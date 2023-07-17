@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="javascript:void(0)" class="btn btn-info float-right mb-3" id="btn-create-post"><i
                            class="typcn typcn-plus"></i>
                        Tambah Data</a>
                    <h3 class="mt-0 header-title">List User</h3>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-default">
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA</th>
                                    <th>EMAIL</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($user as $data)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" id="btn-edit-post" data-id="{{ $data->id }}"
                                                class="btn btn-warning btn-sm"><i class="typcn typcn-edit"></i> EDIT</a>
                                            <a href="javascript:void(0)" id="btn-delete-post" data-id="{{ $data->id }}"
                                                class="btn btn-danger btn-sm"><i class="typcn typcn-trash"></i> DELETE</a>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        User data is empty!
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <hr>
                        <span class="float-right"> {{ $user->links() }} </span>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    {{-- MODALS --}}
    @include('components.users.modal-create')
    @include('components.users.modal-edit')
    <script>
        //button delete event
        $('body').on('click', '#btn-delete-post', function() {

            let user_id = $(this).data('id');
            var token = document.getElementById('token').value;

            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "ingin menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'TIDAK',
                confirmButtonText: 'YA, HAPUS!'
            }).then((result) => {
                if (result.isConfirmed) {
                    //fetch to delete data
                    $.ajax({
                        url: `users/delete/${user_id}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {

                            //show success message
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: `${response.message}`,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            // set time out then reload page
                            setTimeout(function() { // wait for 1 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 1000);
                        }
                    });
                }
            })
        });
    </script>
@endsection
