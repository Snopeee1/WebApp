@php
   use App\Models\Stock;
   use App\Models\User;
   use App\Models\Company;


  $userModel = User::Account('account_id', Auth::user()->user_account_id)->first();

     
  /* $companyList = Company::Contact('company_store_id',$userModel->person_user_id)->get(); */
@endphp

<div class="uk-grid-match uk-grid-small uk-child-width-1-2@xl" uk-grid>
    <div>
        <div class="uk-card uk-card-default uk-padding">
            <h3>GENERAL</h3>
           
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">NON STOCK</label>
                <input name="stock_merchandise[non_stock]" value="0" class="uk-checkbox" type="checkbox" @if ($data['stockModel']->stock_merchandise['non_stock'])checked @endif>
            </div>
        
            
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">{{Str::upper('master_plu')}}</label>
                <select class="uk-select" name="stock_merchandise[stock_plu_id]">
                    <option selected="selected" disabled>SELECT ...</option>
                    @if ($data['settingModel']->setting_stock_group_category_plu)
                        @foreach ($data['settingModel']->setting_stock_group_category_plu as $key => $plu)
                            @if ($plu['type'] == 2)
                                <option value="{{$key}}" @if($key == $data['stockModel']->stock_merchandise['master_plu']) selected @endif>{{$plu['description']}}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">{{Str::upper('case size')}}</label>
                <select class="uk-select" name="stock_merchandise[case_size]">
                    <option selected="selected" disabled>SELECT ...</option>
                    @if ($data['settingModel']->setting_stock_case_size)
                        @foreach ($data['settingModel']->setting_stock_case_size as $key => $stock_case_size)
                            <option value="{{$key}}" @if($key == $data['stockModel']->stock_merchandise['case_size']) selected @endif>{{$stock_case_size['description']}}</option>
                            
                        @endforeach
                    @endif
                </select>
            </div>
        
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">{{Str::upper('recipe link')}}</label>
                <select class="uk-select" name="stock_merchandise[recipe_link]">
                    <option selected="selected" disabled>SELECT ...</option>
                    @if ($data['settingModel']->setting_stock_recipe)
                        @foreach ($data['settingModel']->setting_stock_recipe as $key => $stock_recipe_link)
                            <option value="{{$key}}" @if($key == $data['stockModel']->stock_merchandise['recipe_link']) selected @endif>{{$stock_recipe_link['name']}}</option>
                            
                        @endforeach
                    @endif
                </select>
            </div>
            
            <div class="uk-margin">
                <label class="uk-form-label" for="form-stacked-text">{{Str::upper('set menu')}}</label>
                <select class="uk-select" name="stock_merchandise[set_menu]">
                    <option selected="selected" disabled>SELECT ...</option>
                    @if ($data['settingModel']->setting_stock_set_menu)
                        @foreach ($data['settingModel']->setting_stock_set_menu as $key => $stock_set_menu)
                            <option value="{{$key}}" @if($key == $data['stockModel']->stock_merchandise['set_menu']) selected @endif>{{$stock_set_menu['name']}}</option>
                            
                        @endforeach
                    @endif
                </select>
            </div>
            
            <div>
                @php
                    $exclude = [
                        "non_stock","set_menu","case_size","recipe_link","stock_name","group_id","category_id","brand_id","stock_vat","stock_description","stock_quantity","master_plu"
                    ];
                @endphp
               
               

                @foreach ($data['stockModel']->stock_merchandise as  $key => $stock_merchandise)

                    @if (in_array($key, $exclude) == false)
                        <div class="uk-margin">
                            <label class="uk-form-label" for="form-stacked-text">{{Str::upper($key)}}</label>
                            <input class="uk-input" name="stock_merchandise[{{$key}}]" type="number" value="{{$stock_merchandise}}">
                        </div>
                    @endif
                @endforeach
            </div>
            
        </div>
    </div>
    
    
    <div>
        <div class="uk-card uk-card-default uk-padding">
            @include('stock.partial.supplierPartial')
        </div>
    </div>
    
    <div>
        <div class="uk-card uk-card-default uk-padding">
            @include('stock.partial.transferPartial')
        </div>
    </div>

    

    <div>
        <div class="uk-card uk-card-default uk-padding">
           <h3>STOCK & SHELF EDGE LABELS</h3>
            
           <div class="uk-margin uk-background-muted uk-padding uk-panel">
                <h3>SHELF</h3>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">SHEET SIZE</label>

                    <select id="" class="uk-select" name="label_shelf">
                        <option value="" disabled selected>SELECT ...</option>
                        @foreach ( $data['settingModel']->setting_stock_label['SHELF'] as $key => $shelf_setting_stock_label)
                        
                            <optgroup label="{{Str::upper($key)}}">
                                @foreach ($shelf_setting_stock_label as $stock_label)
                                    
                                    <option>{{ $stock_label}}</option>
                                
                                @endforeach
                            </optgroup>
                            
                        @endforeach
                    </select>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">NUMBER OF LABELS REQUIRED</label>
                    <input class="uk-input" type="number" value="10">
                </div>

                <button class="uk-button uk-button-danger uk-border-rounded uk-width-expand" uk-icon="push"></button>
           </div>


          

           <div class="uk-margin uk-background-muted uk-padding uk-panel">
                <h3>STOCK</h3>
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">SHEET SIZE</label>
                
                    <select id="" class="uk-select" name="label_stock">
                        <option value="" disabled selected>SELECT ...</option>
                        @foreach ( $data['settingModel']->setting_stock_label['STOCK'] as $key => $shelf_setting_stock_label)
                        
                            <optgroup label="{{Str::upper($key)}}">
                                @foreach ($shelf_setting_stock_label as $stock_label)
                                    
                                    <option>{{ $stock_label}}</option>
                                
                                @endforeach
                            </optgroup>
                            
                        @endforeach
                    </select>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-stacked-text">NUMBER OF LABELS REQUIRED</label>
                    <input class="uk-input" type="number" value="10">
                </div>

                <button class="uk-button uk-button-danger uk-border-rounded uk-width-expand" uk-icon="push"></button>
           </div>
        </div>
    </div>

</div>




