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