<?php
    Class ExpensesReportService{

        public function GetReport()
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

                $Url='http://expensesApi:80/api/Report/Expenditures';

                $body = 
                [
                    'login'=> $_COOKIE['login'] ,
                    'password'=> $_COOKIE['password'],
                    'month'=>(int)$Month,
                    'year'=>(int)$Year,
                ];
                        
                $data=$HttpConnector->GetDataByUrl($Url,$body,1);
                if($data['isSuccess'])return $data["data"];
            }
            return null;
        }

        public function GetReportAsync($login,$password,$pencilUrl)
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

            if($login != '' && $password != '')
            {
                include_once 'HttpConnector.php';
                $HttpConnector=new HttpConnector;

                $Url='http://expensesApi:80/api/Report/Expenditures';

                $body = 
                [
                    'login'=>$login ,
                    'password'=> $password,
                    'month'=>(int)$Month,
                    'year'=>(int)$Year,
                ];
                $data=$HttpConnector->GetDataByUrl($Url,$body,1);
                //$Result=$this->HtmlElements($data['data']);
                if($data['isSuccess'])return $this->HtmlElements($data['data'],$pencilUrl);

            }

            return null;
        }

        public function HtmlElements($items,$pencilUrl)
        {
            $UserName="";
            foreach($items as $item){
                $Color=$item['value']>$item['target']?"none":"ok";
                $UserName=$item['responsible'];

                $htmlResult= $htmlResult . 
                '
                <div class="element element_color">
                    <div class="element-part element-body">
                        <div class="icon icon_colorize '. $Color .'">
                            <div class="icon-content '. $Color.'">' . substr($item['expenditure'],0,2) .'</div>
                        </div>
                        <div class="value-fact '. $Color.'">'. number_format( $item['value'], 0, ',', ' ').'</div>
                        <div class="icon pencil-container">
                            <img src="'. $pencilUrl .'" alt="Редактировать" class="pencil"></img>
                        </div>
                    </div>
                    <div class="element-part element-footer">
                        <div class="plan-value">'. number_format( $item['target'], 0, ',', ' ').'</div>
                        <div class="expense_item expenses-element">'. $item['expenditure'].'</div>
                    </div>
                </div>';
            }  

            $result = 
            [
                'html'=>$htmlResult,
                'user'=> $UserName
            ];
            return $result;
        }
}
?>