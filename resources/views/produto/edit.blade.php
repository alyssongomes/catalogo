@extends('layouts.app')
@section('title','Alterar o produto'.$produto->titulo)
@section('content')
  <h1>Alterar o produto: {{$produto->titulo}}</h1>
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
      </ul>
    </div>
  @endif
  @if(Session::has('mensagem'))
    <div class="alert alert-success">
      {{Session::get('mensagem')}}
    </div>
  @endif
  <form action="/produtos/{{$produto->id}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT" />
    <label for="referencia">Referência</label>
    <input type="text" name="referencia" placeholder="Referência" class="form-control" required value="{{$produto->referencia}}"/>
    <label for="titulo">Título</label>
    <input type="text" name="titulo" placeholder="Título" class="form-control" required  value="{{$produto->titulo}}"/>
    <label for="descricao">Descrição</label>
    <textarea type="text" name="descricao" placeholder="Descrição" class="form-control" rows="3" required>{{$produto->descricao}}</textarea>
    <label for="preco">Preço</label>
    <input type="text" name="preco" placeholder="Preço" class="form-control" required value="{{$produto->preco}}"/>
    <label for="foto">Foto</label>
    <input type="file" name="foto" id="foto" />
    <br>
    <input type="submit" name="atualizar" value="Atualizar!" class="btn btn-primary">
  </form>
@endsection
