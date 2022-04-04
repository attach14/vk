<?php
include 'data.php';
include 'Check.php';
include 'Country.php';
include 'Write.php';
include 'Getr.php';
include 'Findr.php';
$db = new DataBase;
class Console{
    public function user(){
    echo "Введите цифру 1,если хотите узнать страну телефонного номера\n";
    echo "Введите цифру 2,если хотите оставить отзыв\n";
    echo "Введите цифру 3,если хотите найти все отзывы о телефонном номере\n";
    echo "Введите цифру 4,если хотите найти количество отзывов о телефонных номерах по их началу\n";
    echo "Введите что-либо другое для завершения сеанса\n";
    $ans = readline();
    if($ans == 1){
      $now = new Country;
      $now->GetCountry();
      $this->user();
      return;
    }
    if($ans == 2){
        $now = new WriteReview;
        $now->Write();
        $this->user();
        return;
    }
    if($ans == 3){
        $now = new GetReviews;
        $now->Reviews();
        $this->user();
        return;
    }
    if($ans == 4){
        $now = new FindReviews;
        $now->GetNumber();
        $this->user();
        return;
    }
    return;
    }
}
$a = new Console;
$a->user();
?>
