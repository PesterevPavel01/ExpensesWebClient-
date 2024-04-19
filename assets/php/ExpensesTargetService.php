<?php
    Class ExpensesTargetService{

        public function SetTargetAsync($expenses,$target)
        {
            
            $now = time();

            if($_COOKIE['month'] != '')
            {
                $Month=$_COOKIE['month'];
            }
            else
            {
                $Month= date('m', $now);   
            }
            
            $Year='2024';
            
            if($_COOKIE['login'] != '' && $_COOKIE['password'] != '')
            {
                
                include_once 'HttpConnector.php';
                $HttpConnector=new HttpConnector;
                
                $Url='http://expensesApi:80/api/Target/update';

                $body = 
                [
                    'Id'=>0,
                    'Expenditure'=>$expenses,
                    'Value'=> (double)$target,
                    'month'=>(int)$Month,
                    'year'=>(int)$Year,
                ];

                $data=$HttpConnector->GetDataByUrl($Url,$body,1);

                if($data['isSuccess'])return $data['data'];
            }
            return null;
        }
}
?>