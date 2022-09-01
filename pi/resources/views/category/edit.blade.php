<h1>Editar categoria</h1>

<form action="{{route('category.update', $category->id)}}" method="POST">
    @csrf
    @method('PUT')
    Nome da Categoria: <input type="text" name="name" value="{{$category->name}}">
    <button type="submit">Salvar</button>
</form>
