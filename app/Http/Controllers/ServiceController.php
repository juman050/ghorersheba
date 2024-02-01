<?php
/*
Controller:ServiceController
author:juman
date:24-11-18
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\SubService;
use App\Mail\OrderMail;
use Illuminate\Mail\Mailable;
use DB;
use View;
use Redirect;
use Session;
use Mail;
class ServiceController extends Controller
{
    public function __construct() {
        $settings = DB::table('settings')->get();
        if ($settings[0]->maintanance_mode == '1') {
           echo '<h1>Sorry! Our site is under construction.</h1><h2>We are coming soon....</h2>';
           exit;
        }else{
            View::share('settings', $settings);
        }
    }
    public function index()
    {
    	$serviceInfo =  Service::where('deleted',0)->get();
        $active = 'home';
    	return view('front.home.index',['serviceInfo'=>$serviceInfo,'active'=>$active]);
    }
    public function get_service_subs(Request $request)
    {

        $serviceSingle =  Service::where(['service_id'=>$request->service,'deleted'=>0])->get();
        return Redirect::to('service/'.$serviceSingle[0]->service_slug);
    }

    public function get_service($slug)
    {
        
        $serviceInfo =  Service::where('deleted',0)->get();
        $serviceSingle =  Service::where(['service_slug'=>$slug,'deleted'=>0])->get();
        $sub_survices = DB::table('service_subs')
                    ->join('sub_services','service_subs.sub_service_id','sub_services.sub_service_id')
                    ->where('service_subs.service_id','=', $serviceSingle[0]->service_id)
                    ->get();
        $cities =  DB::table('cities')->get();
        $active = 'service';
        return view('front.service.index',['sub_survices'=>$sub_survices,'serviceInfo'=>$serviceInfo,'serviceSingle'=>$serviceSingle,'cities'=>$cities,'active'=>$active]);
    }

    public function makeOrder(Request $request)
    {
        $this->validate($request, [
            'service_id' => 'required',
            'subservices' => 'required',
            'customer_city' => 'required',
            'customer_name' => 'required',
            'customer_area' => 'required',
            'customer_phone_number' => 'required'
        ]);

        $ids=array();
        foreach ($request->subservices as $id) {
            $ids[] = $id;
        }
        
        $sub_total = SubService::whereIn('sub_service_id',$ids)->sum('sub_service_price');

        $date = date('Y-m-d H:i:s');

        DB::table('orders')->insert([
            'order_total'=>$sub_total,
            'customer_name'=>$request->customer_name,
            'customer_city'=>$request->customer_city,
            'customer_area'=>$request->customer_area,
            'customer_address'=>$request->customer_address,
            'customer_phone_number'=>$request->customer_phone_number,
            'customer_email'=>$request->customer_email,
            'created_at'=>$date,
            'updated_at'=>$date
        ]);

        $order_id = DB::getPdo()->lastInsertId();

        DB::table('order_services')->insert([
            'service_id'=>$request->service_id,
            'order_id'=>$order_id
        ]);


        $sub_service=array();
        $sub_service = $request->subservices;

        $count = count($request->subservices);
        $data = array();
        if ($count!=null) {
            for($i=0; $i < $count; $i++) {
              $data[] = array('order_id' => $order_id,'sub_service_id'=>$sub_service[$i] );
            }
              DB::table('order_sub_services')->insert($data);
        }

        $serviceSingle =  Service::where(['service_id'=>$request->service_id,'deleted'=>0])->get();
        $sub_services = DB::table('order_sub_services')
                    ->join('sub_services', 'sub_services.sub_service_id', '=', 'order_sub_services.sub_service_id')
                    ->where('order_sub_services.order_id', '=', $order_id)
                    ->select('sub_services.*','order_sub_services.*')
                    ->get();
        $string='';
        $count = count($sub_services);
        $i = 1;
        foreach ($sub_services as $value){      
            if ($count != $i) {
               $string .=  '<b><small>'.$value->sub_service_name.'</small> | </b>';
            }else{
               $string .=  '<b><small>'.$value->sub_service_name.'</small></b>';
            }
            $i++;
        }
        
        $msg="";
        $msg.= "Order id: ".$order_id;
        $msg.= "<br>Order Service: ".$serviceSingle[0]->service_name;
        $msg.= "<br>Order Sub Service: ".$string;
        $msg.= "<br>Order total: ".$sub_total;
        $msg.="<br><a href='http://localhost/ghorersheba/update_order_status/".$order_id."'>Confirm Order</a>";

        try {   

            Mail::to($request->customer_email)->send(new OrderMail($msg));

            // $mail = Mail::send('mail.order', array('firstname'=>"$request->customer_name",'msg'=>"$msg"), function($message) use ($request) {
            //     $message->to("$request->customer_email", "$request->customer_name")->subject('Welcome to GhorerSheba!');
            // });
            
        }
        catch (Exception $e) {
                Log::error($e->getMessage()) ;
                return "false";
        }




        


    }

    public function contact()
    {
        $active = 'contact';
        $serviceInfo =  Service::where('deleted',0)->get();
        return view('front.contact.index',['serviceInfo'=>$serviceInfo,'active'=>$active]);
    }

    public function send_msg(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'message' => 'required|string|max:255'
        ]);
        $date = date('Y-m-d H:i:s');
        DB::table('contacts')->insert([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'phone_number'=>$request->phone_number,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>$date,
            'updated_at'=>$date
        ]);
        Session::flash('message', 'Message has been sent Successfully!'); 
        return  redirect('/contact');
    }

    //request a call
    public function req_call(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        DB::table('request_calls')->insert([
            'req_name'=>$request->customer_name,
            'req_number'=>$request->phone_number,
            'created_at'=>$date
        ]);
    }

    // request a service
    public function req_service()
    {
        $serviceInfo =  Service::where('deleted',0)->get();
        return view('front.service.req',['serviceInfo'=>$serviceInfo]);
    }
    public function add_req_service(Request $request)
    {
        $date = date('Y-m-d H:i:s');
        DB::table('request_services')->insert([
            'req_user_name'=>$request->req_user_name,
            'req_user_phone'=>$request->req_user_phone,
            'req_service_name'=>$request->req_service_name,
            'req_service_description'=>$request->req_service_description,
            'created_at'=>$date
        ]);
    }

    public function about()
    {
        $active = 'about';
        $serviceInfo =  Service::where('deleted',0)->get();
        return view('front.about.index',['serviceInfo'=>$serviceInfo,'active'=>$active]);
    }
    public function howItWorks(){
        $active = 'howitworks';
        $serviceInfo =  Service::where('deleted',0)->get();
        return view('front.howitworks.index',['serviceInfo'=>$serviceInfo,'active'=>$active]);
    }

}
