<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\invoice;
use App\transaction;
use App\recapitulation;
use App\item;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;
use App\key;
use App\Helpers\Rc4;
use App\temp;

class DashboardController extends Controller
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
        $count_notif = invoice::where('notif_status', 0)->count();
        return view('admin/index', [
            'title' => $title,
            'count_notif' => $count_notif,
            'name' => $hasilDecrypt
        ]);
    }

    public function invoice()
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

        Cart::destroy();
        $invoices = DB::select('select * from invoices order by id desc');
        $count_notif = invoice::where('notif_status', 0)->count();

        //Dekripsi tabel invoices
        foreach($invoices as $invoice){ 
            // DEKRIPSI RC4
            $key = substr(1824, 0,16);
            $rc4 	 = new rc4($key);

            $plainteks1 = $invoice->username;
            $plainteks2 = $invoice->nama;
            $plainteks3 = $invoice->alamat;
            $plainteks4 = $invoice->no_telpon;
                
            $cipherteks1 = utf8_decode($plainteks1); //Proses colation untuk karakter khusus dari database
            $cipherteks2 = utf8_decode($plainteks2); //Proses colation untuk karakter khusus dari database
            $cipherteks3 = utf8_decode($plainteks3); //Proses colation untuk karakter khusus dari database
            $cipherteks4 = utf8_decode($plainteks4); //Proses colation untuk karakter khusus dari database

            $decrypt1 = $rc4->decrypt($cipherteks1);
            $decrypt2 = $rc4->decrypt($cipherteks2);
            $decrypt3 = $rc4->decrypt($cipherteks3);
            $decrypt4 = $rc4->decrypt($cipherteks4);
            // END DEKRIPSI RC4
            
            // DEKRIPSI RSA
            $cipherRsa = array(
                1 => $decrypt1,
                2 => $decrypt2,
                3 => $decrypt3,
                4 => $decrypt4,
            );

            $n = 187;    //Menampung value n
            $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
            $hasilDecrypt1 = "";
            $hasilDecrypt2 = "";
            $hasilDecrypt3 = "";
            $hasilDecrypt4 = "";

            $teks1 = explode(".",$cipherRsa[1]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks2 = explode(".",$cipherRsa[2]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks3 = explode(".",$cipherRsa[3]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks4 = explode(".",$cipherRsa[4]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
                
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
            // END DEKRIPSI RSA

            temp::create([
                'id_public' => $invoice->id,
                'username' => $hasilDecrypt1,
                'nama' => $hasilDecrypt2,
                'alamat' => $hasilDecrypt3,
                'no_telpon' => $hasilDecrypt4,
                'batas_bayar' => $invoice->batas_bayar,
                'notif_status' => $invoice->notif_status,
            ]);
        }
        //End dekripsi tabel invoices

        $decryptInvoices = temp::all();

        $title = 'Invoices';
        return view('admin/invoice', [
            'invoice' => $decryptInvoices,
            'title' => $title,
            'count_notif' => $count_notif,
            'name' => $hasilDecrypt
        ]);
    }

    public function detail_invoice(invoice $invoice)
    {
        $user = Auth::user();

        // DEKRIPSI RC4
        $teks = array(
            1 => $user->name,
            2 => $invoice->username,
            3 => $invoice->nama,
            4 => $invoice->alamat,
            5 => $invoice->no_telpon,
        );

        $key = substr(1824, 0,16);
        $rc4 	 = new rc4($key);
        for($i=1; $i<=5; $i++){
            $cipherteks[$i] = utf8_decode($teks[$i]); //Proses colation untuk karakter khusus dari database
            $decrypt[$i] = $rc4->decrypt($cipherteks[$i]);
        }
        // END DEKRIPSI RC4
        
        // DEKRIPSI RSA
        $n = 187;    //Menampung value n
        $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
        for($i=1; $i<=5; $i++){
            $hasilDecrypt[$i] = "";  //Deklarasi variabel untuk menampung hasil dekripsi
        }

        for($i=1; $i<=5; $i++){
            $teks = explode(".",$decrypt[$i]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            
            foreach($teks as $nilai){   //Melakukan foreach pada variabel teks
                $nilai = (integer) $nilai;
                $hasilDecrypt[$i].= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
        }
        // END DEKRIPSI RSA
        
        $title = 'Invoices';
        Cart::destroy();
        // $users = DB::table('users')->where('votes', 100)->get();
        
        Cart::restore($invoice->id);
        $carts = Cart::content();

        invoice::where(['id' => $invoice->id])
            ->update([
                'notif_status' => 1, 
        ]);

        $count_notif = invoice::where('notif_status', 0)->count();

        return view('admin/detail_invoice', [
            'title' => $title,
            'carts' => $carts,
            'invoice' => $invoice,
            'username' => $hasilDecrypt[2],
            'nama' => $hasilDecrypt[3],
            'alamat' => $hasilDecrypt[4],
            'no_telpon' => $hasilDecrypt[5],
            'count_notif' => $count_notif,
            'name' => $hasilDecrypt[1],
        ]);
    }

    public function destroy_invoice(invoice $invoice)
    {
        invoice::destroy($invoice->id);
        return redirect('/invoice')->with('status', 'Data invoice berhasil dihapus.');
    }

    public function stok_laku(item $item)
    {   
        date_default_timezone_set('Asia/Jakarta');

        // DEKRIPSI RC4
        $teks = array(
            1 => $item->stok,
            2 => $item->harga_pokok,
            3 => $item->harga_jual,
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
        
        if( $hasilDecrypt[1] > 0){
            $stok = $hasilDecrypt[1] - 1;
            $laba = $hasilDecrypt[3] - $hasilDecrypt[2];
            $lakuSatu = 1;
            $plainteksStok = (string) $stok;
            $plainteksLaba = (string) $laba;
            $plainteksLakusatu = (string) $lakuSatu;

            //ENKRIPSI RSA
            $n = 187;    //Kunci n
            $e = 7;     //Kunci e
            $teks = array(  //Mengambil plainteks dengan array
                1 => $plainteksStok,
                2 => $plainteksLaba,
                3 => $plainteksLakusatu,
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
            
            item::where('id', $item->id)
            ->update([
                'nama_barang' => $item->nama_barang,
                'stok' => $cipher[1],
                'penjualan' => $item->penjualan + 1,
                'harga_pokok' => $item->harga_pokok,
                'harga_jual' => $item->harga_jual,
                'kategori' => $item->kategori,
                'expired' => $item->expired,
                'gambar' => $item->gambar
            ]);

            transaction::create([
                'nama_barang' => $item->nama_barang,
                'jumlah' => $cipher[3],
                'harga_pokok' => $item->harga_pokok,
                'harga_jual' => $item->harga_jual,
                'kategori' => $item->kategori,
                'laba' => $cipher[2],
            ]);

            return redirect('/items')->with('status', '1 Stok barang telah terjual.');
        }else{
            return redirect('/items')->with('status_gagal', 'Maaf, Stok barang habis.');
        }
        
    }

    public function form_laku_banyak(item $item)
    {
        $user = Auth::user();

        // DEKRIPSI RC4
        $teks = array(
            1 => $user->name,
            2 => $item->nama_barang,
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
        
        // // DEKRIPSI RSA
        // $keyrsa = key::where('id', 1)->first();
        // $n = $keyrsa->n;
        // $d = base64_decode($keyrsa->d); //simpan ke database setelah generate-key dan dilakukan enkripsi base64
        // $hasilDecryptKey = "";
        // //pesan enkripsi dipecah menjadi array dengan batasan "."
        // $teks = explode(".",$keyrsa->cipherkey);
        // foreach($teks as $nilai){
        //     //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
        //     $hasilDecryptKey.= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n)));
        // }
        // // END DEKRIPSI RSA

        // // DEKRIPSI RC4
        // $cipherteksName = utf8_decode($user->name);
        // $cipherteksNamabarang = utf8_decode($item->nama_barang);
        // $key = substr($hasilDecryptKey, 0,16);
        // $rc4 	 = new rc4($key);
        // $decryptName = $rc4->decrypt($cipherteksName);
        // $decryptNamabarang = $rc4->decrypt($cipherteksNamabarang);
        // // END DEKRIPSI RC4

        $title = 'Data Barang';
        $count_notif = invoice::where('notif_status', 0)->count();
        return view('admin/form_laku_banyak', [
            'item' => $item,
            'nama_barang' => $hasilDecrypt[2],
            'title' => $title,
            'count_notif' => $count_notif,
            'name' => $hasilDecrypt[1]
        ]);

    }

    public function laku_banyak(Request $request, item $item)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
        ], [
            'jumlah.required' => 'Kolom jumlah harus diisi!',
            'jumlah.numeric' => 'Kolom jumlah harus berisi angka!',
        ]);

        // DEKRIPSI RC4
        $teks = array(
            1 => $item->stok,
            2 => $item->harga_pokok,
            3 => $item->harga_jual,
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

        // // DEKRIPSI RSA
        // $keyrsa = key::where('id', 1)->first();
        // $n = $keyrsa->n;
        // $d = base64_decode($keyrsa->d); //simpan ke database setelah generate-key dan dilakukan enkripsi base64
        // $hasilDecryptKey = "";
        // //pesan enkripsi dipecah menjadi array dengan batasan "."
        // $teks = explode(".",$keyrsa->cipherkey);
        // foreach($teks as $nilai){
        //     //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
        //     $hasilDecryptKey.= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n)));
        // }
        // // END DEKRIPSI RSA

        // // DEKRIPSI RC4
        // $cipherteksStok = utf8_decode($item->stok);
        // $cipherteksHargapokok = utf8_decode($item->harga_pokok);
        // $cipherteksHargajual = utf8_decode($item->harga_jual);
        // $key = substr($hasilDecryptKey, 0,16);
        // $rc4 	 = new rc4($key);
        // $decryptStok = $rc4->decrypt($cipherteksStok);
        // $decryptHargapokok = $rc4->decrypt($cipherteksHargapokok);
        // $decryptHargajual = $rc4->decrypt($cipherteksHargajual);
        // // END DEKRIPSI RC4
        
        if($request->jumlah > $hasilDecrypt[1]){
            return redirect('/items')->with('status_gagal', 'Stok tidak mencukupi.');
        }else{
            date_default_timezone_set('ASIA/JAKARTA');

            $stok = $hasilDecrypt[1] - $request->jumlah;
            $hargaPokok = $hasilDecrypt[2] * $request->jumlah;
            $hargaJual = $hasilDecrypt[3] * $request->jumlah;
            $laba = $hargaJual - $hargaPokok;
            $stok = (string) $stok;
            $hargaPokok = (string) $hargaPokok;
            $hargaJual = (string) $hargaJual;
            $laba = (string) $laba;

            //ENKRIPSI RSA
            $n = 187;    //Kunci n
            $e = 7;     //Kunci e
            $teks = array(  //Mengambil plainteks dengan array
                1 => $stok,
                2 => $hargaPokok,
                3 => $hargaJual,
                4 => $laba,
                5 => $request->jumlah
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
            // $enkripStok = $rc4->encrypt($stok);    //Pemanggilan fungsi encrypt dari helpers rc4
            // $enkripHargapokok = $rc4->encrypt($hargaPokok);    //Pemanggilan fungsi encrypt dari helpers rc4
            // $enkripHargajual = $rc4->encrypt($hargaJual);    //Pemanggilan fungsi encrypt dari helpers rc4
            // $enkripLaba = $rc4->encrypt($laba);    //Pemanggilan fungsi encrypt dari helpers rc4
            // $enkripJumlah = $rc4->encrypt($request->jumlah);    //Pemanggilan fungsi encrypt dari helpers rc4
            // $cipherStok = utf8_encode($enkripStok); //Proses colation karakter khusus yang akan dikirim ke database
            // $cipherHargapokok = utf8_encode($enkripHargapokok); //Proses colation karakter khusus yang akan dikirim ke database
            // $cipherHargajual = utf8_encode($enkripHargajual); //Proses colation karakter khusus yang akan dikirim ke database
            // $cipherLaba = utf8_encode($enkripLaba); //Proses colation karakter khusus yang akan dikirim ke database
            // $cipherJumlah = utf8_encode($enkripJumlah); //Proses colation karakter khusus yang akan dikirim ke database
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

            $cek1 = item::where('id', $item->id)
            ->update([
                'stok' => $cipher[1],
                'penjualan' => $item->penjualan + $request->jumlah
            ]);

            $cek2 = transaction::create([
                'nama_barang' => $item->nama_barang,
                'jumlah' => $cipher[5],
                'harga_pokok' => $cipher[2],
                'harga_jual' => $cipher[3],
                'kategori' => $item->kategori,
                'laba' => $cipher[4]
            ]);

            if($cek1 && $cek2){
                return redirect('/items')->with('status', 'Sejumlah barang berhasil terjual.');
            }else{
                echo "Gagal terjual.";
            }
        } 
    }

    public function transaksi()
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
        
        $count_transaksi = transaction::count();
        $title = 'Transaksi';
        $transactions = transaction::all();
        $count_notif = invoice::where('notif_status', 0)->count();

        foreach($transactions as $transaction){
            // DEKRIPSI RC4
            $key = substr(1824, 0,16);
            $rc4 	 = new rc4($key);

            $plainteks1 = $transaction->nama_barang;
            $plainteks2 = $transaction->jumlah;
            $plainteks3 = $transaction->harga_pokok;
            $plainteks4 = $transaction->harga_jual;
            $plainteks5 = $transaction->laba;
            $plainteks6 = $transaction->kategori;
                
            $cipherteks1 = utf8_decode($plainteks1); //Proses colation untuk karakter khusus dari database
            $cipherteks2 = utf8_decode($plainteks2); //Proses colation untuk karakter khusus dari database
            $cipherteks3 = utf8_decode($plainteks3); //Proses colation untuk karakter khusus dari database
            $cipherteks4 = utf8_decode($plainteks4); //Proses colation untuk karakter khusus dari database
            $cipherteks5 = utf8_decode($plainteks5); //Proses colation untuk karakter khusus dari database
            $cipherteks6 = utf8_decode($plainteks6); //Proses colation untuk karakter khusus dari database

            $decrypt1 = $rc4->decrypt($cipherteks1);
            $decrypt2 = $rc4->decrypt($cipherteks2);
            $decrypt3 = $rc4->decrypt($cipherteks3);
            $decrypt4 = $rc4->decrypt($cipherteks4);
            $decrypt5 = $rc4->decrypt($cipherteks5);
            $decrypt6 = $rc4->decrypt($cipherteks6);
            // END DEKRIPSI RC4
            
            // DEKRIPSI RSA
            $cipherRsa = array(
                1 => $decrypt1,
                2 => $decrypt2,
                3 => $decrypt3,
                4 => $decrypt4,
                5 => $decrypt5,
                6 => $decrypt6,
            );

            $n = 187;    //Menampung value n
            $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
            $hasilDecrypt1 = "";
            $hasilDecrypt2 = "";
            $hasilDecrypt3 = "";
            $hasilDecrypt4 = "";
            $hasilDecrypt5 = "";
            $hasilDecrypt6 = "";

            $teks1 = explode(".",$cipherRsa[1]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks2 = explode(".",$cipherRsa[2]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks3 = explode(".",$cipherRsa[3]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks4 = explode(".",$cipherRsa[4]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks5 = explode(".",$cipherRsa[5]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
            $teks6 = explode(".",$cipherRsa[6]);    //pesan enkripsi dipecah menjadi array dengan batasan "."
                
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
            foreach($teks6 as $nilai){   //Melakukan foreach pada variabel teks
                $hasilDecrypt6 .= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus enkripsi <pesan>=<enkripsi>^<d>mod<n>
            }
            // END DEKRIPSI RSA

            temp::create([
                'id_public' => $transaction->id,
                'nama_barang' => $hasilDecrypt1,
                'jumlah' => $hasilDecrypt2,
                'harga_pokok' => $hasilDecrypt3,
                'harga_jual' => $hasilDecrypt4,
                'laba' => $hasilDecrypt5,
                'kategori' => $hasilDecrypt6,
            ]);
        }

        $decryptTransactions = temp::all();

        return view('admin/transaksi', [
            'title' => $title,
            'transactions' => $decryptTransactions,
            'count_notif' => $count_notif,
            'count_transaksi' => $count_transaksi,
            'name' => $hasilDecrypt
        ]);
    }

    public function hapus_transaksi(transaction $transaction)
    {
        transaction::destroy($transaction->id);
        return redirect('/transaksi')->with('status', 'Data barang berhasil dihapus.');
    }

    public function hapus_semua_transaksi()
    {
        $cek = transaction::truncate();
        if ($cek) {
            return redirect('/transaksi')->with('status', 'Semua data transaksi berhasil dihapus.');
        }else{
            echo "Gagal dihapus";
        }
    }

    public function rekap_transaksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $total_hargapokok = transaction::sum('harga_pokok');
        $total_hargajual = transaction::sum('harga_jual');
        $total_laba = transaction::sum('laba');

        recapitulation::create([
            'total_hargapokok' => $total_hargapokok,
            'total_hargajual' => $total_hargajual,
            'laba' => $total_laba
        ]);

        return redirect('/transaksi')->with('status', 'Data transaksi berhasil direkap. Silahkan anda lihat pada menu Rekapitulasi');
    }

    public function rekapitulasi()
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

        $count_rekap = recapitulation::count();
        $title = 'Rekapitulasi';
        $rekapitulasi = recapitulation::all();
        $count_notif = invoice::where('notif_status', 0)->count();
        return view('admin/rekapitulasi', [
            'title' => $title,
            'rekapitulasi' => $rekapitulasi,
            'count_notif' => $count_notif,
            'count_rekap' => $count_rekap,
            'name' => $hasilDecrypt
        ]);   
    }

    public function hapus_rekapitulasi(recapitulation $recapitulation)
    {
        recapitulation::destroy($recapitulation->id);
        return redirect('/rekapitulasi')->with('status', 'Data barang berhasil dihapus.');
    }

    public function hapus_semua_rekapitulasi()
    {
        $cek = recapitulation::truncate();
        if($cek){
            return redirect('/rekapitulasi')->with('status', 'Semua data rekapitulasi berhasil dihapus.');
        }else{
            echo "Gagal Dihapus";
        }
        
    }

}
