<?php


namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Order_info;
use Illuminate\Http\Request;
use App\Models\Order_product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $products = Product::all();
        return view('products', compact('products'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cart()
    {
        return view('website.cart');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id"  =>$product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }



    function purchase(){

        if(session('cart')) {
            return view('website.check-out');
        }else {

            return redirect()->back()->with('danger', 'your cart is empty');
        }

    }


    function checkout(Request $request){

        $total=0;
        //get cart
        $carts = session()->get('cart', []);
        // create order
        $order=Order::create([
         'user_id'=>Auth::user()->id,      // function to get user id
        ]);


        //store product cart in database
        foreach($carts as $cart){

            $total += $cart['price'] * $cart['quantity'];

        Order_product::create([
            'order_id' =>$order->id,
            'product_id'=>$cart['id'],
            'quantity'=>$cart['quantity'],
        ]);
    }
        // store phone and adress order in order info
                  //stor total price in order table
        $order->total= $total;
        $order->save();

        Order_info::create([
            'order_id'=>$order->id,
            'address'=>$request->adress,
            'phone'=>$request->phone,
        ]);

        // destroy session cart
        Session::forget('cart');

        return redirect('/')->with('success', 'Your Order Sent successfully!');

    }


    public function search(Request $request){
        $search = $request->search;

        $products = Product::where('name', 'like', "%".$search."%")->limit(9)->orderBy('created_at', 'desc')->get();

        return view('website.search', compact('products', 'search'));
    }


    public function searchcat(Request $request){
        $search = $request->search;

        $products = Product::where('cat_name', 'like', "%".$search."%")->limit(9)->orderBy('created_at', 'desc')->get();

        return view('website.search', compact('products', 'search'));
    }

    public function searchsub(Request $request){
        $search = $request->search;

        $products = Product::where('sup_name', 'like', "%".$search."%")->limit(9)->orderBy('created_at', 'desc')->get();

        return view('website.search', compact('products', 'search'));
    }

    public function getcategory($id){
        $products = Product::where('category_id',$id)->limit(9)->orderBy('created_at', 'desc')->get();
        return view('website.getpc', compact('products'));
    }
}
