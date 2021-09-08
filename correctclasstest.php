<?php

class Model
{
    public $greet;
    public $name;
    function __construct($greet)
    {
        $this->greet = $greet;
        return $this->greet;
    }
    function set($name)
    {

        $this->name = $name." hi";
        return ($this->greet)($this->name);

    }
}
$greet = function ($name) {
    echo $name;

};
$test = new Model(function ($name) {
    echo $name." ".$name;

});
echo $test->set('i am salman');

//تست تابع بی نام در کلاس با استفاده از کلوژر نکته برای تابع با پارامتر این است که در کلاس زمانی که میخواهیم از تابع استفاده کنیم به اسم متغیری که نشان دهنده این تابع است () اضافه میکنیم و داخل ان متغیر میزاریم و اگر قبل ان فراخوانی کنیم و مقدار دهی نکنیم ارور صفر پارامتر میدهد مانند مثال دیگر که اشتباه حل شده