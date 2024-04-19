<?php
    Class HttpConnector
    {
        public function GetByUrl($Url, $bodyData, $Method)
        {
            $ch = curl_init();
                
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, $Url);
            $curl_result = curl_exec($ch);

            $data=json_decode($curl_result,true);
            curl_close($ch);
                    
            return $data;
        }

        public function GetDataByUrl($Url, $bodyData, $Method)
        {
              $curl = curl_init();
              curl_setopt($curl, CURLOPT_URL, $Url);
              curl_setopt($curl, CURLOPT_POST, true);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
            $headers = array(
              "Accept: application/json",
              "Content-Type: application/json",
            );
          
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($bodyData, JSON_UNESCAPED_UNICODE));
                
            $curl_result = curl_exec($curl);

            curl_close($curl);

            $data=json_decode($curl_result,true);
          
            return $data;   
        }    
    }
?>