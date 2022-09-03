$('.news_slider').slick({
	dots: true,
	arrows: false,
	autoplay: true,
	autoplaySpeed: 4000
});

$('.product_slider').slick({
	dots: true,
	arrows: false
});

let isMobile = {
	Android: function() {return navigator.userAgent.match(/Android/i);},
	BlackBerry: function() {return navigator.userAgent.match(/BlackBerry/i);},
	iOS: function() {return navigator.userAgent.match(/iPhone|iPad|iPod/i);},
	Opera: function() {return navigator.userAgent.match(/Opera Mini/i);},
	Windows: function() {return navigator.userAgent.match(/IEMobile/i);},
	any: function() {return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());}
};

		let body=document.querySelector('body');
if(isMobile.any()){
		body.classList.add('touch');
}else{
	body.classList.add('mouse');
}


$(document).ready(function(){
	$('.burger_icon').click(function(event){
		$('.burger_submenu, .burger_icon').toggleClass('active');
		
		
	});
});