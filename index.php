<!DOCTYPE html>

<html lang="ru" xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <title> Бюджет </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php wp_head();?>
        
        <script>
            function IsSuccess(data)
            {
                $result=(JSON.parse(data));
                $("#element-container").html($result['html']);
                $("#user").html($result['user']);
            }

            $(document).ready(function(){

                $("#btn-login").bind('click',function(){ 

                    let body=
                    {
                        login:$("#login").val(),
                        password: $("#password").val(),
                        month:4,
                        year:2024
                    };

                    $.ajax({
                        url:"<?=get_template_directory_uri(  ) ."/assets/php/AsyncService.php"?>",
                        type:"POST",
                        data:(body),
                        dataType:"html",
                        success:IsSuccess
                    })
                });
            });
        </script>

    </head>
    
    <body>

        <?php get_header(); ?>

        <main>

        <?php 

            include_once 'assets/php/ExpensesReportService.php';

            $ExpensesReportService=new ExpensesReportService;

            $items=$ExpensesReportService->GetReport();

            $UserName=(is_null($items))?'Необходимо войти':$items[0]["responsible"];
            
        ?>

        <div class="swiper">  

                <div class="swiper-wrapper">
                            
                        <div class="swiper-slide container_user" >

                            <div class="element-white element-white_color">
                                        
                                    <div class="element-form">
                                        <div class="element-form-header">
                                            <div class="user-icon-blue start_container"></div>
                                            <div></div>
                                        </div>
                                        <div class="element-form-title" id="user"><?=$UserName; ?></div>
                                    </div>

                            </div>    

                        </div>
                        
                        <div class="swiper-slide container_user" >

                            <div class="element-white element-white_color">
                    
                                <div class="element-form">

                                    <div class="element-form-header">
                                        <div class="calendar-icon-form start_container"></div>
                                        <div></div>
                                </div>
                                
                                <div class="swiper-conteiner">

                                    <div class="swiper-month">

                                        <div class="swiper-button-prev"></div>
                                        <div class="swiper-button-next"></div>

                                        <div class="swiper-wrapper">

                                            <div class="swiper-slide month">Январь</div>
                                            <div class="swiper-slide month">Февраль</div>
                                            <div class="swiper-slide month">Март</div>
                                            <div class="swiper-slide month">Апрель</div>
                                            <div class="swiper-slide month">Май</div>
                                            <div class="swiper-slide month">Июнь</div>
                                            <div class="swiper-slide month">Июль</div>
                                            <div class="swiper-slide month">Август</div>
                                            <div class="swiper-slide month">Сентябрь</div>
                                            <div class="swiper-slide month">Октябрь</div>
                                            <div class="swiper-slide month">Ноябрь</div>
                                            <div class="swiper-slide month">Декабрь</div>
                                            
                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>   
                        </div> 

                        <div class="swiper-slide container_user">

                            <div class="element-white element-white_color">

                                <?php $scriptPath=get_template_directory_uri(  ) .'/assets/php/Autorization.php'?>
                                        
                                    <div class="element-form">
                                        <div class="element-form-header">
                                            <div class="btn-success start_conteiner btn-login" id="btn-login"></div>
                                            <div></div>
                                        </div>
                                        <input type="text" class="form-control element-white_color" name="login" id="login" placeholder="Имя" >
                                        <input type="password" class="form-control element-white_color" name="password" id="password" placeholder="Пароль">
                                    </div>
                            </div>    

                        </div>
                </div>
            </div>

            <div class="title"><?=CFS()->get('main_title')?></div>


            <div class="element-container" id="element-container">
           
                <?php 
                    if(!is_null($items))
                    {
                        foreach($items as $item){

                            $Color=$item['value']>$item['target']?"none":"ok";
                            $UserName=$item["responsible"];

                ?>
                
                        <div class="element element_color">

                            <div class="element-part element-body">
                                <div class="icon icon_colorize  <?= $Color?>">
                                    <div class="icon-content  <?= $Color?>"><?= substr($item['expenditure'],0,2); ?></div>
                                </div>
                                <div class="value-fact <?= $Color?>"><?= number_format( $item['value'], 0, ',', ' '); ?></div>
                                <div class="icon"></div>
                            </div>

                            <div class="element-part element-footer">

                                <div class="plan-value"><?= number_format( $item['target'], 0, ',', ' '); ?></div>
                                <div class="expense_item"><?= $item['expenditure']; ?></div>

                            </div>

                        </div>
                <?php

                    }

                }    

                ?>

            </div>  




        <div class="updateFormContainer" id="updateFormContainer">

            <form class="updateForm" action="./assets/php/uploadValue.php" method="post">
                <?php
                echo "<input type='hidden' class='manager' name='manager' id='manager' value='error' readonly>"
                ?>
                <?php
                echo "<input type='hidden' class='update_argument' name='update_argument' id='update_argument' value='error' readonly>"
                ?>
                <input type="number" step="any" class="updateForm_value formControl" name="updateForm_value" id="time" placeholder="Отработано часов" pattern="\d+(,\d{2})?">
                <button class="timeValue_btn-success  formControl">Изменить</button>
            </form>
            
        </div>

    <?php get_footer( ); ?>