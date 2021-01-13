<?php

namespace App\Http\Controllers;

use App\item;
use App\kategori;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\key;
use Auth;
use App\Helpers\Rc4;
use App\temp;

class CartMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        
        // DEKRIPSI RC4
        $cipherteks = utf8_decode($user->name);
        $key = substr(1824, 0,16);
        $rc4 	 = new rc4($key);
        $decrypt = $rc4->decrypt($cipherteks);
        // END DEKRIPSI RC4
        
        // DEKRIPSI RSA
        $n = 187;
        $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
        $hasilDecrypt = "";
        //pesan enkripsi dipecah menjadi array dengan batasan "."
        $teks = explode(".",$decrypt);
        foreach($teks as $nilai){
            //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            $hasilDecrypt.= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n)));
        }
        // END DEKRIPSI RSA

        $kategoris = kategori::all();
        $items = Cart::content();
        return view('cart/member', [
            'items' => $items,
            'kategoris' => $kategoris,
            'title' => "Cart",
            'name' => $hasilDecrypt
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart = temp::find($id);
        Cart::add($id, $cart->nama_barang, 1, $cart->harga_jual);
        return back()->withSuccessMessage('Barang berhasil ditambahkan ke keranjang. Silahkan periksa keranjang anda dengan menekan logo keranjang dibagian atas halaman ini.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cart = temp::find($id);
        Cart::add($id, $cart->nama_barang, 1, $cart->harga_jual);
        return redirect('cartmember')->withSuccessMessage('Barang berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::update($id, $request->qty);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect('cartmember')->withSuccessMessage('Berhasil dihapus dari keranjang!');
    }

    public function emptycartmember()
    {
        Cart::destroy();
        return redirect('cartmember')->withSuccessMessage('Keranjang berhasil dikosongkan!');
    }
}
