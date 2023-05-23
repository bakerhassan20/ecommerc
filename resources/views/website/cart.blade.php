@extends('website.layout')

@section('title')
    Cart
@endsection

@section('name')
    Cart
@endsection

@section('content')



  <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>



       @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                   <tr data-id="{{ $id }}">
                         <td class="image product-thumbnail"><img src="{{ asset('Product_image/'. $details['image'] ) }}" alt="#"></td>
                        <td class="product-des product-name">
                         <h5 class="product-name"><a href="#">{{ $details['name'] }}</a></h5>
                        </td>

                        <td class="price" data-title="Price"><span>${{ $details['price'] }} </span></td>
                        <td class="text-center" data-title="Stock">
                <div class="">
                      <input style=" width: 70px !important;
  height: 30px !important;" type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                </div>


                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span>${{ $details['price'] * $details['quantity'] }} </span>
                                        </td>
                                        <td class="action" data-title="Remove"><a class="remove-from-cart text-muted"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
                        @endforeach
                  @endif
                                        <td colspan="6" class="text-end">
                                            <a href="#" class="text-muted"> <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-action text-end">

                            <a class="btn" href="{{ route('home') }}"><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                      <div class="row mb-50">

 <div class="col-lg-6 col-md-6">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">${{$total}}</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

     <a href="{{route('purchase')}}" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
                 </div>
            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>




@endsection




@section('scripts')
<script type="text/javascript">

    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

</script>
@endsection









