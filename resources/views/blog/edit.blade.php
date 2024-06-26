@extends ('admin..app')
@section('title', 'Product List')
@section ('content')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
    // CKEDITOR.replace( 'blog-post');
    CKEDITOR.replace( 'blog-post',{
        filebrowserUploadUrl: "{{route('uploadimage', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>

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
<!-- Lưu tại resources/views/product/index.blade.php -->
<section class="content">
    <div class ="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <!-- general form elements -->
                <div class="card ">
                    <div class="card-header .bg-success">
                        <h3 class="card-title">Edit Blog</h3>
                    </div>


                    {{-- check error --}}

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error')}}
                    </div>
                    @endif
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="all">

                    <form role="form" action="{{ url('blog/update/' . $blog->blog_id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                        
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">Id</span>
                                </div>
                                <input type="text" class="form-control" id="txt-id" name="id" value="{{$blog->blog_id}}" readonly placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                              </div>
                              
                            

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">Content</span>
                                </div>
                                <input type="text" class="form-control" id="txt-name" name="content" value="{{$blog->content}}">
                              </div>

                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">User</span>
                                </div>
                                <input type="text" class="form-control" id="txt-name" name="user_id" value="{{$blog->user_id}}">
                              </div>
                            
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">Hagtag</span>
                                </div>
                                <input type="text" class="form-control" id="txt-name" name="hagtag" value="{{$blog->hagtag}}">
                              </div>
                              <div class="form-group row">
                                @if(!Auth::user()->isAdmin)
                                    <label for="blog-post" class="col-sm-3 text-left control-label col-form-label">Blog</label>
                                    <div class="col-sm-12">
                                        <textarea id="blog-post" name="blog-post" class="blog-post form-control @error('blog-post') is-invalid @enderror"
                                        rows="10" cols="80" placeholder="Write your blog post content here" required></textarea>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                        <script>
                            CKEDITOR.replace( 'blog-post');
                        </script>

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button style="background-color: #009879;" type="submit" class="btn btn-primary">Update</button>                            
                        </div>
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
    ClassicEditor
      .create( document.querySelector( '.ck-editor' ) )
      .catch( error => {
          console.error( error );
      } );

</script>
@endsection