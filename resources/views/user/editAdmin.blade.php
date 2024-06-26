@extends ('admin..app')
@section('title', 'Product List')
@section ('content')

<!-- Lưu tại resources/views/product/index.blade.php -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Product</h3>
                    </div>


                    {{-- check error --}}

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error')}}
                    </div>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('admin/postEdit') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txt-id">Id</label>
                                <input type="text" class="form-control" id="txt-id" name="id" value="{{$admin->id}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="txt-name">Full Name</label>
                                <input type="text" class="form-control" id="txt-name" name="name" value="{{$admin->name}}">
                            </div>
                            <div class="form-group">
                                <label for="txt-price">Email</label>
                                <input type="text" class="form-control" id="txt-email" name="email" value="{{$admin->email}}">
                            </div>
                            <div class="form-group">
                                <label for="txt-password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="txt-password" name="password" value="{{$admin->password}}">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default" id="togglePassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label for="txt-dob">DoB</label>
                                <input type="date" class="form-control" id="txt-dob" max="2005-01-01" name="dob" value="{{substr($admin->dob, 0, 10)}}">
                            </div> -->
                            <div class="form-group">
                                <label for="txt-price">Role</label>
                                <input readonly type="text" class="form-control" id="txt-role" name="role" value="{{$admin->role==1 ?'Admin':'User'}}">
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection

@section ('script-content')
<script>
    const togglePasswordButton = document.getElementById("togglePassword");
    const passwordField = document.getElementById("txt-password");

    togglePasswordButton.addEventListener("click", function() {
        const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);

        // Thay đổi icon "eye" thành "eye-slash" khi ẩn mật khẩu và ngược lại
        if (type === "password") {
            togglePasswordButton.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i>';
        } else {
            togglePasswordButton.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i>';
        }
    });
</script>
@endsection