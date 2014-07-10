<?php
$queryString = isset($_GET['url'])?trim($_GET['url']):'';
$shareProvider = explode("/",$queryString);
$horizontalShare = isset($shareProvider['0'])?trim($shareProvider['0']):'';
$verticalShare = isset($shareProvider['1'])?trim($shareProvider['1']):'';
$horizontalCounter = isset($shareProvider['2'])?trim($shareProvider['2']):'';
$verticalCounter = isset($shareProvider['3'])?trim($shareProvider['3']):'';
$shareScript = 'var islrsharing = true;
var islrsocialcounter = true;

/**
 * @param elem
 */
function loginRadiusHorizontalRearrangeProviderList(elem) {
    if (elem.checked) {
        var ul = \'<li title="\'+elem.value+\'" id="lrhorizontal_\' + elem.value.toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'" class="lrshare_iconsprite32 lrshare_\' + elem.value.toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'"><input type="hidden" name="horizontal_rearrange[]" value="\'+elem.value+\'"></li>\';
        jQuery(\'#horsortable\').append(ul);
    }
    else {
    if (jQuery(\'#lrhorizontal_\' + elem.value.toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\'))) {
        jQuery(\'#lrhorizontal_\' + elem.value.toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')).remove();
        }
    }
}

/**
 * @param elem
 */
function loginRadiusVerticalRearrangeProviderList(elem) {
    if (elem.checked) {
        var ul = \'<li title="\'+elem.value+\'" id="lrvertical_\' + elem.value.toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'" class="lrshare_iconsprite32 lrshare_\' + elem.value.toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'"><input type="hidden" name="vertical_rearrange[]" value="\'+elem.value+\'"></li>\';
        jQuery(\'#versortable\').append(ul);
    }
    else {
        if (jQuery(\'#lrvertical_\' + elem.value.toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\'))) {
            jQuery(\'#lrvertical_\' + elem.value.toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')).remove();
        }
    }
}

/**
 * @param elem
 */
function loginRadiusVerticalSharingLimit(elem) {
    var provider = $("#sharevprovider").find(":checkbox");
    var checkCount = 0;
    for (var i = 0; i < provider.length; i++) {
        if (provider[i].checked) {
            // count checked providers
            checkCount++;
            if (checkCount >= 10) {
                elem.checked = false;
                $("#loginRadiusVerticalSharingLimit").show(\'slow\');
                setTimeout(function () {
                    $("#loginRadiusVerticalSharingLimit").hide(\'slow\');
                }, 5000);
                return;
            }
        }
    }
}

/**
 * @param elem
 */
function loginRadiusHorizontalSharingLimit(elem) {
    var provider = $("#sharehprovider").find(":checkbox");
    var checkCount = 0;
    for (var i = 0; i < provider.length; i++) {
        if (provider[i].checked) {
            // count checked providers
            checkCount++;
            if (checkCount >= 10) {
                elem.checked = false;
                $("#loginRadiusHorizontalSharingLimit").show(\'slow\');
                setTimeout(function () {
                    $("#loginRadiusHorizontalSharingLimit").hide(\'slow\');
                }, 5000);
                return;
            }
        }
    }
}

/**
 * select counter in checkbox and rearrange
 */
function createHorzontalShareProvider() {
    jQuery(\'#lrhorizontalshareprovider\').show();
    jQuery(\'#lrhorizontalsharerearange\').show();
    jQuery(\'#lrhorizontalcounterprovider\').hide();
}

/**
 * single image in provider
 */
function singleImgShareProvider() {
    jQuery(\'#lrhorizontalshareprovider\').hide();
    jQuery(\'#lrhorizontalsharerearange\').hide();
    jQuery(\'#lrhorizontalcounterprovider\').hide();
}

/**
 * select counter in checkbox
 */
function createHorizontalCounterProvider() {
    jQuery(\'#lrhorizontalcounterprovider\').show();
    jQuery(\'#lrhorizontalsharerearange\').hide();
    jQuery(\'#lrhorizontalshareprovider\').hide();
}

/**
 * select vertical sharing provider in checkbox
 */
function createVerticalShareProvider() {
    jQuery(\'#lrverticalshareprovider\').show();
    jQuery(\'#lrverticalsharerearange\').show();
    jQuery(\'#lrverticalcounterprovider\').hide();
}

/**
 * select counter in checkbox
 */
function createVerticalCounterProvider() {
    jQuery(\'#lrverticalcounterprovider\').show();
    jQuery(\'#lrverticalsharerearange\').hide();
    jQuery(\'#lrverticalshareprovider\').hide();
}

/**
 * select vertical interface in sharing
 */
function makeVerticalVisible() {
    jQuery(\'#sharevertical\').show();
    jQuery(\'#sharehorizontal\').hide();
    jQuery(\'#arrow\').addClass("vertical");
    jQuery(\'#arrow\').removeClass("horizontal");
    jQuery(\'#mymodal2\').css("color", "#00CCFF");
    jQuery(\'#mymodal1\').css("color", "#000000");
}

/**
 * select horizontal interface in sharing
 */
function makeHorizontalVisible() {
    jQuery(\'#sharehorizontal\').show();
    jQuery(\'#sharevertical\').hide();
    jQuery(\'#arrow\').removeClass("vertical");
    jQuery(\'#arrow\').addClass("horizontal");
    jQuery(\'#mymodal1\').css("color", "#00CCFF");
    jQuery(\'#mymodal2\').css("color", "#000000");
}
window.onload=function(){var shareProvider = $SS.Providers.More;var counterProvider = $SC.Providers.All;';
$shareScript .= "\r\n".'var horshareChecked = ' . $horizontalShare . ';
var vershareChecked = ' . $verticalShare . ';
var horcounterChecked = ' . $horizontalCounter . ';
var vercounterChecked = ' . $verticalCounter . ';
    for (var i = 0; i < shareProvider.length; i++) {
        var sharehdiv = \'<div class="loginRadiusProviders"><label class="socialTitle" for="horizontalsharingid\'+shareProvider[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'"><input type="checkbox" onchange="loginRadiusHorizontalSharingLimit(this);loginRadiusHorizontalRearrangeProviderList(this);" id="horizontalsharingid\'+shareProvider[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'" value="\'+shareProvider[i]+\'" style="float: left !important;">\'+shareProvider[i]+\'</label> </div>\';
        jQuery("#sharehprovider").append(sharehdiv);

        var sharevdiv = \'<div class="loginRadiusProviders"><label class="socialTitle" for="verticalsharingid\'+shareProvider[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'"><input type="checkbox" onchange="loginRadiusVerticalSharingLimit(this);loginRadiusVerticalRearrangeProviderList(this);" id="verticalsharingid\'+shareProvider[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'" value="\'+shareProvider[i]+\'" style="float: left !important;">\'+shareProvider[i]+\'</label> </div>\';
        jQuery("#sharevprovider").append(sharevdiv);

    }
    for (var i = 0; i < counterProvider.length; i++) {
        var counterhdiv = \'<div class="loginRadiusCounterProviders"><label class="socialTitle" for="horizontalcounterid\'+counterProvider[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'"><input type="checkbox" id="horizontalcounterid\'+counterProvider[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'" value="\'+counterProvider[i]+\'" name="horizontalcounter[]" style="float: left !important;">\'+counterProvider[i]+\'</label> </div>\';
        jQuery("#counterhprovider").append(counterhdiv);

        var countervdiv = \'<div class="loginRadiusProviders"><label class="socialTitle" for="verticalcounterid\'+counterProvider[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'"><input type="checkbox" id="verticalcounterid\'+counterProvider[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')+\'" value="\'+counterProvider[i]+\'" name="verticalcounter[]" style="float: left !important;">\'+counterProvider[i]+\'</label> </div>\';
        jQuery("#countervprovider").append(countervdiv);

    }
    for (var i = 0; i < horshareChecked.length; i++) {
        jQuery(\'#horizontalsharingid\' + horshareChecked[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')).attr("checked","checked");
    }
    for (var i = 0; i < vershareChecked.length; i++) {
        jQuery(\'#verticalsharingid\' + vershareChecked[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')).attr("checked","checked");
    }
    for (var i = 0; i < horcounterChecked.length; i++) {
        jQuery(\'#horizontalcounterid\' + horcounterChecked[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')).attr("checked","checked");
    }
    for (var i = 0; i < vercounterChecked.length; i++) {
        jQuery(\'#verticalcounterid\' + vercounterChecked[i].toLowerCase().replace(/\ /gi,\'\').replace(/\+/gi,\'\')).attr("checked","checked");
    }
}
';
echo $shareScript;
?>
var LoginRadius={user_settings:{},user_settings:{apikey:"",app_domain:"",protocol:"",hybridsharing:"",sharecounttype:"",twittermention:"",twitterrelated:"",isMobileFriendly:""},socialshare:{}},$SS=LoginRadius.socialshare;LoginRadius.socialcounter={};var $SC=LoginRadius.socialcounter;LoginRadius.util={};
(function(a){a.elementById=function(a){return document.getElementById(a)};a.elementsByClass=function(a,d){d=d?d:document.body;for(var c=[],b=RegExp("(^| )"+a+"( |$)"),f=d.getElementsByTagName("*"),e=0,k=f.length;e<k;e++)b.test(f[e].className)&&c.push(f[e]);return c};a.addEvent=function(a,d,c){var b=[];d instanceof Array?b=d:b.push(d);for(i=0;i<b.length;i++)b[i].attachEvent?b[i].attachEvent("on"+a,function(){c.call(b[i])}):b[i].addEventListener&&b[i].addEventListener(a,c,!1)};var h={};a.tmpl=function d(c,
b){var f=/\W/.test(c)?new Function("obj","var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('"+c.replace(/[\r\t\n]/g," ").split("<%").join("\t").replace(/((^|%>)[^\t]*)'/g,"$1\r").replace(/\t=(.*?)%>/g,"',$1,'").split("\t").join("');").split("%>").join("p.push('").split("\r").join("\\'")+"');}return p.join('');"):h[c]=h[c]||d(a.elementById(c).innerHTML);return b?f(b):f};a.openWindow=function(a){a=a||this.href;window.open(a,"lrpopupchildwindow","menubar=1,resizable=1,width=530,height=530");
return!1};a.addCss=function(a,c){for(var b in c)a.style[b]=c[b];return!0};a.getPos=function(a){for(var c=0,b=0;null!=a;c+=a.offsetLeft,b+=a.offsetTop,a=a.offsetParent);return{x:c,y:b}};a.getscreensize=function(){var a,c;"undefined"!=typeof window.innerWidth?(a=window.innerWidth,c=window.innerHeight):"undefined"!=typeof document.documentElement&&"undefined"!=typeof document.documentElement.clientWidth&&0!=document.documentElement.clientWidth?(a=document.documentElement.clientWidth,c=document.documentElement.clientHeight):
(a=document.getElementsByTagName("body")[0].clientWidth,c=document.getElementsByTagName("body")[0].clientHeight);return{x:c,y:a}};a.isMobile=function(){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)?!0:!1};a.containsStringArray=function(a,c){for(var b=0;b<a.length;b++)if(-1!=a[b].indexOf(c))return!0;return!1};a.addExternalCss=function(a){if(a){var c=document.getElementsByTagName("head")[0],b=document.createElement("link");b.rel="stylesheet";b.type=
"text/css";b.media="all";b.href=a;c.appendChild(b)}return!0};a.toggle_visibility=function(a){a=document.getElementById(a);a.style.display="block"==a.style.display?"none":"block"};a.toggle_show=function(a){document.getElementById(a).style.display="block"};a.toggle_hide=function(a){document.getElementById(a).style.display="none"};a.addEmbedCss=function(a){var c=document.createElement("style");c.type="text/css";c.styleSheet?c.styleSheet.cssText=a:c.innerHTML=a;document.getElementsByTagName("head")[0].appendChild(c);
return!0};a.addScript=function(a){var c=document.createElement("script");c.type="text/javascript";try{c.innerHTML=a}catch(b){c.text=a}document.getElementsByTagName("head")[0].appendChild(c);return!0};a.jsonpCall=function(a,c){if(a){var b="Loginradius"+Math.floor(1E18*Math.random()+1);window[b]=function(a){c(a);try{delete window[b]}catch(d){}document.body.removeChild(f)};var f=document.createElement("script");f.src=-1!=a.indexOf("?")?a+"&callback="+b:a+"?callback="+b;f.type="text/javascript";document.body.appendChild(f)}};
a.getCornerCss=function(a,c,b,f){var e={};c?e.right=c:e.left=a;f?e.bottom=f:e.top=b;return e}})(LoginRadius.util);
(function(a){function h(){if(!e&&(e=!0,k)){for(var a=0;a<k.length;a++)k[a].call(window,[]);k=[]}}function l(a){var b=window.onload;window.onload="function"!=typeof window.onload?a:function(){b&&b();a()}}function d(){if(!f){f=!0;document.addEventListener&&!b.opera&&document.addEventListener("DOMContentLoaded",h,!1);b.msie&&window==top&&function(){if(!e){try{document.documentElement.doScroll("left")}catch(a){setTimeout(arguments.callee,0);return}h()}}();b.opera&&document.addEventListener("DOMContentLoaded",
function(){if(!e){for(var a=0;a<document.styleSheets.length;a++)if(document.styleSheets[a].disabled){setTimeout(arguments.callee,0);return}h()}},!1);if(b.safari){var a;(function(){if(!e)if("loaded"!=document.readyState&&"complete"!=document.readyState)setTimeout(arguments.callee,0);else{if(void 0===a){for(var b=document.getElementsByTagName("link"),f=0;f<b.length;f++)"stylesheet"==b[f].getAttribute("rel")&&a++;b=document.getElementsByTagName("style");a+=b.length}document.styleSheets.length!=a?setTimeout(arguments.callee,
0):h()}})()}l(h)}}var c=navigator.userAgent.toLowerCase(),b={version:(c.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/)||[])[1],safari:/webkit/.test(c),opera:/opera/.test(c),msie:/msie/.test(c)&&!/opera/.test(c),mozilla:/mozilla/.test(c)&&!/(compatible|webkit)/.test(c)};a.browser=b;var f=!1,e=!1,k=[];a.ready=function(a,b){d();e?a.call(window,[]):k.push(function(){return a.call(window,[])})};d()})(LoginRadius.util);(islrsharing||hybridsharing)&&LoginRadius_Sharing(LoginRadius);
function LoginRadius_Sharing(a){function h(b){if(""!=b&&null!=b){var f=window.location.href,c=f.indexOf("#");0<c&&(window.location=f.substring(0,c));a.util.jsonpCall("//"+$SS.domain+"/Refferal/"+b,function(a){console.log("response "+a)})}}function l(){var b='<div class="lrshare_close_imageshare" onclick="$SS.hideimagepopup()"><img src="//'+$SS.domain+'/Content/css/pl_close_button.png" /></div><div class="lrshare_heading">Select an image you want to share on Pinterest.</div><div class="lrshare_contents"><div class="lrshare_imagelist"><ul><%for(var i=0;i<imgSrc.length;i++) {if(parseInt(imgSrc[i].width)>32 && parseInt(imgSrc[i].height) >32){%><li><span class="div_pinimages_spanouter loginradius_pinsharing_style"><span class="div_pinimages_spaninner" onclick=$SS.providerClick("media=+<%=imgSrc[i].src %>")><img title="<%=imgSrc[i].title %>" alt="<%=imgSrc[i].alt %>" src="<%=imgSrc[i].src %>" height="190px" width="190px" style="opacity: 1;"><div style="display: none;"></div></span><span class="atImgSpanSize"><%=imgSrc[i].width %> x <%=imgSrc[i].height %></span></span></li><%}}%></ul></div><div class="lrshare_poweredby" style="background-color:#fff;">Social Share by <a href="http://www.loginradius.com" target="_blank" style="text-decoration: none;"><span style="color: #00ccff; padding: 0px; text-shadow: none !important;">Login</span><span style="color: #000; text-shadow: none !important;">Radius</span></a></div></div>';
a.util.ready(function(){$SS.imagesfrompage=document.createElement("div");$SS.imgSrcs=document.getElementsByTagName("img");$SS.imagesfrompage.className="lrshare_imagepoup";$SS.imagesfrompage.style.display="none";$SS.imagesfrompage.innerHTML="";$SS.imagesfrompage.innerHTML=a.util.tmpl(b,{imgSrc:$SS.imgSrcs});document.body.appendChild($SS.imagesfrompage)});$SS.showimagepopup=function(){$SS.hideMore();$SS.imagesfrompage.style.display="block"};$SS.hideimagepopup=function(){$SS.imagesfrompage.style.display=
"none"};$SS.imgseach=function(a){var b=$SS.imagesfrompage.getElementsByTagName("li");for(i=0;i<b.length;i++)-1!=(b[i].innerText||b[i].textContent).toLowerCase().indexOf(a)?b[i].style.display="block":b[i].style.display="none"}}function d(){var b='<div class="lrshare_close" onclick="$SS.hideEvenMore()"><img src="//'+$SS.domain+'/Content/css/pl_close_button.png" /></div><div class="lrshare_heading"><div style="float:left;width:70px !important;">SHARE</div><input type="text" class="lrshare_headingtitleinput" onkeyup="$SS.seach(this.value);" placeholder="Search your sharing network" /></div><div class="lrshare_contents"><div class="lrshare_iconlist"><ul><%for(var i=0;i<providers.length;i++) { %><li onclick=$SS.providerClick("<%=providers[i].toLowerCase()%>")><span class="lrshare_iconsprite16 lrshare_<%=providers[i].toLowerCase() %>"></span><%=providers[i] %> </li><%}%></ul></div><div class="lrshare_poweredby" style="background-color:#fff;">Social Share by <a href="http://www.loginradius.com" target="_blank" style="text-decoration: none;"><span style="color: #00ccff; padding: 0px; text-shadow: none !important;">Login</span><span style="color: #000; text-shadow: none !important;">Radius</span></a></div></div>';
a.util.ready(function(){$SS.evenMore=document.createElement("div");$SS.evenMore.className="lrshare_evenmorepoup";$SS.evenMore.innerHTML=a.util.tmpl(b,{providers:$SS.Providers.All});document.body.appendChild($SS.evenMore)});$SS.showEvenMore=function(){$SS.imagesseleted&&$SS.hideimagepopup();$SS.hideMore();$SS.evenMore.style.display="block"};$SS.hideEvenMore=function(){$SS.evenMore.style.display="none"};$SS.seach=function(a){var b=$SS.evenMore.getElementsByTagName("li");for(i=0;i<b.length;i++)-1!=(b[i].innerText||
b[i].textContent).toLowerCase().indexOf(a.toLowerCase())?b[i].style.display="block":b[i].style.display="none"}}function c(){function b(){clearTimeout($SS.intervalmorehide);$SS.intervalmorehide=setTimeout($SS.hideMore,1E3)}a.util.ready(function(){$SS.More=document.createElement("div");$SS.More.className="lrshare_smallpopupevenmore";$SS.More.innerHTML=a.util.tmpl('<div class="lrshare_heading_smallevenmore">Bookmark & Share<div class="lrshare_close_smallevenmore" onclick="$SS.hideMore()"> <span class="closebuttonsprite close_span"></span></div></div><div class="lrshare_contents"><div class="lrshare_iconlist_smallevenmore"><ul><%for(var i=0;i<providers.length;i++) { %><li onclick=$SS.providerClick("<%=providers[i].toLowerCase()%>")><span class="lrshare_iconsprite16 lrshare_<%=providers[i].toLowerCase() %>"></span><%=providers[i] %> </li><%}%><% if(typeof isevenmorepopup == "undefined" || isevenmorepopup!="false"){%><li onclick=$SS.showEvenMore()><span class="lrshare_iconsprite16 lrshare_evenmore16"></span>More... </li><%}%></ul></div><div class="lrshare_poweredby">Social Share by <a href="http://www.loginradius.com" target="_blank" style="text-decoration: none;"><span style="color: #00ccff; padding: 0px; text-shadow: none !important;">Login</span><span style="color: #000; text-shadow: none !important;">Radius</span></a></div></div>',
{providers:$SS.Providers.More});document.body.appendChild($SS.More);a.util.addEvent("mouseout",$SS.More,function(){b()});a.util.addEvent("mouseover",$SS.More,function(){clearTimeout($SS.intervalmorehide)})});$SS.showMore=function(f){var c=a.util.getPos(f),d=window.screen.availHeight,g=f.offsetHeight+c.y+5,m=c.x,m=m+288>=window.screen.availWidth?m=c.x-210-10:m,g=g+288>=d?g=c.y-288+10:g;$SS.More.style.display="block";$SS.More.style.left=m+"px";$SS.More.style.top=g+"px";clearTimeout($SS.intervalmorehide);
a.util.addEvent("mouseout",f,function(){b()})};$SS.hideMore=function(a){$SS.More.style.display="none"}}$SS.TrackCount=function(b,c){a.util.jsonpCall("//"+$SS.domain+"/share/TrackCount/"+a.user_settings.apikey+"?ProviderID="+b+"&Url="+c+"&counttype="+a.user_settings.sharecounttype+"&twittermention="+a.user_settings.twittermention+"&twitterrelated="+a.user_settings.twitterrelated,function(a){})};$SS.providerClick=function(b){-1<b.indexOf("media")?(url="http://"+$SS.domain+"/share/"+a.user_settings.apikey+
"?ProviderID=pinterest&Url="+$SS.url+"&"+b+"&counttype="+a.user_settings.sharecounttype+"&twittermention="+a.user_settings.twittermention+"&twitterrelated="+a.user_settings.twitterrelated+"&title="+$SS.title+"&description="+$SS.description+"&ismobile="+LoginRadius.util.isMobile()+"&facebookappid="+$SS.facebookappid+"&redirecturi="+$SS.redirecturi+"&t="+document.title+"&imageUrl="+$SS.imageurl,$SS.hideimagepopup(),a.util.openWindow(url)):(url="http://"+$SS.domain+"/share/"+a.user_settings.apikey+"?ProviderID="+
b+"&Url="+$SS.url+"&counttype="+a.user_settings.sharecounttype+"&twittermention="+a.user_settings.twittermention+"&twitterrelated="+a.user_settings.twitterrelated+"&title="+$SS.title+"&description="+$SS.description+"&ismobile="+LoginRadius.util.isMobile()+"&facebookappid="+$SS.facebookappid+"&redirecturi="+$SS.redirecturi+"&t="+document.title+"&imageUrl="+$SS.imageurl,"undefined"!=typeof isevenmorepopup&&"false"==isevenmorepopup||$SS.hideEvenMore(),"undefined"!=typeof ismorepopup&&"false"==ismorepopup||
$SS.hideMore(),"print"==b?window.print():"pinterest"==b?($SS.imagesseleted||(l(),$SS.imagesseleted=!0),$SS.showimagepopup()):a.util.openWindow(url),$SS.callback&&$SS.callback(b))};(function(){$SS.domain="share.loginradius.com";$SS.Interface={};$SS.Providers={};$SS.imgSrcs=[];$SS.imgSrc={};$SS.Providers.All="Facebook Pinterest BarraPunto BlinkList blogmarks connotea Current Delicious Digg Diigo DZone eKudos Fark FriendFeed Google GooglePlus Gwar HackerNews Haohao HealthRanker Hemidemi Hyves Kirtsy LaTafanera LinkArena LinkaGoGo LinkedIn Linkter Meneame MisterWong Mixx muti MyShare MySpace Netvibes NewsVine Netvouz NuJIJ Posterous PDF Print Ratimarks Reddit Scoopeo Segnalo Slashdot Sphinn StumbleUpon Technorati ThisNext Tumblr Twitter Upnews Vkontakte Wykop Xerpi Yigg Yahoo SheToldMe Diggita".split(" ");
$SS.Providers.Top=[];$SS.Providers.More="Facebook Pinterest Twitter Print Email Google Digg Reddit Vkontakte GooglePlus Tumblr LinkedIn MySpace Delicious Yahoo".split(" ");var a=document.createElement("link");a.href="//"+$SS.domain+"/Content/css/LoginRadiusShare.css";a.rel="stylesheet";a.type="text/css";a.media="all";document.getElementsByTagName("head")[0].appendChild(a);!0==LoginRadius.util.isMobile()&&(document.head.insertAdjacentHTML("beforeEnd",'<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=0" />'),
document.getElementsByTagName("head").innerText=document.head.innerHTML);$SS.TotalShare=0;$SS.IsLabel=!1;$SS.imagesseleted=!1;$SS.url=encodeURIComponent(window.location.href);$SS.title="";$SS.description="";$SS.imageurl="";$SS.facebookappid="";$SS.redirecturi="";"undefined"!=typeof IsEnableFullUrl&&IsEnableFullUrl&&h(window.location.hash.substr(1));$SS.isCustomcss=!1})();"undefined"!=typeof isevenmorepopup&&"false"==isevenmorepopup||d();"undefined"!=typeof ismorepopup&&"false"==ismorepopup||c();(function(){$f=
$SS.Interface.Simplefloat={};$f.left="";$f.right="";$f.top="";$f.bottom="";$f.size=0;a.user_settings.apikey=""==a.user_settings.apikey?"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx":a.user_settings.apikey;$f.show=function(b){if(!0==LoginRadius.util.isMobile()&&!0==a.user_settings.isMobileFriendly)$mobile=$SS.Interface.mobileInterface,$mobile.show(b);else{a.util.jsonpCall("//"+$SS.domain+"/ApiData/"+a.user_settings.apikey+"?url="+$SS.url+"&url="+$SS.url+"&counttype="+a.user_settings.sharecounttype,function(a){$SS.IsLabel=
a[0].iswhitelabel;if("true"==a[0].iswhitelabel){a=LoginRadius.util.elementsByClass("lrshare_poweredby");for(var b=0;b<a.length;b++)a[b].style.display="none"}});$topproviders=$SS.Providers.Top;$f.size=$f.size||16;var c=$f.isHorizontal?"lrshare_floatleft":"";$f.classname="";"true"==$SS.isCustomcss&&($f.classname="custom_");$f.template='<ul><% for(var i=0;i<providers.length;i++){ %><li><div onclick=$SS.providerClick("<%=providers[i].toLowerCase()%>") class="'+$f.classname+"lrshare_iconsprite"+$f.size+
        " "+$f.classname+"lrshare_<%=providers[i].toLowerCase() %> "+c+'" title="<%=providers[i]%>"></div></li><% } %>';if("undefined"==typeof ismorepopup||"false"!=ismorepopup)$f.template+='<li><div onmouseover="$SS.showMore(this)" class="lrshare_iconsprite'+$f.size+" lrshare_evenmore"+$f.size+" "+c+'" title="more..."></div></li></ul>';c=b&&a.util.elementsByClass(b)?a.util.elementsByClass(b)[0]:document.createElement("div");b||document.body.appendChild(c);c.className+=" lrshare_interfacebox";c.innerHTML=
a.util.tmpl($f.template,{providers:$topproviders});b=c.getAttribute("data-share-url");var e=c.getAttribute("data-share-title"),d=c.getAttribute("data-share-description"),g=c.getAttribute("data-share-imageurl");b=b||$SS.url;e=e||$SS.title;d=d||$SS.description;g=g||$SS.imageurl;setDataUri(c,b,e,d,g);a.util.addCss(c,a.util.getCornerCss($f.left,$f.right,$f.top,$f.bottom))}}})();(function(){var b=$SS.Interface.simpleimage={};b.show=function(c){if(!0==LoginRadius.util.isMobile()&&!0==a.user_settings.isMobileFriendly)$mobile=
$SS.Interface.mobileInterface,$mobile.show(c);else if(a.util.jsonpCall("//"+$SS.domain+"/ApiData/"+(a.user_settings.apikey||"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx")+"?url="+$SS.url+"&counttype="+a.user_settings.sharecounttype,function(a){$SS.IsLabel=a[0].iswhitelabel;if("true"==a[0].iswhitelabel){a=LoginRadius.util.elementsByClass("lrshare_poweredby");for(var b=0;b<a.length;b++)a[b].style.display="none"}}),b.size=b.size||32,c=LoginRadius.util.elementsByClass(c))for(var e=0;e<c.length;e++){c[e].className+=
" lrshare_simpleshareimage"+b.size;c[e].innerHTML="";var d=c[e].getAttribute("data-share-url"),g=c[e].getAttribute("data-share-title"),m=c[e].getAttribute("data-share-description"),h=c[e].getAttribute("data-share-imageurl"),d=d||$SS.url,g=g||$SS.title,m=m||$SS.description,h=h||$SS.imageurl;setDataUri(c[e],d,g,m,h);a.util.addEvent("mouseover",c[e],function(){$SS.showMore(this)})}}})();(function(){$h=$SS.Interface.horizontal={};$h.size=0;a.user_settings.apikey=""==a.user_settings.apikey?"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx":
a.user_settings.apikey;$h.show=function(b){if(!0==LoginRadius.util.isMobile()&&!0==a.user_settings.isMobileFriendly)$mobile=$SS.Interface.mobileInterface,$mobile.show(b);else{$h=$h||16;$topproviders=$SS.Providers.Top;$h.classname="";"true"==$SS.isCustomcss&&($h.classname="custom_");$h.template='<ul><% for(var i=0;i<providers.length;i++){ %><li><div onclick=$SS.providerClick("<%=providers[i].toLowerCase()%>") class="'+$h.classname+"lrshare_iconsprite"+$h.size+" "+$h.classname+'lrshare_<%=providers[i].toLowerCase() %>" title="<%=providers[i]%>"></div></li><% } %>';
    if("undefined"==typeof ismorepopup||"false"!=ismorepopup)$h.template+='<li><div onmouseover="$SS.showMore(this);" class="lrshare_iconsprite'+$h.size+" lrshare_evenmore"+$h.size+'"  title="more..."></div></li>';$h.template+='<li><div class="lrshare_iconsprite'+$h.size+" lrshare_sharingcounter"+$h.size+' lrshare-totalshare" title="total shares">'+$SS.TotalShare+"</div></li></ul>";var c=a.util.elementsByClass(b);b=a.util.tmpl($h.template,{providers:$topproviders});if(c)for(var e=0;e<c.length;e++){c[e].innerHTML=
b;var d=c[e].getAttribute("data-share-url"),g=c[e].getAttribute("data-share-title"),h=c[e].getAttribute("data-share-description"),l=c[e].getAttribute("data-share-imageurl"),d=d||$SS.url,g=g||$SS.title,h=h||$SS.description,l=l||$SS.imageurl;setDataUri(c[e],d,g,h,l);c[e].className+=" lrshare_interfacehorizontal";a.util.jsonpCall("//"+$SS.domain+"/ApiData/"+a.user_settings.apikey+"?url="+d+"&counttype="+a.user_settings.sharecounttype,function(b){return function(d){a.util.elementsByClass("lrshare-totalshare",
c[b])[0].innerHTML=d[0].loginradiussharecount;$SS.IsLabel=d[0].iswhitelabel;if("true"==d[0].iswhitelabel){d=LoginRadius.util.elementsByClass("lrshare_poweredby");for(var e=0;e<d.length;e++)d[e].style.display="none"}}}(e))}}}})();(function(){$m=$SS.Interface.mobileInterface={};$m.size=0;a.user_settings.apikey=""==a.user_settings.apikey?"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx":a.user_settings.apikey;$m.show=function(){$m=$m||16;$topproviders=$SS.Providers.More;var b=$topproviders.indexOf("Print");-1<
b&&$topproviders.splice(b,1);b=$topproviders.indexOf("Pinterest");-1<b&&$topproviders.splice(b,1);b=document.createElement("div");b.className="lrshare_button";var c=document.createElement("div");c.className="lr_menu";c.id="lr_sharing_mobile_menu";c.style.display="none";$m.template1='<a  href="#" onclick=LoginRadius.util.toggle_show("lr_sharing_mobile_menu");><i class="lr_arrow"></i>Share</a>';$m.template+='<div class="lrmenu_inner"><div class="lrmenu_header"><div class="lrmenu_headerinner"><div class="lrmenu_head" >Share</div><a id="" class="lrmenu_headercancel" href="#" onclick=LoginRadius.util.toggle_hide("lr_sharing_mobile_menu");>Close</a></div></div><div class="lrmenu_body lrmenu_overflow"><div class="lrmenu_scroller"><div class="lrmenu_search" style="display:none;"><input type="text" placeholder="Find a service" ><input type="submit"><input  type="cancel" ></div>';
            $m.template+='<div class="lrmenu_content"><ul class="lrmenu_content"><% for(var i=0;i<providers.length;i++){ %><li onclick=$SS.providerClick("<%=providers[i].toLowerCase()%>")><a href="#"><div onclick=$SS.providerClick("<%=providers[i].toLowerCase()%>") class="" title="<%=providers[i]%>"><span class="lrmenu_contenticon lrshare_iconsprite32 lrshare_<%=providers[i].toLowerCase() %>"></span><span class="lrmenu_contentlabel"><%=providers[i]%></span><span class="lrmenu_contentarrow"></span></div></li><% } %>';
                    $m.template+="</ul></div></div></div></div>";var d=a.util.tmpl($m.template,{providers:$topproviders});b.innerHTML=$m.template1;c.innerHTML=d;document.body.appendChild(b);document.body.appendChild(c);LoginRadius.util.toggle_hide("lr_sharing_mobile_menu")}})()}
function setDataUri(a,h,l,d,c){LoginRadius.util.addEvent("mouseover",a,function(){if("undefined"==typeof isevenmorepopup||"false"!=isevenmorepopup){if("none"==$SS.evenMore.style.display||""==$SS.evenMore.style.display)$SS.url=h,$SS.title=l,$SS.description=d,$SS.imageurl=c}else $SS.url=h,$SS.title=l,$SS.description=d,$SS.imageurl=c});if(a=a.getElementsByTagName("div"))for(var b=0;b<a.length;b++)"undefined"==typeof isevenmorepopup||"false"!=isevenmorepopup?LoginRadius.util.addEvent("mouseover",a[b],
function(){if("none"==$SS.evenMore.style.display||""==$SS.evenMore.style.display)$SS.url=h,$SS.title=l,$SS.description=d,$SS.imageurl=c}):($SS.url=h,$SS.title=l,$SS.description=d,$SS.imageurl=c)}
islrsocialcounter&&function(a){function h(a,b,d,e){if(e){var h=a.getElementsByTagName(b)[0];a.getElementById(d)||(a=a.createElement(b),a.id=d,a.src=e,h.parentNode.insertBefore(a,h))}}function l(){var c=$SC.Interface.simple={};c.left="";c.right="";c.top="";c.bottom="";c.countertype="";c.isHorizontal=c.isHorizontal||!1;$SC.url=$SC.url||window.location.href;c.show=function(b){if(!0==LoginRadius.util.isMobile()&&!0==a.user_settings.isMobileFriendly){if("undefined"==typeof myVar||!0!=islrsharing)LoginRadius_Sharing(LoginRadius),
$mobile=$SS.Interface.mobileInterface,$mobile.show(b)}else{var f="horizontal"==c.countertype,e=[],k,g;for(g in d)if(d.hasOwnProperty(g))for(var m in d[g].buttons)d[g].buttons.hasOwnProperty(m)&&a.util.containsStringArray($SC.Providers.Selected,d[g].buttons[m].name)&&(k=d[g].buttons[m].name==d.google.buttons.share.name?f?d[g].layouts.sharehorizontal:d[g].layouts.shareverticle:f?d[g].layouts.horizontal:d[g].layouts.verticle,e.push(d[g].buttons[m].html.replace(/\#layout#/g,k).replace(/\#apikey#/g,LoginRadius.user_settings.apikey||
"xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx").replace(/\#scounttype#/g,"url")),d[g].src&&h(document,"script",d[g].id,d[g].src));"horizontal"==c.countertype?(LoginRadius.util.addEmbedCss(".IN-widget { float:none !important; height:auto;}  .reddit_width{vertical-align: bottom;}"),LoginRadius.util.addEmbedCss(".a.PIN_1364561637082_pin_it_button.PIN_1364561637082_pin_it_above{margin-top:38px !important;} .IN-widget { float:none !important;} .reddit_width{vertical-align: bottom;} .twitter-share-button {width: 80px !important;}")):
LoginRadius.util.addEmbedCss(" .reddit_width{vertical-align: bottom;} .IN-widget { float:none !important; } .lrshare_hybrid_share_vertical{margin-top:37px !important;} .lr_shares_count_vertical{margin-left:-58px !important;float:left !important;} .reddit_width{vertical-align: bottom;} .twitter-share-button {width: 80px !important;}");c.isHorizontal?(template='<table style="border:none !important;background:none !important;"><tbody style="border:none !important;background:none !important;"><tr style="border:none !important;background:none !important;"> <% for(var i=0;i<buttons.length;i++){ %> <td style="border:none !important;background:none !important;"><%= buttons[i] %></td><% } %></tr></tbody></table>',
f={}):(template='<table style="border:none !important;background:none !important;"><tbody style="border:none !important;background:none !important;"> <% for(var i=0;i<buttons.length;i++){ %><tr style="border:none !important;background:none !important;"><td style="border:none !important;background:none !important;"><%= buttons[i] %></td></tr><% } %></tbody></table>',f=a.util.getCornerCss(c.left,c.right,c.top,c.bottom),f.position="fixed");e=a.util.tmpl(template,{buttons:e});b=a.util.elementsByClass(b);
for(k=0;k<b.length;k++){g=b[k].getAttribute("data-counter-url")||$SC.url;b[k].innerHTML=e.replace(/\#url#/g,g);m=b[k].getAttribute("data-share-title");var l=b[k].getAttribute("data-share-description"),n=b[k].getAttribute("data-share-imageurl");g=g||$SC.url;m=m||$SC.title;l=l||$SC.description;n=n||$SC.imageurl;setDataUri(b[k],g,m,l,n);b[k].className=b[k].className+" lrcounter-"+(c.isHorizontal?"horizontal":"vertical")+"-"+c.countertype;LoginRadius.util.addCss(b[k],{"background-color":"transparent",
border:"0px solid #DDDDDD","border-radius":"6px 6px 6px 6px",padding:"0px",clear:"both",display:"inline-block","text-align":"center","box-shadow":"0 0 0px #D1D1D1 inset","z-index":"9999"});LoginRadius.util.addCss(b[k],f);a.util.addScript("window.fbAsyncInit = function () { FB.Event.subscribe('edge.create', function (response) {console.log('facebook like', response);$SS.TrackCount('facebook','"+$SC.url+"')});FB.Event.subscribe('edge.remove', function (response) {console.log('faceboo un-like', response);}); FB.Event.subscribe('message.send', function (response) {console.log('faceboo Send', response);});};");
a.util.addScript("window.twttr = (function (d, s, id) {var t, js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id; js.src = 'https://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js, fjs);return window.twttr || (t = { _e: [], ready: function (f) { t._e.push(f) } });}(document, 'script', 'twitter-wjs'));function followIntentToAnalytics(intentEvent) {if (!intentEvent) return;var label = console.log('twitter', intentEvent);$SS.TrackCount('twitter','"+
$SC.url+"')}  twttr.ready(function (twttr) {twttr.events.bind('tweet', followIntentToAnalytics);});");a.util.addScript("function tracklinkedin(reponse) {console.log('linkedin' + reponse);$SS.TrackCount('linkedin','"+$SC.url+"')};function trackgoogle(reponse) {console.log('Google Plus' + reponse.state);if(reponse.state=='on'){$SS.TrackCount('googleplus','"+$SC.url+"')}};");h(document,"script","twiitterwidget","http://platform.twitter.com/widgets.js")}}c.isHorizontal?null!=document.getElementById("pinterestId")&&
(document.getElementById("pinterestId").className="pinterest-horizontal"):null!=document.getElementById("pinterestId")&&(document.getElementById("pinterestId").className="pinterest-vertical")}}var d;(function(){$SC.domain="share.loginradius.com";$SC.url=$SC.url||window.location.href;d={facebook:{id:"facebook-jssdk",src:"//connect.facebook.net/en_US/all.js#xfbml=1",buttons:{like:{html:'<div class="fb-like fb-like-#layout#" data-send="false" data-layout="#layout#"  data-show-faces="false" data-href="#url#"></div>',
name:"Facebook Like"},recommend:{html:'<div class="fb-like" data-send="false" data-layout="#layout#"  data-show-faces="false" data-action="recommend"  data-href="#url#"></div>',name:"Facebook Recommend"},send:{html:'<div class="fb-send fb_edge_widget_with_comment fb_iframe_widget"  data-href="#url#" callback="facebooksendcallback" ></div>',name:"Facebook Send"}},layouts:{horizontal:"button_count",verticle:"box_count"}},twitter:{id:"twitter-wjs",src:"",buttons:{share:{html:'<a href="https://twitter.com/share" class="twitter-share-button"  data-url="#url#" data-count="#layout#">Tweet</a>',
name:"Twitter Tweet"}},layouts:{horizontal:"horizontal",verticle:"vertical"}},pinterest:{id:"pinterest-wjs",src:"//assets.pinterest.com/js/pinit.js",buttons:{share:{html:'<div id="pinterestId"> <a data-pin-config="#layout#" href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark"  ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a> </div>',name:"Pinterest Pin it"}},layouts:{horizontal:"beside",verticle:"above"}},linkedin:{id:"linkedin-wjs",src:"//platform.linkedin.com/in.js",
buttons:{share:{html:'<script type="IN/Share" data-counter="#layout#" data-url="#url#" data-onSuccess="tracklinkedin">\x3c/script>',name:"LinkedIn Share"}},layouts:{horizontal:"right",verticle:"top"}},stumbleupon:{id:"stumbleupon-wjs",src:"//platform.stumbleupon.com/1/widgets.js",buttons:{share:{html:'<su:badge layout="#layout#" location="#url#"></su:badge>',name:"StumbleUpon Badge"}},layouts:{horizontal:"1",verticle:"5"}},reddit:{buttons:{share:{html:'<iframe src="https://redditstatic.s3.amazonaws.com/button/button#layout# scrolling="no" frameborder="0" class="reddit_width"></iframe>',
name:"Reddit"}},layouts:{horizontal:'1.html?width=120&url=#url#&newwindow=1" height="22" width="100" align="left"',verticle:'2.html?width=51&url=#url#&newwindow=1" height="69" width="51"'}},google:{id:"google-plusone",src:"//apis.google.com/js/plusone.js",buttons:{plusone:{html:'<div class="g-plusone"  style="width: 50px ! important; height: 25px ! important; vertical-align: bottom ! important;"  data-size="#layout#" data-callback="trackgoogle" data-href="#url#"></div>',name:"Google+ +1"},share:{html:'<div class="g-plus" data-action="share" data-annotation="#layout#" data-href="#url#" data-callback="trackgoogle" ></div>',
name:"Google+ Share"}},layouts:{horizontal:"hori",verticle:"tall",sharehorizontal:"bubble",shareverticle:"vertical-bubble"}},hybridshare:{id:"hybridshare-wjs",buttons:{share:{html:'<div><div onmouseover="$SS.showMore(this)" class="lrshare_hybrid_share lrshare_hybrid_share_#layout#"  title="more..." style="float:left;"></div><div style="float:right;" class="lr_shares_count_#layout#"><iframe src="//'+$SC.domain+'/count/#apikey#?size=32&url=#url#&counttype=#scounttype#&datalayout=#layout#" frameborder="0" scrolling="no" allowtransparency="true" height="35" width="50" style="margin-top: 0px;"></iframe></div></div>',
name:"Hybridshare"}},layouts:{horizontal:"horizontal",verticle:"vertical"}}};$SC.Providers={};var c=$SC.Providers,b=[],f;for(f in d)if(d.hasOwnProperty(f))for(var e in d[f].buttons)d[f].buttons.hasOwnProperty(e)&&b.push(d[f].buttons[e].name);c.All=b;$SC.Providers.Selected=[];$SC.Interface={};$SC.url="";$SC.PageTitle="";$SC.PageDescription="";$SC.imageurl="";$SC.facebookappid="";$SC.redirecturi="";l();a.util.addEmbedCss(".lrcounter-vertical-horizontal tr td{border:none!important;background:none!important;color:#000!important;}.fb_iframe_widget iframe {position: relative !important;}.fb_iframe_widget span {display: inline-block !important; position: relative;text-align: justify;width:auto !important;}.lrcounter-vertical-horizontal table{border:none!important;background:none!important;color:#000!important;margin:0!important;padding:0!important;text-align:left !important;}.lrcounter-horizontal-vertical table{ background: none !important; border: medium none !important; color: #000000 !important; margin:0 !important;padding:0 !important; text-align:left !important;}.lrcounter-horizontal-vertical table tr,.lrcounter-horizontal-vertical table td {background: none repeat scroll 0 0 transparent !important;  border: medium none !important; color: #000000 !important;display: inline-table;  margin-left: 4px !important;  padding: 0 2px !important; text-align: left !important; vertical-align: bottom !important;}.lrcounter-horizontal-horizontal{background: none repeat scroll 0 0 transparent !important;  border: medium none !important; color: #000000 !important;display: inline-table;  margin: 0 !important;  padding: 0 2px !important; text-align: left !important; vertical-align: bottom !important;}.lrshare_hybrid_share_vertical{height: 27px !important;}.lrcounter-horizontal-horizontal td { border: medium none !important;display: inline-table;padding:0 !important;vertical-align: middle;}.pinterest-vertical {margin-top: 31px ! important;}.pinterest-horizontal {margin-right: 24px ! important;}")})()}(LoginRadius);