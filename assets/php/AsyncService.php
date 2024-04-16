<?php
    
    include_once 'ExpensesReportService.php';
    
    $ExpensesReportService=new ExpensesReportService;
    
    $result=$ExpensesReportService->GetReportAsync($_POST['login'],$_POST['password']);

    setcookie('login', $_POST['login'], time()+3600*24*30,"/");
    setcookie('password',  $_POST['password'], time()+3600*24*30,"/");
    
    echo json_encode($result);


?>