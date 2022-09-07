<!--use o HTML/CSS/JS do layouts/padrao.blade.php-->
@extends('layouts.padrao')

<!--define o título da pagina view-->
@section('title', 'Quadro de avisos')

<!--usa o sidebar do layout padrão-->
@section('sidebar')
    @parent
    <br> ------------- Barra superior específica -------------
@endsection

<!--insere o conteúdo personalizado no layout padrão-->
@section('content')
    <h3>Quadro de AVISOS</h3>
    <br>
    <h4>Exemplo com a sintaxe do Blade</h4>

    <!--laço de repetição -> para cada aviso dentro de avisos-->
    @foreach($avisos as $aviso)

        <!--if no blade-->
        @if($aviso['exibir'])

            {{$aviso['data']}}: {{$aviso['aviso']}}
            <br>
        @else
            Não há aviso
            <br>
        @endif
    @endforeach

    <h4>Exemplo com a sintaxe PHP</h4>

    <?php
    //também permite PHP puro no blade
    foreach($avisos as $aviso) {
        if($aviso['exibir']){
            echo "{$aviso['data']}: {$aviso['aviso']} <br>";
        } else {
            echo "Não há aviso! <br>";
        }
    }
    ?>
@endsection
