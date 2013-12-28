/*!
imgLiquid v0.9.944 / 03-05-2013
jQuery plugin to resize images to fit in a container.
Copyright (c) 2012 Alejandro Emparan (karacas) @krc_ale
Dual licensed under the MIT and GPL licenses
https://github.com/karacas/imgLiquid
**//*
ex:
	$('.imgLiquid').imgLiquid({fill:true});

	// OPTIONS:

	> js:
			fill: true,
			verticalAlign:		// 'center' //	'top'	//	'bottom' // '50%'  // '10%'
			horizontalAlign:	// 'center' //	'left'	//	'right'  // '50%'  // '10%'

	> CallBacks:
			onStart:		function(){},
			onFinish:		function(){},
			onItemStart:	function(index, container, img){},
			onItemFinish:	function(index, container, img){}

	> hml5 data attr (overwrite all)
			data-imgLiquid-fill='true'
			data-imgLiquid-horizontalAlign='center'
			data-imgLiquid-verticalAlign='center'
*///
var imgLiquid=imgLiquid||{VER:"0.9.944"};imgLiquid.bgs_Available=!1;imgLiquid.bgs_CheckRunned=!1;imgLiquid.injectCss=".imgLiquid img {visibility:hidden}";(function(e){function t(){if(imgLiquid.bgs_CheckRunned)return;imgLiquid.bgs_CheckRunned=!0;var t=e('<span style="background-size:cover" />');e("body").append(t);!function(){var e=t[0];if(!e||!window.getComputedStyle)return;var n=window.getComputedStyle(e,null);if(!n||!n.backgroundSize)return;imgLiquid.bgs_Available=n.backgroundSize==="cover"}();t.remove()}e.fn.extend({imgLiquid:function(n){this.defaults={fill:!0,verticalAlign:"center",horizontalAlign:"center",useBackgroundSize:!0,useDataHtmlAttr:!0,responsive:!0,delay:0,fadeInTime:0,removeBoxBackground:!0,hardPixels:!0,responsiveCheckTime:500,timecheckvisibility:500,onStart:null,onFinish:null,onItemStart:null,onItemFinish:null,onItemError:null};t();var r=this;this.options=n;this.settings=e.extend({},this.defaults,this.options);this.settings.onStart&&this.settings.onStart();return this.each(function(t){function o(){i.css("background-image").indexOf(encodeURI(s.attr("src")))===-1&&i.css({"background-image":'url("'+s.attr("src")+'")'});i.css({"background-size":n.fill?"cover":"contain","background-position":(n.horizontalAlign+" "+n.verticalAlign).toLowerCase(),"background-repeat":"no-repeat"});e("a:first",i).css({display:"block",width:"100%",height:"100%"});e("img",i).css({display:"none"});n.onItemFinish&&n.onItemFinish(t,i,s);i.addClass("imgLiquid_bgSize");i.addClass("imgLiquid_ready");h()}function u(){function o(){if(s.data("imgLiquid_error")||s.data("imgLiquid_loaded")||s.data("imgLiquid_oldProcessed"))return;if(i.is(":visible")&&s[0].complete&&s[0].width>0&&s[0].height>0){s.data("imgLiquid_loaded",!0);setTimeout(c,t*n.delay)}else setTimeout(o,n.timecheckvisibility)}if(s.data("oldSrc")&&s.data("oldSrc")!==s.attr("src")){var r=s.clone().removeAttr("style");r.data("imgLiquid_settings",s.data("imgLiquid_settings"));s.parent().prepend(r);s.remove();s=r;s[0].width=0;setTimeout(u,10);return}if(s.data("imgLiquid_oldProcessed")){c();return}s.data("imgLiquid_oldProcessed",!1);s.data("oldSrc",s.attr("src"));e("img:not(:first)",i).css("display","none");i.css({overflow:"hidden"});s.fadeTo(0,0).removeAttr("width").removeAttr("height").css({visibility:"visible","max-width":"none","max-height":"none",width:"auto",height:"auto",display:"block"});s.on("error",f);s[0].onerror=f;o();a()}function a(){if(!n.responsive&&!s.data("imgLiquid_oldProcessed"))return;if(!s.data("imgLiquid_settings"))return;n=s.data("imgLiquid_settings");i.actualSize=i.get(0).offsetWidth+i.get(0).offsetHeight/1e4;i.sizeOld&&i.actualSize!==i.sizeOld&&c();i.sizeOld=i.actualSize;setTimeout(a,n.responsiveCheckTime)}function f(){s.data("imgLiquid_error",!0);i.addClass("imgLiquid_error");n.onItemError&&n.onItemError(t,i,s);h()}function l(){var e={};if(r.settings.useDataHtmlAttr){var t=i.attr("data-imgLiquid-fill"),n=i.attr("data-imgLiquid-horizontalAlign"),s=i.attr("data-imgLiquid-verticalAlign");if(t==="true"||t==="false")e.fill=Boolean(t==="true");n!==undefined&&(n==="left"||n==="center"||n==="right"||n.indexOf("%")!==-1)&&(e.horizontalAlign=n);s!==undefined&&(s==="top"||s==="bottom"||s==="center"||s.indexOf("%")!==-1)&&(e.verticalAlign=s)}imgLiquid.isIE&&r.settings.ieFadeInDisabled&&(e.fadeInTime=0);return e}function c(){var e,r,o,u,a,f,l,c,p=0,d=0,v=i.width(),m=i.height();s.data("owidth")===undefined&&s.data("owidth",s[0].width);s.data("oheight")===undefined&&s.data("oheight",s[0].height);if(n.fill===v/m>=s.data("owidth")/s.data("oheight")){e="100%";r="auto";o=Math.floor(v);u=Math.floor(v*(s.data("oheight")/s.data("owidth")))}else{e="auto";r="100%";o=Math.floor(m*(s.data("owidth")/s.data("oheight")));u=Math.floor(m)}a=n.horizontalAlign.toLowerCase();l=v-o;a==="left"&&(d=0);a==="center"&&(d=l*.5);a==="right"&&(d=l);if(a.indexOf("%")!==-1){a=parseInt(a.replace("%",""),10);a>0&&(d=l*a*.01)}f=n.verticalAlign.toLowerCase();c=m-u;f==="left"&&(p=0);f==="center"&&(p=c*.5);f==="bottom"&&(p=c);if(f.indexOf("%")!==-1){f=parseInt(f.replace("%",""),10);f>0&&(p=c*f*.01)}if(n.hardPixels){e=o;r=u}s.css({width:e,height:r,"margin-left":Math.floor(d),"margin-top":Math.floor(p)});if(!s.data("imgLiquid_oldProcessed")){s.fadeTo(n.fadeInTime,1);s.data("imgLiquid_oldProcessed",!0);n.removeBoxBackground&&i.css("background-image","none");i.addClass("imgLiquid_nobgSize");i.addClass("imgLiquid_ready")}n.onItemFinish&&n.onItemFinish(t,i,s);h()}function h(){t===r.length-1&&r.settings.onFinish&&r.settings.onFinish()}var n=r.settings,i=e(this),s=e("img:first",i);if(!s.length){f();return}if(!s.data("imgLiquid_settings"))n=e.extend({},r.settings,l());else{i.removeClass("imgLiquid_error").removeClass("imgLiquid_ready");n=e.extend({},s.data("imgLiquid_settings"),r.options)}s.data("imgLiquid_settings",n);n.onItemStart&&n.onItemStart(t,i,s);imgLiquid.bgs_Available&&n.useBackgroundSize?o():u()})}})})(jQuery);!function(){var e=imgLiquid.injectCss,t=document.getElementsByTagName("head")[0],n=document.createElement("style");n.type="text/css";n.styleSheet?n.styleSheet.cssText=e:n.appendChild(document.createTextNode(e));t.appendChild(n)}();