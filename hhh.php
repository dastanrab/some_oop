<?php
$r=14;
$o=2;
for($i=$r;$i>=$o;$i--) {
        for ($j = $r; $j >=$o; $j--) {
            {if (sqrt($i * $i + $j * $j) > $r) {
                echo "*";
            }
            else{

                echo "#";

            }}


    }
        for ($j = $o; $j <= $r; $j++) {

                if (sqrt($i * $i + $j * $j) > $r) {
                echo "*";
            }
            else{

                echo "#";

            }


        }


    echo "<br>";
}

for($i=$o;$i<=$r;$i++) {

        for ($j = $r; $j >= $o; $j--) {

            if (sqrt(($i+1) * ($i+1) + ($j+1) * ($j+1)) >= $r) {//به این باید اضافه بشه تا از چپ به تعداد عددی که به i و j اضافه میشه انتقال پبدا کنه
                echo "*";
            }
            else{

                echo "#";

            }

        }
        for ($j = $o; $j <= $r; $j++) {
            if (sqrt(($i) * ($i) + ($j) * ($j)) >= $r) {
                echo "*";
            }
            else{

                echo "#";


            }

        }





    echo "<br>";
}




?>

