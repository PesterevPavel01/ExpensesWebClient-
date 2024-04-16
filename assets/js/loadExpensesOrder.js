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
    expensesClick();
}

function DocumentIsSucsess(data)
{
    $result=(JSON.parse(data));
    console.log($result);
    $("#element-container").html($result['html']);
    $("#user").html($result['user']);
    expensesClick();
}

function expensesClick(){

    let $elements=$('.expenses-element');
    console.log($elements);
    
    $elements.each(function(){
        $( this ).bind('click',function(el){
            console.log($( this ).text());
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

$(document).ready(function(){

    $("#btn-login").bind('click',function(){ 

        let body=
        {
            login:$("#login").val(),
            password: $("#password").val(),
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

    });

    expensesClick();

});

