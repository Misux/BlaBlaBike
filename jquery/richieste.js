//effetto di show e hide per le richieste profilo
$(document).ready(function(){
    $("#hide").click(function(){
      $("p").hide("speed");
    });
    $("#show").click(function(){
        $("p").show();
    });
});
