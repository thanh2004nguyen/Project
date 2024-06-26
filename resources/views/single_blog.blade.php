<style>
.the-blogs{
    width: 100% ;
    height: auto;
    margin-top: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.main-blog{
    width: 60%;
    height: 100%;
    float: left;
}
.main-blog-name{

    color: #01579b;
}
.main-blog-title{
    font-weight: 700;
    font-size: 32px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
.img-parent{
    width: 95%;
    height: 530px;
    border-radius: 10px;
    margin: 20px;
}


/* blog child */
.array-blog{

    margin-top: -500px;
    margin-left: 40px;
    width: 40%;
    height: 100%;
}
.title-childs{
    width: 130px;
    height: 38px;
    color: white;
    font-size: 24px;
    text-align: center;
    font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    background: #1E73BE;
}
.title-child{
    font-size: 25px;
    color: black;
    margin-left: 35px;
}

.blog{

    display: flex;
}
.img-child{
    width: 100px;
    height: 100px;
    border-radius: 5px;
}
</style>
@extends('layouts.app')
@section('title', 'View Product')
@section('content')



{{-- the blogs --}}
<div class="the-blogs" style="display: flex; justify-content: space-around" style="width: 100%; height: auto;">
    <div class="main-blog" style="width: 65%;">
        <h6 class="main-blog-name">name</h6>
        <h3 class="main-blog-title">{{$blog->hagtag}}</h3>
        @foreach ($images as $img)
                                        @if ($img->blog_id == $blog->blog_id)
                                            <img class="img-parent"
                                                src="
                                                    {{ $img->url }}
                                                " alt="{{ $img->url }}" class="img-fluid" />
                                            @break
                                        @endif
                                    @endforeach
        <p>
            {!!$blog->content!!}
        </p>
    </div>

    {{--$blog = Blog::findOrFail($blog_id);
        $blogall = Blog::all();
        $images = BlogImage::all(); --}}

    <div class="array-blog" style="width: 35%;float: left;padding-top: 280px;">
        <h2 class="title-childs">Other views</h2>
        <input type="text" style="width: 60%; height: 2px; background: blue; border: none; margin-bottom: 30px;" readonly>
        @foreach ($blogall as $blog)
            <div class="blog" style="overflow: inherit">
                <a style="width: 400px; height: 150px;" href="{{ route('single_blog', ['blog_id' => $blog->blog_id]) }}">
                    <img style="width: 400px; height: 150px;object-fit: cover; border-radius: 7px;" src="{{ $images->where('blog_id', $blog->blog_id)->first()->url }}" alt="Image" class="img-fluid" />
                </a>
                <a href="{{ route('single_blog', ['blog_id' => $blog->blog_id]) }}">
                    <h3 class="title-child">{{ $blog->hagtag }}</h3>
                </a>
            </div>
            <hr>
        @endforeach

    </div>

</div>



@endsection
