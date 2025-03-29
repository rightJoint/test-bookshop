$(document).ready(function (){
    console.log('books-report');
    $(".report span.books").click(function () {
        if($(this).html() == "+"){

            $(this).parent().find("ul").slideDown("slow");
            $(this).html("-");
        }else{
            $(this).parent().find("ul").slideUp("slow");
            $(this).html("+");
        }
    });
})