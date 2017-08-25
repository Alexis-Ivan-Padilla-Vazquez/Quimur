/*!
* Flavius v0.1
* Copyright (c) 1998, Regents of the University of California
* All rights reserved.
* Redistribution and use in source and binary forms, with or without
* modification, are permitted provided that the following conditions are met:
*
*     * Redistributions of source code must retain the above copyright
*       notice, this list of conditions and the following disclaimer.
*     * Redistributions in binary form must reproduce the above copyright
*       notice, this list of conditions and the following disclaimer in the
*       documentation and/or other materials provided with the distribution.
*     * Neither the name of the University of California, Berkeley nor the
*       names of its contributors may be used to endorse or promote products
*       derived from this software without specific prior written permission.
*
* THIS SOFTWARE IS PROVIDED BY THE REGENTS AND CONTRIBUTORS ``AS IS'' AND ANY
* EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
* WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
* DISCLAIMED. IN NO EVENT SHALL THE REGENTS AND CONTRIBUTORS BE LIABLE FOR ANY
* DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
* (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
* LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
* ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
* (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
* SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*
* Mathias Desloges <m.desloges@gmail.com> || @freakdev
*
* Includes my-class.js
* http://myjs.fr/my-class/
* Date : 6 january 2012
*/
(function(){my={};my.Class=function(){var e=arguments.length;var d=arguments[e-1];var f=e>1?arguments[0]:null;var j=e>2;var g,c;if(d.constructor===Object){g=function(){}}else{g=d.constructor;delete d.constructor}if(f){c=function(){};c.prototype=f.prototype;g.prototype=new c();g.prototype.constructor=g;g.Super=f;b(g,f,false)}if(j){for(var h=1;h<e-1;h++){b(g.prototype,arguments[h].prototype,false)}}a(g,d);return g};var a=my.extendClass=function(c,e,d){if(e.STATIC){b(c,e.STATIC,d);delete e.STATIC}b(c.prototype,e,d)};var b=function(d,f,c){var e;if(c===false){for(e in f){if(!(e in d)){d[e]=f[e]}}}else{for(e in f){d[e]=f[e]}if(f.toString!==Object.prototype.toString){d.toString=f.toString}}}})();var Mustache=function(){var a=function(){};a.prototype={otag:"{{",ctag:"}}",pragmas:{},buffer:[],pragmas_implemented:{"IMPLICIT-ITERATOR":true},context:{},render:function(e,d,c,f){if(!f){this.context=d;this.buffer=[]}if(!this.includes("",e)){if(f){return e}else{this.send(e);return}}e=this.render_pragmas(e);var b=this.render_section(e,d,c);if(f){return this.render_tags(b,d,c,f)}this.render_tags(b,d,c,f)},send:function(b){if(b!=""){this.buffer.push(b)}},render_pragmas:function(b){if(!this.includes("%",b)){return b}var d=this;var c=new RegExp(this.otag+"%([\\w-]+) ?([\\w]+=[\\w]+)?"+this.ctag);return b.replace(c,function(g,e,f){if(!d.pragmas_implemented[e]){throw ({message:"This implementation of mustache doesn't understand the '"+e+"' pragma"})}d.pragmas[e]={};if(f){var h=f.split("=");d.pragmas[e][h[0]]=h[1]}return""})},render_partial:function(b,d,c){b=this.trim(b);if(!c||c[b]===undefined){throw ({message:"unknown_partial '"+b+"'"})}if(typeof(d[b])!="object"){return this.render(c[b],d,c,true)}return this.render(c[b],d[b],c,true)},render_section:function(d,c,b){if(!this.includes("#",d)&&!this.includes("^",d)){return d}var f=this;var e=new RegExp(this.otag+"(\\^|\\#)\\s*(.+)\\s*"+this.ctag+"\n*([\\s\\S]+?)"+this.otag+"\\/\\s*\\2\\s*"+this.ctag+"\\s*","mg");return d.replace(e,function(h,i,g,j){var k=f.find(g,c);if(i=="^"){if(!k||f.is_array(k)&&k.length===0){return f.render(j,c,b,true)}else{return""}}else{if(i=="#"){if(f.is_array(k)){return f.map(k,function(l){return f.render(j,f.create_context(l),b,true)}).join("")}else{if(f.is_object(k)){return f.render(j,f.create_context(k),b,true)}else{if(typeof k==="function"){return k.call(c,j,function(l){return f.render(l,c,b,true)})}else{if(k){return f.render(j,c,b,true)}else{return""}}}}}}})},render_tags:function(k,b,d,f){var e=this;var j=function(){return new RegExp(e.otag+"(=|!|>|\\{|%)?([^\\/#\\^]+?)\\1?"+e.ctag+"+","g")};var g=j();var h=function(n,i,m){switch(i){case"!":return"";case"=":e.set_delimiters(m);g=j();return"";case">":return e.render_partial(m,b,d);case"{":return e.find(m,b);default:return e.escape(e.find(m,b))}};var l=k.split("\n");for(var c=0;c<l.length;c++){l[c]=l[c].replace(g,h,this);if(!f){this.send(l[c])}}if(f){return l.join("\n")}},set_delimiters:function(c){var b=c.split(" ");this.otag=this.escape_regex(b[0]);this.ctag=this.escape_regex(b[1])},escape_regex:function(c){if(!arguments.callee.sRE){var b=["/",".","*","+","?","|","(",")","[","]","{","}","\\"];arguments.callee.sRE=new RegExp("(\\"+b.join("|\\")+")","g")}return c.replace(arguments.callee.sRE,"\\$1")},find:function(c,d){c=this.trim(c);function b(f){return f===false||f===0||f}var e;if(b(d[c])){e=d[c]}else{if(b(this.context[c])){e=this.context[c]}}if(typeof e==="function"){return e.apply(d)}if(e!==undefined){return e}return""},includes:function(c,b){return b.indexOf(this.otag+c)!=-1},escape:function(b){b=String(b===null?"":b);return b.replace(/&(?!\w+;)|["'<>\\]/g,function(c){switch(c){case"&":return"&amp;";case"\\":return"\\\\";case'"':return"&quot;";case"'":return"&#39;";case"<":return"&lt;";case">":return"&gt;";default:return c}})},create_context:function(c){if(this.is_object(c)){return c}else{var d=".";if(this.pragmas["IMPLICIT-ITERATOR"]){d=this.pragmas["IMPLICIT-ITERATOR"].iterator}var b={};b[d]=c;return b}},is_object:function(b){return b&&typeof b=="object"},is_array:function(b){return Object.prototype.toString.call(b)==="[object Array]"},trim:function(b){return b.replace(/^\s*|\s*$/g,"")},map:function(f,d){if(typeof f.map=="function"){return f.map(d)}else{var e=[];var b=f.length;for(var c=0;c<b;c++){e.push(d(f[c]))}return e}}};return({name:"mustache.js",version:"0.3.1-dev",to_html:function(d,b,c,f){var e=new a();if(f){e.send=f}e.render(d,b,c);if(!f){return e.buffer.join("\n")}}})}();(function(){var e=my.Class({log:function d(j){if(window.console&&window.console.log){console.log(j.toStirng())}},getNS:function b(m,n){var o=m.split(".");var l=window;for(var k=0,j=o.length;k<j;k++){if("object"!=typeof(l[o[k]])){l[o[k]]={}}l=l[o[k]]}return l},bind:function f(k,j){return function(){return k.apply(j,arguments)}},EmptyFn:function a(){},generateId:function g(m){msg=[m,(new Date).getTime(),Math.random().toString()].join("");function o(B,A){var j=(B<<A)|(B>>>(32-A));return j}function F(C){var B="";var j;var D;var A;for(j=0;j<=6;j+=2){D=(C>>>(j*4+4))&15;A=(C>>>(j*4))&15;B+=D.toString(16)+A.toString(16)}return B}function H(C){var B="";var A;var j;for(A=7;A>=0;A--){j=(C>>>(A*4))&15;B+=j.toString(16)}return B}function l(A){A=A.replace(/\r\n/g,"\n");var j="";for(var C=0;C<A.length;C++){var B=A.charCodeAt(C);if(B<128){j+=String.fromCharCode(B)}else{if((B>127)&&(B<2048)){j+=String.fromCharCode((B>>6)|192);j+=String.fromCharCode((B&63)|128)}else{j+=String.fromCharCode((B>>12)|224);j+=String.fromCharCode(((B>>6)&63)|128);j+=String.fromCharCode((B&63)|128)}}}return j}var r;var J,I;var n=new Array(80);var v=1732584193;var t=4023233417;var s=2562383102;var q=271733878;var p=3285377520;var G,z,y,x,w;var K;msg=l(msg);var k=msg.length;var u=new Array();for(J=0;J<k-3;J+=4){I=msg.charCodeAt(J)<<24|msg.charCodeAt(J+1)<<16|msg.charCodeAt(J+2)<<8|msg.charCodeAt(J+3);u.push(I)}switch(k%4){case 0:J=2147483648;break;case 1:J=msg.charCodeAt(k-1)<<24|8388608;break;case 2:J=msg.charCodeAt(k-2)<<24|msg.charCodeAt(k-1)<<16|32768;break;case 3:J=msg.charCodeAt(k-3)<<24|msg.charCodeAt(k-2)<<16|msg.charCodeAt(k-1)<<8|128;break}u.push(J);while((u.length%16)!=14){u.push(0)}u.push(k>>>29);u.push((k<<3)&4294967295);for(r=0;r<u.length;r+=16){for(J=0;J<16;J++){n[J]=u[r+J]}for(J=16;J<=79;J++){n[J]=o(n[J-3]^n[J-8]^n[J-14]^n[J-16],1)}G=v;z=t;y=s;x=q;w=p;for(J=0;J<=19;J++){K=(o(G,5)+((z&y)|(~z&x))+w+n[J]+1518500249)&4294967295;w=x;x=y;y=o(z,30);z=G;G=K}for(J=20;J<=39;J++){K=(o(G,5)+(z^y^x)+w+n[J]+1859775393)&4294967295;w=x;x=y;y=o(z,30);z=G;G=K}for(J=40;J<=59;J++){K=(o(G,5)+((z&y)|(z&x)|(y&x))+w+n[J]+2400959708)&4294967295;w=x;x=y;y=o(z,30);z=G;G=K}for(J=60;J<=79;J++){K=(o(G,5)+(z^y^x)+w+n[J]+3395469782)&4294967295;w=x;x=y;y=o(z,30);z=G;G=K}v=(v+G)&4294967295;t=(t+z)&4294967295;s=(s+y)&4294967295;q=(q+x)&4294967295;p=(p+w)&4294967295}var K=H(v)+H(t)+H(s)+H(q)+H(p);return["id-",K.toLowerCase()].join("")},collectionToArray:function c(m){var l=[];for(var k=0,j=m.length;k<j;k++){l.push(m[k])}return l}});var i=new e();var h=i.getNS("oo.core");h.utils=i;return oo})();var oo=(function(a){var e={};var b={};var f=this;var d=function(j,h){var i;if(typeof j=="object"&&j.sc&&j.fn){i={fn:j.fn,sc:j.sc}}else{i={fn:j,sc:f}}if(h){i.se=h}return i};b.addListener=function c(h,k,i){if(!e[h]){e[h]=[]}var j=d(k,i);e[h].push(j)};b.removeListener=function g(h,l,j){if(e[h]){var k=d(l,j);var i=e[h].indexOf(k);if(-1!=i){e[h].splice(i,1)}}};b.triggerEvent=function c(j,l,n){if(e[j]){for(var k=0,h=e[j].length;k<h;k++){var m=e[j][k];if(undefined===m.se||m.se===l){m.fn.apply(m.sc,n)}}}};a.Events=b;return a})(oo||{});var oo=(function(a){var c=function c(){};var f="ontouchstart" in window?true:false;var e=function e(h,g){if(f){g=g||0;var i=h.touches[g];if(undefined===i){i=h.changedTouches[g]}}else{i=h}return[parseInt(i.pageX,10),parseInt(i.pageY,10)]};c.getPosition=e;c.getPositionX=function b(h,g){return e(h,g)[0]};c.getPositionY=function b(h,g){return e(h,g)[1]};c.getTarget=function d(h,g){return h.touches[g||0].target};if(!f){c.EVENT_START="mousedown";c.EVENT_MOVE="mousemove";c.EVENT_END="mouseup"}else{c.EVENT_START="touchstart";c.EVENT_MOVE="touchmove";c.EVENT_END="touchend"}a.Touch=c;return a})(oo||{});var oo=(function(a){var c={};var b={requestParams:{},dispatch:function e(l){b.parseRoute(l);if(b.requestParams){var k=[b.requestParams.controller.charAt(0).toUpperCase(),b.requestParams.controller.substring(1),"Controller"].join("");var i=[b.requestParams.action,"Action"].join("");var j;if(typeof c[k]!=="function"){if(undefined===c[k]){c[k]=CONTROLLERS[k]}j=c[k];if(typeof j[i]==="function"){return j[i](b.requestParams.params)}}}},parseRoute:function g(j){var i=b.routes;var k=null,l;for(var m in i){var l=i[m];if(l.url==j.substring(0,l.url.length)){k={controller:l.controller,action:l.action};j=j.substring(l.url.length)}}if("/"==j.substring(0,1)){j=j.slice(1)}var n=j.split("/");if(!k){k={controller:n[0],action:n[1]};if(!k.controller){k.controller="index"}else{n.shift()}if(!k.action||k.action==undefined){k.action="index"}else{n.shift()}}k.params={};while(n.length){paramName=n.shift();if(paramName){paramValue=n.shift();if(paramValue!==undefined){k.params[paramName]=paramValue}}}b.requestParams=k;return k},url:function d(i,m){var j=b.routes[i];if(!j){throw Error("route name doesn’t exists")}var k="";for(var l in m){k=[k,"/",l,"/",m[l]].join("")}return[j.url,k].join("")},load:function f(i){window.location.hash=i},init:function h(i){window.addEventListener("hashchange",function(j){b.dispatch(window.location.hash.slice(1))},false);b.dispatch(window.location.hash.slice(1))}};a.Router=b;return a})(oo||{});var oo=(function(g){var f=g.Dom,c=g.Touch,m=g.Events;var i=function i(o){this._data=o;this._snapshot;this._orderByCol;this._grouped;this._filterFn};i.EVT_REFRESH="refresh";var a=i.prototype;a.setData=function n(o){this._data=o;this._takeSnapshot()};a.setFilter=function l(o){this._filterFn=o;this._takeSnapshot()};a.setNoFilter=function b(){this._filterFn=function(){return true};this._takeSnapshot()};a.setOrderCol=function j(o,p){this._orderByCol=o;this._grouped=p;this._takeSnapshot()};a._filter=function h(o){if(o){this._filterFn=o}if(typeof this._filterFn=="function"){this._snapshot=this._data.filter(this._filterFn);return true}return false};a._order=function e(){if(this._orderByCol){var o=[];var p=this;this._snapshot.forEach(function(t,s,v){var q=0,u=o.length;while(q<u){var r=(q+u)>>1;o[r][p._orderByCol]<t[p._orderByCol]?q=r+1:u=r}o.splice(q,0,t)});this._snapshot=o;return true}return false};a._takeSnapshot=function k(){var p=this._filter();var o=this._order();if(p||o){m.triggerEvent(i.EVT_REFRESH,this)}else{this._snapshot=this._data}};a.getData=function d(p){var u=[];if(null==this._snapshot||p){this._takeSnapshot()}u=this._snapshot;if(this._grouped&&this._orderByCol){u=[];var t="",s="";for(var q=0,o=this._snapshot.length;q<o;q++){var r=this._snapshot[q];s=r.nom.substring(0,1);if(t!=s){u.push({id:"separator",cropped:s});t=s}u.push(r)}}return u};a.write=function d(r,p){var q=this;var o=[];this._data.forEach(function(t,s){for(prop in p){if(t[prop]!==p[prop]){return false}}o.push(s);return true});o.forEach(function(s){for(prop in r){q._data[s][prop]=r[prop]}});this._takeSnapshot()};g.Store=i;return g})(oo||{});var oo=(function(oo){var ajaxPool=[];ajaxPool.insert=function insert(elem){if(undefined==this.autoIncrementKey){this.autoIncrementKey=0}this.autoIncrementKey++;ajaxPool[this.autoIncrementKey]=elem;return this.autoIncrementKey};ajaxPool.getNextKey=function getNextKey(){if(undefined==this.autoIncrementKey){this.autoIncrementKey=0}return this.autoIncrementKey+1};Request=function Request(key,isPermanent,defaultParams){this.url;this.method=Ajax.GET;this.defaultParams=defaultParams;this.key=key;this.isPermanent=isPermanent;this.xhr=new XMLHttpRequest();this.isOpen=false;this.isLoading=false;var me=this;this.xhr.addEventListener("readystatechange",function(){if(4==me.xhr.readyState){me.isOpen=me.isLoading=false;if(200==me.xhr.status){me.successCallback(JSON.parse(me.xhr.responseText))}else{me.errorCallback()}if(!isPermanent){me.destroy()}}})};var rp=Request.prototype;rp.parseJson=function(text){dataWrapper="(function () { return %json%; })()";var obj=eval(dataWrapper.replace("%json%",text));return obj};rp.destroy=function(){delete ajaxPool[this.key]};rp.setUrl=function(url){this.url=url};rp.setMethod=function(method){this.method=method};rp.setSuccessCallback=function(callback){this.successCallback=callback};rp.setErrorCallback=function(callback){this.errorCallback=callback};rp.open=function(){try{this.xhr.open(this.method,this.url,true);this.isOpen=true}catch(e){throw e}};rp.send=function(params){if(!this.isOpen){this.open()}var paramsString=this.encodeParams(params||this.defaultParams);if(Ajax.POST==this.method){this.xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded")}this.isLoading=true;this.xhr.send(paramsString)};rp.encodeParams=function encodeParams(params){var tmpArr=[];for(var p in params){tmpArr.push([p,"=",params[p]].join(""))}return tmpArr.join("&")};rp.abort=function(){this.xhr.abort()};var Ajax={POST:"POST",GET:"GET",ajaxCall:function(options){if(undefined==options.url||null==options.url||""==options.url){throw new Error("no URL parameter given")}options.isPermanent=false;var key=this.buildRequest(options);var req=ajaxPool[key];req.send();return key},buildRequest:function(options){if(undefined==options.url||null==options.url||""==options.url){throw new Error("no URL parameter given")}var method=options.method||this.GET;var params=options.params||{};var isPermanent=options.isPermanent||false;var success=options.success||function(){};var error=options.error||function(){};var key=ajaxPool.getNextKey();var req=new Request(key,isPermanent,params);req.setUrl(options.url);req.setMethod(method);req.setSuccessCallback(success);req.setErrorCallback(error);ajaxPool.insert(req);return key},getRequest:function(id){return ajaxPool[id]},getRequestStatus:function(id){return ajaxPool[id].isLoading},abortCall:function(id){if(ajaxPool[id]){ajaxPool[id].abort()}},destroy:function(id){if(ajaxPool[id]){ajaxPool[id].destroy()}},send:function(id,params){if(ajaxPool[id]){ajaxPool[id].send(params||{})}}};oo.Ajax=Ajax;return oo})(oo||{});var oo=(function(oo){var ClassList=my.Class({constructor:function constructor(obj){this._dom=obj;this._list=obj.className.split(" ")},destroy:function destroy(){this._dom=null;this._list.splice(0);this._list=null},_updateClassList:function _updateClassList(){this._dom.className=this._list.join(" ")},removeClass:function removeClass(clsName){if(typeof clsName=="string"){clsName=clsName.split(" ")}var updated=false;var that=this;clsName.forEach(function(element,index,array){var i=that._list.indexOf(element);if(-1!==i){that._list.splice(i,1);updated=true}});if(updated){this._updateClassList()}},addClass:function addClass(clsName){if(typeof clsName=="string"){clsName=clsName.split(" ")}if(!this.hasClass(clsName)){clsName.splice(0,0,0,0);Array.prototype.splice.apply(this._list,clsName);this._updateClassList()}},setClass:function setClass(clsName){if(typeof clsName=="string"){clsName=clsName.split(" ")}this._list=clsName;this._updateClassList()},hasClass:function hasClass(clsName){var i=this._list.indexOf(clsName);if(-1===i){return false}else{return true}},getClasses:function getClasses(){return this._list}});var prop={readOnly:[],readWrite:["width","height","zIndex","display","top","right","bottom","left","webkitTransitionProperty","webkitTransitionTimingFunction","webkitTransitionDuration"]};var Dom=my.Class({STATIC:{CSSMATRIXPATTERN:/matrix\(1, 0, 0, 1, (-?[0-9.]+), (-?[0-9.]+)\)/},constructor:function constructor(identifier){this._dom;this._cached={};this._template;this._cacheTpl;if(typeof identifier=="string"){this.setDomObject(document.querySelector(identifier))}else{this.setDomObject(identifier)}this.generateAccessor();this.classList=new ClassList(this._dom)},destroy:function destroy(){this.classList.destroy();this.classList=null;this._cached.splice(0);this._cached=null;this._dom.removeEventListeners();document.removeElement(this._dom);this._dom=null},generateAccessor:function generateAccessor(){var p=this;for(var i=0,len=prop.readOnly.length;i<len;i++){eval(["p.get",prop.readOnly[i].charAt(0).toUpperCase(),prop.readOnly[i].slice(1)," = function (unit, noCache) { if (noCache || !this._cached[['",prop.readOnly[i],"',(unit ? 'u' : '')].join('')]) { this._cached[['",prop.readOnly[i],"',(unit ? 'u' : '')].join('')] = (unit ? window.getComputedStyle(this._dom).",prop.readOnly[i]," : (window.getComputedStyle(this._dom).",prop.readOnly[i],").replace(/s|ms|px|em|pt|%/, '')); this._cached[['",prop.readOnly[i],"',(unit ? 'u' : '')].join('')] = parseInt(this._cached[['",prop.readOnly[i],"',(unit ? 'u' : '')].join('')], 10) || this._cached[['",prop.readOnly[i],"',(unit ? 'u' : '')].join('')]; } return this._cached[['",prop.readOnly[i],"', (unit ? 'u' : '')].join('')]; };"].join(""))}for(var i=0,len=prop.readWrite.length;i<len;i++){eval(["p.get",prop.readWrite[i].charAt(0).toUpperCase(),prop.readWrite[i].slice(1)," = function (unit, noCache) { if (noCache || !this._cached[['",prop.readWrite[i],"',(unit ? 'u' : '')].join('')]) { this._cached[['",prop.readWrite[i],"',(unit ? 'u' : '')].join('')] = (unit ? window.getComputedStyle(this._dom).",prop.readWrite[i]," : (window.getComputedStyle(this._dom).",prop.readWrite[i],").replace(/s|ms|px|em|pt|%/, '')); this._cached[['",prop.readWrite[i],"',(unit ? 'u' : '')].join('')] = parseInt(this._cached[['",prop.readWrite[i],"',(unit ? 'u' : '')].join('')], 10) || this._cached[['",prop.readWrite[i],"',(unit ? 'u' : '')].join('')]; } return this._cached[['",prop.readWrite[i],"', (unit ? 'u' : '')].join('')]; };"].join(""));eval(["p.set",prop.readWrite[i].charAt(0).toUpperCase(),prop.readWrite[i].slice(1)," = function (val, unit) { if (this._cached['",prop.readWrite[i],"'] || this._cached[['",prop.readWrite[i],"', 'u'].join('')]) { this._cached['",prop.readWrite[i],"'] = this._cached[['",prop.readWrite[i],"', 'u'].join('')] = null; } this._dom.style.",prop.readWrite[i]," = [val, (undefined !== unit ? unit : '')].join(''); return this };"].join(""))}},getTranslations:function getTranslations(noCache){if(!this._cached.webkitTranslations||noCache){var values=this.getWebkitTransform().match(Dom.CSSMATRIXPATTERN);if(null===values){values=[0,0,0]}this._cached.webkitTranslations=[parseInt(values[1],10),parseInt(values[2],10)]}return this._cached.webkitTranslations},getWebkitTransform:function getWebkitTransform(noCache){if(!this._cached.webkitTransform||noCache){this._cached.webkitTransform=window.getComputedStyle(this._dom).webkitTransform}return this._cached.webkitTransform},setWebkitTransform:function setWebkitTransform(value){if(this._cached.webkitTransform||this._cached.webkitTranslations){this._cached.webkitTransform=null;this._cached.webkitTranslations=null}this._dom.style.webkitTransform=value;return this},setTranslations:function setTranslations(x,y,unit){unit=unit||"px";this.setWebkitTransform(["translate3d(",x,unit,", ",y,unit,", 0)"].join(""));return this},getTranslateX:function getTranslateX(unit,noCache){return(unit?[this.getTranslations(noCache)[0],"px"].join(""):this.getTranslations(noCache)[0])},getTranslateY:function getTranslateY(unit,noCache){return(unit?[this.getTranslations(noCache)[1],"px"].join(""):this.getTranslations(noCache)[1])},setTranslateX:function setTranslateX(val){var valY=this.getTranslateY();this.setTranslations(val,valY);return this},setTranslateY:function setTranslateY(val){var valX=this.getTranslateX();this.setTranslations(valX,val);return this},setDomObject:function setDomObject(domNode){this._dom=domNode;if(!this._dom.id){this._dom.id=oo.core.utils.generateId(this._dom.tagName)}return this},getDomObject:function getDomObject(){return this._dom},find:function find(selector){return new Dom(this._dom.querySelector(selector))},findParentByCls:function findParentByCls(cls){var p=this._dom.parentNode;var pattern=new RegExp(cls);while(!pattern.test(p.className)&&p){p=this._dom.parentNode}if(p){return new Dom(p)}else{return false}},appendDomNode:function appendDomNode(domNode){this._dom.appendChild(domNode);return this},appendChild:function appendChild(node){if(node instanceof Dom){this.appendDomNode(node.getDomObject())}else{this.appendDomNode(node)}return this},appendHtml:function appendHtml(html){this._dom.innerHTML=[this._dom.innerHTML,html].join("");return this},clear:function clear(){this._dom.innerHTML="";return this},stopAnimation:function stopAnimation(){this.setWebkitTransitionDuration(0,"ms");this._dom.removeEventListener("webkitTransitionEnd");return this},translateTo:function translateTo(coord,duration,listener,timingFunction){if(typeof coord==="object"){coord.x=undefined!==coord.x?coord.x:this.getTranslateX();coord.y=undefined!==coord.y?coord.y:this.getTranslateY()}var currentTransitionDuration=(this.getWebkitTransitionDuration()*1000);duration=duration||0;this.setWebkitTransitionDuration(duration,"ms");var currentTimingFunction=this.getWebkitTransitionTimingFunction();if(typeof timmingFunction==="string"){this.setWebkitTransitionTimingFunction(timingFunction,"")}var that=this,endListener=function endListener(e){that._dom.removeEventListener("webkitTransitionEnd",this);that.setWebkitTransitionDuration(currentTransitionDuration,"ms");that.setWebkitTransitionTimingFunction(currentTimingFunction,"");if(listener){listener.call(that,e)}};this._dom.addEventListener("webkitTransitionEnd",endListener,false);this.setTranslations(coord.x,coord.y);return this},setTemplate:function setTemplate(tpl){this._template=tpl;return this},render:function render(data,tpl,resetCache){if(tpl){this.setTemplate(tpl)}if(!this._cacheTpl||resetCache){data=data||{};this._cacheTpl=Mustache.to_html(this._template,data)}this.appendHtml(this._cacheTpl);return this}});Dom.createElement=function createElement(tag){return new Dom(document.createElement(tag))};var exports=oo.core.utils.getNS("oo.View");exports.Dom=Dom;return oo})(oo||{});var oo=(function(f){var c=f.Dom,k=f.Touch,n=f.utils,j=f.Events;var o=function(p){p=p||"body";this._root=new c(p);this.classList=this._root.classList;this._panels=[];this._panelsDic=[];this._enabledPanels=[];this._focusedStack=[]};o.ANIM_RTL="rtl";o.ANIM_LTR="ltr";o.NO_ANIM="none";o.ANIM_DURATION=500;var l=o.prototype;l.hasPanel=function b(p){return -1!=this._panelsDic.indexOf(p)?true:false};l.addPanel=function h(t,v,A,z,u){var y=new c.createElement("div");y.getDomObject().id=v;y.classList.addClass("oo-panel");var w=t;var x={};if(typeof t=="object"&&t.template){w=t.template;x=t.data||{}}y.setTemplate(w);this._panels.push(y);this._panelsDic.push(v);if(A){u=z||u;y.render(x);this.showPanel(v,u)}else{if(z){y.render(x)}}};l._identifierToIndex=function e(t){var p=t;if(typeof p=="string"){p=this._panelsDic.indexOf(p)}return p};l._indexToIdentifier=function e(p){return p=this._panelsDic[p]};l._enablePanel=function a(t){var p=this._identifierToIndex(t);this._root.appendChild(this._panels[p]);this._enabledPanels.push(p);j.triggerEvent("onEnablePanel",this._panels[p],[{identifier:this._indexToIdentifier(p),panel:this._panels[p]}])};l.getFocusedPanel=function g(p){index=this._focusedStack[this._focusedStack.length-1];if(p){return undefined!==index?index:false}else{return this.getPanel(index)}};l.getPanel=function s(p){return this._panels[this._identifierToIndex(p)]||false};l.panelIsEnable=function q(p){return(-1!=this._enabledPanels.indexOf(this._identifierToIndex(p))?true:false)};l.removePanel=function i(p){var t=this._identifierToIndex(p);this._panels[t].destroy();this._panels.slice(t,1);this._panelsDic.slice(t,1)};l.showPanel=function r(t,w){var u=this._identifierToIndex(t);w=w||o.ANIM_RTL;var p=0;if(w!==o.NO_ANIM){var v=this._root.getWidth()*(w==o.ANIM_RTL?1:-1);this.getPanel(u).setTranslateX(v);p=o.ANIM_DURATION}if(!this.panelIsEnable(u)){this._enablePanel(u)}this.getPanel(u).translateTo({x:0},p);this._focusedStack.push(u);j.triggerEvent("onShowPanel",this._panels[u],[{identifier:this._indexToIdentifier(u),panel:this._panels[u]}])};l.hidePanel=function d(t,y,v){var u=this._identifierToIndex(t);y=y||o.ANIM_RTL;var p=0;if(y!==o.NO_ANIM){p=o.ANIM_DURATION}var x=this._root.getWidth()*(y==o.ANIM_RTL?-1:1);var w=this;this.getPanel(u).translateTo({x:x},o.ANIM_DURATION,function(){w.getPanel(u).stopAnimation()});if(u==this.getFocusedPanel(true)){this._focusedStack.pop()}j.triggerEvent("onHidePanel",this,[{identifier:this._indexToIdentifier(u),panel:this._panels[u]}])};l.switchPanel=function m(x,p,w){var u,t,v;if(typeof arguments[1]=="string"||1==arguments.length){u=p;v=x;t=this.getFocusedPanel(true)}else{t=x;v=p;u=w}this.showPanel(v,u);if(false!==t){this.hidePanel(t,u)}};f.Viewport=o;return f})(oo||{});var oo=(function(h){var f=h.Dom,e=h.Touch;Events=h.Events;var g=function g(m){this._dom=new h.View.Dom(m);this._active=false;this._initEvents()};g.EVT_TOUCH="touch";g.EVT_RELEASE="release";var d=g.prototype;d.getDom=function l(){return this._dom};d._initEvents=function a(){var m=this;this._dom.getDomObject().addEventListener(e.EVENT_START,function(n){return m._onTouch.call(m,n)});this._dom.getDomObject().addEventListener(e.EVENT_END,function(n){return m._onRelease.call(m,n)})};d._onTouch=function c(m){if(!this.isActive()){this.setActive(true)}Events.triggerEvent(g.EVT_TOUCH,this,[this,m])};d._onRelease=function j(m){this.setActive(false);Events.triggerEvent(g.EVT_RELEASE,this,[this,m])};d.toogleActive=function i(){this.setActive(!this._active)};d.isActive=function k(){return this._active};d.setActive=function b(m){if(m||undefined===m){this._dom.classList.addClass("active");this._active=true}else{this._dom.classList.removeClass("active");this._active=false}};h.Button=g;return h})(oo||{});var oo=(function(a){var e=a.Dom,d=a.Touch;Events=a.Events,Button=a.Button;var c=function c(j,m){this._buttons=[];m=m||c.TYPE_RADIO;var l=document.querySelectorAll(j);var n=this;for(var k=0,h=l.length;k<h;k++){btn=new Button(l[k]);btn._onRelease=function(i){b.call(btn,i,n)};this._buttons.push(btn);if(m==c.TYPE_RADIO){var n=this;Events.addListener(Button.EVT_TOUCH,function(i,o){n.updateActive.apply(n,[i,o])},btn)}}};c.TYPE_RADIO="radio";c.TYPE_CHECKBOX="checkbox";var g=c.prototype;g.updateActive=function f(l,j){for(var k=0,h=this._buttons.length;k<h;k++){if(this._buttons[k]!==l){this._buttons[k].setActive(false)}}};var b=function b(i,h){if(this.isActive()){this.setActive(false)}Events.triggerEvent("release",h,[i,this])};a.ButtonGroup=c;return a})(oo||{});var oo=(function(h){var f=h.Dom,e=h.Touch,j=h.utils,n=h.Events,i=h.Store;var m=function m(q,r,p){this._data;this._touchedItem;this._store=q;var s=this;n.addListener(i.EVT_REFRESH,function(){s._refreshList.apply(s,arguments)},this._store);this.setTemplate(r||'<li class="oo-list-item item-{{id}}">{{.}}</li>');if(p){this._dom=new f(p)}else{this._dom=f.creataElement("ul")}this._initEvents();this._refreshList()};m.EVT_RENDER="render";m.EVT_ITEM_PRESSED="item-pressed";m.EVT_ITEM_RELEASED="item-released";var c=m.prototype;c._initEvents=function(){function q(v){var s=new f(v);var w;if(s.classList.hasClass("oo-list-item")){w=s.getDomObject().className.match(/item-([0-9]*)/)[1]}else{var u=s.findParentByCls("oo-list-item");if(u){s=u;w=s.getDomObject().className.match(/item-([0-9]*)/)[1]}}if(w){return{id:w,dom:s}}return false}var r=this;var p;this._dom.getDomObject().addEventListener(e.EVENT_START,function(s){this._touchedItem=s.target;p=q(s.target);if(false!==p){p.dom.classList.addClass("active");n.triggerEvent(m.EVT_ITEM_PRESSED,r,[p.dom,p.id])}},false);this._dom.getDomObject().addEventListener(e.EVENT_MOVE,function(s){if(this._touchedItem){this._touchedItem=null;r._dom.find(".active").classList.removeClass("active")}},false);this._dom.getDomObject().addEventListener(e.EVENT_END,function(s){p=q(s.target);p.dom.classList.removeClass("active");if(false!==p&&this._touchedItem==s.target){n.triggerEvent(m.EVT_ITEM_RELEASED,r,[p.dom,p.id])}},false)};c.getDom=function o(){return this._dom};c._refreshList=function g(){this._fetchStoreData();this._dom.clear();this._dom.render(this._data,this._template,true);n.triggerEvent(m.EVT_RENDER,this)};c._prepareData=function k(p){return{items:p}};c.setData=function l(p){this._data=this._prepareData(p)};c._fetchStoreData=function a(){this.setData(this._store.getData())};c.setTemplate=function d(p){this._template=this._prepareTpl(p)};c._prepareTpl=function b(p){return["{{#items}}",p,"{{/items}}"].join("")};h.List=m;return h})(oo||{});var oo=(function(i){var g=i.Dom,e=i.Touch,o=i.utils;var a=function h(q,p,r){this._wrapper=new g(q);this._content=this._wrapper.find(".content");this._orientation=p||a.VERTICAL;this._displayScroll=r||a.BOTH;this._vscrollbarWrapper;this._vscrollbar;this._hscrollbarWrapper;this._hscrollbar;this._maxvScrollTranslate;this._maxhScrollTranslate;this._buildScrollbars();this.initSizes();this._startY=0;this._startX=0;this._touchStartY;this._touchInterY;this._touchStartX;this._touchInterX;this._startTime;this._render()};a.VERTICAL="v";a.HORIZONTAL="h";a.BOTH="b";a.NONE="none";var b=a.prototype;b.initSizes=function k(){this._content.getWidth(false,true);this._content.getHeight(false,true);this._content.translateTo({x:0,y:0},0);this._startY=0;this._startX=0;if(a.VERTICAL==this._orientation||a.BOTH==this._orientation){this._vscrollbar.setDisplay("");this._maxvTranslate=(this._wrapper.getHeight()-this._content.getHeight());if(this._maxvTranslate>0){this._maxvTranslate=0;this._vscrollbar.setDisplay("none")}this._determineScrollbarSize(a.VERTICAL);this._vscrollbar.translateTo({y:0},0)}if(a.HORIZONTAL==this._orientation||a.BOTH==this._orientation){this._hscrollbar.setDisplay("");this._maxhTranslate=(this._content.getWidth()-this._wrapper.getWidth());if(this._maxhTranslate<0){this._maxhTranslate=0;this._hscrollbar.setDisplay("none")}this._determineScrollbarSize(a.HORIZONTAL);this._hscrollbar.translateTo({x:0},0)}};b._buildScrollbars=function d(){if(a.VERTICAL==this._orientation||a.BOTH==this._orientation){this._vscrollbarWrapper=g.createElement("div");this._vscrollbar=g.createElement("div");this._vscrollbar.classList.addClass("oo-scrollbar");this._vscrollbar.setWidth(100,"%");this._vscrollbarWrapper.classList.addClass("oo-scroll-wrapper");this._vscrollbarWrapper.classList.addClass("oo-vscroll-wrapper");this._vscrollbarWrapper.appendChild(this._vscrollbar)}if(a.HORIZONTAL==this._orientation||a.BOTH==this._orientation){this._hscrollbarWrapper=g.createElement("div");this._hscrollbar=g.createElement("div");this._hscrollbar.classList.addClass("oo-scrollbar");this._hscrollbar.setHeight(100,"%");this._hscrollbarWrapper.classList.addClass("oo-scroll-wrapper");this._hscrollbarWrapper.classList.addClass("oo-hscroll-wrapper");this._hscrollbarWrapper.appendChild(this._hscrollbar)}};b._renderScrollbars=function m(){if((this._displayScroll==a.VERTICAL||this._displayScroll==a.BOTH)&&(a.VERTICAL==this._orientation||a.BOTH==this._orientation)){this._wrapper.appendChild(this._vscrollbarWrapper)}if((this._displayScroll==a.HORIZONTAL||this._displayScroll==a.BOTH)&&(a.HORIZONTAL==this._orientation||a.BOTH==this._orientation)){this._wrapper.appendChild(this._hscrollbarWrapper)}};b._determineScrollbarSize=function c(p){var r=(a.VERTICAL==p?"Height":"Width");var q=this._content[["get",r].join("")]()/this._wrapper[["get",r].join("")]();var s=parseInt(this._wrapper[["get",r].join("")]()/q,10);this[["_",p,"scrollbar"].join("")][["set",r].join("")](s);this[["_max",p,"ScrollTranslate"].join("")]=this._wrapper[["get",r].join("")]()-s};b._determineScrollbarTranslate=function l(q,p){var r=this[["_max",p,"Translate"].join("")]/q;return(this[["_max",p,"ScrollTranslate"].join("")]/r)*(a.HORIZONTAL==p?-1:1)};b._initListeners=function f(){var q=this._content.getDomObject();var p=this;var r;q.addEventListener(e.EVENT_START,function(s){r=0;if(a.VERTICAL==this._orientation||a.BOTH==this._orientation){p._vscrollbar.stopAnimation()}if(a.HORIZONTAL==this._orientation||a.BOTH==this._orientation){p._hscrollbar.stopAnimation()}p._content.stopAnimation();p._touchStartY=p._touchInterY=e.getPositionY(s);p._touchStartX=p._touchInterX=e.getPositionX(s);p._startTime=(new Date).getTime();p._startY=p._content.getTranslateY(false,true);p._startX=p._content.getTranslateX(false,true)},false);q.addEventListener(e.EVENT_MOVE,function(u){var t,s;if(a.VERTICAL==p._orientation||a.BOTH==p._orientation){t=e.getPositionY(u)-p._touchStartY;s=p._startY+t;p._content.setTranslateY(s);p._vscrollbar.setTranslateY(p._determineScrollbarTranslate(s,a.VERTICAL))}if(a.HORIZONTAL==p._orientation||a.BOTH==p._orientation){t=e.getPositionX(u)-p._touchStartX;s=p._startX+t;p._content.setTranslateX(s);p._hscrollbar.setTranslateX(p._determineScrollbarTranslate(s,a.HORIZONTAL))}r++;u.preventDefault()},false);q.addEventListener(e.EVENT_END,function(w){var t=(new Date).getTime();var v=t-p._startTime;var s=0.0006;var u=500;function x(y){var A=p._content[["getTranslate",(a.VERTICAL==y?"Y":"X")].join("")](false,true);var E=null;var z=e[["getPosition",(a.VERTICAL==y?"Y":"X")].join("")](w);var D=z-p[["_touchInter",(a.VERTICAL==y?"Y":"X")].join("")];var C=Math.abs(D)/v;var B=((C*C)/(2*s))*(D<0?-1:1);if((a.VERTICAL==y&&A>0)||(a.HORIZONTAL==y&&A>0)){E=0}else{if((a.VERTICAL==y&&A<p[["_max",y,"Translate"].join("")])||(a.HORIZONTAL==y&&Math.abs(A)>p[["_max",y,"Translate"].join("")])){E=p[["_max",y,"Translate"].join("")]*(a.HORIZONTAL==y?-1:1)}else{E=p._content[["getTranslate",(a.VERTICAL==y?"Y":"X")].join("")](false,true)+B;E=parseInt((E>0?0:(E<p[["_max",y,"Translate"].join("")]?p[["_max",y,"Translate"].join("")]:E)),10)*(a.HORIZONTAL==y?-1:1);u=C/s}}if(E!==null){var F={};F[(a.VERTICAL==y?"y":"x")]=E;p._content.translateTo(F,u,function(){p._content.stopAnimation()});F[(a.VERTICAL==y?"y":"x")]=p._determineScrollbarTranslate(E,y);p[["_",y,"scrollbar"].join("")].translateTo(F,u,function(){p[["_",y,"scrollbar"].join("")].stopAnimation()},"ease-out");p[["_start",(a.VERTICAL==y?"Y":"X")].join("")]=E}}if(a.VERTICAL==p._orientation||a.BOTH==p._orientation){x(a.VERTICAL)}if(a.HORIZONTAL==p._orientation||a.BOTH==p._orientation){x(a.HORIZONTAL)}},false)};b._render=function j(){this._wrapper.classList.addClass("oo-list-wrapper");this._initListeners();this._renderScrollbars()};b.destroy=function n(){this._wrapper.destroy();this._content.getDomObject().removeEventListener(e.EVENT_START);this._content.getDomObject().removeEventListener(e.EVENT_MOVE);this._content.getDomObject().removeEventListener(e.EVENT_END);this._content.destroy();this._vscrollbarWrapper.destroy();this._vscrollbar.destroy();this._hscrollbarWrapper.destroy();this._hscrollbar.destroy()};i.Scroll=a;return i})(oo||{});var oo=(function(k){var h=k.View.Dom,d=k.Touch,n=k.utils;var m=function m(p,q,s){this._startX=0;this._startTranslate=0;this.callback=s||function(){};this._panelContainer=new h(p);this._transitionDuration=200;var r=this._panelContainer.getDomObject();this._panelWidth=(new h(r.firstElementChild)).getWidth();this._nbPanel=document.querySelectorAll([p," > *"].join("")).length;this._displayPager=(q?true:false);this._pager;this._buildPager();this.currentItem=0;this._moved=false;this.render()};var b=m.prototype;b._buildPager=function i(){if(this._displayPager){this._pager=h.createElement("div");this._pager.classList.addClass("carousel-pager");this._pager.setTemplate('{{#bullet}}<i class="dot"></i>{{/bullet}}');var q=[];for(var p=0;p<this._nbPanel;p++){q.push(p)}this._pager.render({bullet:q});this._updatePager()}};b._updatePager=function f(){var p=this._pager.getDomObject().querySelector(".dot.active");if(p){p.className=p.className.replace(/ *active/,"")}this._pager.getDomObject().querySelector([".dot:nth-child(",(this._activePanel+1),")"].join("")).className+=" active"};b.hasMoved=function o(){return this._moved};b._initListeners=function e(){var r=this._panelContainer.getDomObject();var q=this;var t;var p=false;var s=false;if("mousemove"!==d.EVENT_MOVE){r.addEventListener(d.EVENT_START,function(u){q._startX=d.getPositionX(u);q._startTranslate=q._panelContainer.getTranslateX();t=0;s=true},false);r.addEventListener(d.EVENT_MOVE,function(v){var u=d.getPositionX(v)-q._startX;if(s&&(u>20||u<-20)){q._panelContainer.translateTo({x:(q._startTranslate+u)},0);q._moved=true;p=true}},false);r.addEventListener(d.EVENT_END,function(){q._moved=false;var x=q._panelContainer.getTranslateX();if(x<0){x=Math.abs(x);var w=(q._panelWidth/2),u=(q._panelWidth*(q._nbPanel-1)-w);for(var v=w;v<=u;v=v+q._panelWidth){if(x<v){break}}var y;if(x>u){y=u+w}else{y=v-w}y*=-1}else{y=0}q._activePanel=Math.abs(y/q._panelWidth);q._panelContainer.translateTo({x:y},q._transitionDuration);if(this._displayPager){q._updatePager()}q.currentItem=q._activePanel;q._startTranslate=y;s=false;if(p){q.callback();p=false}},false)}};b.goToNext=function l(){this.goTo(this.currentItem+1);if(this.currentItem>=this._nbPanel-1){return true}else{return false}};b.goToPrev=function g(){this.goTo(this.currentItem-1);if(this.currentItem==0){return true}else{return false}};b.goTo=function c(p){var q=p*this._panelWidth;this._panelContainer.translateTo({x:-q},this._transitionDuration);this.currentItem=p};b.reset=function j(){var p=this._panelContainer.getDomObject();this._panelWidth=(new h(p.firstElementChild)).getWidth();var q=this.currentItem*this._panelWidth;this._panelContainer.translateTo({x:-q},this._transitionDuration)};b.render=function a(){if(this._pager){(new h(this._panelContainer.getDomObject().parentNode)).appendChild(this._pager)}this._initListeners()};k.Carousel=m;return k})(oo||{});