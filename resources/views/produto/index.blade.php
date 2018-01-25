@extends('layouts.app')
@section('title','Listagem de Produtos')
@section('content')
  <h1>Produtos</h1>
  @if (Session::has('mensagem'))
    <div class="alert alert-success">
      {{Session::get('mensagem')}}
    </div>
  @endif
  <form action="/produtos/buscar" method="post">
    {{csrf_field()}}
    <div class="row">
      <div class="col-lg-12">
        <div class="input-group">
          <input type="text" class="form-control" name="busca" value="{{$busca}}" placeholder="Buscar produto" required>
          <span class="input-group-btn">
            <input type="submit" value="Buscar" class="btn btn-default">
          </span>
        </div>
      </div>
    </div>
  </form>
  <div class="row">
    @foreach ($produtos as $produto)
      <div class="col-md-3">
        <h4>{{$produto->titulo}}</h4>
        @if (file_exists(public_path()."/img/produtos/".md5($produto->id).".jpg"))
          <a href="{{url("produtos/".$produto->id)}}">
            <img src="{{asset("img/produtos/".md5($produto->id).".jpg")}}">
          </a>
        @else
          <a class="thumbnail" href="{{url("produtos/".$produto->id)}}">{{$produto->titulo}}</a>
        @endif
        @if(Auth::check())
          <form action="/produtos/{{$produto->id}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE" />
            <a class="btn btn-default" href="{{url("produtos/".$produto->id."/edit")}}">Editar</a>
            <input class="btn btn-default" type="submit" name="excluir" value="Excluir" />
          </form>
        @endif
      </div>
    @endforeach
  </div>
  {{$produtos->links()}}
@endsection
