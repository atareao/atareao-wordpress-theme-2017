/*! Featherlight v1.4.0 - http://noelboss.github.io/featherlight/ MIT Licensed.*/
(function(f){if("undefined"===typeof f){if("console" in window){window.console.info("Too much lightness, Featherlight needs jQuery.")}return}function a(j,i){if(this instanceof a){this.id=a.id++;this.setup(j,i);this.chainCallbacks(a._callbackChain)}else{var k=new a(j,i);k.open();return k}}var g=[],h=function(i){g=f.grep(g,function(j){return j!==i&&j.$instance.closest("body").length>0});return g};var b=function(o,n){var i={},m=new RegExp("^"+n+"([A-Z])(.*)");for(var k in o){var j=k.match(m);if(j){var l=(j[1]+j[2].replace(/([A-Z])/g,"-$1")).toLowerCase();i[l]=o[k]}}return i};var e={keyup:"onKeyUp",resize:"onResize"};var c=function(i){f.each(a.opened().reverse(),function(){if(!i.isDefaultPrevented()){if(false===this[e[i.type]](i)){i.preventDefault();i.stopPropagation();return false}}})};var d=function(j){if(j!==a._globalHandlerInstalled){a._globalHandlerInstalled=j;var i=f.map(e,function(l,k){return k+"."+a.prototype.namespace}).join(" ");f(window)[j?"on":"off"](i,c)}};a.prototype={constructor:a,namespace:"featherlight",targetAttr:"data-featherlight",variant:null,resetCss:false,background:null,openTrigger:"click",closeTrigger:"click",filter:null,root:"body",openSpeed:250,closeSpeed:250,closeOnClick:"background",closeOnEsc:true,closeIcon:"&#10005;",loading:"",persist:false,otherClose:null,beforeOpen:f.noop,beforeContent:f.noop,beforeClose:f.noop,afterOpen:f.noop,afterContent:f.noop,afterClose:f.noop,onKeyUp:f.noop,onResize:f.noop,type:null,contentFilters:["jquery","image","html","ajax","iframe","text"],setup:function(n,l){if(typeof n==="object"&&n instanceof f===false&&!l){l=n;n=undefined}var j=f.extend(this,l,{target:n}),m=!j.resetCss?j.namespace:j.namespace+"-reset",k=f(j.background||['<div class="'+m+"-loading "+m+'">','<div class="'+m+'-content">','<span class="'+m+"-close-icon "+j.namespace+'-close">',j.closeIcon,"</span>",'<div class="'+j.namespace+'-inner">'+j.loading+"</div>","</div>","</div>"].join("")),i="."+j.namespace+"-close"+(j.otherClose?","+j.otherClose:"");j.$instance=k.clone().addClass(j.variant);j.$instance.on(j.closeTrigger+"."+j.namespace,function(p){var o=f(p.target);if(("background"===j.closeOnClick&&o.is("."+j.namespace))||"anywhere"===j.closeOnClick||o.closest(i).length){j.close(p);p.preventDefault()}});return this},getContent:function(){if(this.persist!==false&&this.$content){return this.$content}var j=this,n=this.constructor.contentFilters,i=function(q){return j.$currentTarget&&j.$currentTarget.attr(q)},m=i(j.targetAttr),o=j.target||m||"";var l=n[j.type];if(!l&&o in n){l=n[o];o=j.target&&m}o=o||i("href")||"";if(!l){for(var k in n){if(j[k]){l=n[k];o=j[k]}}}if(!l){var p=o;o=null;f.each(j.contentFilters,function(){l=n[this];if(l.test){o=l.test(p)}if(!o&&l.regex&&p.match&&p.match(l.regex)){o=p}return !o});if(!o){if("console" in window){window.console.error("Featherlight: no content filter found "+(p?' for "'+p+'"':" (no target specified)"))}return false}}return l.process.call(j,o)},setContent:function(j){var i=this;if(j.is("iframe")||f("iframe",j).length>0){i.$instance.addClass(i.namespace+"-iframe")}i.$instance.removeClass(i.namespace+"-loading");i.$instance.find("."+i.namespace+"-inner").not(j).slice(1).remove().end().replaceWith(f.contains(i.$instance[0],j[0])?"":j);i.$content=j.addClass(i.namespace+"-inner");return i},open:function(k){var i=this;i.$instance.hide().appendTo(i.root);if((!k||!k.isDefaultPrevented())&&i.beforeOpen(k)!==false){if(k){k.preventDefault()}var j=i.getContent();if(j){g.push(i);d(true);i.$instance.fadeIn(i.openSpeed);i.beforeContent(k);return f.when(j).always(function(l){i.setContent(l);i.afterContent(k)}).then(i.$instance.promise()).done(function(){i.afterOpen(k)})}}i.$instance.detach();return f.Deferred().reject().promise()},close:function(k){var j=this,i=f.Deferred();if(j.beforeClose(k)===false){i.reject()}else{if(0===h(j).length){d(false)}j.$instance.fadeOut(j.closeSpeed,function(){j.$instance.detach();j.afterClose(k);i.resolve()})}return i.promise()},resize:function(i,k){if(i&&k){this.$content.css("width","").css("height","");var j=Math.max(i/parseInt(this.$content.parent().css("width"),10),k/parseInt(this.$content.parent().css("height"),10));if(j>1){this.$content.css("width",""+i/j+"px").css("height",""+k/j+"px")}}},chainCallbacks:function(j){for(var i in j){this[i]=f.proxy(j[i],this,f.proxy(this[i],this))}}};f.extend(a,{id:0,autoBind:"[data-featherlight]",defaults:a.prototype,contentFilters:{jquery:{regex:/^[#.]\w/,test:function(i){return i instanceof f&&i},process:function(i){return this.persist!==false?f(i):f(i).clone(true)}},image:{regex:/\.(png|jpg|jpeg|gif|tiff|bmp|svg)(\?\S*)?$/i,process:function(l){var k=this,j=f.Deferred(),i=new Image(),m=f('<img src="'+l+'" alt="" class="'+k.namespace+'-image" />');i.onload=function(){m.naturalWidth=i.width;m.naturalHeight=i.height;j.resolve(m)};i.onerror=function(){j.reject(m)};i.src=l;return j.promise()}},html:{regex:/^\s*<[\w!][^<]*>/,process:function(i){return f(i)}},ajax:{regex:/./,process:function(k){var j=this,i=f.Deferred();var l=f("<div></div>").load(k,function(n,m){if(m!=="error"){i.resolve(l.contents())}i.fail()});return i.promise()}},iframe:{process:function(k){var i=new f.Deferred();var j=f("<iframe/>").hide().attr("src",k).css(b(this,"iframe")).on("load",function(){i.resolve(j.show())}).appendTo(this.$instance.find("."+this.namespace+"-content"));return i.promise()}},text:{process:function(i){return f("<div>",{text:i})}}},functionAttributes:["beforeOpen","afterOpen","beforeContent","afterContent","beforeClose","afterClose"],readElementConfig:function(j,k){var l=this,m=new RegExp("^data-"+k+"-(.*)"),i={};if(j&&j.attributes){f.each(j.attributes,function(){var o=this.name.match(m);if(o){var q=this.value,n=f.camelCase(o[1]);if(f.inArray(n,l.functionAttributes)>=0){q=new Function(q)}else{try{q=f.parseJSON(q)}catch(p){}}i[n]=q}})}return i},extend:function(k,j){var i=function(){this.constructor=k};i.prototype=this.prototype;k.prototype=new i();k.__super__=this.prototype;f.extend(k,this,j);k.defaults=k.prototype;return k},attach:function(o,j,i){var m=this;if(typeof j==="object"&&j instanceof f===false&&!i){i=j;j=undefined}i=f.extend({},i);var k=i.namespace||m.defaults.namespace,l=f.extend({},m.defaults,m.readElementConfig(o[0],k),i),n;o.on(l.openTrigger+"."+l.namespace,l.filter,function(q){var p=f.extend({$source:o,$currentTarget:f(this)},m.readElementConfig(o[0],l.namespace),m.readElementConfig(this,l.namespace),i);var r=n||f(this).data("featherlight-persisted")||new m(j,p);if(r.persist==="shared"){n=r}else{if(r.persist!==false){f(this).data("featherlight-persisted",r)}}p.$currentTarget.blur();r.open(q)});return o},current:function(){var i=this.opened();return i[i.length-1]||null},opened:function(){var i=this;h();return f.grep(g,function(j){return j instanceof i})},close:function(i){var j=this.current();if(j){return j.close(i)}},_onReady:function(){var i=this;if(i.autoBind){f(i.autoBind).each(function(){i.attach(f(this))});f(document).on("click",i.autoBind,function(j){if(j.isDefaultPrevented()||j.namespace==="featherlight"){return}j.preventDefault();i.attach(f(j.currentTarget));f(j.target).trigger("click.featherlight")})}},_callbackChain:{onKeyUp:function(j,i){if(27===i.keyCode){if(this.closeOnEsc){f.featherlight.close(i)}return false}else{return j(i)}},onResize:function(j,i){this.resize(this.$content.naturalWidth,this.$content.naturalHeight);return j(i)},afterContent:function(k,j){var i=k(j);this.onResize(j);return i}}});f.featherlight=a;f.fn.featherlight=function(j,i){return a.attach(this,j,i)};f(document).ready(function(){a._onReady()})}(jQuery));

var Cookie = {
    set: function(name,value,days) {
            if (days) {
                    var date = new Date();
                    date.setTime(date.getTime()+(days*24*60*60*1000));
                    var expires = "; expires="+date.toGMTString();
            }
            else var expires = "";
            document.cookie = name+"="+value+expires+"; path=/";
    },
    read: function(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') {
                            c = c.substring(1,c.length);
                    }
                    if (c.indexOf(nameEQ) === 0) {
                            return c.substring(nameEQ.length,c.length);
                    }
            }
            return null;
    },
    erase: function(name) {
            this.set(name,"",-1);
    },
    exists: function(name) {
            return (this.read(name) !== null);
    }
}   ;

jQuery(document).ready(function(jQuery){
    //Fancy added by Lorenzo Carbonell
    jQuery('.highslide').featherlight();

    // Back to top
    if (jQuery('#back-to-top').length) {
        var scrollTrigger = 200, // px
            backToTop = function () {
                var scrollTop = jQuery(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    jQuery('#back-to-top').addClass('show');
                    jQuery('#back-to-top').show();
                } else {
                    jQuery('#back-to-top').removeClass('show');
                    jQuery('#back-to-top').hide();
                }
            };
        backToTop();
        jQuery(window).on('scroll', function () {
            backToTop();
        });
        jQuery('#back-to-top').on('click', function (e) {
            e.preventDefault();
            jQuery('html,body').animate({
                scrollTop: 0
            }, 700);
        });
        //
		navArrows:true,
		jQuery('audio').playlistParser();

    }
    /*loadDisqus2();*/
    var ACCEPT_COOKIE_NAME = 'atareao_viewed_cookie_policy';
    var ACCEPT_COOKIE_EXPIRE = 365;
    //Cookie.erase(ACCEPT_COOKIE_NAME);
    if (!Cookie.exists(ACCEPT_COOKIE_NAME)){
        jQuery('body').prepend('<div class="cookie-policy"><div class="cookie-policy-wrapper"><a href="#" class="link-cta"></a><p>Este sitio utiliza cookies propias y de terceros para mejorar tu experiencia y nuestros servicios. Si continuas navegando, consideramos que aceptas la <a href="./politica-de-cookies/">política de cookies.</a></p></div></div>');
        jQuery('.link-cta').click(function(){
            Cookie.set(ACCEPT_COOKIE_NAME, 'yes', ACCEPT_COOKIE_EXPIRE);
            if(jQuery('.cookie-policy').hasClass('selected')==false){
                jQuery('.cookie-policy').slideUp(500);
            }
        });
    }
});
