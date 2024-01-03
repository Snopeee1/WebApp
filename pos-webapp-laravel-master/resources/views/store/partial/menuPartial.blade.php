@php
     $action =  Str::after(Request::route()->getName(), '.'); 
     $active = '';
    $actionList = [
        'dashboard',
        'person',
        'person',
        'address',
        'branch',
        'order',
    ];
    
    if ($action == 'show') {
        $action = 'person';
    }
@endphp

<ul class="uk-subnav uk-subnav-pill" uk-margin>
    @foreach ($actionList as $actionItem)
        @php
            $href = 'store-manager.'.$actionItem;
        @endphp
        <li class="@if($actionItem == $action){{'uk-active'}} @endif"><a href="{{route($href, $data['storeModel']->store_id)}}">{{$actionItem}}</a></li>
        
    @endforeach
</ul>