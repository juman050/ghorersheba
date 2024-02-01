<?php 
function subService($order_id){
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
    return $string;
}
function service($order_id){
    $services = DB::table('order_services')
    			->join('services', 'services.service_id', '=', 'order_services.service_id')
    			->where('order_services.order_id', '=', $order_id)
    			->select('order_services.*','services.*')
    			->get();
    foreach ($services as $service) {
    	return $service->service_name;
    }

    
}
function orderStatus($status)
{
	$string='';
	if ($status == 0) {
		$string="<label class='label label-warning'>Pending</label>";
	}elseif($status == 1){
		$string="<label class='label label-success'>Completed</label>";
	}elseif($status == 2){
		$string="<label class='label label-danger'>Cancelled</label>";
	}else{
		$string="<label class='label label-danger'>Deleted</label>";
	}
	return $string;
}