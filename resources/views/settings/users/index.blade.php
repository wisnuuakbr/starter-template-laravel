@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="mt-0 header-title">List User</h3>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-default">
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA</th>
                                    <th>EMAIL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($user as $data)
                                    <tr>
                                        <th>{{ $no++ }}</th>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        User data is empty!
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        <span class="float-right"> {{ $user->links() }} </span>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
