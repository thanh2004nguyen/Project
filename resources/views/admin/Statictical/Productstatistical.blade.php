
@extends('admin.app')
@section('content')
<h3>Thống Kê Đơn Hàng Doanh Số</h3>
<br><br>
<div class="row">
  
    <form autocomplete="off"></form>
      @csrf
      <div class="col-md-2">
               <p>Từ Ngày: <input type="text" id="datepicker" class="form-control">
               <input type="button" id="btn-dashboard-filler" class="btn btn-primary btn-sm" value="Loc Ket Qua"></p>

      </div>
      <div class="col-md-2">
        <p>Đến Ngày: <input type="text" id="datepicker2" class="form-control"></p>

     </div>

     <div class="col-md-2">
      <p>
            Lọc Theo:
            <select class="dashboard-filler form-control" id="">
              <option value="">--Chọn--</option>
              <option value="7ngay">7 Ngày Qua</option>
              <option value="thangtruoc">tháng trước</option>
              <option value="thangnay">Tháng Này</option>
              <option value="365ngayqua">365 Ngày Qua</option>
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
     var chart =   new Morris.Bar({
          element: 'myfirstchart',

           lineColor:['#819C79','#fc8710','#FF6541','#766B56'],
           parseTime: false,
           xkey: 'period',

          ykeys: ['order','sales','profit','quantity'],
          labels: ['ĐƠN HÀNG','DOANH SỐ','LỢi NHUẬN','SỐ LƯỢNG HÀNG']
        });


      $('#btn-dashboard-filler').click(function(){
          
           var _token = $('input[name="_token"]').val();
           var from_date = $('#datepicker').val();
           var to_date = $('#datepicker2').val();

           $.ajax({
            url: "{{ url('/filter-by-date')}}",
            method: "POST",
            dataType: "JSON",
            data: {from_date:from_date, to_date:to_date, _token:_token},
            success: function(data)
            {
              chart.setData(data);
            }

           });

      });
      $('.dashboard-filler').change(function(){
          var dashboard_value = $(this).val();
          var _token = $('input[name="_token"]').val();
          $.ajax({
           url: "{{ url('/dashboard-filler')}}",
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