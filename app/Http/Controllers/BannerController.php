<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Console\View\Components\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use function Laravel\Prompts\alert;

class BannerController extends Controller
{
    public function __construct() {
        
        $this->middleware('can:admin')->only('edit','destroy','show','update','index');
    }
    public function auth()
    {
        if (auth()->check()) {
            return view('banner.index');
        } else {
            return view('principal.index');
        }

    }
    public function index(Request $request)
    {
        $busqueda = $request ->busqueda;
        $banners=Banner::where('nombre','LIKE','%'.$busqueda.'%')
        ->orWhere('apellido','LIKE','%'.$busqueda.'%')
        ->orWhere('tipo','LIKE','%'.$busqueda.'%')
        ->latest('id')->PAGINATE();
        $data =[
            'banners'=>$banners
        ];
        return view('banner.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => ['required','size:9'],
            'email' => ['required','email:rfc,dns'],
            'tipo' => ['required'],
            'terminos' => ['required'],
            'fecha' => ['required', 'date_format:Y-m-d', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')]

        ]);
        $banners =new Banner();
        $banners->nombre=$request->get('nombre');
        $banners->apellido=$request->get('apellido');
        $banners->fecha=$request->get('fecha');
        $banners->tipo=$request->get('tipo');
        $banners->telefono=$request->get('telefono');
        $banners->email=$request->get('email');
        $banners->comentario=("");
        $banners->verificacion=("Proceso");
        $banners->terminos=("Aceptada");
        $banners->save();
        session()->flash('success', 'El registro se creó correctamente.');
        return redirect('/principal');
    }
    public function edit( $id)
    {
        $banner = Banner::find($id);

        return view('banner.edit')->with('banner',$banner);
    }

    /**
     * Update the specified resource in storage.    
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'comentario' => 'required',
            'apellido' => 'required',
            'telefono' => ['required','size:9'],
            'email' => ['required','email:rfc,dns'],
            'tipo' => ['required'],
            'fecha' => ['required', 'date_format:Y-m-d', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')]

        ]);
        $banners=Banner::find($id);
        $banners->nombre=$request->get('nombre');
        $banners->apellido=$request->get('apellido');
        $banners->fecha=$request->get('fecha');
        $banners->tipo=$request->get('tipo');
        $banners->telefono=$request->get('telefono');
        $banners->email=$request->get('email');
        $banners->comentario=$request->get('comentario');
        $banners->verificacion=$request->get('verificacion');
        $banners->save();
        return redirect('/banner');
    }
    public function destroy(string $id)
        {
            $banner = Banner::find($id)->delete();
    
            return redirect()->route('banner.index');
        }
    public function nuevo()
    {
        return view('banner.nosotros');
    }
    public function mapa()
    {
        return view('banner.hospital');
    }
    public function terminos(Request $request)
    {
        return view('banner.terminos');
    }

} 
