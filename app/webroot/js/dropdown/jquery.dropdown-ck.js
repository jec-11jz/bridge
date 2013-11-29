/**
 * jquery.dropdown.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2012, Codrops
 * http://www.codrops.com
 */(function(e,t,n){"use strict";e.DropDown=function(t,n){this.$el=e(n);this._init(t)};e.DropDown.defaults={speed:300,easing:"ease",gutter:0,stack:!0,delay:0,random:!1,rotated:!1,slidingIn:!1,onOptionSelect:function(e){return!1}};e.DropDown.prototype={_init:function(t){this.options=e.extend(!0,{},e.DropDown.defaults,t);this._layout();this._initEvents()},_layout:function(){var t=this;this.minZIndex=1e3;var r=this._transformSelect();this.opts=this.listopts.children("li");this.optsCount=this.opts.length;this.size={width:this.dd.width(),height:this.dd.height()};var i=this.$el.attr("name"),s=this.$el.attr("id"),o=i!==n?i:s!==n?s:"cd-dropdown-"+(new Date).getTime();this.inputEl=e('<input type="hidden" name="'+o+'" value="'+r+'"></input>').insertAfter(this.selectlabel);this.selectlabel.css("z-index",this.minZIndex+this.optsCount);this._positionOpts();Modernizr.csstransitions&&setTimeout(function(){t.opts.css("transition","all "+t.options.speed+"ms "+t.options.easing)},25)},_transformSelect:function(){var t="",r="",i=-1;this.$el.children("option").each(function(){var s=e(this),o=isNaN(s.attr("value"))?s.attr("value"):Number(s.attr("value")),u=s.attr("class"),a=s.attr("selected"),f=s.text();o!==-1&&(t+=u!==n?'<li data-value="'+o+'"><span class="'+u+'">'+f+"</span></li>":'<li data-value="'+o+'"><span>'+f+"</span></li>");if(a){r=f;i=o}});this.listopts=e("<ul/>").append(t);this.selectlabel=e("<span/>").append(r);this.dd=e('<div class="cd-dropdown"/>').append(this.selectlabel,this.listopts).insertAfter(this.$el);this.$el.remove();return i},_positionOpts:function(t){var n=this;this.listopts.css("height","auto");this.opts.each(function(t){e(this).css({zIndex:n.minZIndex+n.optsCount-1-t,top:n.options.slidingIn?(t+1)*(n.size.height+n.options.gutter):0,left:0,marginLeft:n.options.slidingIn?t%2===0?n.options.slidingIn:-n.options.slidingIn:0,opacity:n.options.slidingIn?0:1,transform:"none"})});this.options.slidingIn||this.opts.eq(this.optsCount-1).css({top:this.options.stack?0:0,left:this.options.stack?4:0,width:this.options.stack?this.size.width-8:this.size.width,transform:"none"}).end().eq(this.optsCount-2).css({top:this.options.stack?0:0,left:this.options.stack?2:0,width:this.options.stack?this.size.width-4:this.size.width,transform:"none"}).end().eq(this.optsCount-3).css({top:this.options.stack?0:0,left:0,transform:"none"})},_initEvents:function(){var t=this;this.selectlabel.on("mousedown.dropdown",function(e){t.opened?t.close():t.open();return!1});this.opts.on("click.dropdown",function(){if(t.opened){var n=e(this);t.options.onOptionSelect(n);t.inputEl.val(n.data("value"));t.selectlabel.html(n.html());t.close()}})},open:function(){var t=this;this.dd.toggleClass("cd-active");this.listopts.css("height",(this.optsCount+1)*(this.size.height+this.options.gutter));this.opts.each(function(n){e(this).css({opacity:1,top:t.options.rotated?t.size.height+t.options.gutter:(n+1)*(t.size.height+t.options.gutter),left:t.options.random?Math.floor(Math.random()*11-5):0,width:t.size.width,marginLeft:0,transform:t.options.random?"rotate("+Math.floor(Math.random()*11-5)+"deg)":t.options.rotated?t.options.rotated==="right"?"rotate(-"+n*5+"deg)":"rotate("+n*5+"deg)":"none",transitionDelay:t.options.delay&&Modernizr.csstransitions?t.options.slidingIn?n*t.options.delay+"ms":(t.optsCount-1-n)*t.options.delay+"ms":0})});this.opened=!0},close:function(){var t=this;this.dd.toggleClass("cd-active");this.options.delay&&Modernizr.csstransitions&&this.opts.each(function(n){e(this).css({"transition-delay":t.options.slidingIn?(t.optsCount-1-n)*t.options.delay+"ms":n*t.options.delay+"ms"})});this._positionOpts(!0);this.opened=!1}};e.fn.dropdown=function(t){var n=e.data(this,"dropdown");if(typeof t=="string"){var r=Array.prototype.slice.call(arguments,1);this.each(function(){n[t].apply(n,r)})}else this.each(function(){n?n._init():n=e.data(this,"dropdown",new e.DropDown(t,this))});return n}})(jQuery,window);