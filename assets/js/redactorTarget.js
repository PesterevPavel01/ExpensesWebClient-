
$(document).ready(function(){

    console.log("START");
    InitOpenButtonEvent();
    addEvents_redactorCloseClick();
    addEvents_saveTargetClick();
    expenditureRedactorDisable();

});

function InitOpenButtonEvent(){
    $.ajax({
        url:"./wp-content/themes/expenses/assets/js/redactor-OpenButtonEvent.js",
        dataType:"script",
    });
}
function IsSucsess(data)
{
    $result=(JSON.parse(data));

    if($result['expenditure']!=null)
        SetNewTargetPage($result['expenditure'],$result['value'],$result['month']);
    
    $('#expenditure-redactor-target').val("");

}

function SetNewTargetPage($Expenditure,$Target,$Month){

    if(getCookieValue("month")!=$Month)
        return;

    let $elements=$('.element');

    $elements.each(function(){

        let $expenditure=$( this ).find(".expense_item");

        if($expenditure.text()==$Expenditure)
        {
            let $target=$( this ).find(".plan-value");
            $target.text($Target);
            return;
        }
    });

}

function addEvents_redactorCloseClick()
{

    let $closeButton=$('.expenditure-redactor-close-button');

    $closeButton.bind('click',function(){

        expenditureRedactorDisable();

    });
    
}

function addEvents_saveTargetClick(){

    console.log("addEvents_redactorCloseClick");

    let $saveButton=$('.expenditure-redactor-button');

    console.log($saveButton);

    $saveButton.bind('click',function(el){

        let body=
        {
            expenditure: $(".expenditure-redactor-title").text(),
            target:$('#expenditure-redactor-target').val(),
            service:"SetTarget"
        };

        console.log(body);

        $.ajax({
            url:"./wp-content/themes/expenses/assets/php/AsyncService.php",
            type:"POST",
            data:(body),
            dataType:"html",
            success: IsSucsess
        });

     });
}

function expenditureRedactorDisable(){

    console.log("footerDisable");
    $(".footer").removeClass( "enable" );
    $(".footer").addClass( "disable" );
    $(".expenditure-redactor-title").text("Наименование статьи");

}

function expenditureRedactorEnable(expenditure){

    console.log("footerEnable");
    $(".footer").removeClass( "disable" );
    $(".footer").addClass( "enable" );
    $(".expenditure-redactor-title").text(expenditure);

}

function getCookieValue(name) 
{
    const regex = new RegExp(`(^| )${name}=([^;]+)`)
    const match = document.cookie.match(regex)
    
    if (match) {
        return match[2]
    }
}