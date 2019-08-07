/*!
 * Barcoder v1.1.1
 */
!function(){"use strict";var a="1.1.1",b=6,c=18,e={ean8:{validChars:/^\d+$/,validLength:8},ean12:{validChars:/^\d+$/,validLength:12},ean13:{validChars:/^\d+$/,validLength:13},ean14:{validChars:/^\d+$/,validLength:14},ean18:{validChars:/^\d+$/,validLength:18},gtin12:{validChars:/^\d+$/,validLength:12},gtin13:{validChars:/^\d+$/,validLength:13},gtin14:{validChars:/^\d+$/,validLength:14}},f=function(a){var b=a.substring(0,a.length-1),c=parseInt(a.substring(a.length-1),10),d=0,e=0;return b.split("").map(function(b,c){b=parseInt(b,10),0===a.length%2&&(c+=1),d+=0===c%2?b:3*b}),d%=10,e=0===d?0:10-d,e!==c?!1:!0},g=function(a,b){if(a&&!e[a])throw new Error('"format" invalid');this.format=a?e[a]:"autoSelect",this.options=b?b:{enableZeroPadding:!0},this.options.enableZeroPadding||(this.options.enableZeroPadding=!0)};g.prototype.validate=function(a){var d=this;if("autoSelect"===d.format){if(a.length<b||a.length>c)return!1;var e=f(a),g=a,h=!1;if(!e)for(var i=c-a.length;i--;)if(g="0"+g,f(g)){e=!0,h=!0;break}return{possibleType:a.length>8?"GTIN"+a.length:"EAN8 / padded GTIN",isValid:e}}var j=d.format.validChars,k=d.format.validLength,l=d.options.enableZeroPadding;if(null===j.exec(a))return!1;if(l&&a.length<k)for(var m=k-a.length;m--;)a="0"+a;else{if(!l&&a.length!=k)return!1;if(a.length>k)return!1}return f(a)},"undefined"!=typeof module&&module.exports&&(module.exports=g,exports.version=a),"undefined"==typeof ender&&(this.Barcoder=g),"function"==typeof define&&define.amd&&define("Barcoder",[],function(){return g})}.call(this);


