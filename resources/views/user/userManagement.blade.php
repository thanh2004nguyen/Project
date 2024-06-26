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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a type="button" class="btn btn-primary btn-action-block-user"></a>
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
        <h1>User management</h1>
    </div>
    <table id="discount__table" class="table table-striped table-bordered  border-2 border-dark">
        <thead class="thead-dark ">
            <tr>
                <th>Id</th>
                <th>Full name</th>
                <th>Email</th>
                <th>Dob</th>
                <th>create_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $user)
            <tr>
                <td>{{$user->id}} </td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->dob}}</td>
                <td>{{$user->created_at}}</td>
                <td class="text-center">
                    <button type="button" class="btn {{$user->block===1 ?'btn-warning':'btn-danger'}} btn-sm text-dark mr-1 btn-block-user" style="font-size: 18px; font-weight:600" block-status="{{$user->block}}" data="{{$user->id}}" data-toggle="modal" data-target="#exampleModal">
                        @if($user->block===1)
                        <i class="fas fa-recycle"></i>
                        @else
                        <i class="fas fa-ban"></i>
                        @endif {{$user->block===1 ?"Restore" :"Block"}}
                    </button>
                    <button type="button" class="btn btn-primary btn-sm ">
                        <a class="text-dark " style="font-size: 18px; font-weight:600" href="{{url('/admin/detailUser/'.$user->id)}}"><i class="fas fa-eye text-light"></i> View</a>
                    </button>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>




@endsection