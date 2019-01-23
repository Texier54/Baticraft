function image(imagenom){ //Fonction pour supprimer # dans l'image
	var myString = document.getElementById(imagenom);
	var v = myString.getAttribute("src");
	v = v.replace('little/', '');
	myString.setAttribute("src", v);
}

$(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

	$('a[data-modal-id]').click(function(e) { //Fonction pour ouvrir un modal
		e.preventDefault();
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#'+modalBox).fadeIn($(this).data());
	});

		
	$('a[data-modal-id-2]').click(function(e) { //Fonction pour révourir nouveau modal quand on est déjà dans un un
		    $(".modal-box, .modal-overlay").fadeOut(0, function() {
        $(".modal-overlay").remove();
    	});
		e.preventDefault();
    	$("body").append(appendthis);
    	$(".modal-overlay").fadeTo(0, 0.7);
    	//$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id-2');
		$('#'+modalBox).fadeIn($(this).data());
	});  
  
  
$(".js-modal-close, .modal-overlay").click(function() {
    $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
    });
 
});

 
$(window).resize(function() { //Mettre le modal au milieu
    $(".modal-box").css({
        //top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 2
    });
});
 
$(window).resize();
 
});