<?php
    Class DocumentService{

        public function GetDocumentAsync($Expenditure)
        {
            $now = time();
            $Year='2024';

            if($_COOKIE['month'] != '')
            {
                $Month=$_COOKIE['month'];
            }
            else
            {
                $Month= date('m', $now);   
            }

            $Url='http://expensesApi:80/api/Report/expenditure';

            $body = 
            [
                'expenditure'=>  $Expenditure,
                'month'=>(int)$Month,
                'year'=>(int)$Year,
            ];
            
            include_once 'HttpConnector.php';
            
            $HttpConnector=new HttpConnector;

            $data=$HttpConnector->GetDataByUrl($Url,$body,1);

            if($data['isSuccess'])return $this->HtmlElements($data['data']);

            return $data;
        }

        public function HtmlElements($items)
        {
            $Expenditure="";

            foreach($items as $item){

                $Color="ok";

                $Expenditure=$item['expenditure'];

                $htmlResult= $htmlResult . 
                '
                <div class="element element_color">
                    <div class="element-part element-body">
                        <div class="icon icon_colorize '. $Color .'">
                            <div class="icon-content '. $Color.'">' . substr($item['organization'],0,2) .'</div>
                        </div>
                        <div class="value-fact '. $Color.'">'. number_format( $item['value'], 0, ',', ' ').'</div>
                        <div class="icon"></div>
                    </div>
                    <div class="element-part element-footer">
                        <div class="plan-value">'. date("d.m.Y",strtotime($item['date'])). '</div>
                        <div class="expense_item expenses-element">'. $item['organization'] .'</div>
                    </div>
                </div>';
            }  

            $result = 
            [
                'html'=>$htmlResult,
                'expenditure'=> $Expenditure,
            ];
            return $result;
        }
}
?>