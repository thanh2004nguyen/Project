@extends('admin.app')
@section('content')

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
 .gradient-custom-2 {
/* fallback for old browsers */
background: #a1c4fd;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
}

#progressbar-1 {
color: #455A64;
}

#progressbar-1 li {
list-style-type: none;
font-size: 13px;
width: 25%;
float: left;
position: relative;
}

#progressbar-1 #step1:before {
content: "1";
color: #fff;
width: 29px;
margin-left: 22px;
padding-left: 11px;
}

#progressbar-1 #step2:before {
content: "2";
color: #fff;
width: 29px;
}

#progressbar-1 #step3:before {
content: "3";
color: #fff;
width: 29px;
margin-right: 22px;
text-align: center;
}

#progressbar-1 #step4:before {
content: "4";
color: #fff;
width: 29px;
margin-right: 22px;
text-align: center;
}

#progressbar-1 li:before {
line-height: 29px;
display: block;
font-size: 12px;
background: #455A64;
border-radius: 50%;
margin: auto;
}

#progressbar-1 li:after {
content: '';
width: 121%;
height: 2px;
background: #455A64;
position: absolute;
left: 0%;
right: 0%;
top: 15px;
z-index: -1;
}

#progressbar-1 li:nth-child(2):after {
left: 50%
}

#progressbar-1 li:nth-child(1):after {
left: 25%;
width: 121%
}

#progressbar-1 li:nth-child(3):after {
left: 50%;
width: 50%;
}


#progressbar-1 li:nth-child(4):after {
left: 0%;
width: 75%;
}

#progressbar-1 li.active:before,
#progressbar-1 li.active:after {
background: #1266f1;
}

.card-stepper {
z-index: 0
}



</style>
<section class="content-header">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Order Detail
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
           
            <th>Number</th>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Payment Status</th>
            <th style="width:450px;">Order Status</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          @endphp
          @foreach($order as $key => $ord)
            @php 
            $i++;
            @endphp
          @if($ord->order_status != 6)
          <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{ $ord->order_id  }}</td>
            <td>{{ $ord->created_at }}</td>
            <td>{{ $ord->payment_content}}</td>
            <td >@if($ord->order_status==1)
              <div class="card card-stepper" style="border-radius: 16px;" >
                <div class="card-body p-1" >
                  <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                    <li class="step0 active" id="step1"><span
                        style="margin-left: 22px; margin-top: 12px;">Checking</span></li>
                    <li class="step0 muted text-center" id="step2"><span>Order Processing</span></li>
                    <li class="step0 text-muted text-end" id="step3"><span
                        style="margin-right: 22px;">SHIPPED</span></li>
                        <li class="step0 text-muted text-end" id="step4"><span
                        style="margin-right: 22px;">COMPLETED</span></li>
                  </ul>
                </div>
              </div>
          @elseif($ord->order_status==2)
                  <div class="card card-stepper" style="border-radius: 16px;" >
                    <div class="card-body p-1" >
                      <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                        <li class="step0 active" id="step1"><span
                            style="margin-left: 22px; margin-top: 12px;">Checking</span></li>

                        <li class="step0 active text-center" id="step2"><span>Order Processed</span></li>

                        <li class="step0 text-muted text-end" id="step3"><span
                            style="margin-right: 22px;">SHIPPED</span></li>
                            <li class="step0 text-muted text-end" id="step4"><span
                              style="margin-right: 22px;">COMPLETED</span></li>
                      </ul>
                    </div>
                  </div>
          @elseif($ord->order_status==3)
          <div class="card card-stepper" style="border-radius: 16px;" >
            <div class="card-body p-1" >
              <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                <li class="step0 active" id="step1"><span
                    style="margin-left: 22px; margin-top: 12px;">Checking</span></li>

                <li class="step0 active text-center" id="step2"><span>Order Processed</span></li>

                <li class="step0 active text-center" id="step3"><span
                    style="margin-right: 22px;">SHIPPED</span></li>
                    <li class="step0 text-muted text-end" id="step4"><span
                      style="margin-right: 22px;">COMPLETED</span></li>
              </ul>
            </div>
          </div>
          @elseif($ord->order_status==4)
          <div class="card card-stepper" style="border-radius: 16px;" >
            <div class="card-body p-1" >
              <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                <li class="step0 active" id="step1"><span
                    style="margin-left: 22px; margin-top: 12px;">Checking</span></li>

                <li class="step0 active text-center" id="step2"><span>Order Processed</span></li>

                <li class="step0 active text-center" id="step3"><span
                    style="margin-right: 22px;">SHIPPED</span></li>
                    <li class="step0 active text-center" id="step4"><span
                      style="margin-right: 22px;">COMPLETED</span></li>
              </ul>
            </div>
          </div>
          @elseif($ord->order_status==5)
        <span style="font-size:15px" class="label label-danger">Order Canceled</span>
          @elseif($ord->order_status==6)
          Payment error
          @elseif($ord->order_status==7)
          <div class="card card-stepper" style="border-radius: 16px;" >
            <div class="card-body p-1" >
              <ul id="progressbar-1" class="mx-0 mt-0 mb-5 px-0 pt-0 pb-4">
                <li class="step0 active" id="step1"><span
                    style="margin-left: 22px; margin-top: 12px;">Checking</span></li>

                <li class="step0 muted text-center" id="step2"><span>Order Processed</span></li>

                <li class="step0 text-muted text-end" id="step3"><span
                    style="margin-right: 22px;">SHIPPED</span></li>

                    
                    <li class="step0 text-muted text-end" id="step4"><span
                    style="margin-right: 22px;">COMPLETED</span></li>
              </ul>
            </div>
          </div>
          @elseif($ord->order_status==8)
         <span style="font-size:15px" class="label label-danger">Customer Do Not Receive /Refuse Order</span>

         @elseif($ord->order_status==9)
         <span style="font-size:15px" class="label label-danger">Canceled! Need Process Refund!</span>

          @endif
            </td>
            <td class="text-right">
              <a class="btn btn-primary btn-sm" href="{{URL::to('/view-order/'.$ord->order_id)}}">
                  <i class="fas fa-folder"></i> View
              </a>
          </td>
          </tr>
          @endif
          @endforeach
          
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
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
    $(function () {
        $('#brand').DataTable();
    });
</script>
@endsection