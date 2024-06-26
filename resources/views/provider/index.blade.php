@extends('admin.app')
@section('title', 'Brand List')
@section('content')

<!-- ... Code trước đó ... -->

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-header">
                    <h3 class="card-title">List Provider</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="discount__table" class="table table-bordered table-hover">
                        <thead class="thead-dark ">
                        <tr>
                            <th>Provider ID</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Logo</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($providers as $p)
                            <tr>
                                <td>{{ $p->provider_id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->country }}</td>
                                <td><img width="50px" src="{{url($p->logo)  }}" alt="Logo"></td>
                                <td class="text-right">
                                    
                                    <a class="btn btn-info btn-sm" href="{{ url('provider/edit/' . $p->provider_id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    
                                 
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                       
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('script-content')
<script>
    $(function () {
        $('#brand').DataTable();
    });
</script>
@endsection
