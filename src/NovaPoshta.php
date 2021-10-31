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

    protected function description(){
        if($this->locate == 'ru'){
            return 'description_ru';
        }
        return 'description';
    }

    protected function getResult($items){
        $field = $this->description();
        $htm = '';
        foreach ($items as $item){
            $htm .= view('nova_poshta::item_list', ['item'=> $item, 'field'=>$field]);
        }

        return json_encode([
            'first' => $items[0]->$field,
            'options' => $htm,
        ]);
    }

    public function getCities(Request $request){

        $field = $this->description();
        $key = $request->key;

        $cities = $this->connect
            ->table('cities')
            ->where($field, 'LIKE', $key.'%')
            ->orderBy($field, 'asc')
            ->get(['ref', $field]);

        return $this->getResult($cities);
    }

    public function getWarehouses(Request $request){

        $field = $this->description();
        $ref = $request->ref;

        $warehouses = $this->connect
            ->table('warehouses')
            ->where('cityref', $ref)
            ->orderBy($field, 'asc')
            ->get(['ref', $field]);

        return $this->getResult($warehouses);
    }

    public function getWarehousesKey(Request $request){

        $field = $this->description();
        $ref = $request->ref;
        $key = $request->key;

        $query = $this->connect
            ->table('warehouses')
            ->where('cityref', $ref);

        if ((int)$key > 0){
            $query->where(function ($query) use ($field, $key){
                $query->where($field, 'LIKE', '%№'.$key.'%')
                    ->orWhere($field, 'LIKE', '%№ '.$key.'%');
            });
        }else{
            $query->where($field, 'like', '%'.$key.'%');
        }

        $warehouses = $query->get(['ref', $field]);

        return $this->getResult($warehouses);
    }

}