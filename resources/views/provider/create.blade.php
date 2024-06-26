@extends('admin.app')
@section('title', 'Create Provider')
@section('content')
<style>
    .all
    {
        
       border:3px solid #009879;;
    }
    .card-header{
        background-color: #009879
    }

    .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}
input-group {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .input-group-prepend {
        flex: 0 0 auto; /* Đảm bảo các phần tử này không co giãn */
    }

    .form-control {
        flex: 1 1 auto; /* Cho phép các input co giãn để điền đầy không gian */

    }
    .card {
    margin-top: 50px;
}
.input-group{
    border: #009879;
}
.input-group-prepend .input-group-text {
    color: saddlebrown	; /* Màu chữ mong muốn */
  }

  /* Thay đổi màu chữ của label custom-file-label */
  .custom-file-label {
    color: saddlebrown	; /* Màu chữ mong muốn */
  }


</style>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="offset-md-3 col-md-6">
                <!-- general form elements -->
                <div class="card ">
                    <div class="card-header .bg-success">
                        <h3 class="card-title">Create Provider</h3>
                    </div>

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="all">
                    <form role="form" action="{{ route('provider/add') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                          
                            <div class="input-group mb-5 ">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">Provider</span>
                                </div>
                                <input type="text" class="form-control" id="txt-name" name="name" placeholder="Provider Name">
                              </div>
                            <div class="input-group mb-5">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">Country</span>
                                </div>
                                <input type="text" class="form-control" id="txt-country" name="country" placeholder="Provider Country">
                              </div>
                        

                            <div class="input-group mb-5">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Logo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" id="logo" name="images" required>
                                    <label class="custom-file-label" id="file-label" for="logo">Choose file</label>
                                </div>
                              </div>
                            
                        </div>

                        
                        <script>
                            // Lắng nghe sự kiện khi tệp được chọn
                            document.getElementById("logo").addEventListener("change", function(event) {
                                // Lấy tên tệp đã chọn
                                const fileName = event.target.files[0].name;
                                
                                // Gán tên tệp vào label
                                document.getElementById("file-label").textContent = fileName;
                            });
                        </script>
                        <div class="card-footer ">
                            <button style="background-color: #009879;" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
