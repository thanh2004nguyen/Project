@extends('admin.app')
@section('title', 'Brand List')
@section('content')

<br>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <!-- general form elements -->
                <div class="card card-primary mt-4">


                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ url('banner/add') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <h2>Create Banner</h2>
                            </div>
                            @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            {{session()->forget('error')}}
                            @endif
                            <div class="form-group">
                                <b for="txt-bannername">Banner Name</b>
                                <input type="text" class="form-control" id="txt-bannername" name="bannername">
                            </div>
                            <div style="width: 100%; height:200px">
                                <b for="txt-banerURL">Choose Image</b>
                                <input class="border border-warning  position-relative image-new-banner" style="width: 100%; height:100%; color:transparent ; z-index:10" type="file" name="banerURL">
                                <div id="banner__preview" style="width: 100%; height:100% ;bottom:200px ; background-color:transparent;z-index:5 " class="d-flex position-relative image__banner">
                                    <span style="margin: auto ">select or drag file</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="mt-4 d-flex" style="width: 100%">
                            <button type="submit" class="btn btn-primary mb-3 mr-3" style="margin-left: auto">Create</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
@endsection
@section('script-content')
<script>
    ClassicEditor
        .create(document.querySelector('.ck-editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection