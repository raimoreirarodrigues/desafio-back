<?php

namespace App\Services;

class UtilService{
  
  public static function removEspecialCharacter(string $txt){
    return str_replace([" ","#","'",";","/",".","-","@","!","%","&","*","(",")","R$","US$"], '', $txt);
  }

    public static function removeMaskMoney($value){
      $step_one = str_replace(['R$','USD','EUR','$'],'',$value);
      $step_two = str_replace('.','',$step_one);
      $step_three = str_replace(',','.',$step_two);
      $step_four = str_replace(' ','',$step_three);
      return $step_four;
    }

   private static  function mask($val, $mask){
      $maskared = '';
      $k = 0;
      for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
          if ($mask[$i] == '#') {
              if (isset($val[$k])) {
                  $maskared .= $val[$k++];
              }
          } else {
              if (isset($mask[$i])) {
                  $maskared .= $mask[$i];
              }
          }
      }

      return $maskared;
  }


    public static function format_document($document){
        if(strlen($document)==14){
          return self::mask($document,'##.###.###/####-##');
        }else if(strlen($document)==11){
          return self::mask($document,'###.###.###-##');
        }

      return $document;
    }

}