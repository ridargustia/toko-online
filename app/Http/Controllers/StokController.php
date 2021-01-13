<?php

namespace App\Http\Controllers;

use App\item;
use App\kategori;
use Illuminate\Http\Request;
use App\invoice;
use Auth;
use App\User;
use App\key;
use App\Helpers\Rc4;
use App\temp;

class StokController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        temp::truncate();
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
        
        $count_items = item::count();
        $items = item::all();
        $title = 'Data Barang';
        $count_notif = invoice::where('notif_status', 0)->count();
        
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
                'id_public' => $item->id,
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
        
        return view('admin/produk', [
            'items' => $decryptItems,
            'title' => $title,
            'count_notif' => $count_notif,
            'count_items' => $count_items,
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

        $title = 'Data Barang';
        $kategoris = kategori::all();
        $count_notif = invoice::where('notif_status', 0)->count();
        return view('admin/form_create', [
            'kategoris' => $kategoris,
            'title' => $title,
            'count_notif' => $count_notif,
            'name' => $hasilDecrypt
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:16',
            'harga_pokok' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'kategori' => 'required',
            'stok' => 'required|numeric',
        ], [
            'nama_barang.required' => 'Kolom nama barang harus diisi!',
            'harga_pokok.required' => 'Kolom harga pokok harus diisi!',
            'harga_jual.required' => 'Kolom harga jual harus diisi!',
            'kategori.required' => 'Kolom kategori harus diisi!',
            'stok.required' => 'Kolom stok harus diisi!',
            'stok.numeric' => 'Kolom stok harus berisi angka!',
            'harga_pokok.numeric' => 'Kolom harga pokok harus berisi angka!',
            'harga_jual.numeric' => 'Kolom harga jual harus berisi angka!',
            'nama_barang.max' => 'Kolom nama barang maksimal berisi 16 karakter',
        ]);
        
        //ENKRIPSI RSA
        $n = 187;    //Kunci n
        $e = 7;     //Kunci e
        $teks = array(  //Mengambil plainteks dengan array
            1 => $request->nama_barang,
            2 => $request->harga_pokok,
            3 => $request->harga_jual,
            4 => $request->stok,
            5 => $request->kategori,
        );

        for($i=1; $i<=5; $i++){
            $hasilEncrypt[$i] = "";  //Deklarasi variabel untuk menampung hasil enkripsi
        }
        
        for($j=1; $j<=5; $j++){
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
        for($i=1; $i<=5; $i++){
            $encrypt[$i] = $rc4->encrypt($hasilEncrypt[$i]);    //Memanggil fungsi dari helpers Rc4
            $cipher[$i] = utf8_encode($encrypt[$i]); //Proses colation karakter khusus yang akan dikirim ke database
        }
        // END ENKRIPSI RC4

        if($request->file('gambar') == ""){
            if($request->harga_pokok > $request->harga_jual){
                return redirect('/items')->with('status_gagal', 'Maaf, pada data anda terdapat kesalahan. Harga pokok harus lebih kecil dari harga jual! Silahkan ulangi lagi.');
            }else{
                item::create([
                    'nama_barang' => $cipher[1],
                    'stok' =>$cipher[4],
                    'harga_pokok' => $cipher[2],
                    'harga_jual' => $cipher[3],
                    'kategori' => $cipher[5],
                    'expired' => $request->expired,
                    'gambar' => "default.jpg"
                ]);
                return redirect('/items')->with('status', 'Data barang berhasil ditambahkan.');
            }
            
        }else{

            if($request->harga_pokok > $request->harga_jual){
                return redirect('/items')->with('status_gagal', 'Maaf, pada data anda terdapat kesalahan. Harga pokok harus lebih kecil dari harga jual! Silahkan ulangi lagi.');
            }else{

                $file = $request->file('gambar');
                //mengambil nama file
                $nama_file = time()."_".$file->getClientOriginalName();
                //tujuan upload
                $tujuan_upload = 'gambar_barang';
                $file->move($tujuan_upload, $nama_file);

                item::create([
                    'nama_barang' => $cipher[1],
                    'stok' => $cipher[4],
                    'harga_pokok' => $cipher[2],
                    'harga_jual' => $cipher[3],
                    'kategori' => $cipher[5],
                    'expired' => $request->expired,
                    'gambar' => $nama_file
                ]);
                return redirect('/items')->with('status', 'Data barang berhasil ditambahkan.');   
            }
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(temp $item)
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
        $title = 'Data Barang';
        $count_notif = invoice::where('notif_status', 0)->count();
        return view('admin/form_edit', [
            'item' => $item,
            'kategoris' => $kategoris,
            'title' => $title,
            'count_notif' => $count_notif,
            'name' => $hasilDecrypt
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {
         $request->validate([
            'nama_barang' => 'required',
            'harga_pokok' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'kategori' => 'required',
            'stok' => 'numeric|nullable',
        ], [
            'nama_barang.required' => 'Kolom nama barang harus diisi!',
            'harga_pokok.required' => 'Kolom harga pokok harus diisi!',
            'harga_jual.required' => 'Kolom harga jual harus diisi!',
            'kategori.required' => 'Kolom kategori harus diisi!',
            'stok.numeric' => 'Kolom stok harus berisi angka!',
            'harga_pokok.numeric' => 'Kolom harga pokok harus berisi angka!',
            'harga_jual.numeric' => 'Kolom harga jual harus berisi angka!',
        ]);

        // DEKRIPSI RC4
        $cipherteks = utf8_decode($item->stok);
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
        
        // // DEKRIPSI RSA
        // $keyrsa = key::where('id', 1)->first(); //Mengambil kunci dari database
        // $n = $keyrsa->n;    //Menampung value n dari database
        // $d = base64_decode($keyrsa->d); //simpan ke database setelah generate-key dan dilakukan enkripsi base64
        // $hasilDecryptKey = "";  //Deklarasi variabel untuk menampung hasil dekripsi kunci
        
        // $teks = explode(".",$keyrsa->cipherkey);    //pesan enkripsi dipecah menjadi array dengan batasan "."
        // foreach($teks as $nilai){   //Melakukan foreach pada variabel teks
            
        //     $hasilDecryptKey.= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
        // }
        // // END DEKRIPSI RSA

        // // DEKRIPSI RC4
        // $cipherteksStok = utf8_decode($item->stok);
        // $key = substr($hasilDecryptKey, 0,16);
        // $rc4 	 = new rc4($key);
        // $decryptStok = $rc4->decrypt($cipherteksStok);
        // // END DEKRIPSI RC4

        $stok = $hasilDecrypt + $request->stok;
        $plainteksStok = (string) $stok;

        //ENKRIPSI RSA
        $n = 187;    //Kunci n
        $e = 7;     //Kunci e
        $teks = array(  //Mengambil plainteks dengan array
            1 => $request->nama_barang,
            2 => $request->harga_pokok,
            3 => $request->harga_jual,
            4 => $plainteksStok,
            5 => $request->kategori
        );

        for($i=1; $i<=5; $i++){
            $hasilEncrypt[$i] = "";  //Deklarasi variabel untuk menampung hasil enkripsi
        }
        
        for($j=1; $j<=5; $j++){
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
        for($i=1; $i<=5; $i++){
            $encrypt[$i] = $rc4->encrypt($hasilEncrypt[$i]);    //Memanggil fungsi dari helpers Rc4
            $cipher[$i] = utf8_encode($encrypt[$i]); //Proses colation karakter khusus yang akan dikirim ke database
        }
        // END ENKRIPSI RC4
        
        // // ENKRIPSI RC4
        // $key 	= substr($hasilDecryptKey, 0,16);   //Menampung kunci dari indeks 0 dengan maksimal 16 karakter
        // $rc4 	= new rc4($key);    //Instansiasi objek
        // $enkripNamabarang = $rc4->encrypt($request->nama_barang);    //Pemanggilan fungsi encrypt dari helpers rc4
        // $enkripHargapokok = $rc4->encrypt($request->harga_pokok);    //Pemanggilan fungsi encrypt dari helpers rc4
        // $enkripHargajual = $rc4->encrypt($request->harga_jual);   //Pemanggilan fungsi encrypt dari helpers rc4
        // $enkripKategori = $rc4->encrypt($request->kategori);    //Pemanggilan fungsi encrypt dari helpers rc4
        // $enkripStok = $rc4->encrypt($plainteksStok);   //Pemanggilan fungsi encrypt dari helpers rc4
        // $cipherNamabarang = utf8_encode($enkripNamabarang); //Proses colation karakter khusus yang akan dikirim ke database
        // $cipherHargapokok = utf8_encode($enkripHargapokok); //Proses colation karakter khusus yang akan dikirim ke database
        // $cipherHargajual = utf8_encode($enkripHargajual); //Proses colation karakter khusus yang akan dikirim ke database
        // $cipherKategori = utf8_encode($enkripKategori); //Proses colation karakter khusus yang akan dikirim ke database
        // $cipherStok = utf8_encode($enkripStok); //Proses colation karakter khusus yang akan dikirim ke database
        // // END ENKRIPSI RC4

        // // GENERATE KEY RSA
        // //mencari bilangan random
        // $rand1 = rand(1000,2000);
        // $rand2 = rand(1000,2000);

        // // mencari bilangan prima selanjutnya dari $rand1 &rand2
        // $p = gmp_nextprime($rand1); 
        // $q = gmp_nextprime($rand2);
        
        // //menghitung&menampilkan n=p*q
        // $n = gmp_mul($p,$q);
        // // $n_ = gmp_strval($n);

        // //menghitung&menampilkan totient/phi=(p-1)(q-1)
        // $totient = gmp_mul(gmp_sub($p,1),gmp_sub($q,1));
        // // $totient_ = gmp_strval($totient);

        // //mencari e, dimana e merupakan coprime dari totient
        // //e dikatakan coprime dari totient jika gcd/fpb dari e dan totient/phi = 1
        // for($e=2;$e<100;$e++){  //mencoba perulangan max 100 kali, 
        //     $gcd = gmp_gcd($e, $totient);
        //     if(gmp_strval($gcd)=='1')
        //         break;
        // }

        // //menghitung&menampilkan d
        // $i=1;
        // do{
        //     $res = gmp_div_qr(gmp_add(gmp_mul($totient,$i),1), $e);
        //     // echo '((totient*'.$i.') + 1) / e='.gmp_strval($res[0])." ; sisa= ".gmp_strval($res[1])."\n";
        //     $i++;
        //     if($i==10000) //maksimal percobaan 10000
        //         break;
        // }while(gmp_strval($res[1])!='0');
        // $d=$res[0];
        
        // // END GENERATE KEY RSA

        // //ENKRIPSI RSA
        // $n = gmp_strval($n);    //Menampung value n dari generate key
        // $e = gmp_strval($e);    //Menampung value n dari generate key
        // $d = base64_encode(gmp_strval($d)); //Menampung value n dari generate key dan melakukan enkripsi dengan base64
        // $teks = $hasilDecryptKey;   //Mengambil plainteks kunci rc4
        // $hasilEncryptKey = "";  //Deklarasi variabel untuk menampung hasil enkripsi kunci
        
        // for($i=0;$i<strlen($teks);++$i){    //pesan dikodekan menjadi kode ascii, kemudian di enkripsi per karakter
            
        //     $hasilEncryptKey.=gmp_strval(gmp_mod(gmp_pow(ord($teks[$i]),$e),$n));   //rumus enkripsi <enkripsi>=<pesan>^<e>mod<n>
           
        //     if($i!=strlen($teks)-1){     //antar tiap karakter dipisahkan dengan "."
        //         $hasilEncryptKey.=".";
        //     } 
        // }
        // //END ENKRIPSI RSA

        // key::where('id', 1) //Melakukan update data kunci
        //     ->update([
        //         'cipherkey' => $hasilEncryptKey,
        //         'n' => $n,
        //         'e' => $e,
        //         'd' => $d
        //     ]);
        
         if($request->file('gambar') == ""){
            if($request->harga_pokok > $request->harga_jual){
                return redirect('/items')->with('status_gagal', 'Maaf, pada data anda terdapat kesalahan. Harga pokok harus lebih kecil dari harga jual! Silahkan ulangi lagi.');
            }else{
                item::where('id', $item->id)
                ->update([
                    'nama_barang' => $cipher[1],
                    'stok' => $cipher[4],
                    'harga_pokok' => $cipher[2],
                    'harga_jual' => $cipher[3],
                    'kategori' => $cipher[5],
                    'expired' => $request->expired,
                    'gambar' => $item->gambar
                ]);
                return redirect('/items')->with('status', 'Data barang berhasil tersimpan.');
            }
            
        }else{

            if($request->harga_pokok > $request->harga_jual){
                return redirect('/items')->with('status_gagal', 'Maaf, pada data anda terdapat kesalahan. Harga pokok harus lebih kecil dari harga jual! Silahkan ulangi lagi.');
            }else{

                $file = $request->file('gambar');
                //mengambil nama file
                $nama_file = time()."_".$file->getClientOriginalName();
                //tujuan upload
                $tujuan_upload = 'gambar_barang';
                $file->move($tujuan_upload, $nama_file);

                item::where('id', $item->id)
                ->update([
                    'nama_barang' => $cipher[1],
                    'stok' => $cipher[4],
                    'harga_pokok' => $cipher[2],
                    'harga_jual' => $cipher[3],
                    'kategori' => $cipher[5],
                    'expired' => $request->expired,
                    'gambar' => $nama_file
                ]);
                return redirect('/items')->with('status', 'Data barang berhasil tersimpan.');   
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        item::destroy($item->id);
        return redirect('/items')->with('status', 'Data barang berhasil dihapus.');
    }

    public function hapus_semua_item()
    {
        $cek = item::truncate();
        if ($cek) {
            return redirect('/items')->with('status', 'Semua data barang berhasil dihapus.');
        }else{
            echo "Gagal dihapus";
        }
    }
}
