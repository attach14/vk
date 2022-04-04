<?php
class FindReviews{
    public function GetNumber(){
       echo "Введите начало номера телефона: ";
       $number = readline();
       if($number[0]!='+')
       $number='+7'.$number;
       $record = $GLOBALS["db"]->query("SELECT * FROM `tel_num`");
       $ans = array();
       $ok = 0;
       $list = array();
       foreach($record as $row){
           $list[] = $row;
       }
       for($i = 0;$i<count($list);$i++){
           if($list[$i]['type'])
             continue;
           $ok = 1;
           if(strlen($number)> strlen($list[$i]['number']))
           continue;
           for($y = 0;$y<strlen($number);$y++){
               if($number[$y]!=$list[$i]['number'][$y])
                 $ok = 0;
           }
           if($ok == 0)
           continue;
           $cnt = 1;
           for($y = $i + 1;$y<count($list);$y++){
            if($list[$i]['number'] == $list[$y]['number']){
                $cnt++;
                $list[$y]['type'] = 1;
            }
           }
           $cur = $list[$i]['number'];
           $ans[$cur]=$cnt;
       }
       if(count($ans) == 0){
           echo "Подходящие номера не были найдены\n";
            return;
       }
       else{
           echo "Все подходящие номера:\n";
           foreach($ans as $key => $value)
           echo "Номер ".$key.", количество отзывов = ".$ans[$key]."\n";
       }
    }
}  
?>