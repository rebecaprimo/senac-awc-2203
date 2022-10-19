@extends('layouts.app') <!--layout padrão-->

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Vendedores</h2>
        </div>
        <div class="pull-right">

            @can('vendedores-create')
            <a class="btn btn-success" href="{{ route('vendedores.create') }}"> + Novo vendedor</a>
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
   <th>Matrícula</th>
   <th width="280px">Ação</th>
 </tr>

 @foreach ($vend as $key => $cliente)

  <tr>
    <td>{{ $cliente->id }}</td>
    <td>{{ $cliente->nome }}</td>
    <td>{{ $cliente->matricula }}</td>

    <td>
       <a class="btn btn-info" href="{{ route('vendedores.show',$cliente->id) }}">Mostrar</a>
        @can('vendedores-edit')
        <a class="btn btn-primary" href="{{ route('vendedores.edit',$cliente->id) }}">Editar</a>
        @endcan

        @can('vendedores-delete')
        {!! Form::open(['method' => 'DELETE','route' => ['vendedores.destroy', $cliente->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!}
        @endcan

    </td>
  </tr>

 @endforeach

</table>

{!! $vend->render() !!}

@endsection
