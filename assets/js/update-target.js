let ExpensesElements=document.querySelectorAll('.element');
let updateFormBtnSuccess=document.querySelector('.timeValue_btn-success');
let currentElement;
console.log("Выполняется скрипт update-target");

    ExpensesElements.forEach((element)=>{
        element.addEventListener('click', e=>{onClick(e.target)});
    })

    function onClick(e) {
        currentElement=e;
        console.log (currentElement);
    
        document.getElementById("updateFormContainer").classList.add("open");
        
    }