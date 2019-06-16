<?php

namespace Grafline\NovaPoshta;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NovaPoshta
{

    protected $connect;
    protected $locate;
    protected $delivery_np;

    function __construct()
    {
        $this->connect = DB::connection(config('nova-poshta.db_connect'));
        $this->locate = config('nova-poshta.locale');
        $this->delivery_np = config('nova-poshta.delivery_id');
    }

    public function getForm(){
        if(file_exists(resource_path('views/nova_poshta/').'index.blade.php')){
            return view('nova_poshta.index');
        }
        return view('nova_poshta::index');
    }

    public function getDeliveryNP(){
        return $this->delivery_np;
    }

    protected function getLi(){
        if(file_exists(resource_path('views/nova_poshta/').'item_list.blade.php')){
            return view('nova_poshta.item_list');
        }
        return view('nova_poshta::item_list');
    }

    public function getCities(Request $request){

        if($this->locate == 'ru'){
            $field = 'description_ru';
        }else{
            $field = 'description';
        }

        $key = $request->key;

       $cities = $this->connect
           ->table('cities')
           ->where($field, 'LIKE', $key.'%')
           ->get();

        $htm = '';
        foreach ($cities as $city){
            $htm .= view('nova_poshta::item_list', ['item'=> $city, 'field'=>$field]);
        }

        return json_encode([
            'first' => $cities[0]->$field,
            'options' => $htm,
        ]);
    }

    public function getWarehouses(Request $request){

        if($this->locate == 'ru'){
            $field = 'description_ru';
        }else{
            $field = 'description';
        }

        $ref = $request->ref;

        $warehouses = $this->connect
            ->table('warehouses')
            ->where('cityref', $ref)
            ->get();

        $htm = '';
        foreach ($warehouses as $warehouse){
            $htm .= view('nova_poshta::item_list', ['item'=> $warehouse, 'field'=>$field]);
        }

        return json_encode([
            'first' => $warehouses[0]->$field,
            'options' => $htm,
            ]);

    }

}