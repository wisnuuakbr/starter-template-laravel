@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="javascript:void(0)" class="btn btn-primary float-right mb-3" id="btn-create-post"><i
                        class="typcn typcn-plus"></i>
                        Tambah Data
                    </a>
                    <h3 class="mt-0 header-title">List Navigations</h3>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-default">
                                <tr>
                                    <th class="text-center text-uppercase"></th>
                                    <th class="text-center text-uppercase">Nama Menu</th>
                                    <th class="text-center text-uppercase">Url</th>
                                    <th class="text-center text-uppercase">Ditampilkan</th>
                                    <th class="text-center text-uppercase"></th>
                                </tr>
                            </thead>
                            <tbody id="table-posts">
                                {{-- @php $no = 1; @endphp --}}
                                @if (count($menu) > 0)
                                    {{-- Parent Data --}}
                                    @foreach ($menu as $parent)
                                        <tr>
                                            <td class="text-center"><i class="{{ $parent->nav_icon }} fa-lg"></i> </td>
                                            <td>--- {{ $parent->nav_title }}</td>
                                            <td>{{ $parent->nav_url }}</td>
                                            <td class="text-center">
                                                @if ($parent->display_st == 1)
                                                    <span class="badge badge-default badge-lg"
                                                        style="font-size: 12px">YA</span>
                                                @else
                                                    <span class="badge badge-dark badge-lg"
                                                        style="font-size: 12px">TIDAK</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" id="btn-edit-post"
                                                    data-id="{{ $parent->nav_id }}" class="btn btn-warning btn-sm"><i
                                                        class="typcn typcn-edit"></i> EDIT</a>
                                                <a href="javascript:void(0)" id="btn-delete-post"
                                                    data-id="{{ $parent->nav_id }}" class="btn btn-danger btn-sm"><i
                                                        class="typcn typcn-trash"></i> DELETE</a>
                                            </td>
                                        </tr>
                                        {{-- Child Data --}}
                                        @foreach ($parent->children as $child)
                                            <tr>
                                                <td class="text-center"><i class="{{ $child->nav_icon }}"></i> </td>
                                                <td>--- --- {{ $child->nav_title }}</td>
                                                <td>{{ $child->nav_url }}</td>
                                                <td class="text-center">
                                                    @if ($child->display_st == 1)
                                                        <span class="badge badge-default badge-lg"
                                                            style="font-size: 12px">YA</span>
                                                    @else
                                                        <span class="badge badge-dark badge-lg"
                                                            style="font-size: 12px">TIDAK</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0)" id="btn-edit-post"
                                                        data-id="{{ $child->nav_id }}" class="btn btn-warning btn-sm"><i
                                                            class="typcn typcn-edit"></i> EDIT</a>
                                                    <a href="javascript:void(0)" id="btn-delete-post"
                                                        data-id="{{ $child->nav_id }}" class="btn btn-danger btn-sm"><i
                                                            class="typcn typcn-trash"></i> DELETE</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @else
                                    <div class="alert alert-danger">
                                        Navigations Data is empty!
                                    </div>
                                @endif
                            </tbody>
                        </table>
                        <span class="float-right"> {{ $menu->links() }} </span>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    {{-- MODALS --}}
    @include('components.navigations.modal-create')
    @include('components.navigations.modal-edit')
    <script>
        //button delete event
        $('body').on('click', '#btn-delete-post', function() {

            let nav_id = $(this).data('id');
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
                        url: `navigations/${nav_id}`,
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
