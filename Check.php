<?php
class CheckPhone{
    public function Test($number){
       if(strlen($number)<10 || strlen($number)>15){
           return 0;
       }
       elseif($this->ProvNumber($number) == 0){
           return 0;
       }
       elseif($this->CheckCode($number) == 'r'){
           return 0;
       }
       else return $number;
    }
    public function ProvNumber($number){
         $ok = 1;
         for($i = 0; $i < strlen($number); $i++){
             if($i == 0){
              if($number[$i] != '+' && ($number[$i]<'0' || $number[$i]>'9'))
                 $ok = 0;
             }
             else{
              if($number[$i]<'0' || $number[$i]>'9')
              $ok = 0;
             }
         }
         return $ok;
    }
    public function CheckCode($number){
        if($number[0]!='+')
        return 'Россия';
        if($number[1] == '1' && $number[2] == '9' && $number[3] == '0' && $number[4] == '5')
        return 'Мексика';
        if($number[1] == '7')
        return 'Россия';
        if($number[1] == '1')
        return 'США';
        if($number[1] == '8' && $number[2] == '6')
        return 'Китай';
        if($number[1] == '5' && $number[2] == '2')
        return 'Мексика';
        return 'r';
    }
}
?>