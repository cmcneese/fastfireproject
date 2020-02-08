/**
* Source : https://github.com/taras-d/images-grid
* Image Grid
*/

!function(i){function t(t){this.opts=t||{},this.$window=i(window),this.$element=this.opts.element,this.$gridItems=[],this.modal=null,this.imageLoadCount=0;var e=this.opts.cells;this.opts.cells=e<1?1:e>6?6:e,this.onWindowResize=this.onWindowResize.bind(this),this.onImageClick=this.onImageClick.bind(this),this.init()}function e(t){this.opts=t||{},this.imageIndex=null,this.$document=i(document),this.$modal=null,this.$indicator=null,this.close=this.close.bind(this),this.prev=this.prev.bind(this),this.next=this.next.bind(this),this.onIndicatorClick=this.onIndicatorClick.bind(this),this.onImageLoaded=this.onImageLoaded.bind(this),this.onKeyUp=this.onKeyUp.bind(this),this.$document.on("keyup",this.onKeyUp)}i.fn.imagesGrid=function(e){var o=arguments;return this.each(function(){if(i.isPlainObject(e)){this._imgGrid instanceof t&&(this._imgGrid.destroy(),delete this._imgGrid);var n=i.extend({},i.fn.imagesGrid.defaults,e);return n.element=i(this),void(this._imgGrid=new t(n))}if("string"==typeof e&&this._imgGrid instanceof t)switch(e){case"modal.open":this._imgGrid.modal.open(o[1]);break;case"modal.close":this._imgGrid.modal.close();break;case"destroy":this._imgGrid.destroy(),delete this._imgGrid}})},i.fn.imagesGrid.defaults={images:[],cells:5,align:!1,nextOnClick:!0,showViewAll:"more",viewAllStartIndex:"auto",loading:"loading...",getViewAllText:function(i){return"View all "+i+" images"},onGridRendered:i.noop,onGridItemRendered:i.noop,onGridLoaded:i.noop,onGridImageLoaded:i.noop,onModalOpen:i.noop,onModalClose:i.noop,onModalImageClick:i.noop,onModalImageUpdate:i.noop},t.prototype.init=function(){this.setGridClass(),this.renderGridItems(),this.createModal(),this.$window.on("resize",this.onWindowResize)},t.prototype.createModal=function(){var i=this.opts;this.modal=new e({loading:i.loading,images:i.images,nextOnClick:i.nextOnClick,onModalOpen:i.onModalOpen,onModalClose:i.onModalClose,onModalImageClick:i.onModalImageClick,onModalImageUpdate:i.onModalImageUpdate})},t.prototype.setGridClass=function(){var i=this.opts,t=i.images.length,e=t<i.cells?t:i.cells;this.$element.addClass("imgs-grid imgs-grid-"+e)},t.prototype.renderGridItems=function(){var i=this.opts,t=i.images,e=t.length;if(t){this.$element.empty(),this.$gridItems=[];for(var o=0;o<e&&o!==i.cells;++o)this.renderGridItem(t[o],o);("always"===i.showViewAll||"more"===i.showViewAll&&e>i.cells)&&this.renderViewAll(),i.onGridRendered(this.$element)}},t.prototype.renderGridItem=function(t,e){var o=t,n="",s="",a=this.opts,d=this;i.isPlainObject(t)&&(o=t.thumbnail||t.src,n=t.alt||"",s=t.title||"");var l=i("<div>",{class:"imgs-grid-image",click:this.onImageClick,data:{index:e}});l.append(i("<div>",{class:"image-wrap"}).append(i("<img>",{src:o,alt:n,title:s,on:{load:function(e){d.onImageLoaded(e,i(this),t)}}}))),this.$gridItems.push(l),this.$element.append(l),a.onGridItemRendered(l,t)},t.prototype.renderViewAll=function(){var t=this.opts;this.$element.find(".imgs-grid-image:last .image-wrap").append(i("<div>",{class:"view-all"}).append(i("<span>",{class:"view-all-cover"}),i("<span>",{class:"view-all-text",text:t.getViewAllText(t.images.length)})))},t.prototype.onWindowResize=function(i){this.opts.align&&this.align()},t.prototype.onImageClick=function(t){var e,o=this.opts,n=i(t.currentTarget);e=n.find(".view-all").length>0&&"number"==typeof o.viewAllStartIndex?o.viewAllStartIndex:n.data("index"),this.modal.open(e)},t.prototype.onImageLoaded=function(i,t,e){var o=this.opts;++this.imageLoadCount,o.onGridImageLoaded(i,t,e),this.imageLoadCount===this.$gridItems.length&&(this.imageLoadCount=0,this.onAllImagesLoaded())},t.prototype.onAllImagesLoaded=function(){var i=this.opts;i.align&&this.align(),i.onGridLoaded(this.$element)},t.prototype.align=function(){switch(this.$gridItems.length){case 2:case 3:this.alignItems(this.$gridItems);break;case 4:this.alignItems(this.$gridItems.slice(0,2)),this.alignItems(this.$gridItems.slice(2));break;case 5:case 6:this.alignItems(this.$gridItems.slice(0,3)),this.alignItems(this.$gridItems.slice(3))}},t.prototype.alignItems=function(t){var e=t.map(function(i){return i.find("img").height()}),o=Math.min.apply(null,e);i(t).each(function(){var t=i(this),e=t.find(".image-wrap"),n=t.find("img"),s=n.height();if(e.height(o),s>o){var a=Math.floor((s-o)/2);n.css({top:-a})}})},t.prototype.destroy=function(){this.$window.off("resize",this.onWindowResize),this.$element.empty().removeClass("imgs-grid imgs-grid-"+this.$gridItems.length),this.modal.destroy()},e.prototype.open=function(i){this.isOpened()||(this.imageIndex=parseInt(i)||0,this.render())},e.prototype.close=function(i){if(this.$modal){var t=this.opts;this.$modal.animate({opacity:0},{duration:100,complete:function(){this.$modal.remove(),this.$modal=null,this.$indicator=null,this.imageIndex=null,t.onModalClose()}.bind(this)})}},e.prototype.isOpened=function(){return this.$modal&&this.$modal.is(":visible")},e.prototype.render=function(){var i=this.opts;this.renderModal(),this.renderCaption(),this.renderCloseButton(),this.renderInnerContainer(),this.renderIndicatorContainer(),this.$modal.animate({opacity:1},{duration:100,complete:function(){i.onModalOpen(this.$modal,i.images[this.imageIndex])}.bind(this)})},e.prototype.renderModal=function(){this.$modal=i("<div>",{class:"imgs-grid-modal"}).appendTo("body")},e.prototype.renderCaption=function(){this.$caption=i("<div>",{class:"modal-caption",text:this.getImageCaption(this.imageIndex)}).appendTo(this.$modal)},e.prototype.renderCloseButton=function(){this.$modal.append(i("<div>",{class:"modal-close",click:this.close}))},e.prototype.renderInnerContainer=function(){var t=this.opts,e=this.getImage(this.imageIndex);this.$modal.append(i("<div>",{class:"modal-inner"}).append(i("<div>",{class:"modal-image"}).append(i("<img>",{src:e.src,alt:e.alt,title:e.title,on:{load:this.onImageLoaded,click:function(t){this.onImageClick(t,i(this),e)}.bind(this)}}),i("<div>",{class:"modal-loader",html:t.loading})),i("<div>",{class:"modal-control left",click:this.prev}).append(i("<div>",{class:"arrow left"})),i("<div>",{class:"modal-control right",click:this.next}).append(i("<div>",{class:"arrow right"})))),t.images.length<=1&&this.$modal.find(".modal-control").hide()},e.prototype.renderIndicatorContainer=function(){var t=this.opts.images.length;if(1!=t){this.$indicator=i("<div>",{class:"modal-indicator"});var e,o=i("<ul>");for(e=0;e<t;++e)o.append(i("<li>",{class:this.imageIndex==e?"selected":"",click:this.onIndicatorClick,data:{index:e}}));this.$indicator.append(o),this.$modal.append(this.$indicator)}},e.prototype.prev=function(){var i=this.opts.images.length;this.imageIndex>0?--this.imageIndex:this.imageIndex=i-1,this.updateImage()},e.prototype.next=function(){var i=this.opts.images.length;this.imageIndex<i-1?++this.imageIndex:this.imageIndex=0,this.updateImage()},e.prototype.updateImage=function(){var i=this.opts,t=this.getImage(this.imageIndex),e=this.$modal.find(".modal-image img");if(e.attr({src:t.src,alt:t.alt,title:t.title}),this.$modal.find(".modal-caption").text(this.getImageCaption(this.imageIndex)),this.$indicator){var o=this.$indicator.find("ul");o.children().removeClass("selected"),o.children().eq(this.imageIndex).addClass("selected")}this.showLoader(),i.onModalImageUpdate(e,t)},e.prototype.onImageClick=function(i,t,e){var o=this.opts;o.nextOnClick&&this.next(),o.onModalImageClick(i,t,e)},e.prototype.onImageLoaded=function(){this.hideLoader()},e.prototype.onIndicatorClick=function(t){var e=i(t.target).data("index");this.imageIndex=e,this.updateImage()},e.prototype.onKeyUp=function(i){if(this.$modal)switch(i.keyCode){case 27:this.close();break;case 37:this.prev();break;case 39:this.next()}},e.prototype.getImage=function(t){var e=this.opts.images[t];return i.isPlainObject(e)?e:{src:e,alt:"",title:""}},e.prototype.getImageCaption=function(i){return this.getImage(i).caption||""},e.prototype.showLoader=function(){this.$modal&&(this.$modal.find(".modal-image img").hide(),this.$modal.find(".modal-loader").show())},e.prototype.hideLoader=function(){this.$modal&&(this.$modal.find(".modal-image img").show(),this.$modal.find(".modal-loader").hide())},e.prototype.destroy=function(){this.$document.off("keyup",this.onKeyUp),this.close()}}(jQuery);