/*! JsBarcode v3.8.0 | (c) Johan Lindell | MIT license */
!function(t){function e(r){if(n[r])return n[r].exports;var o=n[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,e),o.l=!0,o.exports}var n={};e.m=t,e.c=n,e.i=function(t){return t},e.d=function(t,n,r){e.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:r})},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="",e(e.s=17)}([function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function t(e,n){r(this,t),this.data=e,this.text=n.text||e,this.options=n};e.default=o},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),i=function(){function t(){r(this,t),this.startBin="101",this.endBin="101",this.middleBin="01010",this.binaries={L:["0001101","0011001","0010011","0111101","0100011","0110001","0101111","0111011","0110111","0001011"],G:["0100111","0110011","0011011","0100001","0011101","0111001","0000101","0010001","0001001","0010111"],R:["1110010","1100110","1101100","1000010","1011100","1001110","1010000","1000100","1001000","1110100"],O:["0001101","0011001","0010011","0111101","0100011","0110001","0101111","0111011","0110111","0001011"],E:["0100111","0110011","0011011","0100001","0011101","0111001","0000101","0010001","0001001","0010111"]}}return o(t,[{key:"encode",value:function(t,e,n){var r="";n=n||"";for(var o=0;o<t.length;o++){var i=this.binaries[e[o]];i&&(r+=i[t[o]]),o<t.length-1&&(r+=n)}return r}}]),t}();e.default=i},function(t,e,n){"use strict";function r(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}Object.defineProperty(e,"__esModule",{value:!0});var o,i=e.SET_A=0,a=e.SET_B=1,u=e.SET_C=2,s=(e.SHIFT=98,e.START_A=103),f=e.START_B=104,c=e.START_C=105;e.MODULO=103,e.STOP=106,e.SET_BY_CODE=(o={},r(o,s,i),r(o,f,a),r(o,c,u),o),e.SWAP={101:i,100:a,99:u},e.A_START_CHAR=String.fromCharCode(208),e.B_START_CHAR=String.fromCharCode(209),e.C_START_CHAR=String.fromCharCode(210),e.A_CHARS="[\0-_È-Ï]",e.B_CHARS="[ -È-Ï]",e.C_CHARS="(Ï*[0-9]{2}Ï*)",e.BARS=[11011001100,11001101100,11001100110,10010011e3,10010001100,10001001100,10011001e3,10011000100,10001100100,11001001e3,11001000100,11000100100,10110011100,10011011100,10011001110,10111001100,10011101100,10011100110,11001110010,11001011100,11001001110,11011100100,11001110100,11101101110,11101001100,11100101100,11100100110,11101100100,11100110100,11100110010,11011011e3,11011000110,11000110110,10100011e3,10001011e3,10001000110,10110001e3,10001101e3,10001100010,11010001e3,11000101e3,11000100010,10110111e3,10110001110,10001101110,10111011e3,10111000110,10001110110,11101110110,11010001110,11000101110,11011101e3,11011100010,11011101110,11101011e3,11101000110,11100010110,11101101e3,11101100010,11100011010,11101111010,11001000010,11110001010,1010011e4,10100001100,1001011e4,10010000110,10000101100,10000100110,1011001e4,10110000100,1001101e4,10011000010,10000110100,10000110010,11000010010,1100101e4,11110111010,11000010100,10001111010,10100111100,10010111100,10010011110,10111100100,10011110100,10011110010,11110100100,11110010100,11110010010,11011011110,11011110110,11110110110,10101111e3,10100011110,10001011110,10111101e3,10111100010,11110101e3,11110100010,10111011110,10111101110,11101011110,11110101110,11010000100,1101001e4,11010011100,1100011101011]},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function a(t,e){for(var n=0;n<e;n++)t="0"+t;return t}Object.defineProperty(e,"__esModule",{value:!0});var u=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),s=n(0),f=function(t){return t&&t.__esModule?t:{default:t}}(s),c=function(t){function e(t,n){return r(this,e),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n))}return i(e,t),u(e,[{key:"encode",value:function(){for(var t="110",e=0;e<this.data.length;e++){var n=parseInt(this.data[e]),r=n.toString(2);r=a(r,4-r.length);for(var o=0;o<r.length;o++)t+="0"==r[o]?"100":"110"}return t+="1001",{data:t,text:this.text}}},{key:"valid",value:function(){return-1!==this.data.search(/^[0-9]+$/)}}]),e}(f.default);e.default=c},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var r in n)Object.prototype.hasOwnProperty.call(n,r)&&(t[r]=n[r])}return t};e.default=function(t,e){return r({},t,e)}},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),u=n(0),s=function(t){return t&&t.__esModule?t:{default:t}}(u),f=n(2),c=function(t){function e(t,n){r(this,e);var i=o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t.substring(1),n));return i.bytes=t.split("").map(function(t){return t.charCodeAt(0)}),i}return i(e,t),a(e,[{key:"valid",value:function(){return/^[\x00-\x7F\xC8-\xD3]+$/.test(this.data)}},{key:"encode",value:function(){var t=this.bytes,n=t.shift()-105,r=f.SET_BY_CODE[n];if(void 0===r)throw new RangeError("The encoding does not start with a start character.");var o=e.next(t,1,r);return{text:this.text===this.data?this.text.replace(/[^\x20-\x7E]/g,""):this.text,data:e.getBar(n)+o.result+e.getBar((o.checksum+n)%f.MODULO)+e.getBar(f.STOP)}}}],[{key:"getBar",value:function(t){return f.BARS[t]?f.BARS[t].toString():""}},{key:"correctIndex",value:function(t,e){if(e===f.SET_A){var n=t.shift();return n<32?n+64:n-32}return e===f.SET_B?t.shift()-32:10*(t.shift()-48)+t.shift()-48}},{key:"next",value:function(t,n,r){if(!t.length)return{result:"",checksum:0};var o=void 0,i=void 0;if(t[0]>=200){i=t.shift()-105;var a=f.SWAP[i];void 0!==a?o=e.next(t,n+1,a):(r!==f.SET_A&&r!==f.SET_B||i!==f.SHIFT||(t[0]=r===f.SET_A?t[0]>95?t[0]-96:t[0]:t[0]<32?t[0]+96:t[0]),o=e.next(t,n+1,r))}else i=e.correctIndex(t,r),o=e.next(t,n+1,r);var u=e.getBar(i),s=i*n;return{result:u+o.result,checksum:s+o.checksum}}}]),e}(s.default);e.default=c},function(t,e,n){"use strict";function r(t){for(var e=0,n=0;n<t.length;n++){var r=parseInt(t[n]);(n+t.length)%2==0?e+=r:e+=2*r%10+Math.floor(2*r/10)}return(10-e%10)%10}function o(t){for(var e=0,n=[2,3,4,5,6,7],r=0;r<t.length;r++){e+=n[r%n.length]*parseInt(t[t.length-1-r])}return(11-e%11)%11}Object.defineProperty(e,"__esModule",{value:!0}),e.mod10=r,e.mod11=o},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=function(t){function e(t,n){r(this,e);var i=o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this));return i.name="InvalidInputException",i.symbology=t,i.input=n,i.message='"'+i.input+'" is not a valid input for '+i.symbology,i}return i(e,t),e}(Error),u=function(t){function e(){r(this,e);var t=o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this));return t.name="InvalidElementException",t.message="Not supported type to render on",t}return i(e,t),e}(Error),s=function(t){function e(){r(this,e);var t=o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this));return t.name="NoElementException",t.message="No element to render on.",t}return i(e,t),e}(Error);e.InvalidInputException=a,e.InvalidElementException=u,e.NoElementException=s},function(t,e,n){"use strict";function r(t){var e=["width","height","textMargin","fontSize","margin","marginTop","marginBottom","marginLeft","marginRight"];for(var n in e)e.hasOwnProperty(n)&&(n=e[n],"string"==typeof t[n]&&(t[n]=parseInt(t[n],10)));return"string"==typeof t.displayValue&&(t.displayValue="false"!=t.displayValue),t}Object.defineProperty(e,"__esModule",{value:!0}),e.default=r},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r={width:2,height:100,format:"auto",displayValue:!0,fontOptions:"",font:"monospace",text:void 0,textAlign:"center",textPosition:"bottom",textMargin:2,fontSize:20,background:"#ffffff",lineColor:"#000000",margin:10,marginTop:void 0,marginBottom:void 0,marginLeft:void 0,marginRight:void 0,valid:function(){}};e.default=r},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function a(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function u(t){var e,n=0;for(e=1;e<11;e+=2)n+=parseInt(t[e]);for(e=0;e<11;e+=2)n+=3*parseInt(t[e]);return(10-n%10)%10}Object.defineProperty(e,"__esModule",{value:!0});var s=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}();e.checksum=u;var f=n(1),c=r(f),l=n(0),d=r(l),p=function(t){function e(t,n){o(this,e),-1!==t.search(/^[0-9]{11}$/)&&(t+=u(t));var r=i(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n));return r.displayValue=n.displayValue,n.fontSize>10*n.width?r.fontSize=10*n.width:r.fontSize=n.fontSize,r.guardHeight=n.height+r.fontSize/2+n.textMargin,r}return a(e,t),s(e,[{key:"valid",value:function(){return-1!==this.data.search(/^[0-9]{12}$/)&&this.data[11]==u(this.data)}},{key:"encode",value:function(){return this.options.flat?this.flatEncoding():this.guardedEncoding()}},{key:"flatEncoding",value:function(){var t=new c.default,e="";return e+="101",e+=t.encode(this.data.substr(0,6),"LLLLLL"),e+="01010",e+=t.encode(this.data.substr(6,6),"RRRRRR"),e+="101",{data:e,text:this.text}}},{key:"guardedEncoding",value:function(){var t=new c.default,e=[];return this.displayValue&&e.push({data:"00000000",text:this.text.substr(0,1),options:{textAlign:"left",fontSize:this.fontSize}}),e.push({data:"101"+t.encode(this.data[0],"L"),options:{height:this.guardHeight}}),e.push({data:t.encode(this.data.substr(1,5),"LLLLL"),text:this.text.substr(1,5),options:{fontSize:this.fontSize}}),e.push({data:"01010",options:{height:this.guardHeight}}),e.push({data:t.encode(this.data.substr(6,5),"RRRRR"),text:this.text.substr(6,5),options:{fontSize:this.fontSize}}),e.push({data:t.encode(this.data[11],"R")+"101",options:{height:this.guardHeight}}),this.displayValue&&e.push({data:"00000000",text:this.text.substr(11,1),options:{textAlign:"right",fontSize:this.fontSize}}),e}}]),e}(d.default);e.default=p},function(t,e,n){"use strict";function r(t,e){return e.height+(e.displayValue&&t.text.length>0?e.fontSize+e.textMargin:0)+e.marginTop+e.marginBottom}function o(t,e,n){if(n.displayValue&&e<t){if("center"==n.textAlign)return Math.floor((t-e)/2);if("left"==n.textAlign)return 0;if("right"==n.textAlign)return Math.floor(t-e)}return 0}function i(t,e,n){for(var i=0;i<t.length;i++){var a,u=t[i],f=(0,c.default)(e,u.options);a=f.displayValue?s(u.text,f,n):0;var l=u.data.length*f.width;u.width=Math.ceil(Math.max(a,l)),u.height=r(u,f),u.barcodePadding=o(a,l,f)}}function a(t){for(var e=0,n=0;n<t.length;n++)e+=t[n].width;return e}function u(t){for(var e=0,n=0;n<t.length;n++)t[n].height>e&&(e=t[n].height);return e}function s(t,e,n){var r;if(n)r=n;else{if("undefined"==typeof document)return 0;r=document.createElement("canvas").getContext("2d")}return r.font=e.fontOptions+" "+e.fontSize+"px "+e.font,r.measureText(t).width}Object.defineProperty(e,"__esModule",{value:!0}),e.getTotalWidthOfEncodings=e.calculateEncodingAttributes=e.getBarcodePadding=e.getEncodingHeight=e.getMaximumHeightOfEncodings=void 0;var f=n(4),c=function(t){return t&&t.__esModule?t:{default:t}}(f);e.getMaximumHeightOfEncodings=u,e.getEncodingHeight=r,e.getBarcodePadding=o,e.calculateEncodingAttributes=i,e.getTotalWidthOfEncodings=a},function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var r=n(24),o=n(23),i=n(30),a=n(33),u=n(32),s=n(38),f=n(40),c=n(39),l=n(31);e.default={CODE39:r.CODE39,CODE128:o.CODE128,CODE128A:o.CODE128A,CODE128B:o.CODE128B,CODE128C:o.CODE128C,EAN13:i.EAN13,EAN8:i.EAN8,EAN5:i.EAN5,EAN2:i.EAN2,UPC:i.UPC,UPCE:i.UPCE,ITF14:a.ITF14,ITF:u.ITF,MSI:s.MSI,MSI10:s.MSI10,MSI11:s.MSI11,MSI1010:s.MSI1010,MSI1110:s.MSI1110,pharmacode:f.pharmacode,codabar:c.codabar,GenericBarcode:l.GenericBarcode}},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),i=function(){function t(e){r(this,t),this.api=e}return o(t,[{key:"handleCatch",value:function(t){if("InvalidInputException"!==t.name)throw t;if(this.api._options.valid===this.api._defaults.valid)throw t.message;this.api._options.valid(!1),this.api.render=function(){}}},{key:"wrapBarcodeCall",value:function(t){try{var e=t.apply(void 0,arguments);return this.api._options.valid(!0),e}catch(t){return this.handleCatch(t),this.api}}}]),t}();e.default=i},function(t,e,n){"use strict";function r(t){return t.marginTop=t.marginTop||t.margin,t.marginBottom=t.marginBottom||t.margin,t.marginRight=t.marginRight||t.margin,t.marginLeft=t.marginLeft||t.margin,t}Object.defineProperty(e,"__esModule",{value:!0}),e.default=r},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){if("string"==typeof t)return i(t);if(Array.isArray(t)){for(var e=[],n=0;n<t.length;n++)e.push(o(t[n]));return e}if("undefined"!=typeof HTMLCanvasElement&&t instanceof HTMLImageElement)return a(t);if(t&&"svg"===t.nodeName||"undefined"!=typeof SVGElement&&t instanceof SVGElement)return{element:t,options:(0,f.default)(t),renderer:l.default.SVGRenderer};if("undefined"!=typeof HTMLCanvasElement&&t instanceof HTMLCanvasElement)return{element:t,options:(0,f.default)(t),renderer:l.default.CanvasRenderer};if(t&&t.getContext)return{element:t,renderer:l.default.CanvasRenderer};if(t&&"object"===(void 0===t?"undefined":u(t))&&!t.nodeName)return{element:t,renderer:l.default.ObjectRenderer};throw new d.InvalidElementException}function i(t){var e=document.querySelectorAll(t);if(0!==e.length){for(var n=[],r=0;r<e.length;r++)n.push(o(e[r]));return n}}function a(t){var e=document.createElement("canvas");return{element:e,options:(0,f.default)(t),renderer:l.default.CanvasRenderer,afterRender:function(){t.setAttribute("src",e.toDataURL())}}}Object.defineProperty(e,"__esModule",{value:!0});var u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},s=n(41),f=r(s),c=n(43),l=r(c),d=n(7);e.default=o},function(t,e,n){"use strict";function r(t){function e(t){if(Array.isArray(t))for(var r=0;r<t.length;r++)e(t[r]);else t.text=t.text||"",t.data=t.data||"",n.push(t)}var n=[];return e(t),n}Object.defineProperty(e,"__esModule",{value:!0}),e.default=r},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e,n){t=""+t;var r=new e(t,n);if(!r.valid())throw new w.InvalidInputException(r.constructor.name,t);var o=r.encode();o=(0,d.default)(o);for(var i=0;i<o.length;i++)o[i].options=(0,c.default)(n,o[i].options);return o}function i(){return s.default.CODE128?"CODE128":Object.keys(s.default)[0]}function a(t,e,n){e=(0,d.default)(e);for(var r=0;r<e.length;r++)e[r].options=(0,c.default)(n,e[r].options),(0,h.default)(e[r].options);(0,h.default)(n),new(0,t.renderer)(t.element,e,n).render(),t.afterRender&&t.afterRender()}var u=n(12),s=r(u),f=n(4),c=r(f),l=n(16),d=r(l),p=n(14),h=r(p),y=n(15),b=r(y),v=n(8),g=r(v),_=n(13),O=r(_),w=n(7),E=n(9),m=r(E),x=function(){},j=function(t,e,n){var r=new x;if(void 0===t)throw Error("No element to render on was provided.");return r._renderProperties=(0,b.default)(t),r._encodings=[],r._options=m.default,r._errorHandler=new O.default(r),void 0!==e&&(n=n||{},n.format||(n.format=i()),r.options(n)[n.format](e,n).render()),r};j.getModule=function(t){return s.default[t]};for(var P in s.default)s.default.hasOwnProperty(P)&&function(t,e){x.prototype[e]=x.prototype[e.toUpperCase()]=x.prototype[e.toLowerCase()]=function(n,r){var i=this;return i._errorHandler.wrapBarcodeCall(function(){r.text=void 0===r.text?void 0:""+r.text;var a=(0,c.default)(i._options,r);a=(0,g.default)(a);var u=t[e],s=o(n,u,a);return i._encodings.push(s),i})}}(s.default,P);x.prototype.options=function(t){return this._options=(0,c.default)(this._options,t),this},x.prototype.blank=function(t){var e=new Array(t+1).join("0");return this._encodings.push({data:e}),this},x.prototype.init=function(){if(this._renderProperties){Array.isArray(this._renderProperties)||(this._renderProperties=[this._renderProperties]);var t;for(var e in this._renderProperties){t=this._renderProperties[e];var n=(0,c.default)(this._options,t.options);"auto"==n.format&&(n.format=i()),this._errorHandler.wrapBarcodeCall(function(){var e=n.value,r=s.default[n.format.toUpperCase()],i=o(e,r,n);a(t,i,n)})}}},x.prototype.render=function(){if(!this._renderProperties)throw new w.NoElementException;if(Array.isArray(this._renderProperties))for(var t=0;t<this._renderProperties.length;t++)a(this._renderProperties[t],this._encodings,this._options);else a(this._renderProperties,this._encodings,this._options);return this},x.prototype._defaults=m.default,"undefined"!=typeof window&&(window.JsBarcode=j),"undefined"!=typeof jQuery&&(jQuery.fn.JsBarcode=function(t,e){var n=[];return jQuery(this).each(function(){n.push(this)}),j(n,t,e)}),t.exports=j},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),u=n(5),s=function(t){return t&&t.__esModule?t:{default:t}}(u),f=n(2),c=function(t){function e(t,n){return r(this,e),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,f.A_START_CHAR+t,n))}return i(e,t),a(e,[{key:"valid",value:function(){return new RegExp("^"+f.A_CHARS+"+$").test(this.data)}}]),e}(s.default);e.default=c},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),u=n(5),s=function(t){return t&&t.__esModule?t:{default:t}}(u),f=n(2),c=function(t){function e(t,n){return r(this,e),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,f.B_START_CHAR+t,n))}return i(e,t),a(e,[{key:"valid",value:function(){return new RegExp("^"+f.B_CHARS+"+$").test(this.data)}}]),e}(s.default);e.default=c},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),u=n(5),s=function(t){return t&&t.__esModule?t:{default:t}}(u),f=n(2),c=function(t){function e(t,n){return r(this,e),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,f.C_START_CHAR+t,n))}return i(e,t),a(e,[{key:"valid",value:function(){return new RegExp("^"+f.C_CHARS+"+$").test(this.data)}}]),e}(s.default);e.default=c},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function a(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var u=n(5),s=r(u),f=n(22),c=r(f),l=function(t){function e(t,n){if(o(this,e),/^[\x00-\x7F\xC8-\xD3]+$/.test(t))var r=i(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,(0,c.default)(t),n));else var r=i(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n));return i(r)}return a(e,t),e}(s.default);e.default=l},function(t,e,n){"use strict";function r(t,e){var n=e?i.A_CHARS:i.B_CHARS,a=t.match(new RegExp("^("+n+"+?)(([0-9]{2}){2,})([^0-9]|$)"));if(a)return a[1]+String.fromCharCode(204)+o(t.substring(a[1].length));var u=t.match(new RegExp("^"+n+"+"))[0];return u.length===t.length?t:u+String.fromCharCode(e?205:206)+r(t.substring(u.length),!e)}function o(t){var e=s(t),n=e.length;if(n===t.length)return t;t=t.substring(n);var o=a(t)>=u(t);return e+String.fromCharCode(o?206:205)+r(t,o)}Object.defineProperty(e,"__esModule",{value:!0});var i=n(2),a=function(t){return t.match(new RegExp("^"+i.A_CHARS+"*"))[0].length},u=function(t){return t.match(new RegExp("^"+i.B_CHARS+"*"))[0].length},s=function(t){return t.match(new RegExp("^"+i.C_CHARS+"*"))[0]};e.default=function(t){var e=void 0;if(s(t).length>=2)e=i.C_START_CHAR+o(t);else{var n=a(t)>u(t);e=(n?i.A_START_CHAR:i.B_START_CHAR)+r(t,n)}return e.replace(/[\xCD\xCE]([^])[\xCD\xCE]/,function(t,e){return String.fromCharCode(203)+e})}},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}Object.defineProperty(e,"__esModule",{value:!0}),e.CODE128C=e.CODE128B=e.CODE128A=e.CODE128=void 0;var o=n(21),i=r(o),a=n(18),u=r(a),s=n(19),f=r(s),c=n(20),l=r(c);e.CODE128=i.default,e.CODE128A=u.default,e.CODE128B=f.default,e.CODE128C=l.default},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function a(t){return u(f(t))}function u(t){return b[t].toString(2)}function s(t){return y[t]}function f(t){return y.indexOf(t)}function c(t){for(var e=0,n=0;n<t.length;n++)e+=f(t[n]);return e%=43}Object.defineProperty(e,"__esModule",{value:!0}),e.CODE39=void 0;var l=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),d=n(0),p=function(t){return t&&t.__esModule?t:{default:t}}(d),h=function(t){function e(t,n){return r(this,e),t=t.toUpperCase(),n.mod43&&(t+=s(c(t))),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n))}return i(e,t),l(e,[{key:"encode",value:function(){for(var t=a("*"),e=0;e<this.data.length;e++)t+=a(this.data[e])+"0";return t+=a("*"),{data:t,text:this.text}}},{key:"valid",value:function(){return-1!==this.data.search(/^[0-9A-Z\-\.\ \$\/\+\%]+$/)}}]),e}(p.default),y=["0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","-","."," ","$","/","+","%","*"],b=[20957,29783,23639,30485,20951,29813,23669,20855,29789,23645,29975,23831,30533,22295,30149,24005,21623,29981,23837,22301,30023,23879,30545,22343,30161,24017,21959,30065,23921,22385,29015,18263,29141,17879,29045,18293,17783,29021,18269,17477,17489,17681,20753,35770];e.CODE39=h},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function a(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function u(t){var e,n=0;for(e=0;e<12;e+=2)n+=parseInt(t[e]);for(e=1;e<12;e+=2)n+=3*parseInt(t[e]);return(10-n%10)%10}Object.defineProperty(e,"__esModule",{value:!0});var s=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),f=n(1),c=r(f),l=n(0),d=r(l),p=function(t){function e(t,n){o(this,e),-1!==t.search(/^[0-9]{12}$/)&&(t+=u(t));var r=i(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n));return!n.flat&&n.fontSize>10*n.width?r.fontSize=10*n.width:r.fontSize=n.fontSize,r.guardHeight=n.height+r.fontSize/2+n.textMargin,r.lastChar=n.lastChar,r}return a(e,t),s(e,[{key:"valid",value:function(){return-1!==this.data.search(/^[0-9]{13}$/)&&this.data[12]==u(this.data)}},{key:"encode",value:function(){return this.options.flat?this.flatEncoding():this.guardedEncoding()}},{key:"getStructure",value:function(){return["LLLLLL","LLGLGG","LLGGLG","LLGGGL","LGLLGG","LGGLLG","LGGGLL","LGLGLG","LGLGGL","LGGLGL"]}},{key:"guardedEncoding",value:function(){var t=new c.default,e=[],n=this.getStructure()[this.data[0]],r=this.data.substr(1,6),o=this.data.substr(7,6);return this.options.displayValue&&e.push({data:"000000000000",text:this.text.substr(0,1),options:{textAlign:"left",fontSize:this.fontSize}}),e.push({data:"101",options:{height:this.guardHeight}}),e.push({data:t.encode(r,n),text:this.text.substr(1,6),options:{fontSize:this.fontSize}}),e.push({data:"01010",options:{height:this.guardHeight}}),e.push({data:t.encode(o,"RRRRRR"),text:this.text.substr(7,6),options:{fontSize:this.fontSize}}),e.push({data:"101",options:{height:this.guardHeight}}),this.options.lastChar&&this.options.displayValue&&(e.push({data:"00"}),e.push({data:"00000",text:this.options.lastChar,options:{fontSize:this.fontSize}})),e}},{key:"flatEncoding",value:function(){var t=new c.default,e="",n=this.getStructure()[this.data[0]];return e+="101",e+=t.encode(this.data.substr(1,6),n),e+="01010",e+=t.encode(this.data.substr(7,6),"RRRRRR"),e+="101",{data:e,text:this.text}}}]),e}(d.default);e.default=p},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function a(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var u=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),s=n(1),f=r(s),c=n(0),l=r(c),d=function(t){function e(t,n){o(this,e);var r=i(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n));return r.structure=["LL","LG","GL","GG"],r}return a(e,t),u(e,[{key:"valid",value:function(){return-1!==this.data.search(/^[0-9]{2}$/)}},{key:"encode",value:function(){var t=new f.default,e=this.structure[parseInt(this.data)%4],n="1011";return n+=t.encode(this.data,e,"01"),{data:n,text:this.text}}}]),e}(l.default);e.default=d},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function a(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var u=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),s=n(1),f=r(s),c=n(0),l=r(c),d=function(t){function e(t,n){o(this,e);var r=i(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n));return r.structure=["GGLLL","GLGLL","GLLGL","GLLLG","LGGLL","LLGGL","LLLGG","LGLGL","LGLLG","LLGLG"],r}return a(e,t),u(e,[{key:"valid",value:function(){return-1!==this.data.search(/^[0-9]{5}$/)}},{key:"encode",value:function(){var t=new f.default,e=this.checksum(),n="1011";return n+=t.encode(this.data,this.structure[e],"01"),{data:n,text:this.text}}},{key:"checksum",value:function(){var t=0;return t+=3*parseInt(this.data[0]),t+=9*parseInt(this.data[1]),t+=3*parseInt(this.data[2]),t+=9*parseInt(this.data[3]),(t+=3*parseInt(this.data[4]))%10}}]),e}(l.default);e.default=d},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function a(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function u(t){var e,n=0;for(e=0;e<7;e+=2)n+=3*parseInt(t[e]);for(e=1;e<7;e+=2)n+=parseInt(t[e]);return(10-n%10)%10}Object.defineProperty(e,"__esModule",{value:!0});var s=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),f=n(1),c=r(f),l=n(0),d=r(l),p=function(t){function e(t,n){return o(this,e),-1!==t.search(/^[0-9]{7}$/)&&(t+=u(t)),i(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n))}return a(e,t),s(e,[{key:"valid",value:function(){return-1!==this.data.search(/^[0-9]{8}$/)&&this.data[7]==u(this.data)}},{key:"encode",value:function(){var t=new c.default,e="",n=this.data.substr(0,4),r=this.data.substr(4,4);return e+=t.startBin,e+=t.encode(n,"LLLL"),e+=t.middleBin,e+=t.encode(r,"RRRR"),e+=t.endBin,{data:e,text:this.text}}}]),e}(d.default);e.default=p},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function a(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function u(t,e){for(var n=parseInt(t[t.length-1]),r=h[n],o="",i=0,a=0;a<r.length;a++){var u=r[a];o+="X"===u?t[i++]:u}return""+(o=""+e+o)+(0,p.checksum)(o)}Object.defineProperty(e,"__esModule",{value:!0});var s=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),f=n(1),c=r(f),l=n(0),d=r(l),p=n(10),h=["XX00000XXX","XX10000XXX","XX20000XXX","XXX00000XX","XXXX00000X","XXXXX00005","XXXXX00006","XXXXX00007","XXXXX00008","XXXXX00009"],y=[["EEEOOO","OOOEEE"],["EEOEOO","OOEOEE"],["EEOOEO","OOEEOE"],["EEOOOE","OOEEEO"],["EOEEOO","OEOOEE"],["EOOEEO","OEEOOE"],["EOOOEE","OEEEOO"],["EOEOEO","OEOEOE"],["EOEOOE","OEOEEO"],["EOOEOE","OEEOEO"]],b=function(t){function e(t,n){o(this,e);var r=i(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n));if(r.isValid=!1,-1!==t.search(/^[0-9]{6}$/))r.middleDigits=t,r.upcA=u(t,"0"),r.text=n.text||""+r.upcA[0]+t+r.upcA[r.upcA.length-1],r.isValid=!0;else{if(-1===t.search(/^[01][0-9]{7}$/))return i(r);if(r.middleDigits=t.substring(1,t.length-1),r.upcA=u(r.middleDigits,t[0]),r.upcA[r.upcA.length-1]!==t[t.length-1])return i(r);r.isValid=!0}return r.displayValue=n.displayValue,n.fontSize>10*n.width?r.fontSize=10*n.width:r.fontSize=n.fontSize,r.guardHeight=n.height+r.fontSize/2+n.textMargin,r}return a(e,t),s(e,[{key:"valid",value:function(){return this.isValid}},{key:"encode",value:function(){return this.options.flat?this.flatEncoding():this.guardedEncoding()}},{key:"flatEncoding",value:function(){var t=new c.default,e="";return e+="101",e+=this.encodeMiddleDigits(t),e+="010101",{data:e,text:this.text}}},{key:"guardedEncoding",value:function(){var t=new c.default,e=[];return this.displayValue&&e.push({data:"00000000",text:this.text[0],options:{textAlign:"left",fontSize:this.fontSize}}),e.push({data:"101",options:{height:this.guardHeight}}),e.push({data:this.encodeMiddleDigits(t),text:this.text.substring(1,7),options:{fontSize:this.fontSize}}),e.push({data:"010101",options:{height:this.guardHeight}}),this.displayValue&&e.push({data:"00000000",text:this.text[7],options:{textAlign:"right",fontSize:this.fontSize}}),e}},{key:"encodeMiddleDigits",value:function(t){var e=this.upcA[0],n=this.upcA[this.upcA.length-1],r=y[parseInt(n)][parseInt(e)];return t.encode(this.middleDigits,r)}}]),e}(d.default);e.default=b},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}Object.defineProperty(e,"__esModule",{value:!0}),e.UPCE=e.UPC=e.EAN2=e.EAN5=e.EAN8=e.EAN13=void 0;var o=n(25),i=r(o),a=n(28),u=r(a),s=n(27),f=r(s),c=n(26),l=r(c),d=n(10),p=r(d),h=n(29),y=r(h);e.EAN13=i.default,e.EAN8=u.default,e.EAN5=f.default,e.EAN2=l.default,e.UPC=p.default,e.UPCE=y.default},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0}),e.GenericBarcode=void 0;var a=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),u=n(0),s=function(t){return t&&t.__esModule?t:{default:t}}(u),f=function(t){function e(t,n){return r(this,e),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n))}return i(e,t),a(e,[{key:"encode",value:function(){return{data:"10101010101010101010101010101010101010101",text:this.text}}},{key:"valid",value:function(){return!0}}]),e}(s.default);e.GenericBarcode=f},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0}),e.ITF=void 0;var a=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),u=n(0),s=function(t){return t&&t.__esModule?t:{default:t}}(u),f=function(t){function e(t,n){r(this,e);var i=o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n));return i.binaryRepresentation={0:"00110",1:"10001",2:"01001",3:"11000",4:"00101",5:"10100",6:"01100",7:"00011",8:"10010",9:"01010"},i}return i(e,t),a(e,[{key:"valid",value:function(){return-1!==this.data.search(/^([0-9]{2})+$/)}},{key:"encode",value:function(){for(var t="1010",e=0;e<this.data.length;e+=2)t+=this.calculatePair(this.data.substr(e,2));return t+="11101",{data:t,text:this.text}}},{key:"calculatePair",value:function(t){for(var e="",n=this.binaryRepresentation[t[0]],r=this.binaryRepresentation[t[1]],o=0;o<5;o++)e+="1"==n[o]?"111":"1",e+="1"==r[o]?"000":"0";return e}}]),e}(s.default);e.ITF=f},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}function a(t){for(var e=0,n=0;n<13;n++)e+=parseInt(t[n])*(3-n%2*2);return 10*Math.ceil(e/10)-e}Object.defineProperty(e,"__esModule",{value:!0}),e.ITF14=void 0;var u=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),s=n(0),f=function(t){return t&&t.__esModule?t:{default:t}}(s),c=function(t){function e(t,n){r(this,e),-1!==t.search(/^[0-9]{13}$/)&&(t+=a(t));var i=o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n));return i.binaryRepresentation={0:"00110",1:"10001",2:"01001",3:"11000",4:"00101",5:"10100",6:"01100",7:"00011",8:"10010",9:"01010"},i}return i(e,t),u(e,[{key:"valid",value:function(){return-1!==this.data.search(/^[0-9]{14}$/)&&this.data[13]==a(this.data)}},{key:"encode",value:function(){for(var t="1010",e=0;e<14;e+=2)t+=this.calculatePair(this.data.substr(e,2));return t+="11101",{data:t,text:this.text}}},{key:"calculatePair",value:function(t){for(var e="",n=this.binaryRepresentation[t[0]],r=this.binaryRepresentation[t[1]],o=0;o<5;o++)e+="1"==n[o]?"111":"1",e+="1"==r[o]?"000":"0";return e}}]),e}(f.default);e.ITF14=c},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=n(3),u=function(t){return t&&t.__esModule?t:{default:t}}(a),s=n(6),f=function(t){function e(t,n){return r(this,e),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t+(0,s.mod10)(t),n))}return i(e,t),e}(u.default);e.default=f},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=n(3),u=function(t){return t&&t.__esModule?t:{default:t}}(a),s=n(6),f=function(t){function e(t,n){return r(this,e),t+=(0,s.mod10)(t),t+=(0,s.mod10)(t),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n))}return i(e,t),e}(u.default);e.default=f},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=n(3),u=function(t){return t&&t.__esModule?t:{default:t}}(a),s=n(6),f=function(t){function e(t,n){return r(this,e),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t+(0,s.mod11)(t),n))}return i(e,t),e}(u.default);e.default=f},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0});var a=n(3),u=function(t){return t&&t.__esModule?t:{default:t}}(a),s=n(6),f=function(t){function e(t,n){return r(this,e),t+=(0,s.mod11)(t),t+=(0,s.mod10)(t),o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n))}return i(e,t),e}(u.default);e.default=f},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}Object.defineProperty(e,"__esModule",{value:!0}),e.MSI1110=e.MSI1010=e.MSI11=e.MSI10=e.MSI=void 0;var o=n(3),i=r(o),a=n(34),u=r(a),s=n(36),f=r(s),c=n(35),l=r(c),d=n(37),p=r(d);e.MSI=i.default,e.MSI10=u.default,e.MSI11=f.default,e.MSI1010=l.default,e.MSI1110=p.default},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0}),e.codabar=void 0;var a=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),u=n(0),s=function(t){return t&&t.__esModule?t:{default:t}}(u),f=function(t){function e(t,n){r(this,e),0===t.search(/^[0-9\-\$\:\.\+\/]+$/)&&(t="A"+t+"A");var i=o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t.toUpperCase(),n));return i.text=i.options.text||i.text.replace(/[A-D]/g,""),i}return i(e,t),a(e,[{key:"valid",value:function(){return-1!==this.data.search(/^[A-D][0-9\-\$\:\.\+\/]+[A-D]$/)}},{key:"encode",value:function(){for(var t=[],e=this.getEncodings(),n=0;n<this.data.length;n++)t.push(e[this.data.charAt(n)]),n!==this.data.length-1&&t.push("0");return{text:this.text,data:t.join("")}}},{key:"getEncodings",value:function(){return{0:"101010011",1:"101011001",2:"101001011",3:"110010101",4:"101101001",5:"110101001",6:"100101011",7:"100101101",8:"100110101",9:"110100101","-":"101001101",$:"101100101",":":"1101011011","/":"1101101011",".":"1101101101","+":"101100110011",A:"1011001001",B:"1010010011",C:"1001001011",D:"1010011001"}}}]),e}(s.default);e.codabar=f},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){if(!t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!e||"object"!=typeof e&&"function"!=typeof e?t:e}function i(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function, not "+typeof e);t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}),e&&(Object.setPrototypeOf?Object.setPrototypeOf(t,e):t.__proto__=e)}Object.defineProperty(e,"__esModule",{value:!0}),e.pharmacode=void 0;var a=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),u=n(0),s=function(t){return t&&t.__esModule?t:{default:t}}(u),f=function(t){function e(t,n){r(this,e);var i=o(this,(e.__proto__||Object.getPrototypeOf(e)).call(this,t,n));return i.number=parseInt(t,10),i}return i(e,t),a(e,[{key:"encode",value:function(){for(var t=this.number,e="";!isNaN(t)&&0!=t;)t%2==0?(e="11100"+e,t=(t-2)/2):(e="100"+e,t=(t-1)/2);return e=e.slice(0,-2),{data:e,text:this.text}}},{key:"valid",value:function(){return this.number>=3&&this.number<=131070}}]),e}(s.default);e.pharmacode=f},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}function o(t){var e={};for(var n in s.default)s.default.hasOwnProperty(n)&&(t.hasAttribute("jsbarcode-"+n.toLowerCase())&&(e[n]=t.getAttribute("jsbarcode-"+n.toLowerCase())),t.hasAttribute("data-"+n.toLowerCase())&&(e[n]=t.getAttribute("data-"+n.toLowerCase())));return e.value=t.getAttribute("jsbarcode-value")||t.getAttribute("data-value"),e=(0,a.default)(e)}Object.defineProperty(e,"__esModule",{value:!0});var i=n(8),a=r(i),u=n(9),s=r(u);e.default=o},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),i=n(4),a=function(t){return t&&t.__esModule?t:{default:t}}(i),u=n(11),s=function(){function t(e,n,o){r(this,t),this.canvas=e,this.encodings=n,this.options=o}return o(t,[{key:"render",value:function(){if(!this.canvas.getContext)throw new Error("The browser does not support canvas.");this.prepareCanvas();for(var t=0;t<this.encodings.length;t++){var e=(0,a.default)(this.options,this.encodings[t].options);this.drawCanvasBarcode(e,this.encodings[t]),this.drawCanvasText(e,this.encodings[t]),this.moveCanvasDrawing(this.encodings[t])}this.restoreCanvas()}},{key:"prepareCanvas",value:function(){var t=this.canvas.getContext("2d");t.save(),(0,u.calculateEncodingAttributes)(this.encodings,this.options,t);var e=(0,u.getTotalWidthOfEncodings)(this.encodings),n=(0,u.getMaximumHeightOfEncodings)(this.encodings);this.canvas.width=e+this.options.marginLeft+this.options.marginRight,this.canvas.height=n,t.clearRect(0,0,this.canvas.width,this.canvas.height),this.options.background&&(t.fillStyle=this.options.background,t.fillRect(0,0,this.canvas.width,this.canvas.height)),t.translate(this.options.marginLeft,0)}},{key:"drawCanvasBarcode",value:function(t,e){var n,r=this.canvas.getContext("2d"),o=e.data;n="top"==t.textPosition?t.marginTop+t.fontSize+t.textMargin:t.marginTop,r.fillStyle=t.lineColor;for(var i=0;i<o.length;i++){var a=i*t.width+e.barcodePadding;"1"===o[i]?r.fillRect(a,n,t.width,t.height):o[i]&&r.fillRect(a,n,t.width,t.height*o[i])}}},{key:"drawCanvasText",value:function(t,e){var n=this.canvas.getContext("2d"),r=t.fontOptions+" "+t.fontSize+"px "+t.font;if(t.displayValue){var o,i;i="top"==t.textPosition?t.marginTop+t.fontSize-t.textMargin:t.height+t.textMargin+t.marginTop+t.fontSize,n.font=r,"left"==t.textAlign||e.barcodePadding>0?(o=0,n.textAlign="left"):"right"==t.textAlign?(o=e.width-1,n.textAlign="right"):(o=e.width/2,n.textAlign="center"),n.fillText(e.text,o,i)}}},{key:"moveCanvasDrawing",value:function(t){this.canvas.getContext("2d").translate(t.width,0)}},{key:"restoreCanvas",value:function(){this.canvas.getContext("2d").restore()}}]),t}();e.default=s},function(t,e,n){"use strict";function r(t){return t&&t.__esModule?t:{default:t}}Object.defineProperty(e,"__esModule",{value:!0});var o=n(42),i=r(o),a=n(45),u=r(a),s=n(44),f=r(s);e.default={CanvasRenderer:i.default,SVGRenderer:u.default,ObjectRenderer:f.default}},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),i=function(){function t(e,n,o){r(this,t),this.object=e,this.encodings=n,this.options=o}return o(t,[{key:"render",value:function(){this.object.encodings=this.encodings}}]),t}();e.default=i},function(t,e,n){"use strict";function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var o=function(){function t(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(e,n,r){return n&&t(e.prototype,n),r&&t(e,r),e}}(),i=n(4),a=function(t){return t&&t.__esModule?t:{default:t}}(i),u=n(11),s="http://www.w3.org/2000/svg",f=function(){function t(e,n,o){r(this,t),this.svg=e,this.encodings=n,this.options=o,this.document=o.xmlDocument||document}return o(t,[{key:"render",value:function(){var t=this.options.marginLeft;this.prepareSVG();for(var e=0;e<this.encodings.length;e++){var n=this.encodings[e],r=(0,a.default)(this.options,n.options),o=this.createGroup(t,r.marginTop,this.svg);this.setGroupOptions(o,r),this.drawSvgBarcode(o,r,n),this.drawSVGText(o,r,n),t+=n.width}}},{key:"prepareSVG",value:function(){for(;this.svg.firstChild;)this.svg.removeChild(this.svg.firstChild);(0,u.calculateEncodingAttributes)(this.encodings,this.options);var t=(0,u.getTotalWidthOfEncodings)(this.encodings),e=(0,u.getMaximumHeightOfEncodings)(this.encodings),n=t+this.options.marginLeft+this.options.marginRight;this.setSvgAttributes(n,e),this.options.background&&this.drawRect(0,0,n,e,this.svg).setAttribute("style","fill:"+this.options.background+";")}},{key:"drawSvgBarcode",value:function(t,e,n){var r,o=n.data;r="top"==e.textPosition?e.fontSize+e.textMargin:0;for(var i=0,a=0,u=0;u<o.length;u++)a=u*e.width+n.barcodePadding,"1"===o[u]?i++:i>0&&(this.drawRect(a-e.width*i,r,e.width*i,e.height,t),i=0);i>0&&this.drawRect(a-e.width*(i-1),r,e.width*i,e.height,t)}},{key:"drawSVGText",value:function(t,e,n){var r=this.document.createElementNS(s,"text");if(e.displayValue){var o,i;r.setAttribute("style","font:"+e.fontOptions+" "+e.fontSize+"px "+e.font),i="top"==e.textPosition?e.fontSize-e.textMargin:e.height+e.textMargin+e.fontSize,"left"==e.textAlign||n.barcodePadding>0?(o=0,r.setAttribute("text-anchor","start")):"right"==e.textAlign?(o=n.width-1,r.setAttribute("text-anchor","end")):(o=n.width/2,r.setAttribute("text-anchor","middle")),r.setAttribute("x",o),r.setAttribute("y",i),r.appendChild(this.document.createTextNode(n.text)),t.appendChild(r)}}},{key:"setSvgAttributes",value:function(t,e){var n=this.svg;n.setAttribute("width",t+"px"),n.setAttribute("height",e+"px"),n.setAttribute("x","0px"),n.setAttribute("y","0px"),n.setAttribute("viewBox","0 0 "+t+" "+e),n.setAttribute("xmlns",s),n.setAttribute("version","1.1"),n.setAttribute("style","transform: translate(0,0)")}},{key:"createGroup",value:function(t,e,n){var r=this.document.createElementNS(s,"g");return r.setAttribute("transform","translate("+t+", "+e+")"),n.appendChild(r),r}},{key:"setGroupOptions",value:function(t,e){t.setAttribute("style","fill:"+e.lineColor+";")}},{key:"drawRect",value:function(t,e,n,r,o){var i=this.document.createElementNS(s,"rect");return i.setAttribute("x",t),i.setAttribute("y",e),i.setAttribute("width",n),i.setAttribute("height",r),o.appendChild(i),i}}]),t}();e.default=f}]);


function pushStateFinal()
{
	$('.barcodePrev').each(function(_el, _a)
	{
		drawBarcodeSvg(this, 0);
	});
	bindBarcodeToRedraw();
}


function bindBarcodeToRedraw()
{
	$('.barCode').on('input', function(e)
	{
		if($(this).attr('id'))
		{
			var svgBox = $('.barcodePrev[data-val="#'+ $(this).attr('id') +'"]');
			if(svgBox)
			{
				drawBarcodeSvg(svgBox);
			}
		}
	});

	// work with barcode trigger
	$('body').on('barcode:detect', function(_e, _barcode)
	{
      	var $focused = $(':focus');
        if($focused.is('.barCode') && $focused.attr('id'))
        {
			var svgBox = $('.barcodePrev[data-val="#'+ $focused.attr('id') +'"]');
			drawBarcodeSvg(svgBox);
        }
	});

	$('body').on('barcode:remove', function(_e, _barcode, _el)
	{
      	var $focused = $(':focus');
        if($focused.is('.barCode') && $focused.attr('id'))
        {
			var svgBox = $('.barcodePrev[data-val="#'+ $focused.attr('id') +'"]');
			drawBarcodeSvg(svgBox);
        }
	});
}


function drawBarcodeSvg(_this, _time)
{
	if(_this.length < 1)
	{
		return;
	}
	var $myCodeElName = $(_this).attr('data-val');
	var $myCodeEl     = $($myCodeElName);
	var myCode        = 'Jibres';
	if($myCodeEl.length)
	{
		// get code
		if($myCodeEl.is('input'))
		{
			myCode = $myCodeEl.val();
		}
		else
		{
			myCode = $myCodeEl.attr('data-val');
		}
	}

	var flagEl = $myCodeEl.parents('.input').find('span i');
	flagDetectAndSet(myCode, flagEl);


	// console.log(_this);
    if(typeof drawTimeout == undefined)
    {
    	var drawTimeout = 0;
    }
    else
    {
      clearTimeout(drawTimeout);
    }
    if(_time === undefined)
    {
    	_time = 100;
    }

    drawTimeout = setTimeout(function()
    {
		var drawOpt   = { height: 50}
		var displayValue = false;


		if($(_this).attr('data-height'))
		{
			drawOpt.height = $(_this).attr('data-height');
			// get height
		}

		if($(_this).attr('data-hideValue') !== undefined)
		{
			drawOpt.displayValue = false;
		}

		// try to draw barcode
		if(myCode)
		{
			if(findBarcodeFormat(myCode))
			{
				drawOpt.format = findBarcodeFormat(myCode);
			}
			// console.log(findBarcodeFormat(myCode)+ ' is format of '+ myCode );
			JsBarcode($(_this).get(0), myCode, drawOpt);
		}
		else
		{
			drawOpt.lineColor = '#ccc;'
			// remove barcode with default design
			JsBarcode($(_this).get(0), "Jibres", drawOpt);
		}


    }, _time);
}


function check_ean13(_code)
{
	var validator = new Barcoder('ean13');
	return validator.validate(_code);
}

function check_code128(_code)
{
	var validator = new Barcoder('code128');
	return validator.validate(_code);
}

function findBarcodeFormat(_code)
{
	if(check_ean13(_code))
	{
		return 'ean13';
	}

	// if(check_code128(_code))
	// {
	// 	return 'code128';
	// }

	return null;
}

function flagDetectAndSet(_code, _flagEl)
{
	var flagDetected = barcode_country(_code).toLowerCase();
	_flagEl.removeClass();
	if(flagDetected)
	{
		_flagEl.addClass('flag ' + barcode_country(_code).toLowerCase());

	}
}


var barcode_country = function (_code)
{
  code = parseInt(_code.substr(0, 3), 10);
  if(_code.length === 16 && code <= 19)
  {
  	return 'IR';
  }
  if ((0 <= code && code <= 19)) {
    // return 'US,CA';
    return 'US';
  } /*else if ((20 <= code && code <= 29)) {
    return 'Restricted distribution (MO defined)';
  }*/ else if ((30 <= code && code <= 39)) {
    return 'US';
  } /*else if ((40 <= code && code <= 49)) {
    return 'Restricted distribution (MO defined)';
  } else if ((50 <= code && code <= 59)) {
    return 'Coupons';
  }*/ else if ((60 <= code && code <= 99)) {
    // return 'US,CA';
    return 'US';
  } else if ((100 <= code && code <= 139)) {
    return 'US';
  } /*else if ((200 <= code && code <= 299)) {
    return 'Restricted distribution (MO defined)';
  }*/ else if ((300 <= code && code <= 379)) {
    // return 'FR,MC';
    return 'FR';
  } else if (code === 380) {
    return 'BG';
  } else if (code === 383) {
    return 'SI';
  } else if (code === 385) {
    return 'HR';
  } else if (code === 387) {
    return 'BA';
  } else if (code === 389) {
    return 'ME';
  } else if ((400 <= code && code <= 440)) {
    return 'DE';
  } else if ((450 <= code && code <= 459)) {
    return 'JP';
  } else if ((460 <= code && code <= 469)) {
    return 'RU';
  } else if (code === 470) {
    return 'KG';
  } else if (code === 471) {
    return 'TW';
  } else if (code === 474) {
    return 'EE';
  } else if (code === 475) {
    return 'LV';
  } else if (code === 476) {
    return 'AZ';
  } else if (code === 477) {
    return 'LT';
  } else if (code === 478) {
    return 'UZ';
  } else if (code === 479) {
    return 'LK';
  } else if (code === 480) {
    return 'PH';
  } else if (code === 481) {
    return 'BY';
  } else if (code === 482) {
    return 'UA';
  } else if (code === 484) {
    return 'MD';
  } else if (code === 485) {
    return 'AM';
  } else if (code === 486) {
    return 'GE';
  } else if (code === 487) {
    return 'KZ';
  } else if (code === 488) {
    return 'TJ';
  } else if (code === 489) {
    return 'HK';
  } else if ((490 <= code && code <= 499)) {
    return 'JP';
  } else if ((500 <= code && code <= 509)) {
    return 'GB';
  } else if ((520 <= code && code <= 521)) {
    return 'GR';
  } else if (code === 528) {
    return 'LB';
  } else if (code === 529) {
    return 'CY';
  } else if (code === 530) {
    return 'AL';
  } else if (code === 531) {
    return 'MK';
  } else if (code === 535) {
    return 'MT';
  } else if (code === 539) {
    return 'IE';
  } else if ((540 <= code && code <= 549)) {
    // return 'BE,LU';
    return 'BE';
  } else if (code === 560) {
    return 'PT';
  } else if (code === 569) {
    return 'IS';
  } else if ((570 <= code && code <= 579)) {
    // return 'DK,FO,GL';
    return 'DK';
  } else if (code === 590) {
    return 'PL';
  } else if (code === 594) {
    return 'RO';
  } else if (code === 599) {
    return 'HU';
  } else if ((600 <= code && code <= 601)) {
    return 'ZA';
  } else if (code === 603) {
    return 'GH';
  } else if (code === 604) {
    return 'SN';
  } else if (code === 608) {
    return 'BH';
  } else if (code === 609) {
    return 'MU';
  } else if (code === 611) {
    return 'MA';
  } else if (code === 613) {
    return 'DZ';
  } else if (code === 615) {
    return 'NG';
  } else if (code === 616) {
    return 'KE';
  } else if (code === 618) {
    return 'CI';
  } else if (code === 619) {
    return 'TN';
  } else if (code === 621) {
    return 'SY';
  } else if (code === 622) {
    return 'EG';
  } else if (code === 624) {
    return 'LY';
  } else if (code === 625) {
    return 'JO';
  } else if (code === 626 || code === 216) {
    return 'IR';
  } else if (code === 627) {
    return 'KW';
  } else if (code === 628) {
    return 'SA';
  } else if (code === 629) {
    return 'AE';
  } else if ((640 <= code && code <= 649)) {
    return 'FI';
  } else if ((690 <= code && code <= 695)) {
    return 'CN';
  } else if ((700 <= code && code <= 709)) {
    return 'NO';
  } else if (code === 729) {
    return 'IL';
  } else if ((730 <= code && code <= 739)) {
    return 'SE';
  } else if (code === 740) {
    return 'GT';
  } else if (code === 741) {
    return 'SV';
  } else if (code === 742) {
    return 'HN';
  } else if (code === 743) {
    return 'NI';
  } else if (code === 744) {
    return 'CR';
  } else if (code === 745) {
    return 'PA';
  } else if (code === 746) {
    return 'DO';
  } else if (code === 750) {
    return 'MX';
  } else if ((754 <= code && code <= 755)) {
    return 'CA';
  } else if (code === 759) {
    return 'VE';
  } else if ((760 <= code && code <= 769)) {
    // return 'CH,LI';
    return 'CH';
  } else if ((770 <= code && code <= 771)) {
    return 'CO';
  } else if (code === 773) {
    return 'UY';
  } else if (code === 775) {
    return 'PE';
  } else if (code === 777) {
    return 'BO';
  } else if (code === 779) {
    return 'AR';
  } else if (code === 780) {
    return 'CL';
  } else if (code === 784) {
    return 'PY';
  } else if (code === 785) {
    return 'PE';
  } else if (code === 786) {
    return 'EC';
  } else if ((789 <= code && code <= 790)) {
    return 'BR';
  } else if ((800 <= code && code <= 839)) {
    // return 'IT,SM,VA';
    return 'IT';
  } else if ((840 <= code && code <= 849)) {
    // return 'ES,AD';
    return 'ES';
  } else if (code === 850) {
    return 'CU';
  } else if (code === 858) {
    return 'SK';
  } else if (code === 859) {
    return 'CZ';
  } else if (code === 860) {
    return 'RS';
  } else if (code === 865) {
    return 'MN';
  } else if (code === 867) {
    return 'KP';
  } else if ((868 <= code && code <= 869)) {
    return 'TR';
  } else if ((870 <= code && code <= 879)) {
    return 'AN';
  } else if (code === 880) {
    return 'KR';
  } else if (code === 884) {
    return 'KH';
  } else if (code === 885) {
    return 'TH';
  } else if (code === 888) {
    return 'SG';
  } else if (code === 890) {
    return 'IN';
  } else if (code === 893) {
    return 'VN';
  } else if (code === 896) {
    return 'PK';
  } else if (code === 899) {
    return 'ID';
  } else if ((900 <= code && code <= 919)) {
    return 'AT';
  } else if ((930 <= code && code <= 939)) {
    return 'AU';
  } else if ((940 <= code && code <= 949)) {
    return 'NZ';
  } /*else if (code === 950) {
    return 'GS1 Global Office: Special applications';
  } else if (code === 951) {
    return 'EPCglobal: Special applications';
  }*/ else if (code === 955) {
    return 'MY';
  } else if (code === 958) {
    return 'MO';
  } /*else if ((960 <= code && code <= 969)) {
    return 'GS1 Global Office: GTIN-8 allocations';
  } else if (code === 977) {
    return 'Serial publications (ISSN)';
  } else if ((978 <= code && code <= 979)) {
    return 'Bookland (ISBN) - 979-0 used for sheet music';
  } else if (code === 980) {
    return 'Refund receipts';
  } else if ((981 <= code && code <= 983)) {
    return 'Common Currency Coupons';
  } else if ((990 <= code && code <= 999)) {
    return 'Coupons';
  }*/ else {
    return '';
  }
};



/**
 * [bindShortkey description]
 * @return {[type]} [description]
 */
function bindShortkey()
{
  $(document).on("keydown", function(_e) { event_corridor.call(this, _e)});
  // $('ul li', explorer).click(function(e)    { event_corridor(e, e.currentTarget, 'click');    });
}

/**
 * corridor of all events on keyboard and mouse
 * @param  {[type]} e     the element that event doing on that
 * @param  {[type]} _self seperated element for doing jobs on it
 * @param  {[type]} _key  the key pressed or click or another events
 * @return {[type]}       void func not returning value! only doing job
 */
function event_corridor(_e, _self, _key)
{
  if(!_key)
  {
    _key = _e.which;
  }

  _self = $(_self);
  var ctrl   = _e.ctrlKey  ? 'ctrl'  : '';
  var shift  = _e.shiftKey ? 'shift' : '';
  var alt    = _e.altKey   ? 'alt'   : '';
  var mytxt  = String(_key) + ctrl + alt + shift;
  var keyp   = String.fromCharCode(_key);

  // logy(mytxt, 'info');
  switch(mytxt)
  {
    // ---------------------------------------------------------- Enter
    case '13':              // Enter
      break;

    case '13ctrl':          // ctrl + Enter
      break;


    // ---------------------------------------------------------- Escape
    case '27':              //Escape
      break;


    // ---------------------------------------------------------- Space
    case '32':              // space
    case '32shift':         // space + shift
    case '32ctrl':          // space + ctrl
    case '32ctrlshift':     // space + ctrl + shift

      break;


    // ---------------------------------------------------------- Page Up
    case '33':              // PageUP
      break;


    // ---------------------------------------------------------- Up
    case '38':              // up
      navigateonFactorAddInputs('up', _e);
      break;


    // ---------------------------------------------------------- Page Down
    case '34':              // PageDown
      break;


    // ---------------------------------------------------------- Down
    case '40':              // down
      navigateonFactorAddInputs('down', _e);
      break;


    // ---------------------------------------------------------- End
    case '35':              // End
      break;


    // ---------------------------------------------------------- Home
    case '36':              // Home
      break;


    // ---------------------------------------------------------- Left
    case '37':              // left
      navigateonFactorAddInputs('left');
      break;


    // ---------------------------------------------------------- Right
    case '39':              // right
      navigateonFactorAddInputs('right');
      break;

    // ---------------------------------------------------------- BackSpace
    case '8':               // Back Space
      break;

    // ---------------------------------------------------------- Delete
    case '46':              // delete
      if(check_factor())
      {
        clearDropdown($('.dropdown.barCode'));

        var selectedRowEl = getSelectedRow(true);
        if(selectedRowEl)
        {
          // var nextSelectedRow = selectedRowEl.prev();
          selectedRowEl.remove();
          $('.dropdown.barCode input.search').val('').trigger("focus");
          // navigationFactorAddSetSelected(nextSelectedRow, true);
          calcFooterValues();
          _e.preventDefault();
        }
      }
      break;


    // ---------------------------------------------------------------------- shortcut
    case '65ctrl':          // a + ctrl
      break;

    case '68shift':         // d + shift
      break;

    case '70':              // f
      break;

    case '72shift':         // h + shift (Home page)
      break;

    case '56shift':         // * | shift + 8
    case '106':             // *
      if(check_factor())
      {
        var RowCountEl = getSelectedRow();
        if(RowCountEl)
        {
          var RowCountEl = RowCountEl.find('input.count');
          RowCountEl.trigger("select");
        }
          // _e.preventDefault();
      }
      break;

    case '107':             // plus +
    case '187shift':        // plus +
      if(check_factor())
      {
        if($(":focus").parents('.dropdown').find('#productSearch'))
        {
          $('.dropdown.barCode input.search').trigger("select");
        }
        else
        {
          $('.dropdown.barCode input.search').trigger("select");
          _e.preventDefault();
        }
      }
      break;

    case '109':             // minus -
    case '189shift':        // minus -
      if(check_factor())
      {
        var RowDiscountEl = getSelectedRow();
        if(RowDiscountEl)
        {
          var RowDiscountEl = RowDiscountEl.find('input.discount');
          RowDiscountEl.trigger("select");
        }
        // _e.preventDefault();
      }
      break;

    case '110':             // .
    case '190':             // .
      break;

    case '111':             // divider on numpad
    case '191':             // divider
      if(check_factor())
      {
        if($(":focus").parents('.dropdown').find('#productSearch'))
        {
          $('.dropdown.barCode input.search').trigger("select");
        }
        else
        {
          $('.dropdown.barCode input.search').trigger("select");
          _e.preventDefault();
        }
      }
      break;

    case '112':             // f1
      break;

    case '113':             // f2
        // prevent any other change
        _e.preventDefault();

        // set factor url
        var myPage     = $('body').attr('data-page');
        var factorUrl  = '/a/sale?from='+ myPage;
        var factorType = $('body').attr('data-page');
        if($('html').attr('lang') !== undefined)
        {
          factorUrl = $('html').attr('lang')+ factorUrl;
        }
        // navigate to add new factor page
        // Navigate({ url: factorUrl });
        if(factorType === 'sale' && check_factor())
        {
          // if we are in check url, first check this one is empty or not
          if(qtyFactorTableItems() == 0)
          {
            var msg = $('#factorAdd').attr('data-msgNewError');
            notif('warn', msg, null, null, {"displayMode": 2});
          }
          else
          {
            window.open(factorUrl + '&extra=true', '_blank');
          }
        }
        else
        {
          if(myPage === 'chap_receipt')
          {
            Navigate({ url: factorUrl });
            // location.replace(factorUrl);
          }
          else
          {
            window.open(factorUrl, '_blank');
          }
        }
      break;

    case '113shift':        // shift+f2
      prevFactor();
      break;

    case '113ctrlshift':        // shift+f2
      prevFactor(undefined, true);
      break;


    case '114':             // f3
    case '114ctrl':         // f3 + ctrl
    case '70ctrl':          // f3 + ctrl
logy($('input.search'));
logy($('input.search').length);

      if($('input[type=search]').length === 1)
      {
        $('input[type=search]').trigger("focus");
        _e.preventDefault();
      }
      else if($('select input.search').length === 2)
      {
        $('input.search').trigger("focus");
        _e.preventDefault();
      }
      break;

    case '115':             // f4

      break;

    case '118':             // f7
      if(check_factor())
      {
        shortkey_toggleDiscount();
        _e.preventDefault();
      }
      break;

    case '119':             // f8

      break;

   case '121':              // f10
      if(check_factor())
      {
        $('.pcPos').trigger('click');
      }
      break;

   case '122shift':         // f11 + shift
      break;

   case '123':              // f12
      break;

    // ---------------------------------------------------------------------- mouse
    case 'click':           // click
      break;

    case 'rightclick':        // Double click
      break;

    default:                // exit this handler for other keys
      return;
  }
}


function getSelectedRow(_confirm)
{
  if(check_factor())
  {
    var aa = $('table.productList tbody tr').length;
    if(aa > 0)
    {
      var selectedRowEl = $('table.productList tbody tr[data-selected]');
      if(selectedRowEl.length == 1)
      {

        // selectedRow = selectedRowEl.index();
      }
      else
      {
        if(_confirm)
        {
          $('table.productList tbody tr:eq(0)').attr('data-selected', 'warn');
          return false;
        }
        else
        {
          selectedRowEl = $('table.productList tbody tr:eq(0)')
        }
      }
      return selectedRowEl;
    }
  }
  return null;
}

function check_factor()
{
  if($('#factorAdd').length > 0)
  {
    return true;
  }

  return false;
}





function pushState()
{
  if($('body').attr('data-in') === 'a')
  {
    calcFooterValues();
    recalcPricePercents();
  }
}

$(function()
{
  // run once on ready
  bindBtnOnFactor();
  // bind shortkey on each page
  callFunc('bindShortkey')
});





function calcFooterValues(_table)
{
  if(!_table)
  {
    _table = $('.productList');
    if(_table.length < 1)
    {
      // return null;
    }
  }
  var calcDtCountRow        = 0;
  var calcDtSumCount        = 0;
  var calcDtSumPrice        = 0;
  var calcDtSumDiscount     = 0;
  var calcDtDiscountPercent = 0;
  var calcDtSumTotal        = 0;
  var factorType            = $('body').attr('data-page');
  // calc total of column
  _table.find('tbody tr').each(function(index)
  {
    // reset row index
    $(this).find('td.cellIndex').text(fitNumber(index + 1));


    // variables
    var tmpCount = $(this).find('.count').val();
    if(tmpCount)
    {
      tmpCount = parseFloat(tmpCount.toEnglish());
    }
    var tmpBuy = $(this).find('td.cellBuy input').val();
    if(tmpBuy)
    {
      tmpBuy = parseInt(tmpBuy.toEnglish());
    }
    var tmpPrice = $(this).find('td.cellPrice').attr('data-val');
    if(tmpPrice)
    {
      tmpPrice = parseInt(tmpPrice);
    }
    var tmpDiscount = $(this).find('.discount').val();
    if(tmpDiscount)
    {
      tmpDiscount = parseInt(tmpDiscount.toEnglish());
    }
    var tmpDiscountPercent = 0;
    if(factorType === 'buy')
    {
      tmpPrice = tmpBuy;
    }

    // check NaN values
    if(isNaN(tmpCount))
    {
      tmpCount = 0;
    }
    if(isNaN(tmpPrice))
    {
      tmpPrice = 0;
    }
    if(isNaN(tmpDiscount))
    {
      tmpDiscount = 0;
    }
    if(tmpPrice < tmpDiscount)
    {
      $(this).find('.discount').val('');
      tmpDiscount = 0;
    }

    var tmpPriceCol    = tmpCount * tmpPrice;
    var tmpDiscountCol = tmpCount * tmpDiscount;
    var tmpFinalCol    = tmpCount * (tmpPrice - tmpDiscount);

    // count of row
    calcDtCountRow    += 1;
    // sum of counts
    calcDtSumCount    += tmpCount;
    calcDtSumPrice    += tmpPriceCol;
    calcDtSumDiscount += tmpDiscountCol;
    calcDtSumTotal    += tmpFinalCol;

    // set discount percent
    tmpDiscountPercent = (tmpDiscount * 100 / tmpPrice).toFixed(2);
    if($.isNumeric(tmpDiscountPercent) && tmpDiscountPercent>0 )
    {
      // $(this).find('td.cellDiscount .addon').text(fitNumber(tmpDiscountPercent) + '%');
      $(this).find('td.cellDiscount input').attr('title', fitNumber(tmpDiscountPercent) + ' %');
    }
    else
    {
      $(this).find('td.cellDiscount input').attr('title', '00');
      // $(this).find('td.cellDiscount .addon').text('');
    }

    // set final price
    if(tmpFinalCol === 0 && !tmpPrice)
    {
      $(this).find('td.cellTotal').text('');
    }
    else
    {
      $(this).find('td.cellTotal').text(fitNumber(tmpFinalCol));
    }

    // some conditional formating
    if(tmpPrice < tmpDiscount)
    {
      $(this).find('.discount').addClass('negative');
      $(this).find('td.cellDiscount').addClass('negative');
      $(this).find('td.cellTotal').addClass('negative');
    }
    else
    {
      $(this).find('.discount').removeClass('negative');
      $(this).find('td.cellDiscount').removeClass('negative');
      $(this).find('td.cellTotal').removeClass('negative');
    }

  });

  // remove decimal value from total price
  // in future get option from store setting to round this value
  calcDtSumPrice    = Math.round(calcDtSumPrice);
  calcDtSumDiscount = Math.round(calcDtSumDiscount);
  calcDtSumTotal    = Math.round(calcDtSumTotal);

  // calc discount percent
  if(calcDtSumDiscount > 0)
  {
    calcDtDiscountPercent = (calcDtSumDiscount / calcDtSumPrice * 100).toFixed(2);
  }


  // show or hide priceBox
  if(calcDtCountRow > 0)
  {
    showWithFade($('.priceBox'));
  }
  else
  {
    setTimeout(function()
    {
      $('.priceBox').slideUp();
    }, 700);
  }

  $('.priceBox .final span').text(fitNumber(calcDtSumTotal)).attr('data-val', calcDtSumTotal);
  $(".priceBox .final").shrink(60);
  $('.priceBox .desc').text(wordifyTomans(calcDtSumTotal));
  $('.priceBox .item span').text(fitNumber(calcDtCountRow)).attr('data-val', calcDtCountRow);
  $('.priceBox .count span').text(fitNumber(calcDtSumCount)).attr('data-val', calcDtSumCount);
  $('.priceBox .sum span').text(fitNumber(calcDtSumPrice)).attr('data-val', calcDtSumPrice);
  $('.priceBox .discountPercent span').text(fitNumber(calcDtDiscountPercent)+ "%").attr('data-val', calcDtDiscountPercent);
  $('.priceBox .discount span').text(fitNumber(calcDtSumDiscount)).attr('data-val', calcDtSumDiscount);
  // update count of item in table
  _table.attr('data-item', calcDtCountRow);

  if(calcDtCountRow === calcDtSumCount || calcDtSumCount === 0)
  {
    $('.priceBox .count').slideUp();
  }
  else
  {
    $('.priceBox .count').slideDown();
  }
  if(calcDtSumDiscount === 0)
  {
    if($('.priceBox .discount').attr('data-wodiscount') === undefined)
    {
      $('.priceBox .discountPercent').slideUp('fast');
      $('.priceBox .discount').slideUp('fast');
    }
    else
    {
      $('.priceBox .discountPercent').slideDown();
      $('.priceBox .discount').slideDown();
    }
  }
  else
  {
    $('.priceBox .discountPercent').slideDown();
    $('.priceBox .discount').slideDown();
  }
  // show fadein box
  if(calcDtCountRow > 0)
  {
    showWithFade($('.NextBox'));
  }
  else
  {
   $('.NextBox').fadeOut('fast');
  }

    // $('.priceBox .final span').text('-');
}







function bindBtnOnFactor()
{
  $('body').on('barcode:detect', function(_e, _barcode)
  {
    if($('#productSearch').length < 1)
    {
      return null;
    }
    $('#productSearch').val('');
    productBarcodeFinded(_barcode)
    // set focus to productSearch field
    $('#productSearch').parent().find('input.search').val('').trigger("focus");
  });

  $(document).on('focus', '#factorAdd table input', function()
  {
    var myTr = $(this).parents('tr');
    if(myTr.attr('data-selected') === undefined)
    {
      navigationFactorAddSetSelected(myTr);
    }
  });

  $(document).on('blur', '#factorAdd table input', function()
  {
    $(this).parents('tr').attr('data-selected', null);
  });


  $(document).on('focus', '#productSearch', function()
  {
    calcFooterValues();
  });

  $(document).on('input', 'input.count', function()
  {
    calcFooterValues();
  });

  $(document).on('blur', 'input.count', function()
  {
    calcFooterValues();
  });

  $(document).on('input', 'input.buy', function()
  {
    calcFooterValues();
  });

  $(document).on('blur', 'input.buy', function()
  {
    calcFooterValues();
  });

  $(document).on('click', '.priceBox .discount', function()
  {
    shortkey_toggleDiscount();
  });

  $(document).on('input', 'input.discount', function()
  {
    calcFooterValues();
  });

  $(document).on('blur', 'input.discount', function()
  {
    calcFooterValues();
  });

  sendToPcPos();

  // add event to handle dropdown selected value
  $('body').on('dropdown:selected:datalist', function(_e, _selectedProduct)
  {
    if(_selectedProduct)
    {
      addFindedProduct(_selectedProduct);
    }
    else
    {
      logy('datalist is not exist');
    }

  });
}



function checkProductExist(_key, _value)
{
  // try to find this product with barcode
  switch(_key)
  {
    case 'barcode':
      var productInList = $('table tbody [data-barcode='+ _value +']');
      // if not finded in barcode, search in barcode2
      if(!productInList.length)
      {
        productInList = $('table tbody [data-barcode2='+ _value +']');
      }
      // if finded try to increase number of this product
      if(productInList.length)
      {
        return productInList;
      }
      break;

    case 'id':
      var productInList = $('table tbody [data-id='+ _value +']');
      // if finded try to increase number of this product
      if(productInList.length)
      {
        return productInList;
      }
      break;
  }
  // not finded
  return false;
}


/**
 * check conditions after finding barcode
 * @param  {[type]} _barcode [description]
 * @return {[type]}          [description]
 */
function productBarcodeFinded(_barcode)
{
  var existRecord = checkProductExist('barcode', _barcode);
  // for simple product we find that barcode
  // but for scale we dont find it and try to add new record
  if(existRecord)
  {
    updateRecord_ProductList(existRecord, 'count');
  }
  else
  {
    searchForProduct('barcode', _barcode);
  }
}


/**
 * try to search on server
 * @param  {[type]} _key   [description]
 * @param  {[type]} _value [description]
 * @return {[type]}        [description]
 */
function searchForProduct(_key, _value)
{
  // if is not barcode and not finde02902749
  // d, search and if find, add or update
  var pSearchURL = "/a/product?json=true&" + _key + "=" + _value;
  $.get(pSearchURL, function(_productData)
  {
    var myMsg;
    pData = clearJson(_productData);
    if(_productData && _productData.result && _productData.result.message)
    {
      myMsg = _productData.result.message;
    }

    // if have error show error message
    if(myMsg)
    {
      addFindedProduct(null, myMsg, _value);
    }
    else
    {
      addFindedProduct(pData);
    }
  });
}



/**
 * final function to add record of product
 * @param {[type]} _product [description]
 */
function addFindedProduct(_product, _msg, _searchedValue)
{
  if(_product)
  {
    if(_product.id)
    {
      var existRecord = checkProductExist('id', _product.id);
      if(existRecord)
      {
        if(_product.scale)
        {
          var duplicateMsg = _product.scaleDuplicate;
          if(!duplicateMsg)
          {
            duplicateMsg = 'Duplicate';
          }

          say(
          {
            type: 'warning',
            text: duplicateMsg,
          });
        }
        else
        {
          updateRecord_ProductList(existRecord, 'count', _product.quantity);
        }
      }
      else
      {
        addNewRecord_ProductList(null, _product);
      }
    }
    else
    {
      say(
      {
        type: 'error',
        text: 'Error in products!',
      });
    }
  }
  else
  {
    if(_msg)
    {
      notif('warn', _msg, null, null, {position:'center', displayMode: 1});
    }
    else
    {
      say(
      {
        type: 'error',
        text: 'Product is not detected!',
      });
    }

    beep('ProductNotExist');
    // show custom message if product not fount
    // if(productNotExistList)
    // productNotExistList.[_searchedValue] = 1;
  }
}

// var productNotExistList;


//All arguments are optional:

//duration of the tone in milliseconds. Default is 500
//frequency of the tone in hertz. default is 440
//volume of the tone. Default is 1, off is 0.
//type of tone. Possible values are sine, square, sawtooth, triangle, and custom. Default is sine.
//callback to use on end of tone
function beep(_msg, duration, frequency, volume, type, callback)
{
  //if you have another AudioContext class use that one, as some browsers have a limit
  try
  {
    var audioCtx = new (window.AudioContext || window.webkitAudioContext || window.audioContext);
  }
  catch(err)
  {
    logy(err.message);
  }
  if(audioCtx)
  {
    var oscillator = audioCtx.createOscillator();
    var gainNode   = audioCtx.createGain();

    oscillator.connect(gainNode);
    gainNode.connect(audioCtx.destination);

    if (volume){gainNode.gain.value           = volume;};
    if (frequency){oscillator.frequency.value = frequency;}
    if (type){oscillator.type                 = type;}
    if (callback){oscillator.onended          = callback;}

    oscillator.start();
    setTimeout(function(){oscillator.stop()}, (duration ? duration : 500));
  }
  else
  {
    logy('close some tabs!');
  }

  _msg =  '/static/sounds/'+ _msg +'.mp4';

  var audio = new Audio(_msg);
  audio.play();
  // try to create sys beep
  sysBeep();
};

function sysBeep()
{
  logy('\u0007');
}



/**
 * update record and increase number of exist record
 * @param  {[type]} _row   [description]
 * @param  {[type]} _key   [description]
 * @param  {[type]} _value [description]
 * @return {[type]}        [description]
 */
function updateRecord_ProductList(_row, _key, _value)
{
  switch (_key)
  {
    case 'count':
      var currentCounter = _row.find('.count');
      console.log(_value);
      if(!_value)
      {
        _value = 1;
      }
      currentCounter.val(parseFloat(currentCounter.val()) + _value);
      break;
  }

  $('#productSearch').val('');
  calcFooterValues();
}


/**
 * add record to table of products
 * @param {[type]} _table   [description]
 * @param {[type]} _product [description]
 * @param {[type]} _append  [description]
 */
function addNewRecord_ProductList(_table, _product, _append)
{
  if(!_table)
  {
    _table = $('.productList');
    if(_table.length < 1)
    {
      return null;
    }
  }

  var factorType = $('body').attr('data-page');

  var trEmpty   = '<tr>';
  trEmpty       += '<td class="cellIndex"></td>';
  trEmpty       += '<td class="cellTitle"></td>';
  trEmpty       += '<td class="cellCount"></td>';
  if(factorType === 'buy')
  {
    trEmpty       += '<td class="cellBuy"></td>';
  }
  else
  {
    trEmpty       += '<td class="cellPrice"></td>';
    trEmpty       += '<td class="cellDiscount"></td>';
  }
  trEmpty       += '<td class="cellTotal"></td>';
  trEmpty       += '</tr>';
  var newRecord = $(trEmpty);
  var cuRow     = _table.find('tr').length;
  // set row number
  newRecord.find('td.cellIndex').text(fitNumber(cuRow));
  if(_product)
  {
    var myQuantity = _product.quantity;
    if(!myQuantity)
    {
      myQuantity = 1;
    }
    var htmlPName     = _product.title + '<input type="hidden" name="products[]" class="hidden" value="' + _product.id + '">';
    var htmlPCount    = '<input class="input count" type="number" name="count[]" autocomplete="off" min="0" max="1000000000" step="any" placeholder="-" value="'+ myQuantity +'">';
    if(factorType === 'buy')
    {
      htmlPCount = '<input class="input count" type="number" name="count[]" autocomplete="off" min="0" max="1000000000" step="any" placeholder="-" >';
    }

    var htmlPBuy      = '<input class="input buy" type="number" name="buy[]" autocomplete="off" min="0" max="1000000000" value="' + _product.buyprice +'">';
    var htmlPDiscount = '<div class="input discountCn">';
    htmlPDiscount    += '<input class="discount" type="number" name="discount[]" autocomplete="off" title="%" min="0" max="1000000000"';
    if(_product.discount)
    {
      var removeDiscount = !(_table.attr('data-woDiscount') !== undefined);
      if(removeDiscount)
      {
        htmlPDiscount += ' value="' + _product.discount + '"';
      }
      // set data-discount on all condition
      htmlPDiscount += ' data-discount="' + _product.discount + '"';
    }
    htmlPDiscount    += '>';
    // htmlPDiscount    += '<span class="addon small">0%</span>'+ '</div>';

    // fill with product details
    // logy(_product);
    newRecord.attr('data-id', _product.id);
    newRecord.attr('data-barcode', _product.barcode);
    newRecord.attr('data-barcode2', _product.barcode2);
    newRecord.find('td.cellTitle').html(htmlPName);
    newRecord.find('td.cellCount').html(htmlPCount);
    if(factorType === 'buy')
    {
      newRecord.find('td.cellBuy').html(htmlPBuy);
    }
    else
    {
      newRecord.find('td.cellPrice').text(fitNumber(_product.price)).attr('data-val', _product.price);
      newRecord.find('td.cellDiscount').html(htmlPDiscount);
    }

    newRecord.find('td.cellTotal').text(fitNumber(_product.finalprice)).attr('data-val', _product.finalprice);
  }
  else
  {
    // empty all inputs
    newRecord.find("input").val('');
    newRecord.find('td.cellPrice').text('');
    newRecord.find('td.cellTotal').text('');
  }

  if(_append)
  {
    // appent to end of table
    newRecord.appendTo('.productList tbody');
  }
  else
  {
    // prepent to start of table
    newRecord.prependTo('.productList tbody');
  }
  // run tippy again for discount
  runTippy();

  calcFooterValues(_table);
}


function qtyFactorTableItems()
{
  NoRecordExist = $('#factorAdd table tbody tr').length;
  return NoRecordExist;
}


function showWithFade(_el)
{
  if(_el.hasClass('hide'))
  {
    _el.removeClass('hide').hide();
  }
  _el.fadeIn();
}


function navigateonFactorAddInputs(_type, _e)
{
  if(!check_factor())
  {
    return false;
  }
  // check focus
  var $focus = $(":focus");

  if(($focus.parents('.productList').length !== 1))
  {
    // outside of table
    return false;
  }

  var currentTd  = $focus.parents('td');
  var currentTr  = $focus.parents('tr');

  // var currentRow = $('#factorAdd .productList tbody').index(currentTr);
  var currentRow = currentTr.index();
  var maxRow     = $('#factorAdd .productList tbody tr').length -1;
  var nextRow    = currentRow;
  var nextField  = 'count';
  // check input group
  if($focus.is('.count'))
  {
    nextField = 'count';
  }
  else if($focus.is('.discount'))
  {
    nextField = 'discount';
  }

  switch(_type)
  {
    case 'up':
      nextRow -= 1;
      _e.preventDefault();
      break;

    case 'down':
      nextRow += 1;
      _e.preventDefault();
      break;

    case 'left':
    case 'right':

      if(nextField == 'count')
      {
        nextField = 'discount';
      }
      else if(nextField == 'discount')
      {
        nextField = 'count';
      }
      break;
  }

  if(nextRow < 0)
  {
    // end
    nextRow = maxRow;
  }
  else if(nextRow > maxRow)
  {
    nextRow = 0;
  }

  var nextRowEl      = $('#factorAdd .productList tbody tr:eq('+ nextRow +')');
  var nextRowInputEl = nextRowEl.find('input.'+ nextField);
  navigationFactorAddSetSelected(nextRowEl);

  setTimeout(function()
  {
    nextRowInputEl.select();
  }, 10);
}


function navigationFactorAddSetSelected(_tr, _focus)
{
  if(!_tr || _tr.length === 0)
  {
    _tr = $('#factorAdd .productList tbody tr:first-child');
  }

  // remove other selecred
  $('#factorAdd .productList tbody tr').attr('data-selected', null);
  // add selected to specefic one
  _tr.attr('data-selected', '');
  if(_focus === true)
  {
    _tr.find('.input.count').select();
  }
}


function shortkey_toggleDiscount(_status)
{
  var priceDiscountEl = $('.priceBox .discount');
  var removeDiscount = !(priceDiscountEl.attr('data-woDiscount') !== undefined);
  if(removeDiscount)
  {
    priceDiscountEl.attr('data-woDiscount', '');
    $('.productList th.headDiscount').addClass('negative').attr('data-woDiscount', '');
  }
  else
  {
    priceDiscountEl.attr('data-woDiscount', null);
    $('.productList th.headDiscount').removeClass('negative').attr('data-woDiscount', null);
  }

  $('.productList input.discount').each(function()
  {
    if(removeDiscount)
    {
      var currentVal = parseInt($(this).val());
      if(!$.isNumeric(currentVal))
      {
        currentVal = null;
      }
      $(this).attr('data-discount', currentVal);
      $(this).val('');
    }
    else
    {
      var savedDiscount = $(this).attr('data-discount');
      if($.isNumeric(savedDiscount))
      {
        $(this).val(savedDiscount);
      }
    }
  });
  // recalc values
  calcFooterValues();
}



function shortkey_print(_el)
{
  if($("#sale_clicked_btn").length)
  {
    $("#sale_clicked_btn").attr('value', 'save_print');
    $("#sale_clicked_btn").parents('form').submit();
  }
  logy('printing...');
}


function prevFactor(_type, _all)
{
  if(_type === undefined)
  {
    _type = 'sale';
  }
  var lastFactorUrl = '/a/' + _type + '/prev';
  // add id if exist
  if(check_factor() && urlParam('id'))
  {
    lastFactorUrl += '/'+ urlParam('id');
  }
  // add lang if exist
  if($('html').attr('lang') !== undefined)
  {
    lastFactorUrl = $('html').attr('lang')+ lastFactorUrl;
  }
  if(_all)
  {
    lastFactorUrl += '?in=all';
  }
  Navigate({ url: lastFactorUrl });
}



function recalcPricePercents()
{
  // if((window.location.pathname).indexOf('/a/product') < 0 || $('#price').length === 0)
  // {
  //   return;
  // }

  // declare variables
  var elFinalPriceBox = $('#finalprice').parent().parent();
  var buy             = parseInt($('#buyprice').val().toEnglish());
  var sale            = parseInt($('#price').val().toEnglish());
  var discount        = parseInt($('#discount').val().toEnglish());
  var finalPrice      = 0;

  var impureIntrestRate = 0;
  var pureIntrestRate   = 0;
  var discountRate      = 0;
  // check and set NAN value
  if(isNaN(buy))
  {
    buy = 0;
  }
  if(isNaN(sale))
  {
    sale = 0;
  }
  if(isNaN(discount))
  {
    discount = 0;
  }

  // impureIntrestRate
  if(buy && sale)
  {
    impureIntrestRate = ((sale * 100 / buy) - 100).toFixed(2);
    pureIntrestRate   = (((sale - discount) * 100 / buy) - 100).toFixed(2);
  }
  $('#price').parent().find('.addon').text(fitNumber(impureIntrestRate) + '%');

  // Discount Rate
  if(discount && sale)
  {
    discountRate = (discount * 100 / sale).toFixed(2);
  }
  $('#discount').parent().find('.addon').text(fitNumber(discountRate) + '%');

  // final price
  finalPrice = sale - discount;
  $('#finalprice').val(finalPrice);
  elFinalPriceBox.find('.addon').text(fitNumber(pureIntrestRate) + '%');
  $('.finalPriceToman').text(wordifyTomans(finalPrice))
  if(sale)
  {
    if(elFinalPriceBox.hasClass('hide'))
    {
      elFinalPriceBox.removeClass('hide').slideDown();
    }
    else
    {
      elFinalPriceBox.slideDown();
    }
  }
  else
  {
    elFinalPriceBox.slideUp();
  }

  // conditional check
  var elPrice      = $('#price').parents('.input');
  var elDiscount   = $('#discount').parents('.input');
  var elFinalPrice = $('#finalprice').parents('.input');

  // all check for price
  // if price is not normal and under buy price, impure under zero
  if(impureIntrestRate < 0)
  {
    elPrice.addClass('warning');
  }
  else
  {
    elPrice.removeClass('warning');
  }
  // if discount is more than 100% of sale price
  if(discount === 0)
  {
    elDiscount.removeClass('error');
    elDiscount.removeClass('warning');
  }
  else if(discountRate > 100)
  {
    elDiscount.addClass('error');
    elDiscount.removeClass('warning');
  }
  else if(sale - discount < buy)
  {
    elDiscount.removeClass('error');
    elDiscount.addClass('warning');
  }
  else
  {
    elDiscount.removeClass('error');
    elDiscount.removeClass('warning');
  }

  // all check for final price
  if(finalPrice === 0)
  {
    elFinalPrice.removeClass('error');
    elFinalPrice.removeClass('warning');
    elFinalPrice.removeClass('ok');
  }
  else if(finalPrice < 0)
  {
    elFinalPrice.addClass('error');
    elFinalPrice.removeClass('warning');
    elFinalPrice.removeClass('ok');
  }
  else if(finalPrice < buy)
  {
    elFinalPrice.removeClass('error');
    elFinalPrice.addClass('warning');
    elFinalPrice.removeClass('ok');
  }
  else
  {
    elFinalPrice.removeClass('error');
    elFinalPrice.removeClass('warning');
    elFinalPrice.addClass('ok');
  }
}

function sendToPcPos()
{
  $(document).on('click', '.pcPos', function()
  {
    var myLink    = $(this).attr('data-link');
    var lastPrice = $('.priceBox .final span').attr('data-val');
    lastPrice += "0";

    if(lastPrice > 0)
    {
      // replace last price
      myLink = myLink.replace("$", lastPrice);
      console.log('send price to pcpos ' + lastPrice);
        $.ajax(
        {
            type: "GET",
            url: myLink,
            dataType: 'jsonp',
            success: function (_data)
            {
              notif('info', 'مبلغ ' + lastPrice + ' به پی‌سی‌پوز ارسال شد.');
              console.log('success calling pcpos');
              console.log(_data);
            },
            error: function (_e)
            {
              // notif('error', 'خطا در اتصال اولیه به پی‌سی‌پوز');
              console.log('error on pcpos');
              console.log(JSON.stringify(_e));
            }
        });
    }
    else
    {
      console.log('Price is not valid to send to pcpos ' + lastPrice);
    }
  });
}




