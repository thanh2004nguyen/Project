<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVoucherRequest;
use App\Http\Requests\EditVoucherRequest;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class VoucherController extends Controller
{
    //
    //coupon
public function insert_coupon(){
    $id = Session::get('admin_id');
    $admin = User::find($id);  
    return view('admin.coupon.insert_coupon',compact('admin'));
}

public function edit_coupon($coupon_id){
    $id = Session::get('admin_id');
    $admin = User::find($id);  
    $voucher = Voucher::find($coupon_id);
    return view('admin.coupon.edit_coupon',compact('admin','voucher'));
}

public function postedit_coupon(EditVoucherRequest $request){
    $data = $request->all();
    $voucher_id = $request->voucher_id;
    $voucher_code = $request->code;
    $voucher = Voucher::where('id', $voucher_id)->first();
    $voucher->name = $request->name;
    $voucher->user_id = $request->specified_user_id;
    $voucher->code = $request->code;
    $voucher->expiration_date = $request->expiration_date;
    $voucher->is_used = 0;
    $voucher->discounttype = $request->discounttype;
    $voucher->discount = $request->discount;
    $voucher->type= $request->type;
    $voucher->expiration_date = $request->expiration_date;
    $voucher->save();

    $id = Session::get('admin_id');
    $admin = User::find($id);  

    // Session::put('message','Edit Voucher Sucessfully');
    $coupon = Voucher::all();
    return redirect('/list_coupon')->with('message', 'Edit Voucher Sucessfully')->with(compact('coupon','admin'));

}


public function insert_coupon_code(CreateVoucherRequest $request){
    $data = array();
    $data['name'] = $request->name;
    $data['user_id'] = $request->specified_user_id;
    $data['code'] = $request->code;
    $data['expiration_date'] = $request->expiration_date;
    $data['is_used'] = 0;
    $data['discounttype'] = $request->discounttype;
    $data['discount'] = $request->discount;
    $data['type'] = $request->type;
    $data['expiration_date'] = $request->expiration_date;

    DB::table('vouchers')->insert($data);

    $id = Session::get('admin_id');
    $admin = User::find($id);  

    // Session::put('message','Thêm mã giảm giá thành công');
    $coupon = Voucher::all();
    return redirect('/list_coupon')->with('message', 'Them coupon thành công')->with(compact('coupon','admin'));

}
public function list_coupon(){
    $id = Session::get('admin_id');
    $admin = User::find($id);  
    // $coupon = Coupon::orderby('coupon_id','DESC')->paginate(2);
    $coupon = Voucher::all();
    return view('admin.coupon.list_coupon')->with(compact('coupon','admin'));
}
public function delete_coupon($coupon_id){
    DB::table('vouchers')->where('id',$coupon_id)->delete();
    Session::put('message','Delete Sucessfully');
    return Redirect::to('/list_coupon');
}


    public function checkVoucher(Request $request)
    {
        $voucherCode = $request->input('voucherCode');
        $id = Auth::id();
        $user = User::find($id);


        // Check the coupon code validity and expiration in the database
         $voucher = Voucher::where('code', $voucherCode)->first();

        if ($voucher)
         {
            $currentDate = now()->toDateString();

            if ( $voucher->is_used === 1 ) 
              {
                // Coupon code is valid but expired
                $response = [
                    'valid' => true,
                    'used' => true,
                    'discount' => null
                ];
               } 

            else

              {
               
                if($voucher->expiration_date && $voucher->expiration_date > $currentDate)
                 {

                        // Coupon code is valid and not expired and not used
                    if($voucher->is_used === 0)
                    {
                           if ( $voucher->type === 1 || $voucher->type === 2 && $voucher->user_id ===  $user->id)
                           {
                               if($voucher->discounttype === 1)
                               {

                                $response = [
                                    'valid' => true,
                                    'expired' => false,
                                    'used' => false,
                                    'discountType' => 'amount',
                                    'discount' => $voucher->discount
                                ];
                                }
                                else if($voucher->discounttype === 2 )
                                {
                                    $response = [
                                        'valid' => true,
                                        'expired' => false,
                                        'used' => false,
                                        'discountType' => 'percent',
                                        'discount' => $voucher->discount
                                    ];

                                }


                             }
                           
                            if($voucher->type === 2 && $voucher->user_id !=  $user->id)
                           {
                            $response = [
                                'valid' => true,
                                'expired' => false,
                                'used' => false,
                                'notown' => true,
                                'discount' => NULL
                            ];

                           }
                  
                    }
                        // Coupon code is valid and not expired but used
                    else
                    {
                        $response = [
                            'valid' => true,
                            'expired' => false,
                            'used' => true,
                            'discount' => null
                        ];
                    }
                 }
                 else
                 {
                 // Coupon code is valid but expired 
                 $response =
                  [
                'valid' => true,
                'expired' => true,
                'discount' => null
                 ];
                 }

            }
            
        
        } 
        else 
        {
            // Coupon code is invalid 
            $response = [
                'valid' => false,
                'expired' => false,
                'discount' => null
            ];
        }

        return response()->json($response);
    }
}
