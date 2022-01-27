<?php
namespace App\Helpers;

class Helper{

    public static function SayHello()
    {
        return "SayHello";
    }
    public static function SayHello2()
    {
        return "SayHello";
    }
    public static function GetEmi($principal,$interest,$term,$term_frequency=12,$which_term)
    {
        echo 'dd';die;
        $rate = $interest/100/$term_frequency;
        $time = $term*$term_frequency;// in month
        $x= pow(1+$rate,$time);
        $monthly = ($principal*$x*$rate)/($x-1);
        $monthly = round($monthly);
        $k= $time;
        $arr= array();
        $upto = $time;
        return self::getEmiTerm($principal,$which_term,$upto,$rate,$monthly,$principal);
    }
    public static function getEmiTerm($t,$which_term,$upto,$rate,$monthly,$tl,$i=0){
        $i++;
        if($upto<=0){
            return 0;
        }
        $r = $t*$rate;
        $p = round($monthly-$r);
        $e= round($t-$p);
        if($upto==2){
            $tl= $e;
        }
        if($upto==1){
            $p= $tl;	
            $e= round($t-$p);
            $monthly= round($p+$r);
        }
        if($i==$which_term){
            return $monthly;
        }else{
            $upto--;
            self::getEmiTerm($e,$which_term,$upto,$rate,$monthly,$tl,$i);
        }
    }
}

