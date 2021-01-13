<?php

namespace App\Http\Controllers;

use App\item;
use App\kategori;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\temp;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = kategori::all();
        $items = Cart::content();
        return view('cart/index', [
            'items' => $items,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

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
        return back()->withSuccessMessage('Barang berhasil ditambahkan ke keranjang.');
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
        return redirect('cart')->withSuccessMessage('Barang berhasil ditambahkan ke keranjang.');

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
        return redirect('cart')->withSuccessMessage('Berhasil dihapus dari keranjang!');
    }

    public function emptycart()
    {
        Cart::destroy();
        return redirect('cart')->withSuccessMessage('Keranjang berhasil dikosongkan!');
    }
}
