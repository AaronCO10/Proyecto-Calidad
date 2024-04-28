<?php

namespace App\Http\Controllers;

use App\Models\Donadore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use Carbon\Carbon;
use Database\Seeders\RoleSeeder;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\React;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Can;
use PhpParser\Node\Expr\Assign;
use Spatie\Ignition\Contracts\Solution;
use Spatie\Permission\Models\Role;

/**
 * Class DonadoreController
 * @package App\Http\Controllers
 */
class DonadoreController extends Controller
{ 
    public function __construct() {
        $this->middleware('can:donador')->only('create','store','index');
        $this->middleware('can:admin')->only('edit','destroy','show','update');
    }
    public function auth()
    {
        if (auth()->check()) {
            return view('donadore.index');
        } else {    
            return view('principal.index');
        }

    }
    
    public function index(Request $request)
    {
        $busqueda = $request ->busqueda;
        $donadores=Donadore::where('dni','LIKE','%'.$busqueda.'%')
        ->orWhere('tipo','LIKE','%'.$busqueda.'%')->latest('id')->PAGINATE();
        $data =[
            'donadore'=>$donadores
        ];
        return view('donadore.index',$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('donadore.create');
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'usuario' => ['required'],
            'dni' => ['required', 'size:8'],
            'talla' => ['required', 'integer', 'min:150', 'max:180', 'imc'],
            'peso' => ['required', 'integer', 'min:55', 'max:90', 'imc'],
            'fnacimiento' => ['required', 'date_format:Y-m-d', 'before_or_equal:' . now()
            ->subYears(18)->format('Y-m-d')],
            'sexo' => ['required'],
            'telefono' => ['required', 'size:9'],
            /*'correo' => ['required','email:rfc,dns'],*/
            'tipo' => ['required'],
            'terminos' => ['required'],
            'fecha' => [ 'nullable','date_format:Y-m-d', 'fecha'],
            'imc' => ['imc'], // Aquí utilizamos la regla personalizada 'imc'
        ]);
        
        $donadores =new Donadore();
        $donadores->usuario=$request->get('usuario');
        $donadores->dni=$request->get('dni');
        $donadores->talla=$request->get('talla');
        $donadores->fnacimiento=$request->get('fnacimiento');
        $donadores->peso=$request->get('peso');
        $donadores->sexo=$request->get('sexo');
        $donadores->fecha=$request->get('fecha');
        $donadores->tipo=$request->get('tipo');
        $donadores->telefono=$request->get('telefono');
        $donadores->correo=(Auth::user()->email);
        $donadores->verificaccion=("Proceso");
        $donadores->terminos=("Aceptado");
        $donadores->save();
        session(['formularioEnviado' => true]);
        session()->flash('success', 'USTED HA SIDO REGISTRADO COMO DONADOR.');
        return view('Principal.index');
        
    }


    public function edit($id)
    {
        $donadore = Donadore::find($id);

        return view('donadore.edit')->with('donadore',$donadore);
    }


    public function update(Request $request,string $id)
    {
        $request->validate([
            'dni' => ['required', 'size:8'],
            'talla' => ['required', 'integer', 'min:150', 'max:180', 'imc'],
            'peso' => ['required', 'integer', 'min:55', 'max:90', 'imc'],
            'fnacimiento' => ['required', 'date_format:Y-m-d', 'before_or_equal:' . now()->subYears(18)
            ->format('Y-m-d')],
            'sexo' => ['required'],
            'telefono' => ['required', 'size:9'],
            'tipo' => ['required'],
            'fecha' => [ 'nullable','date_format:Y-m-d', 'fecha'],
            'imc' => ['imc'], // Aquí utilizamos la regla personalizada 'imc'
        ]);
        $donadores =Donadore::find($id);
        $donadores->usuario=$request->get('usuario');
        $donadores->dni=$request->get('dni');
        $donadores->talla=$request->get('talla');
        $donadores->fnacimiento=$request->get('fnacimiento');
        $donadores->peso=$request->get('peso');
        $donadores->sexo=$request->get('sexo');
        $donadores->fecha=$request->get('fecha');
        $donadores->tipo=$request->get('tipo');
        $donadores->telefono=$request->get('telefono');
        $donadores->correo=$request->get('correo');
        $donadores->verificaccion=$request->get('verificaccion');
        $donadores->save();
        return view('Principal.index');

    }


    public function destroy($id)
    {
        $donadore = Donadore::find($id)->delete();
            return redirect()->route('donadore.index');

    }
    private function calcularIMC($talla, $peso) {
        $alturaMetros = $talla / 100; // Convertir la altura a metros
        return $peso / ($alturaMetros * $alturaMetros);
    }
 
}
