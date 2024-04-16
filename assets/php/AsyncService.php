<?php

    if( $_POST['service']=="ExpencesReport"){

        include_once 'ExpensesReportService.php';

        $ExpensesReportService=new ExpensesReportService;
        
        $result=$ExpensesReportService->GetReportAsync($_POST['login'],$_POST['password']);

        setcookie('login', $_POST['login'], time()+3600*24*30,"/");
        setcookie('password',  $_POST['password'], time()+3600*24*30,"/");
        
    }
    elseif($_POST['service']=="Document")
    {
        include_once 'DocumentService.php';

        $DocumentService=new DocumentService;

        $result=$DocumentService->GetDocumentAsync($_POST['expenditure']);
    }
    
    echo json_encode($result);


?>