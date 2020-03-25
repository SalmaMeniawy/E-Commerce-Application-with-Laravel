<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
@if(auth()->user()->role == 'buyer')
<li class="nav-item"><a class="nav-link" href="{{ url('homepage') }}"><i class="fa fa-dashboard nav-icon"></i>Homepage</a></li>
<li class="nav-item">
<a class="nav-link"  href="{{url('shoppingCart')}}" class="btn btn-light">
<i class="fa fa-shopping-basket"></i>Shopping Cart <span class="badge badge-light">{{Facades\App\ShoppingCart::get_items_count_in_shopping_cart()}}</span>
</a>
</li>
<li class="nav-item">
<a class="nav-link"  href="{{url('buyerCoupon')}}" class="btn btn-light">
<i class="fa fa-ticket" ></i> My Coupon <span class="badge badge-light"></span>
</a>
</li>
<li class="nav-item">
<a class="nav-link"  href="{{url('orders')}}" class="btn btn-light">
<i class="fa fa-truck" ></i> My Orders <span class="badge badge-light"></span>
</a>
</li>
<li class="nav-item"> <a class="nav-link" 
	href="{{ url('buyer/logout') }}">
	<i  class="fa fa-sign-out"></i>
	Logout</a></li>
@endif
@if(auth()->user()->role == 'admin')
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"> <a class="nav-link" 
	href="{{ url('stores') }}">
	Stores</a></li>
<li class="nav-item"> <a class="nav-link" 
href="{{ url('brands') }}">
Brands</a></li>
<li class="nav-item"> <a class="nav-link" 
href="{{ url('buyerCategories') }}">
Buyer Categories</a></li>
<li class="nav-item"> <a class="nav-link" 
href="{{ url('coupons') }}">
Coupons</a></li>
<li class="nav-item"> <a class="nav-link" 
href="{{ url('categories') }}">
Categories</a></li>
<li class="nav-item"><a class="nav-link" 
href="{{ url('admin/logout') }}">
Logout</a></li>
@endif
@if(auth()->user()->role == 'seller')
<li class="nav-item"> <a class="nav-link" 
href="{{ url('home/seller') }}"><i class="fa fa-home"></i>
homepage</a></li>
<li class="nav-item">
<a class="nav-link"  href="" class="btn btn-light">
<i class="fa fa-truck"></i>Orders <span class="badge badge-light">{{Facades\App\Seller::get_count_of_pending_products_in_the_orders()}}</span>
</a>
</li>
<li class="nav-item"> <a class="nav-link" 
href="{{ url('products') }}"><i class="fa fa-gift"></i>
Products</a></li>
<li class="nav-item"><a class="nav-link" 
href="{{ url('seller/logout') }}"><i class="fa fa-sign-out"></i>
Logout</a></li>

@endif