/*
* jquery-match-height 0.7.2 by @liabru
* http://brm.io/jquery-match-height/
* License MIT
*/

!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){var e=-1,o=-1,n=function(t){return parseFloat(t)||0},a=function(e){var o=1,a=t(e),i=null,r=[];return a.each(function(){var e=t(this),a=e.offset().top-n(e.css("margin-top")),s=r.length>0?r[r.length-1]:null;null===s?r.push(e):Math.floor(Math.abs(i-a))<=o?r[r.length-1]=s.add(e):r.push(e),i=a}),r},i=function(e){var o={
byRow:!0,property:"height",target:null,remove:!1};return"object"==typeof e?t.extend(o,e):("boolean"==typeof e?o.byRow=e:"remove"===e&&(o.remove=!0),o)},r=t.fn.matchHeight=function(e){var o=i(e);if(o.remove){var n=this;return this.css(o.property,""),t.each(r._groups,function(t,e){e.elements=e.elements.not(n)}),this}return this.length<=1&&!o.target?this:(r._groups.push({elements:this,options:o}),r._apply(this,o),this)};r.version="0.7.2",r._groups=[],r._throttle=80,r._maintainScroll=!1,r._beforeUpdate=null,
r._afterUpdate=null,r._rows=a,r._parse=n,r._parseOptions=i,r._apply=function(e,o){var s=i(o),h=t(e),l=[h],c=t(window).scrollTop(),p=t("html").outerHeight(!0),u=h.parents().filter(":hidden");return u.each(function(){var e=t(this);e.data("style-cache",e.attr("style"))}),u.css("display","block"),s.byRow&&!s.target&&(h.each(function(){var e=t(this),o=e.css("display");"inline-block"!==o&&"flex"!==o&&"inline-flex"!==o&&(o="block"),e.data("style-cache",e.attr("style")),e.css({display:o,"padding-top":"0",
"padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px",overflow:"hidden"})}),l=a(h),h.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||"")})),t.each(l,function(e,o){var a=t(o),i=0;if(s.target)i=s.target.outerHeight(!1);else{if(s.byRow&&a.length<=1)return void a.css(s.property,"");a.each(function(){var e=t(this),o=e.attr("style"),n=e.css("display");"inline-block"!==n&&"flex"!==n&&"inline-flex"!==n&&(n="block");var a={
display:n};a[s.property]="",e.css(a),e.outerHeight(!1)>i&&(i=e.outerHeight(!1)),o?e.attr("style",o):e.css("display","")})}a.each(function(){var e=t(this),o=0;s.target&&e.is(s.target)||("border-box"!==e.css("box-sizing")&&(o+=n(e.css("border-top-width"))+n(e.css("border-bottom-width")),o+=n(e.css("padding-top"))+n(e.css("padding-bottom"))),e.css(s.property,i-o+"px"))})}),u.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||null)}),r._maintainScroll&&t(window).scrollTop(c/p*t("html").outerHeight(!0)),
this},r._applyDataApi=function(){var e={};t("[data-match-height], [data-mh]").each(function(){var o=t(this),n=o.attr("data-mh")||o.attr("data-match-height");n in e?e[n]=e[n].add(o):e[n]=o}),t.each(e,function(){this.matchHeight(!0)})};var s=function(e){r._beforeUpdate&&r._beforeUpdate(e,r._groups),t.each(r._groups,function(){r._apply(this.elements,this.options)}),r._afterUpdate&&r._afterUpdate(e,r._groups)};r._update=function(n,a){if(a&&"resize"===a.type){var i=t(window).width();if(i===e)return;e=i;
}n?o===-1&&(o=setTimeout(function(){s(a),o=-1},r._throttle)):s(a)},t(r._applyDataApi);var h=t.fn.on?"on":"bind";t(window)[h]("load",function(t){r._update(!1,t)}),t(window)[h]("resize orientationchange",function(t){r._update(!0,t)})});

