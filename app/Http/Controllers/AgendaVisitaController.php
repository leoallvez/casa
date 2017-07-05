<?php

namespace Casa\Http\Controllers;

use Illuminate\Http\Request;

class AgendaVisitaController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //

        return view('agenda-visita.agenda');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function listar() {
        return '[{"id":"7","title":"Evento 1","description":"uenxuxenuixndhexn","color":"#3a87ad","date":"2017-03-26 22:17:00"},{"id":"8","title":"Evento 2","description":"cjdvhdgvcd","color":"#3a87ad","date":"2017-03-26 22:17:00"},{"id":"10","title":"Evento 3","description":"NBMNBMNBMNB","color":"#3a87ad","date":"2017-03-27 08:19:00"},{"id":"9","title":"Evento 2","description":"ieuheiudheu","color":"#3a87ad","date":"2017-03-27 10:18:00"},{"id":"16","title":"Visita 1","description":"xxxxxxxxxxxxx","color":"#2c34e0","date":"2017-05-02 23:14:00"},{"id":"17","title":"Visita A","description":"cccc","color":"#e02cae","date":"2017-05-03 23:14:00"},{"id":"13","title":"Visita 1","description":"bjhdbjhdbedhb","color":"#3a87ad","date":"2017-05-04 10:25:00"},{"id":"14","title":"Visita 2","description":"jc mcn dmcn d","color":"#1c60c7","date":"2017-05-04 12:25:00"},{"id":"19","title":"Visita Z","description":"jhdbjwdbe","color":"#27bdd1","date":"2017-05-10 18:16:00"},{"id":"18","title":"ou8o8u98","description":"8y98","color":"#3a87ad","date":"2017-05-11 21:31:00"},{"id":"22","title":"eiueiuhe","description":"uuieue","color":"#b829c4","date":"2017-06-28 21:08:00"},{"id":"21","title":"teste","description":"sxsxsxs","color":"#3a87ad","date":"2017-07-04 10:04:00"},{"id":"20","title":"Visita1","description":" cndb cndb c","color":"#3e369c","date":"2017-07-04 21:58:00"}]';
    }
}
