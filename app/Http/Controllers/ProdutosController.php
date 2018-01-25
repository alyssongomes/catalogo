<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Produto;
use Session;

class ProdutosController extends Controller
{
    public function index()
    {
      $produtos = Produto::paginate(3);
      return view('produto.index', array('produtos'=> $produtos, 'busca'=>null));
    }

    public function show($id)
    {
      $produto = Produto::find($id);
      return view('produto.show',array('produto' => $produto));
    }


    public function create()
    {
      if(Auth::check())
        return view('produto.create');
      else
        return redirect('login');
    }

    public function store(Request $request)
    {
      if(Auth::check()){
        $this->validate($request,[
          'referencia' => 'required|unique:produtos|min:3',
          'titulo'=>'required|min:3'
        ]);

        $produto = new Produto();
        $produto->titulo = $request->titulo;
        $produto->referencia = $request->referencia;
        $produto->descricao = $request->descricao;
        $produto->preco = $request->preco;
        if($produto->save())
          return redirect('produtos');
      }else{
        return redirect('login');
      }
    }

    public function edit($id)
    {
      if(Auth::check()){
        $produto = Produto::find($id);
        return view('produto.edit',array('produto' =>$produto));
      }else{
        return redirect('login');
      }
    }

    public function update($id, Request $request)
    {
      if(Auth::check()){
        $produto = Produto::find($id);
        $this->validate($request,[
          'referencia' => 'required|min:3',
          'titulo'=>'required|min:3'
        ]);

        $produto->titulo = $request->titulo;
        $produto->referencia = $request->referencia;
        $produto->descricao = $request->descricao;
        $produto->preco = $request->preco;
        if($request->hasFile('foto')){
          $imagem = $request->file('foto');
          $nomeArquivo = md5($id).".".$imagem->getClientOriginalExtension();
          $request->file('foto')->move(public_path('./img/produtos/'), $nomeArquivo);
        }

        $produto->save();
        Session::flash('mensagem','Produto alterado com sucesso.');
        return redirect()->back();
      }else{
        return redirect('login');
      }
    }

    public function destroy($id)
    {
      if(Auth::check()){
        $produto = Produto::find($id);
        $produto->delete();
        Session::flash('mensagem','Produto excluído com sucesso!');
        return redirect()->back();
      }else{
        return redirect('login');
      }
    }

    public function buscar(Request $request)
    {
      $produtos = Produto::where('titulo','LIKE','%'.$request->busca.'%')->orWhere('descricao','LIKE','%'.$request->busca.'%')->paginate(3);
      return view('produto.index',array('produtos'=> $produtos, 'busca'=>$request->busca));
    }
}
