$(document).ready(function() {
const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

accordionItemHeaders.forEach(accordionItemHeader => {
  accordionItemHeader.addEventListener("click", event => {

    // Uncomment in case you only want to allow for the display of only one collapsed item at a time!

    // const currentlyActiveAccordionItemHeader = document.querySelector(".accordion-item-header.active");
    // if(currentlyActiveAccordionItemHeader && currentlyActiveAccordionItemHeader!==accordionItemHeader) {
    //   currentlyActiveAccordionItemHeader.classList.toggle("active");
    //   currentlyActiveAccordionItemHeader.nextElementSibling.style.maxHeight = 0;
    // }

    accordionItemHeader.classList.toggle("active");
    const accordionItemBody = accordionItemHeader.nextElementSibling;
    if(accordionItemHeader.classList.contains("active")) {
      accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
      accordionItemBody.style.border = "1px solid #E4E4E4"
    }
    else {
      accordionItemBody.style.maxHeight = 0;
      accordionItemBody.style.border = 0
    }

  });
});

});
    function myFunction() {
    document.getElementById("try").style.backgroundColor = "#F5F6FA";
     document.getElementById("try").style.border = 0;
}

$('.alert-close').on('click',function (){
    $(this).parent().parent().remove();
});
function AddNotify(id,title,message,type = null,is_auto_hide = false){
    $('#Notifications').append('<div class="alert alert-success top-alert top-alert-primary" id="Notification-'+id+'" role="alert">' +
                                '    <div class="exit">' +
                                '        <button class="alert-close"><i class="fas fa-times"></i></button>' +
                                '    </div>' +
                                '    <h4 class="alert-heading"> <i class="fas fa-exclamation-circle alert-icon"></i>&nbsp; '+title+' </h4>' +
                                '    <p>'+message+'</p>' +
                                '</div>');
    if (is_auto_hide){
        setTimeout(function (){
            $('#Notification-'+id).remove();
        },5000);
    }
}
let adBlockEnabled = false
const ad = document.createElement('div')
ad.innerHTML = '&nbsp;'
ad.className = 'adsbox'
document.body.appendChild(ad)
window.setTimeout(function() {
    if (ad.offsetHeight === 0) {
        adblockEnabled = true;
        AddNotify(1,'Adblock !','Please disable adblock to enjoy using our website !');
    }
    ad.remove();
}
, 100)
