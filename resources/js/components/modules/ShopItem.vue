<template>
    <transition name="el-zoom-in-top">
        <div class="content-wrapper">
                                            <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Shop Item Page<small><i class="ti-heart"></i><i class="ti-export"></i><i class="ti-printer"></i></small></h1>
            <ol class="breadcrumb">
                <li><router-link to="/"> <i class="ti-home"></i></router-link></li>
                <li><a href="#">Apps</a></li>
                <li class="active">Shop Item</li>
            </ol>
        </section>
            <!-- Main content -->
            <section class="content">
                <div class="box" style="padding:30px;">
                    <div class="heading-cart cf">
    <h1>My Cart</h1>
    <a href="#">Continue Shopping</a>
  </div>
    <ul class="cart-items width-100 pull-left pl-60 pr-30 pb-0 pt-0 container-fluid">
			                <li class="cart-items-labels visible-lg-block visible-md-block row"> 
			                    <span class="col-md-6 text-muted small">product</span>
			                    <span class="col-md-2 text-muted small text-center">quantity</span> 
			                    <span class="col-md-4 text-muted small text-right">price</span>
			                </li>
			                <li class="row">
			                    <span class="cart-image col-xs-12 col-sm-12 col-md-2">
			                        <a href="#"><img alt="product description" src="http://thymetheme.pl/vega/v102/assets/img/products/product-03.jpg"></a>
			                    </span>

			                    <div class="cart-item-right col-md-10 col-xs-12 col-sm-12">
			                    	<div class="row">
			                            <span class="cart-description col-xs-12 col-md-5">
			                                <a class="h5" href="#">Product name</a>				   
			                                <span class="cart-item-price h5 text-muted">$ 33.00</span>
			                            </span>

										<span class="col-md-2 col-sm-12">
											<input class="text-center form-control" type="text" value="10">
										</span>

			                            <span class="col-md-5 col-sm-12 text-right">
			                                <span class="cart-price pull-right">$330.00 <a class="cart-remove" href="#">
			                                <span class="ti-trash icon pull-right mt-5 ml-10"></span>
			                                </a></span>
			                               
			                            </span>
			                        </div>
			                    </div>
			                </li>
			                <li class="row">
			                    <span class="cart-image col-xs-12 col-sm-12 col-md-2">
			                        <a href="#"><img alt="product description" src="http://thymetheme.pl/vega/v102/assets/img/products/product-03.jpg"></a>
			                    </span>

			                    <div class="cart-item-right col-md-10 col-xs-12 col-sm-12">
			                    	<div class="row">
			                            <span class="cart-description col-xs-12 col-md-5">
			                                <a class="h5" href="#">Product name</a>                               
			                                <span class="cart-item-price h5 text-muted">$ 33.00</span>
			                            </span>

										<span class="col-md-2 col-sm-12">
											<input class="text-center form-control" type="text" value="10">
										</span>

			                            <span class="col-md-5 col-sm-12 text-right">
			                                <span class="cart-price pull-right">$330.00 <a class="cart-remove" href="#">
			                                <span class="ti-trash icon pull-right mt-5 ml-10"></span>
			                                </a></span>
			                               
			                            </span>
			                        </div>
			                    </div>
			                </li>
			                <li class="row">
			                    <span class="cart-image col-xs-12 col-sm-12 col-md-2">
			                        <a href="#"><img alt="product description" src="http://thymetheme.pl/vega/v102/assets/img/products/product-03.jpg"></a>
			                    </span>

			                    <div class="cart-item-right col-md-10 col-xs-12 col-sm-12">
			                    	<div class="row">
			                            <span class="cart-description col-xs-12 col-md-5">
			                                <a class="h5" href="#">Product name</a>                               
			                                <span class="cart-item-price h5 text-muted">$ 33.00</span>
			                            </span>

										<span class="col-md-2 col-sm-12">
											<input class="text-center form-control" type="text" value="10">
										</span>

			                            <span class="col-md-5 col-sm-12 text-right">
			                                <span class="cart-price pull-right">$330.00 <a class="cart-remove" href="#">
			                                <span class="ti-trash icon pull-right mt-5 ml-10"></span>
			                                </a></span>
			                            </span>
			                        </div>
			                    </div>
			                </li>
			            </ul>
                    
              
                    <div class="width-100 pr-45 checkout-devin">
                        <ul>
      <li class="totalRow"><span class="label">Subtotal</span><span class="value">$35.00</span></li>
      
          <li class="totalRow"><span class="label">Shipping</span><span class="value">$5.00</span></li>
      
            <li class="totalRow"><span class="label">Tax</span><span class="value">$4.00</span></li>
            <li class="totalRow final"><span class="label">Total</span><span class="value">$44.00</span></li>
      <li class="totalRow"><a href="#">Checkout</a></li>
    </ul>
    
    </div>
                    <div style="clear:both"></div>
                    <di
                </div>
            </section>
            <!-- /.content -->
        </div>
    </transition>
</template>
<script>
  export default {
    name: 'ShopItem'
  }
</script>
