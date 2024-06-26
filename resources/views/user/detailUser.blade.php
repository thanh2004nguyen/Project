@extends('admin.app')
@section('title', 'View Product')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-2 col-md-8 mt-5">
                <!-- general form elements -->
                <div class="card card-primary mb-2 mt-2">
                    <div class="card-header">
                        <h3 class="card-title">User Details </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <section class="content">
                        <div class="d-flex ">
                            <div class="d-flex justify-content-center" style="width: 35%;">
                                <img src="img/animal_avatar/{{$user->avatar}}.png "          alt="img/avatar_animal/{{$user->avatar}}.png " width="80%" height="200px">
                            </div>
                            <div class=>
                                <div class="form-group">
                                    UserId: <b>{{ $user->id }} </b>
                                </div>
                                <div class="form-group">
                                    UserName: <b>{{ $user->fullName }} </b>
                                </div>
                                <div class="form-group">
                                    Email: <b>{{ $user->email }} </b>
                                </div>
                                <div class="form-group">
                                    CreatedDate: <b>{{ $user->created_at }} </b>
                                </div>

                                <div class="form-group">
                                    Phone Number : <b>{{ $user->phone }}</b>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="input-group mb-4 ml-5" style="width: 86%">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">Total Order:</b></span>
                            </div>
                            <input type="text" value="" name="id" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-4 ml-5" style="width: 86%">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">Total Spend: </b></span>
                            </div>
                            <input type="text" value=" " name="id" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-4 ml-5" style="width: 86%">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">Total Rate: </b></span>
                            </div>
                            <input type="text" value="" name="id" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-4 ml-5" style="width: 86%">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default"><b style="width:100px">Favarious:</b></span>
                            </div>
                            <input type="text" value="" name="id" readonly class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-default">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection