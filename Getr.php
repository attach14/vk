<?php



class GetReviews{ 
    public $cnt;
    public function Reviews(){
        $this->cnt = 0;
        $number = $this->GetNumber();
        if($number === 0)
        return;
        $all = $GLOBALS["db"]->query("SELECT * FROM `tel_num` WHERE `tel_num`.`number` = '$number'");
        if(count($all)){
        print_r($all);
        $this->RateReviews($number);
        }
        else
        echo "Отзывов о введённом номере нет\n";
    }
    public function RateReviews($number){
        $record = $GLOBALS["db"]->query("SELECT * FROM `tel_num` WHERE `tel_num`.`number` = '$number'");
        $list = array();
        foreach($record as $row){
            $list[] = $row;
        }
        echo "Введите цифру 1, если Вы авторизованы и хотите лайкнуть какой-то отзыв\n";
        echo "Введите цифру 2, если Вы авторизованы и хотите дизлайкнуть какой-то отзыв\n";
        $ans = readline();
        if($ans == 1){
           echo "Введите id нужного отзыва: ";
           $fn = readline();
           $ok = 0;
           for($i = 0;$i < count($list); $i++){
               if($list[$i]['id'] == $fn){
                   $ok = 1;
                   $list[$i]['rate']++;
                 $id = $list[$i]['id'];
                 $txt = $list[$i]['review'];
                 $name = $list[$i]['name'];
                 $rate = $list[$i]['rate'];
                 $GLOBALS["db"]->query("DELETE FROM `tel_num` WHERE `tel_num`.`id` = $id");
                 $GLOBALS["db"]->execute("INSERT INTO `tel_num` SET `id` = $id, `number` = '$number', `review` = '$txt', `name` = '$name', `rate` = $rate, `type` = 0"); 
                 break;
               }
           }
           if($ok){
               echo "Рейтинг отзыва был повышен\n"; 
           }
           else{
               echo "Вы ввели некорректное значение id\n";
           }
        }
        elseif($ans == 2){
            echo "Введите id нужного отзыва: ";
            $fn = readline();
            $ok = 0;
            for($i = 0;$i < count($list); $i++){
                if($list[$i]['id'] == $fn){
                    $ok = 1;
                    $list[$i]['rate']--;
                  $id = $list[$i]['id'];
                  $txt = $list[$i]['review'];
                  $name = $list[$i]['name'];
                  $rate = $list[$i]['rate'];
                  $GLOBALS["db"]->query("DELETE FROM `tel_num` WHERE `tel_num`.`id` = $id");
                  $GLOBALS["db"]->execute("INSERT INTO `tel_num` SET `id` = $id, `number` = '$number', `review` = '$txt', `name` = '$name', `rate` = $rate, `type` = 0"); 
                  break;
                }
            }
            if($ok){
                echo "Рейтинг отзыва был понижен\n"; 
            }
            else{
                echo "Вы ввели некорректное значение id\n";
            }
        }
        else return;
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
}
?>