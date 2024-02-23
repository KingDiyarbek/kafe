$(document).ready(function() {
	$('.header__burger').click(function() {
		$('.header__burger,.header-menu').toggleClass('active'); /*С‚РѕРіРіР» - РїСЂРё РєР»РёРєРµ РґРѕР±Р°РІР»СЏРµС‚/СѓР±РёСЂР°РµС‚ РєР»Р°СЃСЃ active*/
		$('body').toggleClass('lock'); /*С‚РѕР¶Рµ СЃР°РјРѕРµ СЃ С‚РµРіРѕРј Body*/
	});
});