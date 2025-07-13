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

}