/**
* Count to
*/

(function (factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        // CommonJS
        factory(require('jquery'));
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
  var CountTo = function (element, options) {
    this.$element = $(element);
    this.options  = $.extend({}, CountTo.DEFAULTS, this.dataOptions(), options);
    this.init();
  };

  CountTo.DEFAULTS = {
    from: 0,               // the number the element should start at
    to: 0,                 // the number the element should end at
    speed: 1000,           // how long it should take to count between the target numbers
    refreshInterval: 100,  // how often the element should be updated
    decimals: 0,           // the number of decimal places to show
    formatter: formatter,  // handler for formatting the value before rendering
    onUpdate: null,        // callback method for every time the element is updated
    onComplete: null       // callback method for when the element finishes updating
  };

  CountTo.prototype.init = function () {
    this.value     = this.options.from;
    this.loops     = Math.ceil(this.options.speed / this.options.refreshInterval);
    this.loopCount = 0;
    this.increment = (this.options.to - this.options.from) / this.loops;
  };

  CountTo.prototype.dataOptions = function () {
    var options = {
      from:            this.$element.data('from'),
      to:              this.$element.data('to'),
      speed:           this.$element.data('speed'),
      refreshInterval: this.$element.data('refresh-interval'),
      decimals:        this.$element.data('decimals')
    };

    var keys = Object.keys(options);

    for (var i in keys) {
      var key = keys[i];

      if (typeof(options[key]) === 'undefined') {
        delete options[key];
      }
    }

    return options;
  };

  CountTo.prototype.update = function () {
    this.value += this.increment;
    this.loopCount++;

    this.render();

    if (typeof(this.options.onUpdate) == 'function') {
      this.options.onUpdate.call(this.$element, this.value);
    }

    if (this.loopCount >= this.loops) {
      clearInterval(this.interval);
      this.value = this.options.to;

      if (typeof(this.options.onComplete) == 'function') {
        this.options.onComplete.call(this.$element, this.value);
      }
    }
  };

  CountTo.prototype.render = function () {
    var formattedValue = this.options.formatter.call(this.$element, this.value, this.options);
    this.$element.html(formattedValue);
  };

  CountTo.prototype.restart = function () {
    this.stop();
    this.init();
    this.start();
  };

  CountTo.prototype.start = function () {
    this.stop();
    this.render();
    this.interval = setInterval(this.update.bind(this), this.options.refreshInterval);
  };

  CountTo.prototype.stop = function () {
    if (this.interval) {
      clearInterval(this.interval);
    }
  };

  CountTo.prototype.toggle = function () {
    if (this.interval) {
      this.stop();
    } else {
      this.start();
    }
  };

  function formatter(value, options) {
    return value.toFixed(options.decimals);
  }

  $.fn.countTo = function (option) {
    return this.each(function () {
      var $this   = $(this);
      var data    = $this.data('countTo');
      var init    = !data || typeof(option) === 'object';
      var options = typeof(option) === 'object' ? option : {};
      var method  = typeof(option) === 'string' ? option : 'start';

      if (init) {
        if (data) data.stop();
        $this.data('countTo', data = new CountTo(this, options));
      }

      data[method].call(data);
    });
  };
}));

