<?php


class WriteReview{
    var $cnt = 0;
    public function Write(){
        $this->cnt = 0;
        $name = $this->GetUser();
        if($name === 0)
           return;
        $this->cnt = 0;
        $number = $this->GetNumber();
        if($number === 0)
          return;
        if($number[0]!='+'){
           $number = '+7'.$number;
        }
        $this->cnt = 0;
        $txt = $this->GetReview();
        if($txt === 0)
          return;  
        $GLOBALS["db"]->execute("INSERT INTO `tel_num` SET `number` = '$number', `review` = '$txt', `name` = '$name', `rate` = 0, `type` = 0");  
        echo "Ваш отзыв успешно добавлен!\n";
        return;
    }
    public function GetUser(){
        echo "Введите Ваше имя или '-', если хотите оставить анонимный отзыв\n";
        $ans = readline();
        if(strlen($ans) == 0){
            if($this->cnt < 10){
                "Вы ничего не ввели, повторите попытку\n";
                $this->cnt++;
                return $this->GetUser();
            }
            else{
                echo "Вы превысили число попыток\n";
                return 0;
            }
        }
        if($ans == '-')
           $ans = 'Анонимно';
        return $ans;
    }
    public function GetNumber(){
        echo "Введите номер телефона: ";
        $number = readline();
        $now = new CheckPhone;
        $ok = $now->Test($number);
        if($ok == 0){
            if($this->cnt < 10){
            echo "Введён неверный номер телефона, повторите попытку\n";
            $this->cnt++;
            return $this->GetNumber();
            }
            else{
                echo "Вы превысили число попыток\n";
                return 0;
            }
        }
        return $ok;
    }
    public function GetReview(){
        echo "Введите свой отзыв: ";
        $txt = readline();
        if(strlen($txt) == 0){
            if($this->cnt < 10){
            echo "Введён пустой отзыв, повторите попытку\n";
            $this->cnt++;
            return $this->GetReview();
            }
            else{
                echo "Вы превысили число попыток\n";
                return 0;
            }
        }
        return $txt;
    }
}
?>