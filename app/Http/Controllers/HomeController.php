<?php

namespace App\Http\Controllers;

use App\item;
use App\kategori;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\key;
use App\Helpers\Rc4;
use App\temp;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        temp::truncate();
        $items = DB::select('select * from items order by id desc limit 8');
        $kategoris = kategori::all();
        $carts = Cart::content();

        foreach($items as $item){
            // DEKRIPSI RC4
            $key = substr(1824, 0,16);
            $rc4 	 = new rc4($key);

            $cipherteks1 = utf8_decode($item->nama_barang); //Proses colation untuk karakter khusus dari database
            $cipherteks2 = utf8_decode($item->harga_pokok); //Proses colation untuk karakter khusus dari database
            $cipherteks3 = utf8_decode($item->harga_jual); //Proses colation untuk karakter khusus dari database
            $cipherteks4 = utf8_decode($item->stok); //Proses colation untuk karakter khusus dari database
            $cipherteks5 = utf8_decode($item->kategori); //Proses colation untuk karakter khusus dari database

            $decrypt1 = $rc4->decrypt($cipherteks1);
            $decrypt2 = $rc4->decrypt($cipherteks2);
            $decrypt3 = $rc4->decrypt($cipherteks3);
            $decrypt4 = $rc4->decrypt($cipherteks4);
            $decrypt5 = $rc4->decrypt($cipherteks5);
            // END DEKRIPSI RC4
            
            // DEKRIPSI RSA
            $cipherRsa = array(
                1 => $decrypt1,
                2 => $decrypt2,
                3 => $decrypt3,
                4 => $decrypt4,
                5 => $decrypt5,
            );

            $n = 187;    //Menampung value n
            $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
            $hasilDecrypt1 = "";
            $hasilDecrypt2 = "";
            $hasilDecrypt3 = "";
            $hasilDecrypt4 = "";
            $hasilDecrypt5 = "";

            $teks1 = explode(".",$cipherRsa[1]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks2 = explode(".",$cipherRsa[2]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks3 = explode(".",$cipherRsa[3]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks4 = explode(".",$cipherRsa[4]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks5 = explode(".",$cipherRsa[5]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
                
            foreach($teks1 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt1 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            foreach($teks2 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt2 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            foreach($teks3 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt3 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            foreach($teks4 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt4 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            foreach($teks5 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt5 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            // END DEKRIPSI RSA

            temp::create([
                'nama_barang' => $hasilDecrypt1,
                'harga_pokok' => $hasilDecrypt2,
                'harga_jual' => $hasilDecrypt3,
                'stok' => $hasilDecrypt4,
                'kategori' => $hasilDecrypt5,
                'penjualan' => $item->penjualan,
                'gambar' => $item->gambar,
                'expired' => $item->expired
            ]);
        }

        $decryptItems = temp::all();

        return view('index', [
            'items' => $decryptItems,
            'kategoris' => $kategoris,
            'carts' => $carts
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
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(temp $item)
    {
        $kategoris = kategori::all();
        return view('detail', [
            'item' => $item,
            'kategoris' => $kategoris
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        //
    }

    public function kategori(kategori $kategori)
    {
        temp::truncate();

        //ENKRIPSI RSA
        $n = 187;    //Kunci n
        $e = 7;     //Kunci e
        $teks = array(  //Mengambil plainteks dengan array
            1 => $kategori->nama_kategori,
        );

        for($i=1; $i<2; $i++){
            $hasilEncrypt[$i] = "";  //Deklarasi variabel untuk menampung hasil enkripsi
        }
        
        for($j=1; $j<2; $j++){
            for($i=0;$i<strlen($teks[$j]);++$i){    //pesan dikodekan menjadi kode ascii, kemudian di enkripsi per karakter
                
                $hasilEncrypt[$j].=gmp_strval(gmp_mod(gmp_pow(ord(($teks[$j])[$i]),$e),$n));   //rumus enkripsi <enkripsi>=<pesan>^<e>mod<n>
            
                if($i!=strlen($teks[$j])-1){     //antar tiap karakter dipisahkan dengan "."
                    $hasilEncrypt[$j].=".";
                } 
            }
        }
        //END ENKRIPSI RSA
        
        // ENKRIPSI RC4
        $key 	= substr(1824, 0,16);   //Menampung kunci RC4 maksimal 16 karakter dimulai dari indeks 0
        $rc4 	= new rc4($key);    //Instansiasi objek
        for($i=1; $i<2; $i++){
            $encrypt[$i] = $rc4->encrypt($hasilEncrypt[$i]);    //Memanggil fungsi dari helpers Rc4
            $cipher[$i] = utf8_encode($encrypt[$i]); //Proses colation karakter khusus yang akan dikirim ke database
        }
        // END ENKRIPSI RC4

        $items = item::where('kategori', $cipher[1])->get();
        $kategoris = kategori::all();
        $carts = Cart::content();

        foreach($items as $item){
            // DEKRIPSI RC4
            $key = substr(1824, 0,16);
            $rc4 	 = new rc4($key);

            $cipherteks1 = utf8_decode($item->nama_barang); //Proses colation untuk karakter khusus dari database
            $cipherteks2 = utf8_decode($item->harga_pokok); //Proses colation untuk karakter khusus dari database
            $cipherteks3 = utf8_decode($item->harga_jual); //Proses colation untuk karakter khusus dari database
            $cipherteks4 = utf8_decode($item->stok); //Proses colation untuk karakter khusus dari database
            $cipherteks5 = utf8_decode($item->kategori); //Proses colation untuk karakter khusus dari database

            $decrypt1 = $rc4->decrypt($cipherteks1);
            $decrypt2 = $rc4->decrypt($cipherteks2);
            $decrypt3 = $rc4->decrypt($cipherteks3);
            $decrypt4 = $rc4->decrypt($cipherteks4);
            $decrypt5 = $rc4->decrypt($cipherteks5);
            // END DEKRIPSI RC4
            
            // DEKRIPSI RSA
            $cipherRsa = array(
                1 => $decrypt1,
                2 => $decrypt2,
                3 => $decrypt3,
                4 => $decrypt4,
                5 => $decrypt5,
            );

            $n = 187;    //Menampung value n
            $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
            $hasilDecrypt1 = "";
            $hasilDecrypt2 = "";
            $hasilDecrypt3 = "";
            $hasilDecrypt4 = "";
            $hasilDecrypt5 = "";

            $teks1 = explode(".",$cipherRsa[1]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks2 = explode(".",$cipherRsa[2]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks3 = explode(".",$cipherRsa[3]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks4 = explode(".",$cipherRsa[4]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks5 = explode(".",$cipherRsa[5]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
                
            foreach($teks1 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt1 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            foreach($teks2 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt2 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            foreach($teks3 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt3 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            foreach($teks4 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt4 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            foreach($teks5 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt5 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            // END DEKRIPSI RSA

            temp::create([
                'nama_barang' => $hasilDecrypt1,
                'harga_pokok' => $hasilDecrypt2,
                'harga_jual' => $hasilDecrypt3,
                'stok' => $hasilDecrypt4,
                'kategori' => $hasilDecrypt5,
                'penjualan' => $item->penjualan,
                'gambar' => $item->gambar,
                'expired' => $item->expired
            ]);
        }

        $decryptItems = temp::all();

        return view('kategoris', [
            'items' => $decryptItems,
            'kategoris' => $kategoris,
            'categories' => $kategori,
            'carts' => $carts
        ]);
        
    }
}
