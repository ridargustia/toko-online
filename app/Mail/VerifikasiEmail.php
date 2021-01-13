<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\key;
use App\Helpers\Rc4;

class VerifikasiEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user;

    public function __construct(User $user)
    {
        // DEKRIPSI RC4
        $cipherteksEmail = utf8_decode($user['email']); //Proses colation untuk karakter khusus dari database
        $key = substr(1824, 0,16);  //Menampung kunci dari indeks 0 dengan maksimal 16 karakter
        $rc4 	 = new rc4($key);   //Instansiasi objek
        $decrypt = $rc4->decrypt($cipherteksEmail);  //Pemanggilan fungsi decrypt dari helpers rc4
        // END DEKRIPSI RC4

        // DEKRIPSI RSA
        $n = 187;    //Menampung value n
        $d = 23; //simpan ke database setelah generate-key dan dilakukan enkripsi base64
        $hasilDecrypt = "";  //Deklarasi variabel untuk menampung hasil dekripsi kunci
        
        $teks = explode(".",$decrypt);    //pesan enkripsi dipecah menjadi array dengan batasan "."
        foreach($teks as $nilai){   //Melakukan foreach pada variabel teks
            
            $hasilDecrypt.= chr(gmp_strval(gmp_mod(gmp_pow($nilai,$d),$n))); //rumus dekripsi <pesan>=<enkripsi>^<d>mod<n>
        }
        // END DEKRIPSI RSA
        
        $user['email'] = $hasilDecrypt;
        
        $this->user = $user;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.template_email_verifikasi');
    }
}
