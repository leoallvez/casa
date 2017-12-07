<?php
use Casa\Etnia;
use Casa\Adotivo;
use Casa\AdotivoStatus;
/**
 * Esse helper aplica uma mascara de acordo com o parametro passado.
 * Exemplo:
 *  $cnpj = '123456789000120';
 *  $cnpjFormatado = setMascara($cnpj,'##.###.###/####-##');
 * @param [type] $val  Valor a ser aplicado a mascara.
 * @param [type] $mask mascara a ser aplicada.
 */
function setMascara($val, $mask ) 
{
  $maskSize =  strlen($mask);

  if(strlen($val) >= $maskSize){
  	return $val;
  }
  $maskared = '';
  $k = 0;
  for($i = 0; $i <= $maskSize-1; $i++) {
    if($mask[$i] == '#') {
        if(isset($val[$k]))
        $maskared .= $val[$k++];
    } else {
        if(isset($mask[$i]))
        	$maskared .= $mask[$i];
    } 
  }
  return $maskared;	
}

/**
 * Função usada na drop down list de relatório como filtro 
 * de idades
 * @return [array] $idades um array de strings.
 */

function getIdadesHelper() : array
{
  $idades[''] = "Todas Idades";
  $idades[0]  = "Menos de 1 ano";
  $idades[1]  = "1 ano";

  for($i = 2; $i < 18; $i++) {
    $idades[$i] = $i." anos";    
  }

  $idades[] = "18 anos ou mais";

  return $idades;
}

/**
 * Converte uma collection de AdotivoLog para uma
 * collection de Adotivo.

 * @param [Collections] $adotivosLogs  collection de AdotivoLog
 * @return [Collections] $adotivo collection de Adotivo.
 */

function logsToAdotivosHelper($adotivosLogs) 
{
  $adotivos = collect();

  foreach($adotivosLogs as $log) {

    $adotivo = new Adotivo(json_decode($log->adotivoJSON, true));

    $adotivos->prepend($adotivo);
  }
  return $adotivos;
}

function porcentagemAdotivoSexoHelper($adotivos) : array
{
  $total = $adotivos->count();

  $sexoFeminino  = $adotivos->where("sexo","F")->count();

  $sexoMasculino = $adotivos->where("sexo","M")->count();

  $f = new \stdClass();
  $f->name = "Feminino";
  $f->y = porcentagem($total, $sexoFeminino);
  #$f->drilldown = "Feminino";

  $m = new \stdClass();
  $m->name = "Masculino";
  $m->y = porcentagem($total, $sexoMasculino);
  #$m->drilldown = "Masculino";

  return [$f, $m];
}

function quantidadePorStatusHelper($adotivos) : array
{
  $resultado = []; 

  foreach (AdotivoStatus::all() as $status) {
  
    $quantidade = $adotivos->where("status_id", $status->id)->count();
    $resultado[] = [$status->nome, $quantidade];

  }
  return $resultado;
}

function quantidadePorEtniaHelper($adotivos) : array
{
  $resultado = []; 
  $total = $adotivos->count();

  foreach (Etnia::all() as $etnia) {

    $quantidade = $adotivos->where("etnia_id", $etnia->id)->count();

    $std = new \stdClass();
    $std->name = $etnia->nome;
    $std->y = $quantidade;

    $resultado[] = $std;
  }
  return $resultado;
}

function porcentagem($valor_inicial, $valor_final) 
{

  if($valor_inicial > 0 && $valor_final > 0) {
    return (($valor_final - $valor_inicial) / $valor_inicial * 100) * -1;
  }

  return 0;
}


