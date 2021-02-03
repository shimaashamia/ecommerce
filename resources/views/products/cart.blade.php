@extends("layouts.tamkeen-home")

@section("title","الصفحة الرئيسية")

@section("css")

<!-- Google fonts - Roboto-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">

<!-- theme stylesheet-->
<link rel="stylesheet" href="{{asset('universal-theme/css/style.default.css')}}" id="theme-stylesheet">
<style>
.text-muted.lead {
    margin-bottom: 20px;

}


.row {
    margin-right: 10px;
    margin-left: 10px;

}

</style>
@endsection


@section("content")


<div class="row bar mt-5">
    <div class="col-lg-9">
        <p class="text-muted lead text-right">لديك 3 قطع في سلتك</p>
        <div class="box mt-0 pb-0 no-horizontal-padding">
            <form method="get" action="shop-checkout1.html">
                <div class="table-responsive">
                <?php
$cartItems = json_decode(request()->cookie('cart'),true)??[];

                ?>
                    <?php $total = 0 ?>
                    @if(count($cartItems))
                    <table class="table text-right"  >
                        <thead>
                            <tr>
                                <th colspan="2">المنتج</th>
                                <th>الكمية</th>
                                <th>سعر الوحدة</th>
                                <th colspan="2">المجموع</th>
                            </tr>
                        </thead>
                            @foreach($cartItems as $productId=>$quantity)
                            <?php $product = \App\Models\Product::find($productId);
                                $price = $product->sale_price??$product->regular_price;
                                $total+=$price *$quantity;
                            ?>
                            <tr>
                                <td><a href="{{route('product.details',$product->slug) }}"><img src='{{asset("storage/assets/img/{$product->main_image}")}}' alt="White Blouse Armani"
                                            class="img-fluid"></a></td>
                                <td><a href="{{route('product.details',$product->slug) }}">{{$product->title}}</a></td>
                                <td>
                                    <input type="number" value="{{$quantity}}" class="form-control">
                                </td>
                                <td>${{$price}}</td>
                                <td>${{$price*$quantity}}</td>
                                <td><a href="{{route('remove-from-cart',$productId)}}" onclick='return confirm("هل أنت متأكد؟")'><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                            @endforeach                        
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-center">المجموع</th>
                                <th colspan="2">${{$total}}</th>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <div class='alert alert-warning'> لا يوجد منتجات في السلة</div>
                    @endif
                </div>
                <div class="box-footer d-flex justify-content-between align-items-center">
                    
                    <div class="left-col">
                        <button class="btn btn-secondary"><i class="fa fa-refresh"></i> حدث السلة</button>
                        <button type="submit" class="btn btn-template-outlined">شراء <i
                                class="fa fa-chevron-right"></i></button>
                    </div>
                    <div class="right-col"><a href="shop-category.html" class="btn btn-secondary mt-0"><i
                                class="fa fa-chevron-left"></i> اكمل التسوق</a></div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-3 mt-5">
        <div id="order-summary" class="box mt-0 mb-4 p-0">
            <div class="box-header mt-0 text-right">
                <h3>الطلبات</h3>
            </div>
            <p class="text-muted text-right">تم حساب تكاليف الشحن بناءا على القيم التي ادخلتها</p>
            <div class="table-responsive">
                <table class="table text-right">
                    <tbody>
                        <tr>
                            <td>مجموع الطلبات</td>
                            <th>${{$total}}</th>
                        </tr>
                        <tr>
                            <td>الضريبة</td>
                            <th>$0.00</th>
                        </tr>
                        <tr class="total">
                            <td>المجموع</td>
                            <th>${{$total}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>



</div>




@endsection