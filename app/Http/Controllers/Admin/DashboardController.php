<?php


namespace app\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Formulario;
use App\Models\User;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $usuario=Auth::user()->nome;
        $usuarios_mensagens = Formulario::all();
        
        return view('dashboard',
        compact('usuario','usuarios_mensagens'));
    }
}
