@extends('layouts.app') <!--layout padrão-->

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Produtos</h2>
        </div>
        <div class="pull-right">

            @can('produtos-create')
            <a class="btn btn-success" href="{{ route('produtos.create') }}"> + Novo produto</a>
            @endcan

        </div>
    </div>
</div>

<br>

@if ($message = Session::get('success'))

<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>

@endif

<table class="table table-bordered">

 <tr>
   <th>ID</th>
   <th>Nome</th>
   <th>Descrição</th>
   <th>Preço</th>
   <th width="280px">Ação</th>
 </tr>

 @foreach ($prod as $key => $produto)

  <tr>
    <td>{{ $produto->id }}</td>
    <td>{{ $produto->nome }}</td>
    <td>{{ $produto->descricao }}</td>
    <td>{{ $produto->preco }}</td>
    <td>
       <a class="btn btn-info" href="{{ route('produtos.show',$produto->id) }}">Mostrar</a>
        @can('produtos-edit')
        <a class="btn btn-primary" href="{{ route('produtos.edit',$produto->id) }}">Editar</a>
        @endcan

        @can('produtos-delete')
        {!! Form::open(['method' => 'DELETE','route' => ['produtos.destroy', $produto->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!}
        @endcan

    </td>
  </tr>

 @endforeach

</table>

{!! $prod->render() !!}

@endsection
