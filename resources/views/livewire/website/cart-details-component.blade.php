

       @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                   <tr data-id="{{ $id }}">
                         <td class="image product-thumbnail"><img src="{{ asset('assets/website2/assets/imgs/shop/product-1-2.jpg')}}" alt="#"></td>
                        <td class="product-des product-name">
                         <h5 class="product-name"><a href="product-details.html">{{ $details['name'] }}</a></h5>
                        </td>

                        <td class="price" data-title="Price"><span>${{ $details['price'] }} </span></td>
                        <td class="text-center" data-title="Stock">
                <div class="quantity">
                    <span class="form-control form-control-sm border-0 shadow-0 px-2 text-center">
                     {{ $details['quantity'] }}
                    </span>

                </div>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span>${{ $total }} </span>
                                        </td>
                                        <td class="action" data-title="Remove"><a @click="show = false"
                                         wire:click.prevent="RemoveCart({{$cart->id}})"class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                    </tr>
