<?php
defined('_JEXEC') or die ('Direct Access to this location is not allowed.');
JHtml::_('behavior.tooltip');
jimport('joomla.plugin.helper');
jimport('joomla.html.html.tabs');
?>
<form action="<?php echo JRoute::_('index.php?option=com_simplifiedsocialshare&view=simplifiedsocialshare&layout=default'); ?>" method="post" name="adminForm" id="adminForm">
    <div>
        <div class="social_left_section">
            <div>
                <fieldset class="social_form social_form_main social_thanks_section">
                    <div class="social_right_box_one">
                        <h3><?php echo JText::_('COM_SOCIAL_SHARE_THANK'); ?></h3>
                    </div>
                    <div class="social_row social_thanks_subtitle">
                        <?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_PROVIDER'); ?>
                        <a href="http://ish.re/9RZM" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_SOCIALLOGIN'); ?></a>,
                        <a href="http://ish.re/9RZO" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_SOCIALSHARE'); ?></a>,
                        <a href="http://ish.re/HNIA" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_SOCIALINVITE'); ?></a>,
                        <a href="http://ish.re/83Y8" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_USERDATE'); ?></a>,
                        <a href="http://ish.re/83Y8" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_PROFILEACCESS'); ?></a>,
                        <a href="http://ish.re/9RZS" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_SIGNON'); ?></a>,
                        <a href="http://ish.re/AQ5L" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_ANALYTICS'); ?></a>
                        <?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_UNIFIED'); ?>
                    </div>
                    <div class="social_row social_thanks_subtitle">
                        <?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_TWO'); ?>
                        <a href="http://ish.re/96IF" target="_blank">Wordpress</a>,
                        <a href="http://ish.re/B46C" target="_blank">Drupal</a>,
                        <a href="http://ish.re/8PEC" target="_blank">Magento</a>,
                        <a href="http://ish.re/8PEG" target="_blank">osCommerce</a>,
                        <a href="http://ish.re/96IC" target="_blank">Zen-Cart</a>,
                        <a href="http://ish.re/8PFQ" target="_blank">X-Cart</a>,
                        <a href="http://ish.re/8PEH" target="_blank">Prestashop</a>,
                        <a href="http://ish.re/8PEE" target="_blank">VanillaForum</a>,
                        <a href="http://ish.re/8PED" target="_blank">vBulletin</a>,
                        <a href="http://ish.re/96I8" target="_blank">phpBB</a>,
                        <a href="http://ish.re/96I9" target="_blank">SMF</a>
                        <?php echo JText::_('COM_SOCIAL_SHARE_THANK_BLOCK_TWO_AND'); ?>
                        <a href="http://ish.re/96IA" target="_blank">DotNetNuke</a> !
                    </div>
                </fieldset>
            </div>

            <!-- Start simplified social share -->
            <?php
                echo $this->loadTemplate('config');
            ?>
            <!-- End simplified social share -->
        </div>

        <div class="social_right_section">
            <!-- Help Box -->
            <div class="social_right_box">
                <h3 class="social_right_box_one"><?php echo JText::_('COM_SOCIAL_SHARE_DOCUMENTS_HELP'); ?></h3>
                <ul class="help_ul">
                    <li><a href="http://ish.re/9WC3" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_DOCUMENTS_HELP_ONE'); ?></a></li>
                    <li><a href="http://ish.re/8PG2" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_DOCUMENTS_HELP_TWO'); ?></a></li>
                    <li><a href="http://ish.re/96M9" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_DOCUMENTS_HELP_THREE'); ?></a></li>
                    <li><a href="http://ish.re/AEGF" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_DOCUMENTS_HELP_FOUR'); ?></a></li>
                    <!--<li><a href="http://ish.re/BH2T" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_DOCUMENTS_HELP_FIVE'); ?></a></li>-->
                </ul>
            </div>
            <div class="social_clear"></div>
            <div class="social_right_box">
                <h3 class="social_right_box_one"><?php echo JText::_('COM_SOCIAL_SHARE_STAY_UPDATE'); ?></h3>
                <p align="justify" class="social_right_box_two"><?php echo JText::_('COM_SOCIAL_SHARE_STAY_UPDATE_ONE'); ?> </p>
                <p align="justify" class="social_right_box_two">
                    <a href="https://www.facebook.com/loginradius" target="_blank">
                        <img src="components/com_simplifiedsocialshare/assets/img/facebook.png">
                    </a>
                    <a href="https://twitter.com/LoginRadius" target="_blank">
                        <img src="components/com_simplifiedsocialshare/assets/img/twitter.png">
                    </a>
                    <a href="https://plus.google.com/+Loginradius" target="_blank">
                        <img src="components/com_simplifiedsocialshare/assets/img/google.png">
                    </a>
                    <a href="https://www.linkedin.com/company/loginradius" target="_blank">
                        <img src="components/com_simplifiedsocialshare/assets/img/linkedin.png">
                    </a>
                    <a href="https://www.youtube.com/user/LoginRadius" target="_blank">
                        <img src="components/com_simplifiedsocialshare/assets/img/youtube.png">
                    </a>
                </p>
            </div>
            <div class="social_clear"></div>
            <!-- Upgrade Box -->
            <div class="social_right_box">
                <h3 class="social_right_box_one"><?php echo JText::_('COM_SOCIAL_SHARE_SUPPORT'); ?></h3>
                <p align="justify" class="social_right_box_two">
                    <?php echo JText::_('COM_SOCIAL_SHARE_SUPPORT_ONE'); ?>
                    <a href='mailto:feedback@loginradius.com'>feedback@loginradius.com</a>!
                </p>
            </div>
        </div>
    </div>
    <input type="hidden" name="task" value=""/>
</form>