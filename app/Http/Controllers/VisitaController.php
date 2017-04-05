<?php

namespace Casa\Http\Controllers;
use Casa\Visita;
use Casa\Adotivo;
use Casa\Adotante;
use Illuminate\Http\Request;
// use Symfony\Component\Console\Helper;

class VisitaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $visitas = Visita::paginate(10);
        // dd($visitas);
        return view('visita.index', compact('visitas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $adotantes = Adotante::all()->pluck('nome', 'id');
        $adotivos = Adotivo::all()->pluck('nome', 'id');

        return view('visita.create', compact('adotantes', 'adotivos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // dd($request->tempo_estimado);
        $visita = new Visita($request->all());

        $visita->save();

        flash('Visita registrada com Sucesso!', 'success');

        return redirect('visitas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $visita = Visita::find($id);
       
        return view('visita.edit', compact('visita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $visita = Visita::findOrfail($i);
        $visita->update($request->all());

        flash('Visita Alterada com Sucesso!', 'success');

        return redirect('visita');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $visita = Visita::findOrfail($id);

        $visita->delete();
        flash("Visita cancelada com Sucesso", 'danger');

        return redirect('visitas');
    }
}
