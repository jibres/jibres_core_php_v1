Screen Size<hr>
<script>
(function()
{

	var h = '';
	h += "<br>" + screen.height + ' - screen.height'                				// Device screen height (i.e. all physically visible stuff)
	h += "<br>" + screen.availHeight + ' - screen.availHeight'           			// Device screen height minus the operating system taskbar (if present)
	h += "<br>" + window.innerHeight + ' - window.innerHeight'           			// The current document's viewport height, minus taskbars, etc.
	h += "<br>" + window.outerHeight + ' - window.outerHeight'           			// Height the current window visibly takes up on screen
	h += "<br>" + document.body.clientHeight + ' - document.body.clientHeight'    // Height the current window visibly takes up on screen
	h += "<hr>";


	var v = '';
	v += "<br>" + document.body.clientWidth + ' - document.body'      			// Full width of the HTML page as coded, minus the vertical scroll bar
	v += "<br>" + screen.width + ' - screen.width'                   				// Device screen width (i.e. all physically visible stuff)
	v += "<br>" + screen.availWidth + ' - screen.availWidth'              		// Device screen width, minus the operating system taskbar (if present)
	v += "<br>" + window.innerWidth + ' - window.innerWidth'              		// The browser viewport width (including vertical scroll bar, includes padding but not border or margin)
	v += "<br>" + window.outerWidth + ' - window.outerWidth'              		// The outer window width (including vertical scroll bar,



	// alert(h + v);
	document.write(h + v);

})();
</script>