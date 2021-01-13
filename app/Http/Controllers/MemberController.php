<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategori;
use App\item;
use App\order;
use App\invoice;
use App\User;
use App\key;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use App\Helpers\Rc4;
use App\temp;

class MemberController extends Controller
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
	
    public function index()
    {
        $user = Auth::user();
        temp::truncate();

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
        
        $title = 'Dashboard';
        $items = DB::select('select * from items order by id desc limit 8');
        $kategoris = kategori::all();

        foreach($items as $item){

            // DEKRIPSI RC4
            $key = substr(1824, 0,16);
            $rc4 	 = new rc4($key);

            $plainteks1 = $item->nama_barang;
            $plainteks2 = $item->harga_pokok;
            $plainteks3 = $item->harga_jual;
            $plainteks4 = $item->stok;
            $plainteks5 = $item->kategori;
                
            $cipherteks1 = utf8_decode($plainteks1); //Proses colation untuk karakter khusus dari database
            $cipherteks2 = utf8_decode($plainteks2); //Proses colation untuk karakter khusus dari database
            $cipherteks3 = utf8_decode($plainteks3); //Proses colation untuk karakter khusus dari database
            $cipherteks4 = utf8_decode($plainteks4); //Proses colation untuk karakter khusus dari database
            $cipherteks5 = utf8_decode($plainteks5); //Proses colation untuk karakter khusus dari database

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
        
    	return view('member.index', [
            'items' => $decryptItems,
            'kategoris' => $kategoris,
            'title' => $title,
            'name' => $hasilDecrypt
        ]);
    }

     public function kategori(kategori $kategori)
    {
        $user = Auth::user();
        temp::truncate();

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
        
        $title = $kategori->nama_kategori;
        $items = item::where('kategori', $cipher[1])->get();
        $kategoris = kategori::all();

        foreach($items as $item){
            // DEKRIPSI RC4
            $key = substr(1824, 0,16);
            $rc4 	 = new rc4($key);

            $plainteks1 = $item->nama_barang;
            $plainteks2 = $item->harga_pokok;
            $plainteks3 = $item->harga_jual;
            $plainteks4 = $item->stok;
            $plainteks5 = $item->kategori;
                
            $cipherteks1 = utf8_decode($plainteks1); //Proses colation untuk karakter khusus dari database
            $cipherteks2 = utf8_decode($plainteks2); //Proses colation untuk karakter khusus dari database
            $cipherteks3 = utf8_decode($plainteks3); //Proses colation untuk karakter khusus dari database
            $cipherteks4 = utf8_decode($plainteks4); //Proses colation untuk karakter khusus dari database
            $cipherteks5 = utf8_decode($plainteks5); //Proses colation untuk karakter khusus dari database

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

        return view('member/kategoris', [
            'items' => $decryptItems,
            'kategoris' => $kategoris,
            'categories' => $kategori,
            'title' => $title,
            'name' => $hasilDecrypt
        ]);
        
    }

    public function show(temp $item)
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

        $title = $item->kategori;
        $kategoris = kategori::all();
        return view('member/detail', [
            'item' => $item,
            'kategoris' => $kategoris,
            'title' => $title,
            'name' => $hasilDecrypt
        ]);
    }

    public function payment()
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
        return view('member/pembayaran', [
            'kategoris' => $kategoris,
            'title' => "Cart",
            'name' => $hasilDecrypt
        ]);
    }

    public function proses_pesanan(Request $request)
    {
        $request->validate([    //Melakukan validasi inputan user
            'nama' => 'required',
            'jln' => 'required',
            'rt' => 'required',
            'kel' => 'required',
            'kec' => 'required',
            'kab' => 'required',
            'prov' => 'required',
            'patokan' => 'required',
            'no_telpon' => 'required|numeric',
        ], [
            'nama.required' => 'Kolom nama harus diisi!',
            'jln.required' => 'Kolom nama jalan harus diisi!',
            'rt.required' => 'Kolom nama Kampung/RT harus diisi!',
            'kel.required' => 'Kolom Kelurahan harus diisi!',
            'kec.required' => 'Kolom Kecamatan harus diisi!',
            'kab.required' => 'Kolom Kabupaten harus diisi!',
            'prov.required' => 'Kolom Provinsi harus diisi!',
            'patokan.required' => 'Kolom patokan harus diisi!',
            'no_telpon.required' => 'Kolom nomor telepon harus diisi!',
            'no_telpon.numeric' => 'Kolom nomor telepon harus berisi angka!',
        ]);

        $user = Auth::user();   //Mengambil data user yang sedang login

        date_default_timezone_set('Asia/Jakarta');  //Setting zona waktu
        $alamat = $request->jln.", ".$request->rt.", ".$request->kec.", ".$request->kab;  //Menggabungkan beberapa inputan alamat lengkap ke dalam satu variabel

        //ENKRIPSI RSA
        $n = 187;    //Kunci n
        $e = 7;     //Kunci e
        $teks = array(  //Mengambil plainteks dengan array
            1 => $request->nama,
            2 => $alamat,
            3 => $request->no_telpon,
        );

        for($i=1; $i<=3; $i++){
            $hasilEncrypt[$i] = "";  //Deklarasi variabel untuk menampung hasil enkripsi
        }
        
        for($j=1; $j<=3; $j++){
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
        for($i=1; $i<=3; $i++){
            $encrypt[$i] = $rc4->encrypt($hasilEncrypt[$i]);    //Memanggil fungsi dari helpers Rc4
            $cipher[$i] = utf8_encode($encrypt[$i]); //Proses colation karakter khusus yang akan dikirim ke database
        }
        // END ENKRIPSI RC4

        invoice::create([   //Input atau simpan data ke database pada tabel invoices
            'username' => $user->username,
            'nama' => $cipher[1],
            'alamat' => $cipher[2],
            'no_telpon' => $cipher[3],
            // 'pengiriman' => $request->pengiriman,
            // 'bank' => $request->bank,
            'batas_bayar' => date('Y-m-d H:i:s', mktime( date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y')))  //Proses penambahan tanggal
        ]);

        $id_invoice = DB::table('invoices') //Mengambil id data pada baris terakhir dari tabel invoices
                ->orderBy('id', 'desc')
                ->first();
        
        Cart::store($id_invoice->id);   //menyimpan data cart ke dalam database dengan id tertentu

        Cart::destroy();    //Menghapus data cart yang ada pada session
        return redirect('/member')->with('status', 'Terima kasih sudah berbelanja di warung kami. Pesanan akan segera kami antar sesuai alamat anda. Mohon ditunggu ya...');    //Melakukan redirect link dan mengirimkan pesan notifikasi
    }

    public function profil()
    {
        $user = Auth::user();   //Mengambil data akun yang sedang login
        if( $user->admin == 1 ){    //Menentukan status user
            $status = "Administrator";
        }else{
            $status = "Member/Konsumen";
        }
        
        // DEKRIPSI RC4
        $teks = array(
            1 => $user->name,
            2 => $user->username,
            3 => $user->no_telpon,
            4 => $user->email,
        );

        $key = substr(1824, 0,16);
        $rc4 	 = new rc4($key);
        for($i=1; $i<=4; $i++){
            $cipherteks[$i] = utf8_decode($teks[$i]); //Proses colation untuk karakter khusus dari database
            $decrypt[$i] = $rc4->decrypt($cipherteks[$i]);
        }
        // END DEKRIPSI RC4
        
        // DEKRIPSI RSA
        $n = 187;    //Menampung value n
        $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
        for($i=1; $i<=4; $i++){
            $hasilDecrypt[$i] = "";  //Deklarasi variabel untuk menampung hasil dekripsi
        }

        for($i=1; $i<=4; $i++){
            $teks = explode(".",$decrypt[$i]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            
            foreach($teks as $nilai){   //Melakukan foreach pada variabel teks
                $nilai = (integer) $nilai;
                $hasilDecrypt[$i].= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
        }
        // END DEKRIPSI RSA

        $kategoris = kategori::all();   //Mengambil semua data kategori dari database

        return view('member/profil', [  //Menampilkan view
            'kategoris' => $kategoris,
            'title' => "Profil",
            'status' => $status,
            'name' => $hasilDecrypt[1],
            'username' => $hasilDecrypt[2],
            'no_telpon' => $hasilDecrypt[3],
            'email' => $hasilDecrypt[4]
        ]);
    }

    public function edit_profil()
    {
        $user = Auth::user();   //Mengambil data akun yg sedang login
        
        if($user->no_telpon == null){
            // DEKRIPSI RC4
            $teks = array(
                1 => $user->name,
                2 => $user->username,
            );

            $key = substr(1824, 0,16);
            $rc4 	 = new rc4($key);
            for($i=1; $i<=2; $i++){
                $cipherteks[$i] = utf8_decode($teks[$i]); //Proses colation untuk karakter khusus dari database
                $decrypt[$i] = $rc4->decrypt($cipherteks[$i]);
            }
            // END DEKRIPSI RC4
            
            // DEKRIPSI RSA
            $n = 187;    //Menampung value n
            $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
            for($i=1; $i<=2; $i++){
                $hasilDecrypt[$i] = "";  //Deklarasi variabel untuk menampung hasil dekripsi
            }
    
            for($i=1; $i<=2; $i++){
                $teks = explode(".",$decrypt[$i]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
                
                foreach($teks as $nilai){   //Melakukan foreach pada variabel teks
                    $nilai = (integer) $nilai;
                    $hasilDecrypt[$i].= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
                }
            }
            // END DEKRIPSI RSA
    
            $kategoris = kategori::all();   //Mengambil semua data kategori dari database
            return view('member/form_edit_profil', [    //Menampilkan view
                'kategoris' => $kategoris,
                'title' => "Profil",
                'name' => $hasilDecrypt[1],
                'username' => $hasilDecrypt[2],
                'no_telpon' => null
            ]);
            
        }else{
            
            // DEKRIPSI RC4
            $teks = array(
                1 => $user->name,
                2 => $user->username,
                3 => $user->no_telpon,
            );

            $key = substr(1824, 0,16);
            $rc4 	 = new rc4($key);
            for($i=1; $i<=3; $i++){
                $cipherteks[$i] = utf8_decode($teks[$i]); //Proses colation untuk karakter khusus dari database
                $decrypt[$i] = $rc4->decrypt($cipherteks[$i]);
            }
            // END DEKRIPSI RC4
            
            // DEKRIPSI RSA
            $n = 187;    //Menampung value n
            $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
            for($i=1; $i<=3; $i++){
                $hasilDecrypt[$i] = "";  //Deklarasi variabel untuk menampung hasil dekripsi
            }
    
            for($i=1; $i<=3; $i++){
                $teks = explode(".",$decrypt[$i]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
                
                foreach($teks as $nilai){   //Melakukan foreach pada variabel teks
                    $nilai = (integer) $nilai;
                    $hasilDecrypt[$i].= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
                }
            }
            // END DEKRIPSI RSA
    
            $kategoris = kategori::all();   //Mengambil semua data kategori dari database
            return view('member/form_edit_profil', [    //Menampilkan view
                'kategoris' => $kategoris,
                'title' => "Profil",
                'name' => $hasilDecrypt[1],
                'username' => $hasilDecrypt[2],
                'no_telpon' => $hasilDecrypt[3]
            ]);
        }
    }

    public function update_profil(Request $request)
    {
        $request->validate([    //Validation inputan
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:20|regex:/^[a-zA-Z]*$/',
            'no_telpon' => 'numeric|nullable',
            'foto' => 'image'
        ], [
            'name.required' => 'Nama harus diisi!',
            'username.required' => 'Username harus diisi!',
            'name.max' => 'Panjang maks 50 karakter!',
            'username.max' => 'Panjang maks 20 karakter!',
            'username.regex' => 'Tidak boleh ada spasi!',
            'no_telpon.numeric' => 'Hanya bisa diisi angka!',
            'foto.image' => 'Foto tidak valid!'
        ]);

        $user = Auth::user();   //Mengambil data akun user yang sedang login
        
        //ENKRIPSI RSA
        $n = 187;    //Kunci n
        $e = 7;     //Kunci e
        $teks = array(  //Mengambil plainteks dengan array
            1 => $request->name,
            2 => $request->username,
            3 => $request->no_telpon,
        );

        for($i=1; $i<=3; $i++){
            $hasilEncrypt[$i] = "";  //Deklarasi variabel untuk menampung hasil enkripsi
        }
        
        for($j=1; $j<=3; $j++){
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
        for($i=1; $i<=3; $i++){
            $encrypt[$i] = $rc4->encrypt($hasilEncrypt[$i]);    //Memanggil fungsi dari helpers Rc4
            $cipher[$i] = utf8_encode($encrypt[$i]); //Proses colation karakter khusus yang akan dikirim ke database
        }
        // END ENKRIPSI RC4

        if($request->file('foto') == ""){   //Kondisi inputan foto kosong

            User::where('id', $user->id)    //Melakukan update data user
            ->update([
                'name' => $cipher[1],
                'username' => $cipher[2],
                'no_telpon' => $cipher[3],
                'foto' => $user->foto,
            ]);
            return redirect('/profil')->with('status', 'Akun profil anda berhasil disimpan.');  //Melakukan redirect link dengan mengirim pesan notifikasi
        }else{  //Kondisi dilakukan upload foto
            $file = $request->file('foto'); //Menampung file foto ke dalam variabel
            
            $nama_file = time()."_".$file->getClientOriginalName(); //mengambil nama file foto
            
            $tujuan_upload = 'foto_profil'; //tujuan penyimpanan foto
            $file->move($tujuan_upload, $nama_file);    //Proses penyimpanan foto

            User::where('id', $user->id)    //Melakukan update data user
            ->update([
                'name' => $cipher[1],
                'username' => $cipher[2],
                'no_telpon' => $cipher[3],
                'foto' => $nama_file,
            ]);
            return redirect('/profil')->with('status', 'Akun profil anda berhasil disimpan.');  //Melakukan redirect link dengan mengirim pesan notifikasi
        }
    }
}
