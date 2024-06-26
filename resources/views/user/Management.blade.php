@extends('admin.app')
@section('title', 'View Product')
@section('content')


<div class="card-body  p-2">


    <!-- Modal -->
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
                    <a type="button" class="btn btn-danger btn-action-delete-admin">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- end Modal -->

    @if (session('success'))
    <div class="alert {{session('success')!='Block user successfully'?'alert-success':'alert-danger'}}">{{ session('success') }}</div>
    {{session()->forget('success')}}
    @endif
    <div class=" d-flex align-items-center mb-4">
        <h1>Admin management</h1>
    </div>
    <div class="card-body">
        <table id="admin-management-user" class="table table-striped table-bordered  border-2 border-dark">
            <thead class="thead-dark ">
                <tr>
                    <th>Id</th>
                    <th>Full Name</th>
                    <th>Email</th>



                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $a)
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>{{ $a->name }}</td>
                    <td>{{ $a->email }}</td>





                    <td class="text-right">

                        <a class="btn btn-info btn-sm" style="font-size: 18px; font-weight:600" href="{{ url('admin/edit/'.$a->id) }}">
                            <i class="fas fa-pencil-alt"></i> Edit
                        </a>
                    
                    </td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</div>
</div>
</div>




@endsection