@extends('admin.app')
@section('title', 'Brand List')
@section('content')

<!-- ... Code trước đó ... -->

<!-- Main content -->
<section class="content">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header alert-warning">
                    <h5 class="modal-title " id="exampleModalLabel" style="font-size: 20px; font-weight:bold">Block Notify</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body notify-text-block-user" style="font-size: 20px; font-weight:bold">
                    Are you sure delete tis Admin ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-danger btn-action-delete-blog">Delete</a>
                </div>
            </div>
        </div>
    </div>
    {{-- vvv --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('success'))
    <div class="alert {{session('success')!='Block user successfully'?'alert-success':'alert-danger'}}">{{ session('success') }}</div>
    {{session()->forget('success')}}
    @endif
                <div class="card-header">
                    <h3 class="card-title">List Category</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="discount__table" class="table table-bordered table-hover">
                        <thead class="thead-dark ">
                        <tr>
                            <th>Category ID</th>
                            <th>Name</th>
                        

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $c)
                            <tr>
                                <td>{{ $c->category_id }}</td>
                                <td>{{ $c->name}}</td>
                          

                                <td class="text-right">
 
                                    <button type="button" class="btn btn-danger btn-sm text-dark mr-1 btn-delete-blog" style="font-size: 18px; font-weight:600" data="{{$c->category_id}}" data-toggle="modal" data-target="#exampleModal">
                                        Delete
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
@endsection

@section('script-content')
<script>
    $(function () {
        $('#brand').DataTable();
    });
</script>
@endsection
