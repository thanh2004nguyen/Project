
@extends('admin.app')
@section('content')
<span style="font-size: 30px ; color:blue">Product Statistics</span>
<br><br>
<div class="row">
  
    <form autocomplete="off"></form>
      @csrf
      <div class="col-md-2">
               <p>Fromdate: <input type="text" id="datepicker" class="form-control">
               <input type="button" id="btn-dashboard-filler" class="btn btn-primary btn-sm" value="Search"></p>

      </div>
      <div class="col-md-2">
        <p>Todate: <input type="text" id="datepicker2" class="form-control"></p>

     </div>

     <div class="col-md-2">
      <p>
        Filter By:
            <select class="dashboard-filler form-control" >
              <option value="">--Choose--</option>
              <option value="7ngay">Last 7 Days</option>
              <option value="thangtruoc">Month</option>
              <option value="thangnay">6 Months</option>
              <option value="365ngayqua">365 days ago</option>
            </select>
      </p>
     </div>

     <div class="col-md-12">

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

    <script src="backend/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.3.0/raphael.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<script>
  $( function() {
    $( "#datepicker" ).datepicker({
   dateFormat:"yy-mm-dd"
  });


  $( "#datepicker2" ).datepicker({
    dateFormat:"yy-mm-dd"
  });
});

  </script>
    
    <script>
   $(document).ready(function(){

    chart60daysorder();


     var chart =   new Morris.Area({
          element: 'myfirstchart',

           lineColor:['#819C79','#fc8710','#FF6541','#766B56'],
           parseTime: false,
           xkey: 'product_name',

          ykeys: ['review','sales_count'],
          labels: ['Review','SALES']
        });


      $('#btn-dashboard-filler').click(function(){
          
           var _token = $('input[name="_token"]').val();
           var from_date = $('#datepicker').val();
           var to_date = $('#datepicker2').val();

           $.ajax({
            url: "{{ url('/pfilter-by-date')}}",
            method: "POST",
            dataType: "JSON",
            data: {from_date:from_date, to_date:to_date, _token:_token},
            success: function(data)
            {
              chart.setData(data);
            }

           });

      });

      function chart60daysorder()
      {
        var _token = $('input[name="_token"]').val();
          $.ajax({
           url: "{{ url('/pday-order')}}",
           method: "POST",
           dataType: "JSON",
           data: {_token:_token},
           success: function(data)
           {

             chart.setData(data);
           }

          });
      }

      $('.dashboard-filler').change(function(){
          var dashboard_value = $(this).val();
          var _token = $('input[name="_token"]').val();
          $.ajax({
           url: "{{ url('/pdashboard-filler')}}",
           method: "POST",
           dataType: "JSON",
           data: {dashboard_value:dashboard_value, _token:_token},
           success: function(data)
           {
      
             chart.setData(data);
           }

          });

     });


    });


    </script>


@endsection