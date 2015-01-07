<?php
defined('_JEXEC') or die ('Direct Access to this location is not allowed.');

$enableHorizontalShare = "";
$disableHorizontalShare = "";
$horizontalTheme32 = "";
$horizontalTheme16 = "";
$horizontalThemeLarge = "";
$horizontalThemeSmall = "";
$horizontalCounter32 = "";
$horizontalCounter16 = "";
$responcive = "";
$enableVerticalShare = "";
$disableVerticalShare = "";
$topLeft = "";
$topRight = "";
$bottomLeft = "";
$bottomRight = "";
$verticalTheme32 = "";
$verticalTheme16 = "";
$verticalCounterTheme32 = "";
$verticalCounterTheme16 = "";

if ($this->settings['sharehorizontal'] == '1') $enableHorizontalShare = "checked='checked'";
else if ($this->settings['sharehorizontal'] == '0') $disableHorizontalShare = "checked='checked'";
else $enableHorizontalShare = "checked='checked'";

if ($this->settings['choosehorizontalshare'] == '0') $horizontalTheme32 = "checked='checked'";
else if ($this->settings['choosehorizontalshare'] == '1') $horizontalTheme16 = "checked='checked'";
else if ($this->settings['choosehorizontalshare'] == '2') $horizontalThemeLarge = "checked='checked'";
else if ($this->settings['choosehorizontalshare'] == '3') $horizontalThemeSmall = "checked='checked'";
else if ($this->settings['choosehorizontalshare'] == '4') $horizontalCounter16 = "checked='checked'";
else if ($this->settings['choosehorizontalshare'] == '5') $horizontalCounter32 = "checked='checked'";
else if ($this->settings['choosehorizontalshare'] == '6') $responcive = "checked='checked'";
else $horizontalTheme32 = "checked='checked'";

if ($this->settings['chooseverticalshare'] == '0') $verticalTheme32 = "checked='checked'";
else if ($this->settings['chooseverticalshare'] == '1') $verticalTheme16 = "checked='checked'";
else if ($this->settings['chooseverticalshare'] == '2') $verticalCounterTheme32 = "checked='checked'";
else if ($this->settings['chooseverticalshare'] == '3') $verticalCounterTheme16 = "checked='checked'";
else $verticalTheme32 = "checked='checked'";

if ($this->settings['sharevertical'] == '1') $enableVerticalShare = "checked='checked'";
else if ($this->settings['sharevertical'] == '0') $disableVerticalShare = "checked='checked'";
else $enableVerticalShare = "checked='checked'";

if ($this->settings['verticalsharepos'] == '0') $topLeft = "checked='checked'";
else if ($this->settings['verticalsharepos'] == '1') $topRight = "checked='checked'";
else if ($this->settings['verticalsharepos'] == '2') $bottomLeft = "checked='checked'";
else if ($this->settings['verticalsharepos'] == '3') $bottomRight = "checked='checked'";
else $topLeft = "checked='checked'";
?>

