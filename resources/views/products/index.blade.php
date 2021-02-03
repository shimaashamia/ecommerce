@extends("layouts.tamkeen-home")

@section("title","الصفحة الرئيسية")

@section("css")

<!-- theme stylesheet-->
<link rel="stylesheet" href="{{asset('tamkeen-proj/css/style.default.css')}}" id="theme-stylesheet">
<!--linear icon css-->
<link rel="stylesheet" href="{{asset('tamkeen-proj/assets/css/linearicons.css')}}">
@endsection

@section('content')

<div id="all">

    <!-- page content start -->
    <div id="contentpt-5">

        <div class="container pt-5">
            <div class=" text-center pt-3">
                <h1 class="pt-5">منتجاتنا</h1>
            </div>

            <div class="row bar">
                <div class="col-md-3 aside-left-line">
                    <!-- MENUS AND FILTERS-->
                    <div class="panel panel-default sidebar-menu ">
                        <div class="panel-heading text-center">
                            <h3 class="h4 panel-title">التصنيفات</h3>
                        </div>
                        <form>
                            <div class="panel-body">
                                <ul class="nav nav-pills flex-column text-sm category-menu">
                                    @foreach($categories as $category)
                                    <li class="nav-item ">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <input type="checkbox" id="category_{{$category->id}}" name="category[]"
                                                value="{{$category->id}}" {{in_array($category->id,request()->get("category")??[])?"checked":""}}>


                                            <label for="category_{{$category->id}}" class="w-100">
                                                <a href="{{asset('products?category[]='.$category->id)}}"
                                                    class="nav-link d-flex align-items-center justify-content-between"><span>{{$category->name}}</span><span
                                                        class="badge badge-secondary">{{$category->products()->count()}}</span>
                                                </a>
                                            </label>

                                        </div>

                                    </li>


                                    @endforeach
                                    <li class="pt-3 mt-2 search-top-line">
                                        <div class="row">
                                            <div class="col-9 m-0 pl-1">
                                                <input name='q' id='q' value='{{request()->q}}' autofocus type="text"
                                                    class='form-control' placeholder="ابحث عن منتج..." />
                                            </div>
                                            <div class="col-1 p-0 m-0">
                                                <button type="submit" class="btn btn-primary brd-small-search">
                                                    <i class="fa fa-search" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </li>
                                </ul>


                            </div>
                        </form>

                    </div>


                </div>
                <div class="col-md-9">
                    @if($products->count()>0)
                    <div class="new-arrivals-content">
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="single-new-arrival">
                                    <a href="{{route('product.details',$product->slug) }}">
                                        <div class="single-new-arrival-bg">

                                            <img src='{{asset("storage/assets/img/{$product->main_image}")}}'
                                                alt="new-arrivals images">


                                            <div class="single-new-arrival-bg-overlay"></div>
                                            @if($product->sale_price != '')
                                            <div class="sale bg-2">
                                                <p>!SALE</p>
                                            </div>
                                            @endif

                                            <div class="new-arrival-cart">
                                                <p>
                                                    <span class="lnr lnr-cart"></span>
                                                    <a href="{{route('add-to-cart',$product->id)}}">اضافة الى سلة المشتريات</a>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <h4><a href="{{ route('product.details',$product->slug) }}">{{$product->title}}</a>
                                    </h4>
                                    @if($product->sale_price == '')
                                    <p class="arrival-product-price">{{$product->regular_price}}$</p>
                                    @else
                                    <p class="arrival-product-price "><span
                                            class="sale_price_color">{{$product->sale_price}}$</span> <span
                                            class="text-line-through">{{$product->regular_price}}$</span> </p>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="pages text-center">

                        {{ $products->links() }}
                    </div>
                    @else
                    <div class='alert alert-info alert-dismissible fade show'>
                        <div><b>نأسف!</b> لا يوجد نتائج للعرض</div>

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- page content end -->


</div>
@endsection