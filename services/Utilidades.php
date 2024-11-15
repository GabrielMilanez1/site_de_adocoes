<?php

Class Utilidades
{
  public static function formatarCelular($numero)
  {
    $numero = preg_replace("/[^0-9]/", "", $numero);
    $numeroFormatado = '(' . substr($numero, 0, 2) . ') ' . substr($numero, 2, 1) . ' ' . substr($numero, 3, 4) . '-' . substr($numero, 7, 4);
    
    return $numeroFormatado;
  }
}