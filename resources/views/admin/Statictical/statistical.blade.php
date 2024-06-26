@extends('admin.app')
@section('content')
<h3>Income Statictical</h3>
<br><br>
<div class="row">

  <form autocomplete="off"></form>
  @csrf
  <div class="col-md-2">
    <p>From Date: <input type="text" id="datepicker" class="form-control">
      <input type="button" id="btn-dashboard-filler" class="btn btn-primary btn-sm" value="Filter Result">
    </p>

  </div>

  <div class="col-md-2">
    <p>To Date: <input type="text" id="datepicker2" class="form-control"></p>

  </div>


  <div class="col-md-2">
    <p>
      Fillter By:
      <select class="dashboard-filler form-control">
        <option value="">--Choose--</option>
        <option value="7ngay">7 Days</option>
        <option value="thangtruoc">Month</option>
        <option value="thangnay">6 Months</option>
        <option value="365ngayqua">Year</option>
      </select>
    </p>
  </div>

  <div class="col-md-12">

    <div style="width:100% " class="d-flex align-items-center justify-content-around">
      <div class="d-flex flex-column align-items-center"><b id='number__product' style="color: #c8a97e; font-size:45px">0</b>
        <p style="font-size:20px">Products</p>
      </div>
      <div class="d-flex flex-column align-items-center"><b id='number__user' style="color: #c8a97e; font-size:45px">0</b>
        <p style="font-size:20px">Users</p>
      </div>

      <div class="d-flex flex-column align-items-center"><b id='number__sold' style="color: #c8a97e; font-size:45px">0</b>
        <p style="font-size:20px">sales</p>
      </div>

      <div class="d-flex flex-column align-items-center"><b id='number__see' style="color: #c8a97e; font-size:45px">0</b>
        <p style="font-size:20px">view</p>
      </div>
    </div>

    <div id="myfirstchart" style="height: 250px;"></div>
  </div>
</div>




<footer class="panel-footer">
  <div class="row">

    <div class="col-sm-5 text-center">

    </div>
    <div class="col-sm-7 text-right text-center-xs">
      <ul class="pagination pagination-sm m-t-none m-b-none">
        {{-- {!!$products->links()!!} --}}
      </ul>
    </div>
  </div>
</footer>
<table class="table">
  <thead>
    <tr>
      <th>Date</th>
      <th>Order</th>
      <th>Sales</th>
      <th>Profit</th>
      <th>Quantity</th>
    </tr>
  </thead>
  <tbody>
    @foreach($chart_data as $data)
    <tr>
      <td>{{ $data['date'] }}</td>
      <td>{{ $data['total_orders'] }}</td>
      <td>{{ $data['sales'] }}</td>
      <td>{{ $data['profit'] }}</td>
      <td>{{ $data['quantity'] }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {

    let showCount = (element, time, max) => {
      let currentNumber = 0
      const incrementInterval = setInterval(function() {
        if (currentNumber < max) {
          currentNumber++;
          element.textContent = currentNumber;
        } else {
          clearInterval(incrementInterval);
        }
      }, time);
    }


    //count product
    const numberDisplay = document.getElementById('number__product');
    const userDisPlay = document.getElementById('number__user');
    const viewDisplay = document.getElementById('number__see');
    const soleDisplay = document.getElementById('number__sold');

    let products = @json($products);
    let users = @json($users);
    let views = @json($views);
    let sale = 0;

    
    for (let i = 0; i < products.length; i++) {
      sale += products[i].sales_count
    }
    console.log(sale,views)
    showCount(numberDisplay, 200, products.length);
    showCount(userDisPlay, 150, users.length);
    showCount(viewDisplay, 200, views.length);
    showCount(soleDisplay, 150, sale);






  });
</script>


<script>
  $(function() {
    $("#datepicker").datepicker({
      dateFormat: "yy-mm-dd"
    });


    $("#datepicker2").datepicker({
      dateFormat: "yy-mm-dd"
    });
  });
</script>

<script>
  $(document).ready(function() {

    chart60daysorder();


    var chart = new Morris.Bar({
      element: 'myfirstchart',

      lineColor: ['#819C79', '#fc8710', '#FF6541', '#766B56'],
      parseTime: false,
      xkey: 'period',

      ykeys: ['order', 'sales', 'profit', 'quantity'],
      labels: ['Order', 'Sales', 'Profit', 'Quantity']
    });


    $('#btn-dashboard-filler').click(function() {

      var _token = $('input[name="_token"]').val();
      var from_date = $('#datepicker').val();
      var to_date = $('#datepicker2').val();
      //  alert(to_date);
      $.ajax({
        url: "{{ url('/filter-by-date')}}",
        method: "POST",
        dataType: "JSON",
        data: {
          from_date: from_date,
          to_date: to_date,
          _token: _token
        },
        success: function(data) {

          chart.setData(data);
        }

      });

    });

    function chart60daysorder() {
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: "{{ url('/day-order')}}",
        method: "POST",
        dataType: "JSON",
        data: {
          _token: _token
        },
        success: function(data) {

          chart.setData(data);
        }

      });
    }

    $('.dashboard-filler').change(function() {
      var dashboard_value = $(this).val();
      // alert(dashboard_value);
      var _token = $('input[name="_token"]').val();
      $.ajax({
        url: "{{ url('/dashboard-filler')}}",
        method: "POST",
        dataType: "JSON",
        data: {
          dashboard_value: dashboard_value,
          _token: _token
        },
        success: function(data) {
          // alert(data);
          chart.setData(data);
        }

      });

    });


  });
</script>


@endsection