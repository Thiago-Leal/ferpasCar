<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custo;

class CustoController extends Controller
{
    public function index(Request $request)
    {
	    $q = $request->get('q');

	    $query = (new Custo)->newQuery();

	    if(!empty($q['name'])) $query->where('name', 'LIKE', '%' . $q['name'] . '%');
	    if(!empty($q['tipo_custo_id'])) $query->where('tipo_custo_id', $q['tipo_custo_id']);
	    
	    $query->orderBy('created_at', 'desc');

	    if (isset($q['deleted']))
		    $query->withTrashed();

	    $custos = $query->paginate(env('MAX_PAGE', 30));


	    return view('custo.index', compact('custos', 'q'));
    }

    public function create()
    {
	    return view('custo.create');
    }

    public function store(Request $request)
    {
	    $this->validate($request, $this->validatorFields());

	    $request['valor'] = str_replace(',', '.', $request['valor']);

	    $custo = Custo::create($request->all());

	    session()->flash('success', 'Tipo de Custo adicionado com sucesso.');

	    return redirect()->route('custo.index');
    }

    public function show($id)
    {
	    $custo = Custo::find($id);
	    return view('custo.data', compact('custo'));
    }

    public function edit($id)
    {
	    $custo = Custo::find($id);
	    return view('custo.edit', compact('custo'));
    }

    public function update(Request $request, $id)
    {
	    $this->validate($request, $this->validatorFields($id));

	    $request['valor'] = str_replace(',', '.', $request['valor']);

	    $custo = Custo::find($id);
	    $custo->update($request->all());

	    session()->flash('success', 'Dados do Tipo de Custo atualizado com sucesso.');

	    return redirect()->route('custo.index');
    }

    public function destroy($id)
    {
	    Custo::find($id)->delete();
	    session()->flash('success', 'Tipo de Custo excluído com sucesso.');

	    return redirect()->route('custo.index');
    }

    public function restroy($id)
    {
	    $custo = Custo::withTrashed()->whereId($id)->first();
	    $custo->restore();

	    session()->flash('success', 'Tipo de Custo restaurado com sucesso.');

	    return redirect()->route('custo.index');
    }


    private function validatorFields($id = null)
    {
	    $fields['name'] = 'required';
	    $fields['valor'] = 'required';
	    $fields['tipo_custo_id'] = 'required';
	    
	    return $fields;
    }


}
