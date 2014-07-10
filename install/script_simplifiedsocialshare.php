<?php
jimport('joomla.filesystem.folder');
jimport('joomla.installer.installer');
/**
 * Class com_SimplifiedSocialShareInstallerScript
 * installation
 */
class com_SimplifiedSocialShareInstallerScript
{
    /**
     * @param $type
     * @param $parent
     * @return bool
     */
    public function postflight($type, $parent)
    {
        if (!defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }

        $status = new stdClass;
        $status->plugins = array();
        $db = JFactory::getDBO();
        $src = $parent->getParent()->getPath('source');
        $manifest = $parent->getParent()->manifest;

        // Load sociallogin language file
        $lang = JFactory::getLanguage();
        $lang->load('com_simplifiedsocialshare', JPATH_SITE);
        // Installing plugins.
        $plugins = $manifest->xpath('plugins/plugin');

        foreach ($plugins AS $plugin) {
            $plg_data = array();

            foreach ($plugin->attributes() as $key => $value) {
                $plg_data[$key] = strval($value);
            }

            $path = $src . DS . 'plg_' . $plg_data['plugin'];
            $installer = new JInstaller;
            $result = $installer->install($path);

            if ($result) {
                $query = "UPDATE #__extensions SET enabled=1 WHERE type='plugin' AND element=" . $db->Quote($plg_data ['plugin']) . " AND folder=" . $db->Quote($plg_data ['group']);
                $db->setQuery($query);
                $db->execute();
            }

            // Plugin Installed
            $status->plugins[] = array('name' => $plg_data ['title'], 'group' => $plg_data ['group']);
        }

        $this->installationResults($status);
    }
    /**
     * @param $type
     */
    public function update($type)
    {
        $db = JFactory::getDBO();
    }
    /**
     * @param $status
     */
    private function installationResults($status)
    {
        $rows = 0;
        if (count($status->plugins)) {
            ?>
            <h2><?php echo JText::_('COM_SIMPLIFIEDSOCIALSHARE'); ?></h2>
            <table class="adminlist table table-striped">
                <thead>
                    <tr>
                        <th class="title" colspan="2"><?php echo JText::_('Extension'); ?></th>
                        <th><?php echo JText::_('Status'); ?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
                <tbody>
                <tr>
                    <th><?php echo JText::_('Component'); ?></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr class="row0">
                    <td class="key" colspan="2"><?php echo JText::_('COM_SIMPLIFIEDSOCIALSHARE') . ' ' . JText::_('Component'); ?></td>
                    <td style="color:#6c9c31;"><strong><?php echo JText::_('Installed'); ?></strong></td>
                </tr>
                <?php
                if (count($status->plugins)){?>
                    <tr>
                        <th><?php echo JText::_('Plugin'); ?></th>
                        <th><?php echo JText::_('Group'); ?></th>
                        <th></th>
                    </tr>
                    <?php foreach ($status->plugins as $plugin) { ?>
                        <tr class="row<?php echo(++$rows % 2); ?>">
                            <td class="key"><?php echo ucfirst($plugin['name']) . ' ' . JText::_('Plugin'); ?></td>
                            <td class="key"><?php echo ucfirst($plugin['group']); ?></td>
                            <td style="color:#6c9c31;"><strong><?php echo JText::_('Installed'); ?></strong></td>
                        </tr>
                    <?php }
                }?>
                </tbody>
            </table>

            <h2><?php echo JText::_('COM_SOCIAL_SHARE_INSTALLATION_STATUS'); ?></h2>
            <p class="nowarning">
                <?php echo JText::_('COM_SOCIAL_SHARE_INSTALLATION_THANK'); ?>
                <strong>
                    <?php echo JText::_('COM_SIMPLIFIEDSOCIALSHARE'); ?>
                </strong>!
                <?php echo JText::_('COM_SOCIAL_SHARE_INSTALLATION_CONFIG'); ?>
                <a href="index.php?option=com_simplifiedsocialshare">
                    <?php echo JText::_('COM_SIMPLIFIEDSOCIALSHARE'); ?>
                </a>
                <?php echo JText::_('COM_SOCIAL_SHARE_INSTALLATION_FREE'); ?>
                <a href="https://www.loginradius.com/loginradius/contact" target="_blank">
                    <?php echo JText::_('COM_SOCIAL_SHARE_INSTALLATION_CONTACT'); ?></a>
                <?php echo JText::_('COM_SOCIAL_SHARE_INSTALLATION_ASSIST'); ?>
                <strong><?php echo JText::_('COM_SOCIAL_SHARE_INSTALLATION_THANKYOU'); ?></strong>
            </p>
        <?php
        }
    }
}