       
function IsSuccess(data)
{
    $result=(JSON.parse(data));
    console.log($result);
    $("#element-container").html($result['html']);
    $("#user").html($result['user']);
    $(".title").html("Бюджет");
    expensesClick();

    $.ajax({
        url:"./wp-content/themes/expenses/assets/js/redactor-OpenButtonEvent.js",
        dataType:"script",
    })
}

function DocumentIsSucsess(data)
{
    $result=(JSON.parse(data));
    if($result['html']!=null)
    {
        $(".title").html($result['expenditure']);
        $("#element-container").html($result['html']);
        closeButtonEnable();
    }
}

function expensesClick(){

    let $elements=$('.expenses-element');

    $elements.each(function(){
        
        $( this ).bind('click',function(el){
            
            let body=
            {
                expenditure: $( this ).text(),
                service:"Document"
            };

            $.ajax({
                url:"./wp-content/themes/expenses/assets/php/AsyncService.php",
                type:"POST",
                data:(body),
                dataType:"html",
                success: DocumentIsSucsess
            })

         })
    })

}

function LoadReport($Login,$Password){
    
    let body=
    {
        login:$Login,
        password: $Password,
        month:4,
        year:2024,
        service:"ExpencesReport",
        pencilUrl:"./wp-content/themes/expenses/assets/img/Edit.svg"
    };

    $.ajax({
        url:"./wp-content/themes/expenses/assets/php/AsyncService.php",
        type:"POST",
        data:(body),
        dataType:"html",
        success:IsSuccess
    })
}

function LoginEvent(){
    $("#btn-login").bind('click',function(){ 

        LoadReport($("#login").val(), $("#password").val());

    });
}

function closeButtonDisable(){
    console.log("closeButtonDisable");
    $(".close-button").removeClass( "enable" );
    $(".close-button").addClass( "disable" );
}

function closeButtonEnable(){
    console.log("closeButtonEnable");
    $(".close-button").removeClass( "disable" );
    $(".close-button").addClass( "enable" );
}

function closeClick(){
    LoadReport(getCookieValue("login"),getCookieValue("password"));
    closeButtonDisable();
}

function closeButtunActivate(){

    console.log("closeButtunActivate");
    console.log( $(".close-button"));

    $(".close-button").on('click',function(){ 
        console.log("closeButtonClick");
        closeClick();
    });

}

$(document).ready(function(){
    LoginEvent();
    closeButtunActivate();
    expensesClick();
    closeButtonDisable();
});

function getCookieValue(name) 
    {
      const regex = new RegExp(`(^| )${name}=([^;]+)`)
      const match = document.cookie.match(regex)
      if (match) {
        return match[2]
      }
   }