/*
 * jQuery.appear
 * http://code.google.com/p/jquery-appear/
 *
 * Copyright (c) 2009 Michael Hixson
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php)
*/
(function($){$.fn.appear=function(f,o){var s=$.extend({one:true},o);return this.each(function(){var t=$(this);t.appeared=false;if(!f){t.trigger('appear',s.data);return;}var w=$(window);var c=function(){if(!t.is(':visible')){t.appeared=false;return;}var a=w.scrollLeft();var b=w.scrollTop();var o=t.offset();var x=o.left;var y=o.top;if(y+t.height()>=b&&y<=b+w.height()&&x+t.width()>=a&&x<=a+w.width()){if(!t.appeared)t.trigger('appear',s.data);}else{t.appeared=false;}};var m=function(){t.appeared=true;if(s.one){w.unbind('scroll',c);var i=$.inArray(c,$.fn.appear.checks);if(i>=0)$.fn.appear.checks.splice(i,1);}f.apply(this,arguments);};if(s.one)t.one('appear',s.data,m);else t.bind('appear',s.data,m);w.scroll(c);$.fn.appear.checks.push(c);(c)();});};$.extend($.fn.appear,{checks:[],timeout:null,checkAll:function(){var l=$.fn.appear.checks.length;if(l>0)while(l--)($.fn.appear.checks[l])();},run:function(){if($.fn.appear.timeout)clearTimeout($.fn.appear.timeout);$.fn.appear.timeout=setTimeout($.fn.appear.checkAll,20);}});$.each(['append','prepend','after','before','attr','removeAttr','addClass','removeClass','toggleClass','remove','css','show','hide'],function(i,n){var u=$.fn[n];if(u){$.fn[n]=function(){var r=u.apply(this,arguments);$.fn.appear.run();return r;}}});})(jQuery);

