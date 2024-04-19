addEvents_redactorOpenClick();

function addEvents_redactorOpenClick(){

    let $elements=$('.pencil-container');

    $elements.each(function(){
        $( this ).bind('click',function(){
            let $container=$( this ).parent();
            let $body=$container.parent();
            let $expenditure=$body.find(".expense_item");
            expenditureRedactorEnable($expenditure.text());
         });
    });

}