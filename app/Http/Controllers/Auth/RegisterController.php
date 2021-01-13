<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use App\Mail\VerifikasiEmail;
use Mail;
use App\key;
use App\Helpers\Rc4;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/member';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'username' => 'required|string|max:20|unique:users|regex:/^[a-zA-Z]*$/',
            'email' => 'required|string|email|max:25|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'first_name.required' => 'Nama depan harus diisi!',
            'last_name.required' => 'Nama belakang harus diisi!',
            'username.required' => 'Username harus diisi!',
            'email.required' => 'Email harus diisi!',
            'password.required' => 'Password harus diisi!',
            'first_name.max' => 'Panjang maks 20 karakter!',
            'last_name.max' => 'Panjang maks 20 karakter!',
            'username.max' => 'Panjang maks 20 karakter!',
            'email.max' => 'Panjang maks 25 karakter!',
            'password.min' => 'Panjang min 6 karakter!',
            'username.unique' => 'Username sudah ada!',
            'email.unique' => 'Email sudah ada!',
            'password.confirmed' => 'Password tidak cocok!',
            'username.regex' => 'Tidak boleh ada spasi!',
            'email.email' => 'Email tidak valid!',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $full_name = $data['first_name']." ".$data['last_name'];
        
        //ENKRIPSI RSA
        $n = 187;    //Kunci n
        $e = 7;     //Kunci e

        $teks = array(  //Mengambil plainteks dengan array
            1 => $full_name,
            2 => $data['username'],
            3 => $data['email'],
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

        $user = User::create([
            'name' => $cipher[1],
            'username' => $cipher[2],
            'email' => $cipher[3],
            'password' => bcrypt($data['password']),
            'register_token' => Str::random(40),
            'foto' => "default.jpg",
            'admin' => 2,
        ]);
        
        Mail::to($data['email'])->send(new VerifikasiEmail($user));
        
        return $user;
    }

    public function verifikasiemail($email, $register_token)
    {
        //ENKRIPSI RSA
        $n = 187;    //Kunci n
        $e = 7;     //Kunci e
        $teks = $email;   //Mengambil plainteks
        $hasilEncrypt = "";  //Deklarasi variabel untuk menampung hasil enkripsi
        
        for($i=0;$i<strlen($teks);++$i){    //pesan dikodekan menjadi kode ascii, kemudian di enkripsi per karakter
            
            $hasilEncrypt.=gmp_strval(gmp_mod(gmp_pow(ord($teks[$i]),$e),$n));   //rumus enkripsi <enkripsi>=<pesan>^<e>mod<n>
        
            if($i!=strlen($teks)-1){     //antar tiap karakter dipisahkan dengan "."
                $hasilEncrypt.=".";
            } 
        }
        //END ENKRIPSI RSA
        
        // ENKRIPSI RC4
        $key 	= substr(1824, 0,16);   //Menampung kunci RC4 maksimal 16 karakter dimulai dari indeks 0
        $rc4 	= new rc4($key);    //Instansiasi objek
        $encrypt = $rc4->encrypt($hasilEncrypt);    //Memanggil fungsi dari helpers Rc4
        $cipherEmail = utf8_encode($encrypt); //Proses colation karakter khusus yang akan dikirim ke database
        // END ENKRIPSI RC4
        
        User::where(['email' => $cipherEmail, 'register_token' => $register_token])
            ->update([
                'register_status' => 1, 
                'register_token' => NULL
        ]);

        return redirect('login')->withInfo('Akun anda telah aktif, silahkan login.');
    }
}
