<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckOutController extends Controller
{
    public function index(Request $request)
    {
        $selectedProductNames = json_decode($request->input('selectedProducts'));
        $selectedProducts = Cart::whereIn('id', $selectedProductNames)->get();
        return view('pages.checkout', ['selectedProducts' => $selectedProducts]);
    }
    /**
     * Menangani proses checkout.
     */
    public function processCheckout(Request $request)
    {
        $checkout = new Checkout();
        $checkout->name = $request->input('name');
        $checkout->email = $request->input('email');
        $checkout->address = $request->input('address');
        $checkout->city = $request->input('city');
        $checkout->zip = $request->input('zip');
        $checkout->cardname = $request->input('cardname');
        $checkout->cardnumber = $request->input('cardnumber');
        $checkout->expmonth = $request->input('expmonth');
        $checkout->expyear = $request->input('expyear');
        $checkout->cvv = $request->input('cvv');
        $checkout->save();

        $orderedProducts = $request->input('orderedProducts');
        try {
            \DB::beginTransaction();

            $selectedProductNames = array_keys($orderedProducts);
            Cart::whereIn('id', $selectedProductNames)->delete();
    
            \DB::commit();
    
            return redirect('/homepage')->with('successpayment', 'Checkout berhasil!');
        } catch (\Exception $e) {
            \DB::rollback();
    
            return redirect('/cart')->with('checkouterror', 'Terjadi kesalahan saat checkout. Silakan coba lagi.');
        }
    }
}
