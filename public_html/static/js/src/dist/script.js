function bindShortkey(){$(document).on("keydown",function(e){event_corridor.call(this,e)})}function event_corridor(e,t,a){a||(a=e.which),t=$(t);var r=e.ctrlKey?"ctrl":"",c=e.shiftKey?"shift":"",s=e.altKey?"alt":"",o=String(a)+r+s+c;String.fromCharCode(a);switch(o){case"13":case"13ctrl":case"27":break;case"32":case"32shift":case"32ctrl":case"32ctrlshift":case"33":break;case"38":navigateonFactorAddInputs("up",e);break;case"34":break;case"40":navigateonFactorAddInputs("down",e);break;case"35":case"36":break;case"37":navigateonFactorAddInputs("left");break;case"39":navigateonFactorAddInputs("right");break;case"8":break;case"46":if(check_factor()){clearDropdown($(".dropdown.barCode"));var n=getSelectedRow(!0);n&&(n.remove(),$(".dropdown.barCode input.search").val("").trigger("focus"),calcFooterValues(),e.preventDefault())}break;case"65ctrl":case"68shift":case"70":case"72shift":break;case"56shift":case"106":var i;if(check_factor())if(i=getSelectedRow())(i=i.find("input.count")).trigger("select");break;case"107":case"187shift":check_factor()&&($(":focus").parents(".dropdown").find("#productSearch")?$(".dropdown.barCode input.search").trigger("select"):($(".dropdown.barCode input.search").trigger("select"),e.preventDefault()));break;case"109":case"189shift":var d;if(check_factor())if(d=getSelectedRow())(d=d.find("input.discount")).trigger("select");break;case"110":case"190":break;case"111":case"191":check_factor()&&($(":focus").parents(".dropdown").find("#productSearch")?$(".dropdown.barCode input.search").trigger("select"):($(".dropdown.barCode input.search").trigger("select"),e.preventDefault()));break;case"112":break;case"113":e.preventDefault();var l=$("body").attr("data-page"),f="/a/sale?from="+l,u=$("body").attr("data-page");if(void 0!==$("html").attr("lang")&&(f=$("html").attr("lang")+f),"sale"===u&&check_factor())if(0==qtyFactorTableItems()){var p=$("#factorAdd").attr("data-msgNewError");notif("warn",p,null,null,{displayMode:2})}else window.open(f+"&extra=true","_blank");else"chap_receipt"===l?Navigate({url:f}):window.open(f,"_blank");break;case"113shift":prevFactor();break;case"113ctrlshift":prevFactor(void 0,!0);break;case"114":case"114ctrl":case"70ctrl":logy($("input.search")),logy($("input.search").length),1===$("input[type=search]").length?($("input[type=search]").trigger("focus"),e.preventDefault()):2===$("select input.search").length&&($("input.search").trigger("focus"),e.preventDefault());break;case"115":break;case"118":check_factor()&&(shortkey_toggleDiscount(),e.preventDefault());break;case"119":case"122shift":case"123":case"click":case"rightclick":break;default:return}}function getSelectedRow(e){if(check_factor()&&0<$("table.productList tbody tr").length){var t=$("table.productList tbody tr[data-selected]");if(1==t.length);else{if(e)return $("table.productList tbody tr:eq(0)").attr("data-selected","warn"),!1;t=$("table.productList tbody tr:eq(0)")}return t}return null}function check_factor(){return 0<$("#factorAdd").length}