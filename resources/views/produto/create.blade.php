@extends('layouts.app')
@section('title','Adicionando Produto')
@section('content')
  <h1>Criar um novo produto</h1>
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
      </ul>
    </div>
  @endif
  <form action="/produtos" method="post">
    {{csrf_field()}}
    <label for="referencia">Referência</label>
    <input type="text" name="referencia" placeholder="Referência" class="form-control" required />
    <label for="titulo">Título</label>
    <input type="text" name="titulo" placeholder="Título" class="form-control" required />
    <label for="descricao">Descrição</label>
    <textarea type="text" name="descricao" placeholder="Descrição" class="form-control" rows="3" required></textarea>
    <label for="preco">Preço</label>
    <input type="text" name="preco" placeholder="Preço" class="form-control" required />
    <br>
    <input type="submit" name="cadastrar" value="Cadastrar!" class="btn btn-primary" />
  </form>
@endsection
