<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Clientes;

class ClienteController extends Controller
{
    private $qtdPorPagina = 5; //quantos itens vão aparecer na paginação

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //criação de novos métodos CRUD
    public function index(Request $request) //página principal - listagem de dados
    {
        $cli = Clientes::orderBy('id', 'ASC')->paginate($this->qtdPorPagina);
        return view('clientes.index', compact('cli'))
                ->with('i', ($request->input('page', 1)-1)* $this->qtdPorPagina);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //chama o formulário
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //recebe e armazena os dados no banco
    {
        //validate = permite validar os dados de entrada
        //required = dado obrigátorio
        $this->validate($request, ['nome'=>'required', 'email'=>'required|email']);
        $input = $request->all();
        $cliente = Clientes::create($input);

        return redirect()->route('clientes.index')->with('success', 'Cliente gravado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //mostra dados de um determinado registro
    {
        $cliente = Clientes::find($id);

        return view('clientes.show', compact('cliente')); //compact = cria um vetor com váriaveis e seus valores
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //edita os dados
    {
        $cliente = Clientes::find($id);

        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //recebe e atualiza no banco
    {
        $this->validate($request, ['nome'=>'required', 'email'=>'required|email']);
        $input = $request->all();
        $cliente = Clientes::find($id);
        $cliente->update($input);

        return redirect()->route('cliente.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //apaga os dados do banco
    {
        Clientes::find($id)->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }
}
