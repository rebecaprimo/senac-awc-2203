<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr; //Doc.-https://laravel.com/docs/master/helpers
use App\User;
use Spatie\Permission\Models\Role; //classe de perfil (define os perfis que tem acesso a determinada parte da aplicação)
use DB; //banco de dados
use Hash; //criptografia

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) //página inicial CRUD controle de usuário
    {
        $data=User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))->with('i',($request->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required',
                                  'email'=>'required|email|unique:users,email', //email tem que ser único
                                  'password'=>'required|same:confirm-password', //senha confirmada, tem que bater em ambas
                                  'roles'=>'required']);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input); //cria o usuário
        $user->assignRole($request->input('roles')); //delega o perfil do usuário
        return redirect()->route('users.index')->with('success','Usuário criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id); //mostra o usuário com base no id
        return view('users.show', compact('user')); //retorna os dados do usuário respectivo
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
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
        $this->validate($request,['name'=>'required',
                                  'email'=>'required|email|unique:users,email,'. $id, //passando o id para atualizar o mesmo usuário
                                  'password'=>'same:confirm-password','roles'=>'required']);
        $input = $request->all(); //se não foi criada uma nova senha, mantém a mesma do banco

        if(!empty($input['password'])) {
            $input['password']=Hash::make($input['password']);
        } else {
            $input = Arr::except($input,array('password')); //remove tudo menos a senha
        }

        $user = User::find($id);
        $user->update($input); //update baseado no input tratado anteriormente
        DB::table('model_has_roles')->where('model_id',$id)->delete(); //apagar id do pacote model_has_roles
        $user->assignRole($request->input('roles')); //atribui novo perfil pro usuário
        return redirect()->route('users.index')->with('success','Usuário atualizado com sucesso!'); //printa mensagem de sucesso
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete(); //remove de acordo com o id
        return redirect()->route('users.index')->with('success','Usuário removido com sucesso!');
    }
}
