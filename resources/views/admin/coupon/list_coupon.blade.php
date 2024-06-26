@extends('admin.app')
@section('content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <header class="panel-heading">
      <h2 style="text-align:center">List Voucher</h2> 
  </header>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">             
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
      </div>
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
            
            <th>Voucher Name</th>
            <th>Voucher Code</th>
            <th>Expiration Date</th>
            <th>Discount Type</th>
            <th>Discount</th>
            <th>Action</th>
        
          </tr>
        </thead>
        <tbody>
          @foreach($coupon as  $cou)
          <tr>
       
            <td>{{ $cou->name }}</td>
            <td>{{ $cou->code }}</td>
            <td>{{ $cou->expiration_date }}</td>
            <td><span class="text-ellipsis">
              <?php
               if($cou->discounttype==1){
                ?>
                Discount by amount
                <?php
                 }else{
                ?>  
                Discount by %
                <?php
               }
              ?>
            </span>
          </td>

             <td><span class="text-ellipsis">
              <?php
               if($cou->discounttype==1){
                ?>
                Discount {{$cou->discount}} đ
                <?php
                 }else{
                ?>  
                Discount {{$cou->discount}} %
                <?php
               }
              ?>
            </span></td>

            <td>
              <a  onclick='return confirm("Are you sure ???")' class="btn btn-danger btn-sm" href="{{ route('coupon.delete', ['coupon_id' => $cou->id]) }}">
                <i class="fas fa-trash" ></i> Delete
            </a>
       
            <a class="btn btn-info btn-sm" href="{{ route('coupon.edit', ['coupon_id' => $cou->id]) }}">
              <i class="fas fa-pencil-alt"></i> Edit
          </a>


            </td>
          </tr>
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
             {{-- {!!$coupon->links()!!} --}}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection

@section('script-content')
<script>
    $(function () {
        $('#voucher').DataTable();
    });
</script>
@endsection