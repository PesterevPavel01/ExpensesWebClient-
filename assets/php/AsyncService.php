<?php

    if( $_POST['service']=="ExpencesReport"){

        include_once 'ExpensesReportService.php';

        $ExpensesReportService=new ExpensesReportService;
        
        $result=$ExpensesReportService->GetReportAsync($_POST['login'],$_POST['password'],$_POST['pencilUrl']);

        setcookie('login', $_POST['login'], time()+3600*24*30,"/");
        setcookie('password',  $_POST['password'], time()+3600*24*30,"/");
        
    }
    elseif($_POST['service']=="Document")
    {

        include_once 'DocumentService.php';

        $DocumentService=new DocumentService;

        $result=$DocumentService->GetDocumentAsync($_POST['expenditure']);

    }
    elseif($_POST['service']=='SetTarget')
    {

        include_once 'ExpensesTargetService.php';

        $ExpensesTargetService=new ExpensesTargetService;

        $result=$ExpensesTargetService->SetTargetAsync($_POST['expenditure'],$_POST['target']);

    }
    
    echo json_encode($result);


?>