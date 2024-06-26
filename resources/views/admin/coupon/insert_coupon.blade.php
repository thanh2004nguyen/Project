@extends('admin.app')
@section('content')

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-lg-6" style="text-align: center;margin-left: 250px">
        <section class="panel">
            <header class="panel-heading">
                <h2 style="text-align:center">Create Voucher</h2> 
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Voucher Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"  value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Voucher Code</label>
                            <input type="text" name="code" class="form-control" id="exampleInputEmail1" value="{{ old('code') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Voucher Discount Type</label>
                            <select name="discounttype" class="form-control input-sm m-bot15">
                                <option value="0">----Select-----</option>
                                <option value="1">Discount by amount</option>
                                <option value="2">Discount by percent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Discount(Percent type Max 90% / Amount type Max 500000VND)</label>
                            <input type="number" name="discount" class="form-control" id="exampleInputEmail1" min="1" value="{{ old('discount') }}" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Expiration Date</label>
                            <input type="date" name="expiration_date" class="form-control" id="exampleInputEmail1" min="{{ date('Y-m-d') }}" value="{{ old('expiration_date') }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Voucher Owner</label>
                            <select name="type" class="form-control input-sm m-bot15" required>
                                <option value="0">----Select-----</option>
                                <option value="1">Everyone can use</option>
                                <option value="2">Only can use by specified user</option>          
                            </select>
                        </div>

                        <div class="form-group" id="userIdField" style="display: none;">
                            <label for="exampleInputPassword1">Specify User ID</label>
                            <input type="text" name="specified_user_id" class="form-control" id="specified_user_id" required>
                        </div>

                        <button type="submit" name="add_coupon" class="btn btn-info">Add Voucher</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

<script>
    // Show or hide the Specify User ID field based on the Voucher Owner selection
    document.addEventListener('DOMContentLoaded', function() {
        var voucherOwnerSelect = document.querySelector('select[name="type"]');
        var userIdField = document.getElementById('userIdField');
        var specified_user_id = $('#specified_user_id');
        var discountInput = document.querySelector('input[name="discount"]');
        var discountTypeSelect = document.querySelector('select[name="discounttype"]');

        voucherOwnerSelect.addEventListener('change', function() {
            if (this.value === '2') {
                specified_user_id.prop('disabled', false).prop('required', true)
                userIdField.style.display = 'block';
            } else {
                userIdField.style.display = 'none';
                specified_user_id.prop('disabled', true).removeAttr('required');
            }
        });

        discountTypeSelect.addEventListener('change', function() {
            if (this.value === '2') {
                discountInput.max = 90;
            } else {
                discountInput.max = 500000;
            }
        });


        // Check the initial value on page load
        if (voucherOwnerSelect.value === '2') {
            userIdField.style.display = 'block';
            specified_user_id.prop('disabled', false).prop('required', true)
        } else {
            userIdField.style.display = 'none';
            // specified_user_id.prop('disabled', true).removeAttr('required');
            
        }

        if (discountTypeSelect.value === '2') {
            discountInput.max = 100;
        }
    });
</script>