$(document).ready(function() {
   //Při kliknutí na registraci, schovej login a ukaž formulář registrace
    $("#signup").click(function(){
        $("#first").slideUp("slow", function(){
            $("#second").slideDown("slow");
        });
    });
    //Při kliknutí na registraci, schovej formulář registrace a ukaž login
    $("#login").click(function(){
        $("#second").slideUp("slow", function(){
            $("#first").slideDown("slow");
        });
    });
});