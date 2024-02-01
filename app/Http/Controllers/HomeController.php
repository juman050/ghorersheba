<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Mail\Mailable;
use App\User;
use App\City;
use App\Service;
use App\SubService;
use Carbon\Carbon;
use App\Mail\SendMail;
use Auth;
use DB;
use Session;
use Mail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = count(User::all());
        $services = count(Service::all());
        $subservices = count(SubService::all());
        $orders = count(DB::table('orders')->get());
        $request_calls = count(DB::table('request_calls')->get());
        $request_services = count(DB::table('request_services')->get());
        $orders = count(DB::table('orders')->get());


        

        $orders_total = DB::table('orders')->where('order_status',1)->sum('order_total');

        $today = DB::table('orders')->where('order_status',1)->whereDate('created_at', DB::raw('CURDATE()'))->sum('order_total');


        $sevendays = Carbon::today()->subDays(7);
        $thisweek = DB::table('orders')
                    ->where('order_status',1)
                    ->where('created_at', '>=', $sevendays)
                    ->sum('order_total');

        $thirtydays = Carbon::now()->subDays(30);
        $thismonth = DB::table('orders')
                    ->where('order_status',1)
                    ->whereDate('created_at', '>', $thirtydays)
                    ->sum('order_total');

        $messages = count(DB::table('contacts')->get());
        $cities = count(City::all());
        return view('home',['users'=>$users,'orders'=>$orders,'today'=>$today,'thisweek'=>$thisweek,'thismonth'=>$thismonth,'orders_total'=>$orders_total, 'services'=>$services,'subservices'=>$subservices,'messages'=>$messages,'cities'=>$cities,'request_services'=>$request_services,'request_calls'=>$request_calls]);
    }
    public function admin(Request $req){
        return view('admin.test')->withMessage('Admin');
    }
    public function super_admin(Request $req){
        return view('admin.test')->withMessage('Super Admin');
    }

    /**
     * code for city table
     * author:juman
     */

    public function cities()
    {
        $cities = City::all();
        return view('admin.city.index',['cities'=>$cities]);
    }
    public function add_city(Request $req)
    {
        $this->validate($req, [
            'city_name' => 'required'
        ]);

        $city = new City();
        $city->city_name = $req->city_name;
        $city->save();
        Session::flash('message', 'Added Successfully!'); 
        $cities = City::all();
        return view('admin.city.index',['cities'=>$cities]);
    }
    public function edit_city($id)
    {
        $cities = City::all();
        $get_city = DB::table('cities')->where(['city_id' => $id])->get();

        return view('admin.city.index',['get_city'=>$get_city,'cities'=>$cities]);
    }
    public function update_city(Request $req)
    {
        //$date = date('Y-m-d H:i:s');
        $this->validate($req, [
            'city_name' => 'required'
        ]);
        City::where('city_id',$req->city_id)->update(['city_name' => $req->city_name]);
        // DB::table('cities')->where('city_id',$req->city_id)->update(['city_name'=>$req->city_name]);
        Session::flash('message', 'Updated Successfully!'); 
        $cities = City::all();
        return view('admin.city.index',['cities'=>$cities]);
    }
    public function remove_city($id)
    {
        City::where(['city_id' => $id])->delete();
        Session::flash('message', 'Deleted Successfully!'); 
        return redirect('/cities');
    }
    /**
     * code for Request calls table
     * author:juman
     */
    public function requested_calls()
    {
        $get_calls = DB::table('request_calls')->get();
        return view('admin.request.calls',['get_calls'=>$get_calls]);
    }
    public function remove_requested_calls($id)
    {
        DB::table('request_calls')->where(['id' => $id])->delete();
        Session::flash('message', 'Deleted Successfully!'); 
        return redirect('/requested-calls');
    }

    /**
     * code for Request services table
     * author:juman
     */
    public function requested_services()
    {
        $request_services = DB::table('request_services')->get();
        return view('admin.request.services',['request_services'=>$request_services]);
    }
    public function remove_service_requests($id)
    {
        DB::table('request_services')->where(['req_service_id' => $id])->delete();
        Session::flash('message', 'Deleted Successfully!'); 
        return redirect('/requested-services');
    }

    /**
     * code for service table
     * author:juman
     */

    public function services()
    {
        $services = Service::all();
        $all_sub_service = SubService::all();
       // $get_sub_service = DB::table('service_subs')->get();
        return view('admin.service.index',['services'=>$services,'all_sub_service'=>$all_sub_service]);
    }
    public function add_service(Request $req)
    {
        
        $this->validate($req, [
            'service_name' => 'required',
            'service_slug' => 'required|unique:services,service_slug',
            'sub_services' => 'required',
            'service_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'service_short_desc' => 'required',
            'service_long_desc' => 'required',
        ]);
        

        $image = $req->file('service_img');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'images/';
        $image->move($destinationPath, $name);
        $service = new Service();
        $service->service_name = $req->service_name;
        $service->service_slug = str_slug($req->service_slug, '-');
        $service->service_icon = $req->service_icon;
        $service->service_img = $name;
        $service->service_short_desc = $req->service_short_desc;
        $service->service_long_desc = $req->service_long_desc;
        $service->save();
        $affectedRow = Service::orderBy('service_id', 'desc')->first();
        $service_id = $affectedRow->service_id;
        $sub_service=array();
        $sub_service = $req->sub_services;
        $count = count($req->sub_services);
        $data = array();
        $msg ="";
        if ($count!=null) {
            for($i=0; $i < $count; $i++) {
              $data[] = array('service_id' => $service_id,'sub_service_id'=>$sub_service[$i] );
            }
              DB::table('service_subs')->insert($data);
              $msg = 'Successfuly Added.';
        }else{
            $msg = 'You have got some error.';
        }

        Session::flash('message', $msg); 
        $services = Service::all();
        $all_sub_service = SubService::all();
        $get_sub_service = DB::table('service_subs')->get();
        return view('admin.service.index',['services'=>$services,'all_sub_service'=>$all_sub_service,'get_sub_service'=>$get_sub_service]);
    }
    public function edit_service($id)
    {
        $services = Service::all();
        $all_sub_service = SubService::all();
        $get_service = DB::table('services')->where(['service_id' => $id])->get();
        $get_sub_service = DB::table('service_subs')->where(['service_id' => $id])->get();
        return view('admin.service.index',['get_service'=>$get_service,'services'=>$services,'all_sub_service'=>$all_sub_service,'get_sub_service'=>$get_sub_service]);
    }
    public function update_service(Request $req)
    {
        $this->validate($req, [
            'service_name' => 'required',
            'service_slug' => 'required',
            'sub_services' => 'required',
            'service_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'service_short_desc' => 'required',
            'service_long_desc' => 'required',
        ]);

        $sub_services = $req->sub_services;
        if (isset($sub_services)) {
            $sub_service=$sub_services;
        }else{
            $sub_service=array();
        }
        $this->process_service($sub_service,$req->service_id);

        $get_service = DB::table('services')->where(['service_id' => $req->service_id])->get();
        $unlinkImage = 'images/'.$get_service[0]->service_img;
        if($req->hasFile('service_img')) {
            unlink($unlinkImage);
            $image = $req->file('service_img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'images/';
            $image->move($destinationPath, $name);
        }
        else {
            $name = $get_service[0]->service_img;
        }


        Service::where('service_id',$req->service_id)
                     ->update([
                        'service_name' => $req->service_name,
                        'service_slug' => str_slug($req->service_slug, '-'),
                        'service_icon' => $req->service_icon,
                        'service_img' => $name,
                        'service_short_desc' => $req->service_short_desc,
                        'service_long_desc' => $req->service_long_desc,
                    ]);
        Session::flash('message', 'Updated Successfully!'); 
        $services = Service::all();
        $all_sub_service = SubService::all();
        //$get_sub_service = DB::table('service_subs')->get();
        return view('admin.service.index',['services'=>$services,'all_sub_service'=>$all_sub_service]);
    }
    public function remove_service($id)
    {
        Service::where(['service_id' => $id])->delete();
        DB::table('service_subs')->where(['service_id' => $id])->delete();
        Session::flash('message', 'Deleted Successfully!'); 
        return redirect('/services');
    }

    private function process_service($sub_service,$service_id){
        $current_sub=DB::table('service_subs')->where(['service_id' => $service_id])->get();
        $cur_sub_array=array();
        if($current_sub){
            foreach ($current_sub as $value) {
                $cur_sub_array[]=$value->sub_service_id;
            }       
            
        }
        $delete_array = array_diff($cur_sub_array, $sub_service);
        if ($delete_array) {
            $total_data=count($delete_array);
            if ($total_data!=null) {
                foreach ($delete_array as $key => $value) {
                  DB::table('service_subs')->where(['service_id' => $service_id,'sub_service_id'=>$value])->delete();
                }
            
            }
        }
        $insert_array = array_diff($sub_service, $cur_sub_array);
        if ($insert_array) {
            $data = array();
            $total_data=count($insert_array);
            if ($total_data!=null) {
              foreach ($insert_array as $key => $value) {
                $data[] = array('service_id' => $service_id,'sub_service_id'=>$value );
              }
              DB::table('service_subs')->insert($data);
            }
        }
        
    }


    /**
     * code for sub service table
     * author:juman
     */

    public function sub_services()
    {
        $sub_services = SubService::all();
        return view('admin.sub_service.index',['sub_services'=>$sub_services]);
    }
    public function add_sub_service(Request $req)
    {
        $this->validate($req, [
            'sub_service_name' => 'required',
            'sub_service_price' => 'required|integer|min:0'
        ]);

        $sub_service = new SubService();
        $sub_service->sub_service_name = $req->sub_service_name;
        $sub_service->sub_service_price = $req->sub_service_price;
        $sub_service->save();
        Session::flash('message', 'Added Successfully!'); 
        $sub_services = SubService::all();
        return view('admin.sub_service.index',['sub_services'=>$sub_services]);
    }
    public function edit_sub_service($id)
    {
        $sub_services = SubService::all();
        $get_sub_service = DB::table('sub_services')->where(['sub_service_id' => $id])->get();

        return view('admin.sub_service.index',['get_sub_service'=>$get_sub_service,'sub_services'=>$sub_services]);
    }
    public function update_sub_service(Request $req)
    {
        $this->validate($req, [
            'sub_service_name' => 'required',
            'sub_service_price' => 'required|integer|min:0'
        ]);


        SubService::where('sub_service_id',$req->sub_service_id)
                     ->update([
                        'sub_service_name' => $req->sub_service_name,
                        'sub_service_price' => $req->sub_service_price
                    ]);
        Session::flash('message', 'Updated Successfully!'); 
        $sub_services = SubService::all();
        return view('admin.sub_service.index',['sub_services'=>$sub_services]);
    }
    public function remove_sub_service($id)
    {
        SubService::where(['sub_service_id' => $id])->delete();
        DB::table('service_subs')->where(['sub_service_id' => $id])->delete();
        Session::flash('message', 'Deleted Successfully!'); 
        return redirect('/sub_services');
    }



    /**
     * code for Users table
     * author:juman
     */


    public function users()
    {
        $users = User::all();
        return view('admin.user.index',['users'=>$users]);
    }

    public function craete_user(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => $request->type,
        ]);
        Session::flash('message', 'User Added Successfully!'); 
        $users = User::all();
        return view('admin.user.index',['users'=>$users]);
    }

    public function edit($id)
    {
        $sub_services = SubService::all();
        $get_user = DB::table('users')->where(['id' => $id])->get();

        $users = User::all();
        return view('admin.user.index',['users'=>$users,'get_user'=>$get_user]);
    }

    public function update_user(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'type' => 'required',
        ]);
        if ($request->password !='') {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
                'password' => 'required|string|min:6|confirmed',
                'type' => 'required',
            ]);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'type' => $request->type,
            ];
        }else{
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
                'type' => 'required',
            ]);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'type' => $request->type,
            ];
        }
        User::where(['id'=>$request->id])->update($data);
        Session::flash('message', 'User Updated Successfully!'); 
        $users = User::all();
        return view('admin.user.index',['users'=>$users]);
    }
    public function remove_user($id)
    {
        
        User::where(['id' => $id])->delete();
        Session::flash('message', 'Deleted Successfully!'); 
        return redirect('/users');
    }

    /**
     * code for contacts table
     * author:juman
     */

    public function messages(){
        $messages = DB::table('contacts')->get();
        return view('admin.message.index',['messages'=>$messages]);
    }
    public function remove_message($id)
    {
        DB::table('contacts')->where(['id' => $id])->delete();
        Session::flash('message', 'Deleted Successfully!'); 
        return redirect('/messages');
    }
    public function replyMessage(Request $request)
    {  

        try {   
            DB::table('contacts')->where(['id' =>  $request->id])->update(['status'=>1]);
            $data = $request->message;
            Session::flash('message', 'message has been sent successfully.'); 
            Mail::to($request->email)->send(new SendMail($data));
            // $mail = Mail::send('mail.index', array('firstname'=>"$request->fname",'msg'=>"$request->message"), function($message) use ($request) {
            //     $message->to("$request->email", "$request->fname")->subject('Welcome to GhorerSheba!');
            // });
            
        }
        catch (Exception $e) {
                Log::error("Reply Mail " . $e->getMessage()) ;
                return "false";
        }

        

    }

    /**
     * code for orders table
     * author:juman
     */
    public function orders()
    {

        $orders = DB::table('orders')
                    ->orderBy('orders.created_at','DESC')
                    ->get();
        return view('admin.order.index',['orders'=>$orders]);
    }
    public function update_order(Request $request)
    {
        DB::table('orders')->where(['id' => $request->order_id])->update(['order_total'=>$request->order_total]);
    }
    public function remove_order($id)
    {
        DB::table('orders')->where(['id' => $id])->delete();
        Session::flash('message', 'Deleted Successfully!'); 
        return redirect('/orders');
    }
    public function cancel_order($id)
    {
        DB::table('orders')->where(['id' => $id])->update([
            'order_status'=>'2'
        ]);
        Session::flash('message', 'Order cancelled Successfully!'); 
        return redirect('/orders');
    }
    public function complete_order($id)
    {
        DB::table('orders')->where(['id' => $id])->update([
            'order_status'=>'1'
        ]);
        Session::flash('message', 'Order completed Successfully!'); 
        return redirect('/orders');
    }
    public function pending_orders()
    {
        $orders = DB::table('orders')
                  ->where(['orders.order_status' => '0'])
                  ->get();
        return view('admin.order.index',['orders'=>$orders]);
    }
    public function completed_orders()
    {
        $orders = DB::table('orders')
                    ->where(['orders.order_status' => '1'])
                    ->get();
        return view('admin.order.index',['orders'=>$orders]);
    }
    public function cancelled_orders()
    {

        $orders = DB::table('orders')
                    ->where(['orders.order_status' => '2'])
                    ->get();
        return view('admin.order.index',['orders'=>$orders]);
    }

    /**
     * code for setting table
     * author:juman
     */

    public function setting(){

        $userId = Auth::id();
        $currentuser = User::find($userId);
        $settings = DB::table('settings')->get();
        return view('admin.setting.index',['currentuser'=>$currentuser,'settings'=>$settings,'profile_active'=>'active']);
    }
    public function update_profile(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
        ]);
        if ($request->password !='') {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
                'password' => 'required|string|min:6|confirmed',
            ]);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ];
        }else{
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            ]);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
            ];
        }
        User::where(['id'=>$request->id])->update($data);
        Session::flash('message', 'Data Updated Successfully!'); 
        return redirect('setting');
    }
    public function update_about_us(Request $request){
        $this->validate($request, [
            'about_us' => 'required|string'
        ]);

        $data = DB::table('settings')->get();
         
        if ($data->isEmpty()) {
           // data doesn't exist
            DB::table('settings')->insert(['about_us'=>$request->about_us]);
        }else{
            DB::table('settings')->update(['about_us'=>$request->about_us]);
        }
        Session::flash('message', 'Data Updated Successfully!'); 
        $userId = Auth::id();
        $currentuser = User::find($userId);
        $settings = DB::table('settings')->get();
        return view('admin.setting.index',['currentuser'=>$currentuser,'settings'=>$settings,'about_active'=>'active']);
    
    }
    public function update_social_links(Request $request){
        // $this->validate($request, [
        //     'fb_link' => 'required|url',
        //     'tw_link' => 'required|url',
        //     'ln_link' => 'required|url',
        //     'insta_link' => 'required|url',
        // ]);

        $data = DB::table('settings')->get();
         
        if ($data->isEmpty()) {
           // data doesn't exist
            DB::table('settings')->insert([
                'fb_link'=>$request->fb_link,
                'tw_link'=>$request->tw_link,
                'ln_link'=>$request->ln_link,
                'insta_link'=>$request->insta_link
            ]);
        }else{
            DB::table('settings')->update([
                'fb_link'=>$request->fb_link,
                'tw_link'=>$request->tw_link,
                'ln_link'=>$request->ln_link,
                'insta_link'=>$request->insta_link
            ]);
        }
        Session::flash('message', 'Data Updated Successfully!'); 
        $userId = Auth::id();
        $currentuser = User::find($userId);
        $settings = DB::table('settings')->get();
        return view('admin.setting.index',['currentuser'=>$currentuser,'settings'=>$settings,'social_active'=>'active']);
    }
    public function update_contact_infos(Request $request){
        $this->validate($request, [
            'email' => 'required|string|email|max:255',
            'address' => 'required',
            'whatsapp_number' => 'required',
            'phone_number' => 'required'
        ]);

        $data = DB::table('settings')->get();
         
        if ($data->isEmpty()) {
           // data doesn't exist
            DB::table('settings')->insert([
                'email'=>$request->email,
                'address'=>$request->address,
                'hour_of_operation'=>$request->hour_of_operation,
                'whatsapp_number'=>$request->whatsapp_number,
                'phone_number'=>$request->phone_number,
                'map_lat'=>$request->map_lat,
                'map_long'=>$request->map_long
            ]);
        }else{
            DB::table('settings')->update([
                'email'=>$request->email,
                'address'=>$request->address,
                'hour_of_operation'=>$request->hour_of_operation,
                'whatsapp_number'=>$request->whatsapp_number,
                'phone_number'=>$request->phone_number,
                'map_lat'=>$request->map_lat,
                'map_long'=>$request->map_long
            ]);
        }
        Session::flash('message', 'Data Updated Successfully!'); 
        $userId = Auth::id();
        $currentuser = User::find($userId);
        $settings = DB::table('settings')->get();
        return view('admin.setting.index',['currentuser'=>$currentuser,'settings'=>$settings,'contact_active'=>'active']);
    }

    public function update_maintanance(Request $request){

        $data = DB::table('settings')->get();

         
        if ($data->isEmpty()) {
           // data doesn't exist
            DB::table('settings')->insert(['maintanance_mode'=>0]);
        }else{
            DB::table('settings')->update(['maintanance_mode'=>$request->maintanance_mode?'1':0]);
        }
        Session::flash('message', 'Data Updated Successfully!'); 
        $userId = Auth::id();
        $currentuser = User::find($userId);
        $settings = DB::table('settings')->get();
        return view('admin.setting.index',['currentuser'=>$currentuser,'settings'=>$settings,'maintanance_active'=>'active']);
    
    }
}
