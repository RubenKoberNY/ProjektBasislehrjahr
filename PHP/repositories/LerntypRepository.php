<?php


class LerntypRepository
{
    public function __construct()
    {
        @$a=$_POST[''];
        @$b=$_POST['sex'];
        if(@$_POST['submit'])
        {
            echo $s="insert into benutzerantwort(name,sex) values('$a','$b')";
            echo "Your Data Inserted";
            mysql_query($s);
        }
    }

}
