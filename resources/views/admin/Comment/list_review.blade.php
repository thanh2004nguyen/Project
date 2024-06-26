@extends('admin.app')
@section('content')
<section class="content-header">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      List Of Review
    </div>
    <div class="row w3-res-tb">
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table id="admin-management-user" class="table table-striped table-bordered  border-2 border-dark">
        <thead class="thead-dark ">
          <tr>
            <th>Stt</th>
            <th>User </th>
            <th>Comment</th>
            <th>Admin Reply</th>
            <th colspan="2">Rating</th>
            <th>Product</th>
            <th colspan="1">Admin Comment</th>
            <th>Active</th>
       
          </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($reviews as $review)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $review->user->name }}</td>
                <td>{{ $review->comment }}</td>
                <td>{{ $review->admin_comment }}<td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->product->name }}</td>
                <td colspan="1">
                    @if ($review->admin_comment == '')
                        <form method="POST" action="{{ route('admin.replyComment', $review->id) }}">
                            @csrf
                            <textarea name="admin_comment" id="admin_comment" rows="1"></textarea>
                            <button type="submit">Send</button>
                        </form>
                    @else
                        <span>Commented</span>
                    @endif
                </td>
                <td style="color: red; cursor: pointer;">
                    <form method="POST" action="{{ route('admin.deleteComment', $review->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?')">delete</button>
                    </form>
                </td>
            </tr>
            @php
            $i++;
            @endphp
            @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
     
        </div>
        <div class="col-sm-7 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            {{-- {!!$order->links()!!} --}}
          </ul>
        </div>
      </div>
    </footer>

  </div>
</div>
</section>
@endsection

@section('script-content')
<script>

</script>
@endsection
