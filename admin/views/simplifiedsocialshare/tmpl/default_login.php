<?php
defined('_JEXEC') or die ('Direct Access to this location is not allowed.');
?>
<table class="form-table social_table" id="loginradius-registration-account">
    <tr>
        <th class="head" colspan="2"><?php echo JText::_('COM_SOCIAL_SHARE_ACCOUNT_REGISTER'); ?></th>
    </tr>
    <tr>
        <td class="social_row_white">
            <div class="message-container"></div>
            <div id="registration-container"></div>
            <div id="registration_form_link">
                <a href="javascript:void(0)" onclick="accountFormToggle(&quot;login&quot;)"><?php echo JText::_('COM_SOCIAL_SHARE_ALREADY_ACCOUNT'); ?></a>
                <br/>
                <a href="https://secure.loginradius.com/login/forgotten" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_FORGOT_ACCOUNT'); ?></a>
            </div>
        </td>
    </tr>
</table>

<table class="form-table social_table" id="loginradius-login-account" style="display: none;">
    <tr>
        <th class="head" colspan="2"><?php echo JText::_('COM_SOCIAL_SHARE_ACCOUNT_LOGIN'); ?></th>
    </tr>
    <tr>
        <td class="social_row_white">
            <div class="message-container"></div>
            <div id="login-container"></div>
            <div id="login_form_link">
                <a href="javascript:void(0)" onclick="accountFormToggle(&quot;registration&quot;)"><?php echo JText::_('COM_SOCIAL_SHARE_REGISTER_ACCOUNT'); ?></a>
                <br/>
                <a href="https://secure.loginradius.com/login/forgotten" target="_blank"><?php echo JText::_('COM_SOCIAL_SHARE_FORGOT_ACCOUNT'); ?></a>
            </div>
        </td>
    </tr>
</table>
