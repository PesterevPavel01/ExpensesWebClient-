let initFlag=true;
let initChange=true;

var swiper_month=new Swiper('.swiper-month',{  

    speed:5,
    effect: 'fade',

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    on:{

        init: function (swiper_month) 
        {
          console.log("Init");
          console.log("Cookie");
          console.log(getCookie('month'));
          
          if(getCookie('month')===undefined || getCookie('month')===""){
            let date =new Date();
            let month = date.getMonth();
            swiper_month.slideTo(month);
            setCookie('month',month,10);
          }
          else
          {
            swiper_month.slideTo(parseInt(getCookie('month')));
          } 
          initFlag=false;
        },

        activeIndexChange: function (swiper_month) 
        {
          if(initFlag)
          {
            return;
          }

          if(getCookie('month')!=undefined)
          {
            console.log("IndexChange");
            console.log("Cookie");
            console.log(swiper_month.realIndex+1);
            setCookie('month',swiper_month.realIndex+1,10);
            setCookie('2024',swiper_month.realIndex,10);
          }
        }
      },
    loop:true,
    centeredSlides:true,
}); 

function getCookie(name) {
  var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name,value,days) {
  var expires = "";
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days*24*60*60*1000));
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}