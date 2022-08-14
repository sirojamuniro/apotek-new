<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carts = Cart::with(['product.galleries', 'user'])->where('users_id', Auth::user()->id)->get();
        $type = [
            ['code'=>'jne',
            'name'=>'Jalur Nugraha Ekakurir (JNE)'    
            ],
            [
            'code'=>'pos',
            'name'=>'POS Indonesia (POS)' 
            ]
            
        ];
        $province =  Http::withHeaders(['key'=>'320a8cc242375f3a230db7950ee0b8ec'])->get('https://api.rajaongkir.com/starter/province');
  
        $check = $province->json();
        $provincesCheck = $check['rajaongkir']['results'];
        $provinces = $provincesCheck;
        // dd($provinces);
        // foreach($provinces as $provincess){
        //     dd($provincess['province_id']);
        // }
        return view('pages.cart',[
            'carts' => $carts,
            'types'=>$type,
            'provinces'=>$provinces
        ]);
    }

    public function delete(Request $request, $id)
    {
        
        $cart = Cart::where('products_id',$id)->first();
        $cart->delete();

        return redirect('cart');
    }

    public function success()
    {
        return view('pages.success');
    }
}
