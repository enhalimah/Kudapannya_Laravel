<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return view('pages/product')->with('product', $product);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $products = Product::where('nama_product', 'LIKE', '%' . $searchTerm . '%')->get();

        return view('pages/products_index', compact('products'));
    }



    //ADMIN
    public function productadmin()
    {
        $product = Product::all();
        return view('pagesadmin.productadmin')->with('product', $product);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('pagesadmin.updateproduct')->with('product', $product);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->nama_product = $request->nama_product;
        $product->harga_product = $request->harga_product;
        $product->stok = $request->stok;
        $product->desc_product = $request->desc_product;

        if ($request->hasFile('gambar_product')) {
            $destination = 'images/';
            $file = $request->file('gambar_product');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
        
            $oldImagePath = public_path($product->gambar_product);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        
            $file->move(public_path($destination), $filename);
            $product->gambar_product = $destination . $filename;
        }
        $product->update();
    
        return redirect('/productadmin')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $products = Product::find($product->id_product);
        $products->delete();

        return redirect('/productadmin');
    }

    public function add(){
        return view('pagesadmin.addproduct');
    }

    public function add_process(Request $request){
        
        $product = new Product;
        $product->nama_product = $request->input('nama_product');
        $product->harga_product = $request->input('harga_product');
        $product->stok = $request->input('stok');
        $product->desc_product = $request->input('desc_product');
        if($request->hasFile('gambar_product')){
            $destination = 'images/';
            $file = $request->file('gambar_product');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move(public_path($destination), $filename);
            $product->gambar_product = $destination . $filename;
        }
        $product->save();
        return redirect('/productadmin')->with('success-add', 'Product Added Successfully');
    }


    //CART
    public function addcart(Request $request, $id_product) {
        $user = auth()->user();
    
        if ($user) {
            $product = Product::find($id_product);
    
            if ($product) {
                // Cek apakah item cart dengan nama produk yang sama dan user yang sama sudah ada
                $existingCart = Cart::where('name', $user->name)
                    ->where('nama_product', $product->nama_product)
                    ->first();
    
                // Periksa apakah stok mencukupi
                if ($existingCart && ($existingCart->quantity + $request->quantity) > $product->stok) {
                    return redirect()->back()->with('error', '!!! Product quantity exceeds available stock !!!');
                }
    
                if ($existingCart) {
                    // Update quantity jika sudah ada
                    $existingCart->quantity += $request->quantity;
                    $existingCart->save();
                } else {
                    // Periksa apakah stok mencukupi sebelum menambahkan item baru
                    if ($request->quantity > $product->stok) {
                        return redirect()->back()->with('error', '!!! Product quantity exceeds available stock !!!');
                    }
    
                    // Buat item cart baru jika belum ada
                    $cart = new Cart;
    
                    $cart->name = $user->name;
                    $cart->phone = $user->phone;
                    $cart->address = $user->address;
                    $cart->nama_product = $product->nama_product;
                    $cart->harga = $product->harga_product;
                    $cart->quantity = $request->quantity;
                    $cart->save();
                }
    
                return redirect()->back()->with('message', 'Product Added Successfully');
            } else {
                return redirect()->back()->with('error', 'Product not found');
            }
        } else {
            return redirect('/profile');
        }
    }    
    
    public function cart()
    {
        $user = auth()->user();
    
        if ($user) {
            $cartItems = Cart::where('name', $user->name)
                ->with('product')
                ->get();
    
            // Menggabungkan item cart berdasarkan nama_product dan menjumlahkan quantity dan total price
            $cartSummary = $cartItems->groupBy('nama_product')->map(function ($group) {
                $firstItem = $group->first();
    
                return [
                    'cart' => $firstItem, // Simpan seluruh item cart
                    'quantity' => $group->sum('quantity'),
                    'total' => $group->sum(function ($item) {
                        return $item->quantity * $item->harga;
                    }),
                    'image_url' => $firstItem->product->gambar_product,
                ];
            });
    
            // Menghitung total quantity dan total price dari semua item dalam keranjang
            $totalQuantity = $cartSummary->sum('quantity');
            $totalPrice = $cartSummary->sum('total');
    
            return view('pages.cart')->with([
                'cartItems' => $cartSummary,
                'totalQuantity' => $totalQuantity,
                'totalPrice' => $totalPrice,
            ]);
        } else {
            return redirect('/profile');
        }
    }
    

    public function removecart($nama_product)
    {
        $cart = Cart::where('nama_product', $nama_product)->first();
        
        if (!$cart) {
            return redirect()->back()->with('error', 'Product not found in the cart.');
        }
    
        $cart->delete();
        return redirect()->back()->with('removesuccess', 'Product removed from the cart.');
    }
}