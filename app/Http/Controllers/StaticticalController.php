<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductRequest;
use App\Http\Requests\AdmSignupRequest;
use App\Http\Requests\EditProductRequest;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Mail\FinishOrderEmail;
use App\Mail\VoucherEmail;
use App\Mail\WelcomeEmail;
use App\Models\Image;
use App\Models\Price;
use App\Models\StatisProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use App\Models\Social;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Auth;


//du them admin
use Illuminate\Support\Facades\App;
use App\Models\Brand;
use App\Models\Category;
use App\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Customer;
use App\Models\Voucher;
use App\Models\Product;
use PDF;
use App\City;
use App\Models\Staticstical;
use App\Models\Weight;
use App\Province;
use App\Wards;
use App\Models\View;

// chat
use App\Models\Chat;



class StaticticalController extends Controller
{
    //  thong ke (H)
    // thanh sửa static
    public function statistical()
    {
        $id = Session::get('admin_id');
        $admin = User::find($id);

        $statistics = Staticstical::orderBy('order_date', 'ASC')->get();

        $chart_data = [];

        $products = product::get();
        $views = view::get();
        $users = User::get();

        foreach ($statistics as $statistic) {
            $chart_data[] = [
                'date' => $statistic->order_date,
                'total_orders' => $statistic->total_order,
                'sales' => number_format($statistic->sales, 2, '.', ','), // Định dạng doanh số
                'profit' => number_format($statistic->profit, 2, '.', ','), // Định dạng lợi nhuận
                'quantity' => $statistic->quantity
            ];
        }

        return view('admin.Statictical.statistical')->with(compact('admin', 'chart_data', 'products', 'views', 'users'));
    }


    public function filterbydate(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Staticstical::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();
        //  $get = Staticstical::orderBy('order_date', 'ASC')->get();
        if ($get) {
            $chart_data = [];
            foreach ($get as  $val) {
                $chart_data[] = array(
                    'period' => $val->order_date,
                    'order' => $val->total_order,
                    'sales' => $val->sales,
                    'profit' => $val->profit,
                    'quantity' => $val->quantity
                );
            }
        } else {
            $chart_data = [];
        }


        echo $data = json_encode($chart_data);
    }

    public function day_order(Request $request)

    {
        $data = $request->all();
        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Staticstical::whereBetween('order_date', [$sub60days, $now])->orderBy('order_date', 'ASC')->get();
        foreach ($get as  $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboardfiller(Request $request)

    {
        $data = $request->all();
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $sub182days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(182)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay') {
            $get = Staticstical::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangtruoc') {
            $get = Staticstical::whereBetween('order_date', [$sub30days, $now])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangnay') {
            $get = Staticstical::whereBetween('order_date', [$sub182days, $now])->orderBy('order_date', 'ASC')->get();
        } else {
            $get = Staticstical::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        }
        foreach ($get as  $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    //  thong ke product (H)
    public function pstatistical()
    {
        $id = Session::get('admin_id');
        $admin = User::find($id);
        return view('admin.Statictical.pstatistical')->with(compact('admin'));
    }

    public function pfilterbydate(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = StatisProduct::whereBetween('date', [$from_date, $to_date])->orderBy('date', 'ASC')->get();
        $chart_data = [];

        foreach ($get as $val) {
            $product_id = $val->product_id;
            $product = Product::find($product_id);

            $product_name = $product->name;
            $period = $val->date;
            $review = $val->review;
            $sales_count = $val->sales_count;

            // Check if the product already exists in the chart data
            $existing_product_key = collect($chart_data)->search(function ($item) use ($product_name) {
                return $item['product_name'] === $product_name;
            });

            if ($existing_product_key !== false) {
                // If the product exists, update the values in the existing data
                $chart_data[$existing_product_key]['sales_count'] += $sales_count;
                $chart_data[$existing_product_key]['review'] += $review;
            } else {
                // If the product does not exist, add a new entry to the chart data
                $chart_data[] = [
                    'product_name' => $product_name,
                    'period' => $period,
                    'review' => $review,
                    'sales_count' => $sales_count,
                ];
            }
        }

        echo $data = json_encode($chart_data);
    }

    public function pday_order(Request $request)

    {
        $data = $request->all();
        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = StatisProduct::whereBetween('date', [$sub60days, $now])->orderBy('date', 'ASC')->get();
        $chart_data = [];

        foreach ($get as $val) {
            $product_id = $val->product_id;
            $product = Product::find($product_id);

            $product_name = $product->name;
            $period = $val->date;
            $review = $val->review;
            $sales_count = $val->sales_count;

            // Check if the product already exists in the chart data
            $existing_product_key = collect($chart_data)->search(function ($item) use ($product_name) {
                return $item['product_name'] === $product_name;
            });

            if ($existing_product_key !== false) {
                // If the product exists, update the values in the existing data
                $chart_data[$existing_product_key]['sales_count'] += $sales_count;
                $chart_data[$existing_product_key]['review'] += $review;
            } else {
                // If the product does not exist, add a new entry to the chart data
                $chart_data[] = [
                    'product_name' => $product_name,
                    'period' => $period,
                    'review' => $review,
                    'sales_count' => $sales_count,
                ];
            }
        }

        echo $data = json_encode($chart_data);
    }

    public function pdashboardfiller(Request $request)

    {
        $data = $request->all();
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $sub182days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(182)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value'] == '7ngay') {
            $get = StatisProduct::whereBetween('date', [$sub7days, $now])->orderBy('date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangtruoc') {
            $get = StatisProduct::whereBetween('date', [$sub30days, $now])->orderBy('date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangnay') {
            $get = StatisProduct::whereBetween('date', [$sub182days, $now])->orderBy('date', 'ASC')->get();
        } else {
            $get = StatisProduct::whereBetween('date', [$sub365days, $now])->orderBy('date', 'ASC')->get();
        }
        $chart_data = [];

        foreach ($get as $val) {
            $product_id = $val->product_id;
            $product = Product::find($product_id);

            $product_name = $product->name;
            $period = $val->date;
            $review = $val->review;
            $sales_count = $val->sales_count;

            // Check if the product already exists in the chart data
            $existing_product_key = collect($chart_data)->search(function ($item) use ($product_name) {
                return $item['product_name'] === $product_name;
            });

            if ($existing_product_key !== false) {
                // If the product exists, update the values in the existing data
                $chart_data[$existing_product_key]['sales_count'] += $sales_count;
                $chart_data[$existing_product_key]['review'] += $review;
            } else {
                // If the product does not exist, add a new entry to the chart data
                $chart_data[] = [
                    'product_name' => $product_name,
                    'period' => $period,
                    'review' => $review,
                    'sales_count' => $sales_count,
                ];
            }
        }

        echo $data = json_encode($chart_data);
    }
}
