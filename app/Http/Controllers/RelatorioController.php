<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receita;
use App\Models\Custo;
use App\Models\TipoCusto;
use App\Models\TipoPagamento;
use App\Models\TipoReceita;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function welcome()
    {
    	$retorno = new \stdClass();
    	$historico = new \stdClass();

    	$retorno->receita = Receita::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('valor');

        $retorno->receita_dia = Receita::whereDate('created_at', date('Y-m-d'))->sum('valor');

        $retorno->receita_anual = Receita::whereYear('created_at', date('Y'))->sum('valor');

    	$retorno->custo = Custo::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('valor');

        $retorno->custo_anual = Custo::whereYear('created_at', date('Y'))->sum('valor');

    	$retorno->qtd_servico = Receita::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();

        $retorno->qtd_servico_dia = Receita::whereDate('created_at', date('Y-m-d'))->count();

        $retorno->qtd_servico_mes_ant = Receita::whereMonth('created_at', date('m', strtotime('last month')))
                                    ->whereYear('created_at', date('Y', strtotime('last month')))
                                    ->count();

		$retorno->receitas_tp_pgto_mes = [];
		$retorno->receitas_tp_receita_mes = [];
        
        if ($retorno->qtd_servico_mes_ant == 0)
            $retorno->diff_qtd_servico = 0;
        else
            $retorno->diff_qtd_servico = round(($retorno->qtd_servico - $retorno->qtd_servico_mes_ant) * 100 / $retorno->qtd_servico_mes_ant, 2);
        
        $retorno->qtd_servico_anual = Receita::whereYear('created_at', date('Y'))->count();

        $retorno->tipos_pagamento = TipoPagamento::all();
        $retorno->tipos_receita = TipoReceita::all();

        foreach ($retorno->tipos_pagamento as $tipo_pagamento)
        {
            $retorno->receitas_tp_pgto_mes[] = Receita::whereMonth('created_at', date('m'))
                                            ->whereYear('created_at', date('Y'))
                                            ->where('tipo_pagamento_id', $tipo_pagamento->id)
                                            ->sum('valor');
        }

        foreach ($retorno->tipos_receita as $tipo_receita)
        {
            $retorno->receitas_tp_receita_mes[] = Receita::whereMonth('created_at', date('m'))
                                            ->whereYear('created_at', date('Y'))
                                            ->where('tipo_receita_id', $tipo_receita->id)
                                            ->sum('valor');
        }

        $retorno->tipos_pagamento = json_encode($retorno->tipos_pagamento->pluck('name')->toArray());
        $retorno->tipos_receita = json_encode($retorno->tipos_receita->pluck('name')->toArray());
        $retorno->receitas_tp_pgto_mes = json_encode($retorno->receitas_tp_pgto_mes);
        $retorno->receitas_tp_receita_mes = json_encode($retorno->receitas_tp_receita_mes);

        $meses = ['JAN','FEV','MAR','ABR','MAI','JUN','JUL','AGO','SET','OUT','NOV','DEZ'];

        $datetime = new \DateTime();

    	for ($i=0 ; $i<7 ; $i++){

			$historico->receita[] = Receita::whereMonth('created_at', $datetime->format('m'))->whereYear('created_at', $datetime->format('Y'))->sum('valor');
			$historico->custo[] = Custo::whereMonth('created_at', $datetime->format('m'))->whereYear('created_at', $datetime->format('Y'))->sum('valor');
			$historico->qtd_servico[] = Receita::whereMonth('created_at', $datetime->format('m'))->whereYear('created_at', $datetime->format('Y'))->count();
			$historico->ult_7_meses[] = $meses[$datetime->format('m') -1];

    		$datetime->modify('last month');
    	}

		$historico->receita = array_reverse($historico->receita);
		$historico->custo = array_reverse($historico->custo);
		$historico->qtd_servico = array_reverse($historico->qtd_servico);
		$historico->ult_7_meses = array_reverse($historico->ult_7_meses);

    	$historico = json_encode($historico);

    	return view('welcome', compact('retorno', 'historico'));
    }

    public function fluxo_caixa(Request $request)
    {

    	if (empty($request->get('ano_atual'))){
    		$ano_atual = date('Y');
    	} else {
    		$ano_atual = $request->get('ano_atual');
    	}

    	if ($request->get('menos') == 1){
    		$ano_atual--;
    	}
    	if ($request->get('mais') == 1){
    		$ano_atual++;
    	}

    	$estrutura = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

    	$tipos_custo = TipoCusto::all();

    	foreach ($estrutura as $key => $mes) 
    	{
    		//Custos
    		$custos_ = [];
            $total_custos = 0;
            foreach ($tipos_custo as $key2 => $tipo_custo)
            {
            	$vl_custos = Custo::whereMonth('created_at', $key+1)
            					->whereYear('created_at', $ano_atual)
            					->where('tipo_custo_id', $tipo_custo->id)
            					->sum('valor');

            	$custos_[$key2] = new \stdClass();
            	$custos_[$key2]->tipo  = $tipo_custo->name;
            	$custos_[$key2]->valor = number_format($vl_custos, 2, ',', '.');
            	$total_custos += $vl_custos;
            }

            
            //Receitas
            $pagamentos = Receita::whereMonth('created_at', $key+1)->whereYear('created_at', $ano_atual)->sum('valor');

            $estrutura[$key] = new \stdClass();
		    $estrutura[$key]->mes          = $mes;
		    $estrutura[$key]->pagamentos   = number_format($pagamentos, 2, ',', '.');
		    $estrutura[$key]->custos       = $custos_;
		    $estrutura[$key]->total_custos = number_format($total_custos, 2, ',', '.');
		    $estrutura[$key]->saldo        = number_format(($pagamentos - $total_custos), 2, ',', '.');
    	}

    	return view('fluxo_caixa', compact('estrutura', 'tipos_custo', 'ano_atual'));
    }
}
