this.wp=this.wp||{},this.wp.deprecated=function(e){var t={};function n(r){if(t[r])return t[r].exports;var o=t[r]={i:r,l:!1,exports:{}};return e[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}return n.m=e,n.c=t,n.d=function(e,t,r){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:r})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var o in e)n.d(r,o,function(t){return e[t]}.bind(null,o));return r},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=351)}({30:function(e,t){!function(){e.exports=this.wp.hooks}()},351:function(e,t,n){"use strict";n.r(t),n.d(t,"logged",(function(){return o})),n.d(t,"default",(function(){return c}));var r=n(30),o=Object.create(null);function c(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},n=t.version,c=t.alternative,i=t.plugin,u=t.link,a=t.hint,l=i?" from ".concat(i):"",f=n?" and will be removed".concat(l," in version ").concat(n):"",d=c?" Please use ".concat(c," instead."):"",s=u?" See: ".concat(u):"",p=a?" Note: ".concat(a):"",b="".concat(e," is deprecated").concat(f,".").concat(d).concat(s).concat(p);b in o||(Object(r.doAction)("deprecated",e,t,b),console.warn(b),o[b]=!0)}}}).default;