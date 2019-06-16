<div class="row">
    @php($delivery_np = \Grafline\NovaPoshta\Facades\NovaPoshta::getDeliveryNP())
    <div data-dnp="{{$delivery_np}}" class="nova_poshta" @if((!old() && (!isset($user->delivery_id) || (isset($user->delivery_id) && $user->delivery_id != $delivery_np))) || (old('delivery') && old('delivery') != $delivery_np)) style="display: none" @endif>
        <div class="input-group">
            <input type="text" name="np_recipient" value="{{old('np_recipient')}}" class="form-control" placeholder="Получатель">
        </div>
        <div class="input-group">
            <input type="text" name="np_recipient_phone" value="{{old('np_recipient_phone')}}" class="form-control" placeholder="Телефон получателя">
        </div>
        <div id="nova_poshta_city">
            <div class="input-group">
                <input type="text" id="np_city" name="np_city" value="{{old('np_city')}}" class="form-control" placeholder="Выберите город, населеныый пункт">
                <input type="hidden" id="np_city_ref" name="np_city_ref" value="{{old('np_city_ref')}}">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">&#9660;</span>
                </div>
            </div>
            <ul class="list"></ul>
        </div>
        <div id="nova_poshta_warehouse">
            <div class="input-group">
                <input type="text" id="np_warehouse" name="np_warehouse" value="{{old('np_warehouse')}}" class="form-control" placeholder="select warehouse">
                <input type="hidden" id="np_warehouse_ref" name="np_warehouse_ref" value="{{old('np_warehouse_ref')}}">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">&#9660;</span>
                </div>
            </div>
            <ul class="list"></ul>
        </div>
    </div>
</div>