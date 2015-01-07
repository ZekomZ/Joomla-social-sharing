<?php
$queryString = isset($_GET['url'])?trim($_GET['url']):'';
$shareProvider = explode("/",$queryString);
$horizontalShare = isset($shareProvider['0'])?trim($shareProvider['0']):'';
$verticalShare = isset($shareProvider['1'])?trim($shareProvider['1']):'';
$horizontalCounter = isset($shareProvider['2'])?trim($shareProvider['2']):'';
$verticalCounter = isset($shareProvider['3'])?trim($shareProvider['3']):'';
$shareScript = '
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