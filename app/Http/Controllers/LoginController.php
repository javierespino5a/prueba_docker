<?php
use Illuminate\Http\Request;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use Session;
class LoginController extends Controller
{
public function index() 
{
    return view('login.login');
}
public function ingresar()
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $resultado=DB::select("select * from cat_usuarios where USUARIO='".$email."'");
    if (empty($resultado)) {
        
    }
    elseif($resultado[0]->USUARIO==$email && $resultado[0]->TELEFONO==$password)
    {
       Session::put('user',$email);
       Session::put('rol',$resultado[0]->ID_ROL);
       $sa=session()->get('user'); 
       return redirect('inicio');

    }
   
}
public function cerrarsesion()
{
    Session::flush();
    return redirect('/');
}
}
