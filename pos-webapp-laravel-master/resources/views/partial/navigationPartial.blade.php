
@php
    use App\Models\User;
    use App\Models\Store;
    use App\Models\Receipt;
    use App\Helpers\ControllerHelper;

   if (Auth::check()) {
        $userModel = User::Account('account_id', Auth::user()->user_account_id)
        ->first();

        $storeModel = Store::Account('store_id',$userModel->store_id)->first();
        $storeList = Store::List('root_store_id', $storeModel->store_id)
        ->orWhere('store_id', $storeModel->store_id)
        ->get();
   }

   $count = 0;
   $cartList = null;
   $cartAwaitingList = [];

    if (Auth::check()) {
        if (Session::has('user-session-'.Auth::user()->user_id.'.cartList')) {
            $cartList = Session::get('user-session-'.Auth::user()->user_id.'.cartList');
            $count = Receipt::Quantity($cartList);
        }
    }
@endphp





<div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
    <nav class="uk-background-default" uk-navbar style="position: relative; z-index: 980;" >
       
        <div class="uk-navbar-left">           
          
            <div class="uk-navbar-item uk-visible@s">
                <div>
                    {{-- @isset($storeModel)
                        <h3 class="uk-margin-remove-bottom" title="S{{$storeModel->store_id}} : A{{$userModel->person_account_id}}">{{$storeModel->company_name}}</h3>
                        <p class="uk-text-meta uk-margin-remove-top" title="S{{$storeModel->store_id}} : A{{$userModel->person_account_id}}">{{$storeModel->store_name}}</p>
                    @endisset --}}
                    <select name="" id="" class="uk-select">
                        <option value="" selected disabled></option>
                        
                        @isset($storeList)
                            @foreach ($storeList as $store)
                                <option value="" @if($store->store_id == $storeModel->store_id) selected  @endif>{{$store->store_name}} - {{$store->store_id}} - {{$storeModel->store_id}}</option>
                            @endforeach
                        @endisset
                        
                    </select>
                </div>
            </div>
        </div>
        
       <div class="uk-navbar-right uk-margin-right">
            @include('partial.crudPartial')
            

            <div class="uk-navbar-item">
                <div class="uk-button-group">
                    <a class="uk-button uk-button-default uk-border-rounded" href="{{route('home.index')}}">
                        <span  uk-icon="home"></span>
                    </a>
                    <div class="uk-inline">
                        <button class="uk-border-rounded uk-button uk-button-default" type="button">
                            <span uk-icon="icon: cart"></span>
                            <span id="cartCountID" class="uk-label"> {{$count}}</span>
                        </button>
                        
                        <div uk-dropdown="mode: click; boundary: ! .uk-button-group; boundary-align: true;">
                            <ul class="uk-nav uk-dropdown-nav">                       
                               {{--  <li class="uk-nav-header" uk-icon="icon: cart"></li>
                                <li><a class="uk-margin-small uk-button uk-button-default uk-border-rounded" href="{{route('receipt-manager.index')}}">CheckOut</a></li>
                                <li><a class="uk-margin-small uk-button uk-button-default uk-border-rounded" href="{{route('receipt-manager.suspend')}}">Suspend</a></li>
                                <li><a class="uk-margin-small uk-button uk-button-default uk-border-rounded" href="{{route('receipt-manager.awaiting')}}">Awaiting .. </a></li>
                                <li class="uk-nav-header" uk-icon="icon: trash"></li>
                                <li class="uk-nav-divider"></li>
                                <li><a class="uk-margin-small uk-button uk-button-default uk-text-danger uk-border-rounded" href="{{route('receipt-manager.empty')}}">Empty Cart</a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="uk-inline">
                        <button class="uk-border-rounded uk-button uk-button-default" type="button" uk-icon="user"></button>
                        <div uk-dropdown="mode: click">
                            <ul class="uk-nav uk-dropdown-nav">                       
                                 <li class="uk-nav-header" uk-icon="icon: user"></li>
                                 @auth
                                    <li><a class="uk-margin-small uk-button uk-button-default uk-border-rounded" href="{{route('user.show', $userModel->user_id)}}">Profile</a></li>
                                    <li><a class="uk-margin-small uk-button uk-button-default uk-border-rounded" href="{{route('authentication.logout')}}">Logout</a></li>
                                 @endauth
                                 <li><a class="uk-margin-small uk-button uk-button-default uk-border-rounded" href="{{route('authentication.login')}}">Login</a></li>
                                 <li><a class="uk-margin-small uk-button uk-button-default uk-border-rounded" href="{{route('authentication.register')}}">Register</a></li>
                             </ul>
                        </div>
                    </div>
                </div>
            </div>

            
           
            
        </div>
      
    </nav>
</div>



