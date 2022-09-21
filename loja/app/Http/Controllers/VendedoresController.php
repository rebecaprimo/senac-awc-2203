<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Vendedores;

class VendedoresController extends Controller
{
    private $qtdPorPagina = 5; //quantos itens vão aparecer na paginação


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vend = Vendedores::orderBy('id', 'ASC')->paginate($this->qtdPorPagina);
        return view('vendedores.index', compact('vend'))
                ->with('i', ($request->input('page', 1)-1)* $this->qtdPorPagina);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nome'=>'required', 'matricula'=>'required']);
        $input = $request->all();
        $vemdedor = Vendedores::create($input);

        return redirect()->route('vendedores.index')->with('success', 'Vendedor gravado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendedor = Vendedores::find($id);

        return view('vendedores.show', compact('vendedor')); //compact = cria um vetor com váriaveis e seus valores
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vend = Vendedores::find($id);

        return view('vendedores.edit', compact('vend'));
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
        $this->validate($request, ['nome'=>'required', 'matricula'=>'required']);
        $input = $request->all();
        $vend = Vendedores::find($id);
        $vend->update($input);

        return redirect()->route('vendedores.index')->with('success', 'Vendedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vendedores::find($id)->delete();

        return redirect()->route('vendedores.index')->with('success', 'Vendedor removido com sucesso!');
    }
}
