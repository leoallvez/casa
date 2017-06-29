<?php
/**
 * Esse helper aplica uma mascara de acordo com o parametro passado.
 * Exemplo:
 *  $cnpj = '123456789000120';
 *  $cnpjFormatado = setMascara($cnpj,'##.###.###/####-##');
 * @param [type] $val  Valor a ser aplicado a mascara.
 * @param [type] $mask mascara a ser aplicada.
 */
function setMascara($val, $mask ) {
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