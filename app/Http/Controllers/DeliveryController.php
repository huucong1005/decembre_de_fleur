<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;


class DeliveryController extends Controller
{

    public function delivery(Request $request){
        $city=City::orderby('id_tp','ASC')->get();
        return view('admin.delivery.delivery')->with(compact('city'));
    }

    public function select_delivery(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output ='';
            if($data['action']=="city"){
                $select_province =Province::where('id_tp', $data['ma_id'])->orderby('id_qh','ASC')->get();
                    $output='<option value="">----Chọn quận(huyện)----</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->id_qh.'">'.$province->name_qh.'</option>';
                }
                
            }else{
                $select_wards=Wards::where('id_qh', $data['ma_id'])->orderby('id_xptt','ASC')->get();
                    $output='<option value="">----Chọn phường(xã)----</option>';
                foreach($select_wards as $key => $wards){
                    $output.='<option value="'.$wards->id_xptt.'">'.$wards->name_xptt.'</option>';
                }
                
            }
                    
        }
        echo $output;
    }

    public function add_delivery(Request $request){
         $data = $request->all();
         $fee_ship = new Feeship();
         
         $fee_ship->id_tp = $data['city'];
         $fee_ship->id_qh = $data['province'];
         $fee_ship->id_xptt = $data['wards'];
         $fee_ship->fee_ship = $data['fee_ship'];

         $fee_ship->save();
    }

    public function select_feeship(){
        $feeship = Feeship::orderby('fee_id', 'DESC')->get();
        $output ='';
        $output .='<div class="table-responsive">
        <table class="table table-striped b-t b-light table-bordered">
            <thead><tr>
                <th>Tên thành phố</th>
                <th>Tên quận huyện</th>
                <th>Tên phường xã</th>
                <th>Phí ship</th>
            </tr></thead>
            <tbody>';

            foreach($feeship as $key => $fee){
            $output .='<tr>
                <td>'.$fee->city->name_tp.'</th>
                <td>'.$fee->province->name_qh.'</th>
                <td>'.$fee->wards->name_xptt.'</th>
                <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="feeship_edit">'.number_format((float)$fee->fee_ship,0,',','.').'</th>
            </tr>';
            }
            
            $output .='</tbody>
        </table></div>';

        echo $output;


    }


    public function update_delivery(Request $request){
        $data = $request->all();
        $fee_ship = Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->fee_ship = $fee_value;

        $fee_ship->save();
    }

     
}
