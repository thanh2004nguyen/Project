@extends('admin.app')
@section('title', 'Brand List')
@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header alert alert-danger">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <b> Are you sure delete this Banner? </b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-danger action-delete-banner">Delete</a>
            </div>
        </div>
    </div>
</div>



<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">

                <!-- /.card-header -->
                <div class="card-body p-2">
                    <div class=" d-flex align-items-center mb-4">
                        <h1>List of Banner</h1>
                    </div>
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    {{session()->forget('success')}}
                    @endif

                    <table id="material__table" class="table table-striped table-bordered  border-2 border-dark">
                        <thead class="thead-dark ">
                            <tr>
                                <th>Banner ID</th>
                                <th>Name</th>
                                <th>URL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $b)
                            <tr>
                                <td>{{ $b->id}}</td>
                                <td>{{ $b->bannername}}</td>
                                <td><img src="{{$b->banerURL}}" alt="" style="height: 100px;" width="200px"></td>

                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm btn_delete_banner" data-toggle="modal" data-target="#exampleModal" data="{{ $b->id }}">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
{{-- @section('script-content');
    <script>
        $(function () {
            $('#product').DataTable();
        });
    </script> --}}

@endsection