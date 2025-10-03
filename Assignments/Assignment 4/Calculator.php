<?php
class Calculator {
    public function calc($op=null,$a=null,$b=null){
        if(func_num_args()!=3){
            return "<p>Cannot perform operation. You must have three arguments. A string for the operator (+,-,*,/) and two integers or floats for the numbers.</p>";
        }
        if(!in_array($op,['+','-','*','/'])){
            return "<p>Invalid operator. Use one of +, -, *, /.</p>";
        }
        if(!is_numeric($a)||!is_numeric($b)){
            return "<p>Invalid numbers. Both must be integers or floats.</p>";
        }
        if($op=='/'&&$b==0){
            return "<p>The calculation is $a $op $b. The answer is cannot divide a number by zero.</p>";
        }
        if($op=='+'){$ans=$a+$b;}
        if($op=='-'){$ans=$a-$b;}
        if($op=='*'){$ans=$a*$b;}
        if($op=='/'){$ans=$a/$b;}
        return "<p>The calculation is $a $op $b. The answer is $ans.</p>";
    }
}
?>