/**
 * Modules in this bundle
 * @license
 *
 * modal-video:
 *   license: appleple
 *   author: appleple
 *   homepage: http://developer.a-blogcms.jp
 *   version: 2.4.1
 *
 * custom-event-polyfill:
 *   license: MIT (http://opensource.org/licenses/MIT)
 *   maintainers: krambuhl <evan.krambuhl@gmail.com>
 *   contributors: Frank Panetta, Mikhail Reenko <reenko@yandex.ru>, Joscha Feth <joscha@feth.com>
 *   homepage: https://github.com/krambuhl/custom-event-polyfill#readme
 *   version: 0.3.0
 *
 * es6-object-assign:
 *   license: MIT (http://opensource.org/licenses/MIT)
 *   author: Rubén Norte <rubennorte@gmail.com>
 *   homepage: https://github.com/rubennorte/es6-object-assign
 *   version: 1.1.0
 *
 * This header is generated by licensify (https://github.com/twada/licensify)
 */
!function e(t,n,o){function i(a,l){if(!n[a]){if(!t[a]){var u="function"==typeof require&&require;if(!l&&u)return u(a,!0);if(r)return r(a,!0);var d=new Error("Cannot find module '"+a+"'");throw d.code="MODULE_NOT_FOUND",d}var s=n[a]={exports:{}};t[a][0].call(s.exports,function(e){var n=t[a][1][e];return i(n||e)},s,s.exports,e,t,n,o)}return n[a].exports}for(var r="function"==typeof require&&require,a=0;a<o.length;a++)i(o[a]);return i}({1:[function(e,t,n){try{var o=new window.CustomEvent("test");if(o.preventDefault(),!0!==o.defaultPrevented)throw new Error("Could not prevent default")}catch(e){var i=function(e,t){var n,o;return t=t||{bubbles:!1,cancelable:!1,detail:void 0},n=document.createEvent("CustomEvent"),n.initCustomEvent(e,t.bubbles,t.cancelable,t.detail),o=n.preventDefault,n.preventDefault=function(){o.call(this);try{Object.defineProperty(this,"defaultPrevented",{get:function(){return!0}})}catch(e){this.defaultPrevented=!0}},n};i.prototype=window.Event.prototype,window.CustomEvent=i}},{}],2:[function(e,t,n){"use strict";function o(e,t){if(void 0===e||null===e)throw new TypeError("Cannot convert first argument to object");for(var n=Object(e),o=1;o<arguments.length;o++){var i=arguments[o];if(void 0!==i&&null!==i)for(var r=Object.keys(Object(i)),a=0,l=r.length;a<l;a++){var u=r[a],d=Object.getOwnPropertyDescriptor(i,u);void 0!==d&&d.enumerable&&(n[u]=i[u])}}return n}function i(){Object.assign||Object.defineProperty(Object,"assign",{enumerable:!1,configurable:!0,writable:!0,value:o})}t.exports={assign:o,polyfill:i}},{}],3:[function(e,t,n){"use strict";var o=e("../index"),i=function(e){e.fn.modalVideo=function(e){return"strings"==typeof e||new o(this,e),this}};if("function"==typeof define&&define.amd)define(["jquery"],i);else{var r=window.jQuery?window.jQuery:window.$;void 0!==r&&i(r)}t.exports=i},{"../index":5}],4:[function(e,t,n){"use strict";function o(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(n,"__esModule",{value:!0});var i=function(){function e(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}return function(t,n,o){return n&&e(t.prototype,n),o&&e(t,o),t}}();e("custom-event-polyfill");var r=e("../lib/util"),a=e("es6-object-assign").assign,l={channel:"youtube",facebook:{},youtube:{autoplay:1,cc_load_policy:1,color:null,controls:1,disablekb:0,enablejsapi:0,end:null,fs:1,h1:null,iv_load_policy:1,list:null,listType:null,loop:0,modestbranding:null,origin:null,playlist:null,playsinline:null,rel:0,showinfo:1,start:0,wmode:"transparent",theme:"dark",nocookie:!1},ratio:"16:9",vimeo:{api:!1,autopause:!0,autoplay:!0,byline:!0,callback:null,color:null,height:null,loop:!1,maxheight:null,maxwidth:null,player_id:null,portrait:!0,title:!0,width:null,xhtml:!1},allowFullScreen:!0,animationSpeed:300,classNames:{modalVideo:"modal-video",modalVideoClose:"modal-video-close",modalVideoBody:"modal-video-body",modalVideoInner:"modal-video-inner",modalVideoIframeWrap:"modal-video-movie-wrap",modalVideoCloseBtn:"modal-video-close-btn"},aria:{openMessage:"You just openned the modal video",dismissBtnMessage:"Close the modal by clicking here"}},u=function(){function e(t,n){var i=this;o(this,e);var u=a({},l,n),d="string"==typeof t?document.querySelectorAll(t):t,s=document.querySelector("body"),c=u.classNames,f=u.animationSpeed;[].forEach.call(d,function(e){e.addEventListener("click",function(t){"A"===e.tagName&&t.preventDefault();var n=e.dataset.videoId,o=e.dataset.channel||u.channel,a=(0,r.getUniqId)(),l=e.dataset.videoUrl||i.getVideoUrl(u,o,n),d=i.getHtml(u,l,a);(0,r.append)(s,d);var v=document.getElementById(a),m=v.querySelector(".js-modal-video-dismiss-btn");v.focus(),v.addEventListener("click",function(){(0,r.addClass)(v,c.modalVideoClose),setTimeout(function(){(0,r.remove)(v),e.focus()},f)}),v.addEventListener("keydown",function(e){9===e.which&&(e.preventDefault(),document.activeElement===v?m.focus():(v.setAttribute("aria-label",""),v.focus()))}),m.addEventListener("click",function(){(0,r.triggerEvent)(v,"click")})})})}return i(e,[{key:"getPadding",value:function(e){var t=e.split(":"),n=Number(t[0]);return 100*Number(t[1])/n+"%"}},{key:"getQueryString",value:function(e){var t="";return Object.keys(e).forEach(function(n){t+=n+"="+e[n]+"&"}),t.substr(0,t.length-1)}},{key:"getVideoUrl",value:function(e,t,n){return"youtube"===t?this.getYoutubeUrl(e.youtube,n):"vimeo"===t?this.getVimeoUrl(e.vimeo,n):"facebook"===t?this.getFacebookUrl(e.facebook,n):""}},{key:"getVimeoUrl",value:function(e,t){return"//player.vimeo.com/video/"+t+"?"+this.getQueryString(e)}},{key:"getYoutubeUrl",value:function(e,t){var n=this.getQueryString(e);return!0===e.nocookie?"//www.youtube-nocookie.com/embed/"+t+"?"+n:"//www.youtube.com/embed/"+t+"?"+n}},{key:"getFacebookUrl",value:function(e,t){return"//www.facebook.com/v2.10/plugins/video.php?href=https://www.facebook.com/facebook/videos/"+t+"&"+this.getQueryString(e)}},{key:"getHtml",value:function(e,t,n){var o=this.getPadding(e.ratio),i=e.classNames;return'\n      <div class="'+i.modalVideo+'" tabindex="-1" role="dialog" aria-label="'+e.aria.openMessage+'" id="'+n+'">\n        <div class="'+i.modalVideoBody+'">\n          <div class="'+i.modalVideoInner+'">\n            <div class="'+i.modalVideoIframeWrap+'" style="padding-bottom:'+o+'">\n              <button class="'+i.modalVideoCloseBtn+' js-modal-video-dismiss-btn" aria-label="'+e.aria.dismissBtnMessage+"\"></button>\n              <iframe width='460' height='230' src=\""+t+"\" frameborder='0' allowfullscreen="+e.allowFullScreen+' tabindex="-1"/>\n            </div>\n          </div>\n        </div>\n      </div>\n    '}}]),e}();n.default=u,t.exports=n.default},{"../lib/util":6,"custom-event-polyfill":1,"es6-object-assign":2}],5:[function(e,t,n){"use strict";t.exports=e("./core/")},{"./core/":4}],6:[function(e,t,n){"use strict";Object.defineProperty(n,"__esModule",{value:!0});n.append=function(e,t){var n=document.createElement("div");for(n.innerHTML=t;n.children.length>0;)e.appendChild(n.children[0])},n.getUniqId=function(){return(Date.now().toString(36)+Math.random().toString(36).substr(2,5)).toUpperCase()},n.remove=function(e){e&&e.parentNode&&e.parentNode.removeChild(e)},n.addClass=function(e,t){e.classList?e.classList.add(t):e.className+=" "+t},n.triggerEvent=function(e,t,n){var o=void 0;window.CustomEvent?o=new CustomEvent(t,{cancelable:!0}):(o=document.createEvent("CustomEvent"),o.initCustomEvent(t,!1,!1,n)),e.dispatchEvent(o)}},{}]},{},[3]);