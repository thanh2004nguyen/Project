@extends('admin.app')
@section('title', 'Create Provider')
@section('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

<style>
    .all {

        border: 3px solid #009879;
        ;
    }

    .card-header {
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
        flex: 0 0 auto;
        /* Đảm bảo các phần tử này không co giãn */
    }

    .form-control {
        flex: 1 1 auto;
        /* Cho phép các input co giãn để điền đầy không gian */

    }

    .input-group {
        border: #009879;
    }

    .input-group-prepend .input-group-text {
        color: saddlebrown;
        /* Màu chữ mong muốn */
    }

    /* Thay đổi màu chữ của label custom-file-label */
    .custom-file-label {
        color: saddlebrown;
        /* Màu chữ mong muốn */
    }
</style>
<section class="content">
    <div class="container-fluid d-flex" style="justify-content: center;">


        <div class="" style="width: 80%;">
            <!-- general form elements -->
            <div class="card mt-2 ">
                <div class="card-header .bg-success">
                    <h3 class="card-title">Create Blog</h3>
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
                    <form role="form" action="{{ Route('blog/add') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body" style="min-height: 74vh;">


                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Blog Image</span>
                                <input type="file" name="images" accept="image/*" multiple required>
                            </div>

                            
                            <div class="input-group mb-1 ">

                             


                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Hagtag</span>
                                </div>
                                <input required type="text" class="form-control" id="txt-name" name="hagtag" placeholder=" Hagtag">
                            </div>



                            <div class="form-group row">

                                <label for="blog-post" class=" text-left control-label col-form-label">Content</label>
                                <div class="col-sm-12">

                                    <textarea id="blog-post" style="width: 90%; height:100%" name="content" class="blog-post form-control @error('blog-post') is-invalid @enderror" placeholder="Write your blog post content here" ></textarea>
                                </div>


                            </div>
                          

                        </div>

                        <input value="Submit" style="background-color: #009879;" type="submit" class="btn btn-primary ml-3 mb-3"/>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
    <script src="/ckfinder/ckfinder.js"></script>
    <script type="text/javascript">

    ClassicEditor
        .create( document.querySelector( '#blog-post' ), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
        } )
        .catch( function( error ) {
            console.error( error );
        } );
        
</script>

</section>
@endsection