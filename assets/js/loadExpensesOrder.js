/*console.log("Выполняется мой скрипт");
const btn=document.querySelector('.btn-login');
const elementsContainer= document.querySelector('.element-container');

function sendRequest(method,url,body=null)
{
    return new Promise((resolve,reject)=>{
        const request=new XMLHttpRequest();
        request.open(method,url);
        request.responseType='json';
        request.setRequestHeader('Content-Type','application/json');

        request.onload=()=>{
            reject(request.response);
        }

        request.send(JSON.stringify(body));
    })
}

const body={
    login:'JuravlevaG',
    password: 'Jur12GU',
    month:4,
    year:2024
}
console.log(JSON.stringify(body));
sendRequest('POST','http://expensesApi:80/api/Report/Expenditures',body)



$(document).ready(
    function(){
        $(document).ready(function(){
            $("form").on('submit',function(event){
              event.preventDefault();  
              $.post(,$(this).serialize());
            });
        });
    }
)*/
           
function IsSuccess(data)
{
    $result=(JSON.parse(data));
    console.log($result);
    $("#element-container").html($result['html']);
    $("#user").html($result['user']);
    $(".title").html("Бюджет");
    expensesClick();
}

function DocumentIsSucsess(data)
{
    $result=(JSON.parse(data));
    console.log($result);
    console.log('статья затрат: '+$result['expenditure']);
    $(".title").html($result['expenditure']);
    $("#element-container").html($result['html']);
    closeButtonEnable();
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
        service:"ExpencesReport"
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
    console.log();
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