<!-- Display Table-->
<table class="form-table social_table">
    <tr>
        <th class="head" colspan="2"><?php echo JText::_('COM_SOCIAL_SHARE_SOCIAL_SHARE'); ?></th>
    </tr>
    <tr class="social_row_white">
        <td colspan="2">
            <div style="border-bottom: 1px solid #ddd;padding: 10px 0px;">
                <div id="apititle"><span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_APIKEY_TITLE'); ?></span></div>
                <div id="apiinbox"><input name="settings[apikey]" type="text" id="apikey" value="<?php echo $this->settings['apikey']; ?>"/></div>
                <div class="apihelp"><?php echo JText::_('COM_SOCIAL_SHARE_API_SETTING_HELP'); ?></div>
            </div>
        </td>
    </tr>
    <tr class="social_row_white">
        <td colspan="2">
        <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_THEME'); ?></span><br/><br/>
        <a id="mymodal1" href="javascript:void(0);" onclick="makeHorizontalVisible();" style="color: #00CCFF;"><b><?php echo JText::_('COM_SOCIAL_SHARE_HORI'); ?></b></a> &nbsp;|&nbsp;
        <a id="mymodal2" href="javascript:void(0);" onclick="makeVerticalVisible();" style="color: #000000;"><b><?php echo JText::_('COM_SOCIAL_SHARE_VERTICAL'); ?></b></a>
        <div style="border:#dddddd 1px solid; padding:10px; margin:10px 0 0 0;">
        <span id="arrow" class="horizontal"></span>
        <div id="sharehorizontal" style="display:block;">

        <div style="overflow:auto; background:#ffffff; padding:10px;">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_HORIZONTAL'); ?></span><br/><br/>
            <input name="settings[sharehorizontal]" type="radio"  <?php echo $enableHorizontalShare; ?> value="1"/> <?php echo JText::_('COM_SOCIAL_SHARE_YES'); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="settings[sharehorizontal]" type="radio" <?php echo $disableHorizontalShare; ?> value="0"/> <?php echo JText::_('COM_SOCIAL_SHARE_NO'); ?> </div>

        <!--display social share title on top of interface-->
        <div style="overflow:auto; background:#ffffff; padding:10px;">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_HORIZONTAL_THEMES'); ?></span><br/>
            <!--socialshare interface theme-->
            <label for="hori32">
                <input name="settings[choosehorizontalshare]" id="hori32" onclick="createHorzontalShareProvider();" type="radio" <?php echo $horizontalTheme32; ?>value="0"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/horizonSharing32.png" ?>'/>
            </label>
            <label for="hori16">
                <input name="settings[choosehorizontalshare]" id="hori16" onclick="createHorzontalShareProvider();" type="radio" <?php echo $horizontalTheme16; ?>value="1"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/horizonSharing16.png" ?>'/>
            </label>
            <label for="responcive">
                <input name="settings[choosehorizontalshare]" id="responcive" onclick="createHorzontalShareProvider();" type="radio" <?php echo $responcive; ?>value="6"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/responsive-icons.png" ?>'/>
            </label>
            <label for="horithemelarge">
                <input name="settings[choosehorizontalshare]" id="horithemelarge" onclick="singleImgShareProvider();" type="radio" <?php echo $horizontalThemeLarge; ?>value="2"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/single-image-theme-large.png" ?>'/>
            </label>
            <label for="horithemesmall">
                <input name="settings[choosehorizontalshare]" id="horithemesmall" onclick="singleImgShareProvider();" type="radio" <?php echo $horizontalThemeSmall; ?>value="3"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/single-image-theme-small.png" ?>'/>
            </label>
            <label for="chori16">
                <input name="settings[choosehorizontalshare]" id="chori16" onclick="createHorizontalCounterProvider();" type="radio" <?php echo $horizontalCounter16; ?>value="4"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/hybrid-horizontal-horizontal.png" ?>'/>
            </label>
            <label for="chori32">
                <input name="settings[choosehorizontalshare]" id="chori32" onclick="createHorizontalCounterProvider();" type="radio" <?php echo $horizontalCounter32; ?>value="5"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/hybrid-horizontal-vertical.png" ?>'/>
            </label>
        </div>

        <!--socialshare position select-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_POSITION'); ?></span><br/><br/>
            <input name="settings[shareontoppos]" type="checkbox"  <?php echo $this->settings['shareontoppos']; ?> value="1"/> <?php echo JText::_('COM_SOCIAL_SHARE_POSITION_TOP'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="settings[shareonbottompos]" type="checkbox"  <?php echo $this->settings['shareonbottompos']; ?> value="1"/> <?php echo JText::_('COM_SOCIAL_SHARE_POSITION_BOTTOM'); ?>
        </div>

        <!--select counter provider checkboxes-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;display:<?php if ($this->settings['choosehorizontalshare'] == '4' || $this->settings['choosehorizontalshare'] == '5') {
                echo 'block';
            } else {
                echo 'none';
            } ?>;" id="lrhorizontalcounterprovider">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_NETWORKS'); ?></span><br/><br/>
            <div id="counterhprovider" class="row_white"></div>
        </div>

        <!--select share provider checkboxes-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;display:<?php if (in_array($this->settings['choosehorizontalshare'], array('','0','1','6'))) {
                echo 'block';
            } else {
                echo 'none';
            } ?>;" id="lrhorizontalshareprovider">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_NETWORKS'); ?></span><br/><br/>
            <div id="loginRadiusHorizontalSharingLimit"
                 style="color: red; display: none; margin-bottom: 5px;"><?php echo JTEXT::_('COM_SOCIAL_SHARE_PROVIDER_LIMITE'); ?></div>
            <div id="sharehprovider" class="row_white"></div>
        </div>
        <!--select rearrange icon for social share-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;display:<?php if (in_array($this->settings['choosehorizontalshare'], array('','0','1','6'))) {
                echo 'block';
            } else {
                echo 'none';
            } ?>;" id="lrhorizontalsharerearange">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_REARRANGE'); ?></span><br/><br/>
            <ul id="horsortable">
                <?php
                foreach ($this->settings['horizontal_rearrange'] as $horizontal_provider) {
                    ?>
                    <li title="<?php echo $horizontal_provider ?>"
                        id="lrhorizontal_<?php echo strtolower($horizontal_provider); ?>"
                        class="lrshare_iconsprite32 lrshare_<?php echo strtolower($horizontal_provider); ?> dragcursor">
                        <input type="hidden" name="horizontal_rearrange[]"
                               value="<?php echo strtolower($horizontal_provider); ?>"/>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <!--select page for socialshare-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;" id="horizontalPageSelect">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_ARTICLES'); ?></span><br/><br/>
            <select id="horizontalArticles[]" name="horizontalArticles[]" multiple="multiple" style="width:400px;">
                <?php foreach ($this->rows as $row) { ?>
                    <option <?php if (!empty($this->settings['horizontalArticles'])) {
                        foreach ($this->settings['horizontalArticles'] as $key => $value) {
                            if ($row->id == $value) {
                                echo " selected=\"selected\"";
                            }
                        }
                    }?>value="<?php echo $row->id; ?>">
                        <?php echo $row->title; ?>
                    </option>
                <?php } ?>
            </select></div>
        </div>
        <div id="sharevertical" style="display:none;">
        <div style="overflow:auto; background:#FFFFFF; padding:10px;">
            <!--enable vertical share-->
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_ENABLE_VERTICAL'); ?></span><br/><br/>
            <input name="settings[sharevertical]" type="radio"  <?php echo $enableVerticalShare; ?> value="1"/> <?php echo JText::_('COM_SOCIAL_SHARE_YES'); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="settings[sharevertical]" type="radio" <?php echo $disableVerticalShare; ?> value="0"/> <?php echo JText::_('COM_SOCIAL_SHARE_NO'); ?> </div>
        <div style="overflow:auto; background:#FFFFFF; padding:10px;">
            <!--vertical socialshare theme-->
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_VERTICAL_THEMES'); ?></span><br/>
            <label for="vertibox32">
                <input name="settings[chooseverticalshare]" id="vertibox32" onclick="createVerticalShareProvider();" type="radio"  <?php echo $verticalTheme32; ?> value="0"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/32VerticlewithBox.png" ?>' style="vertical-align:top;"/>
            </label>
            <label for="vertibox16">
                <input name="settings[chooseverticalshare]" id="vertibox16" onclick="createVerticalShareProvider();" type="radio" <?php echo $verticalTheme16; ?>value="1"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/16VerticlewithBox.png" ?>' style="vertical-align:top;"/>
            </label>
            <label for="cvertibox32">
                <input name="settings[chooseverticalshare]" id="cvertibox32" onclick="createVerticalCounterProvider();" type="radio"  <?php echo $verticalCounterTheme32; ?> value="2"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/hybrid-verticle-horizontal.png" ?>' style="vertical-align:top;"/>
            </label>
            <label for="cvertibox16">
                <input name="settings[chooseverticalshare]" id="cvertibox16" onclick="createVerticalCounterProvider();" type="radio" <?php echo $verticalCounterTheme16; ?> value="3"/>
                <img src='<?php echo "components/com_simplifiedsocialshare/assets/img/hybrid-verticle-vertical.png" ?>' style="vertical-align:top;"/>
            </label>
        </div>

        <!--position for social share for vertical inter face-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;">
            <p style="margin:0 0 6px 0; padding:0px;"><span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_THEME_POSITION'); ?></span></p>
            <input name="settings[verticalsharepos]" id="topleft" type="radio" <?php echo $topLeft; ?>value="0"/> <?php echo JText::_('COM_SOCIAL_SHARE_THEME_POSITION_TOPL'); ?><br/>
            <input name="settings[verticalsharepos]" id="topright" type="radio" <?php echo $topRight; ?>value="1"/> <?php echo JText::_('COM_SOCIAL_SHARE_THEME_POSITION_TOPR'); ?> <br/>
            <input name="settings[verticalsharepos]" id="bottomleft" type="radio" <?php echo $bottomLeft; ?>value="2"/> <?php echo JText::_('COM_SOCIAL_SHARE_THEME_POSITION_BOTTOML'); ?><br/>
            <input name="settings[verticalsharepos]" id="bottomright" type="radio" <?php echo $bottomRight; ?>value="3"/> <?php echo JText::_('COM_SOCIAL_SHARE_THEME_POSITION_BOTTOMR'); ?><br/>
        </div>
        <!--select socialshare checkboxed for vertical interface-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;display:<?php if ($this->settings['chooseverticalshare'] == '2' || $this->settings['chooseverticalshare'] == '3') {
                echo 'block';
            } else {
                echo 'none';
            } ?>;" id="lrverticalcounterprovider">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_NETWORKS'); ?></span><br/><br/>
            <div id="countervprovider" class="row_white"></div>
        </div>

        <!--social share for vertical interface-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;display:<?php if ($this->settings['chooseverticalshare'] == '' || $this->settings['chooseverticalshare'] == '0' || $this->settings['chooseverticalshare'] == '1') {
                echo 'block';
            } else {
                echo 'none';
            } ?>;" id="lrverticalshareprovider">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_NETWORKS'); ?></span><br/><br/>
            <div id="loginRadiusVerticalSharingLimit" style="color: red; display: none; margin-bottom: 5px;"><?php echo JTEXT::_('COM_SOCIAL_SHARE_PROVIDER_LIMITE'); ?></div>
            <div id="sharevprovider" class="row_white"></div>
        </div>
        <!--socialshare rearrange for vertical-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;display:<?php if ($this->settings['chooseverticalshare'] == '' || $this->settings['chooseverticalshare'] == '0' || $this->settings['chooseverticalshare'] == '1') {
                echo 'block';
            } else {
                echo 'none';
            } ?>;" id="lrverticalsharerearange">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_REARRANGE'); ?></span><br/><br/>
            <ul id="versortable">
                <?php foreach ($this->settings['vertical_rearrange'] as $vertical_provider) {?>
                    <li title="<?php echo $vertical_provider ?>"
                        id="lrvertical_<?php echo strtolower($vertical_provider); ?>"
                        class="lrshare_iconsprite32 lrshare_<?php echo strtolower($vertical_provider); ?> dragcursor">
                        <input type="hidden" name="vertical_rearrange[]" value="<?php echo strtolower($vertical_provider); ?>"/>
                    </li>
                <?php }?>
            </ul>
        </div>
        <!-- select page for vertical share interface-->
        <div style="overflow:auto; background:#FFFFFF; padding:10px;" id="verticalPageSelect">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_ARTICLES'); ?></span><br/><br/>
            <select id="verticalArticles[]" name="verticalArticles[]" multiple="multiple" style="width:400px;">
                <?php foreach ($this->rows as $row) { ?>
                    <option <?php if (!empty($this->settings['verticalArticles'])) {
                        foreach ($this->settings['verticalArticles'] as $key => $value) {
                            if ($row->id == $value) {
                                echo " selected=\"selected\"";
                            }
                        }
                    }?>value="<?php echo $row->id; ?>">
                        <?php echo $row->title; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
    </div>
    </td>
    </tr>
</table>