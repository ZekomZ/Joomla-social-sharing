<?php
/**
 * @package    SimplifiedSocialShare
 * @copyright  Copyright 2012 http://www.loginradius.com - All rights reserved.
 * @license    GNU/GPL 2 or later
 */
defined('_JEXEC') or die ('Direct Access to this location is not allowed.');
jimport('joomla.application.component.controller');

/**
 * Controller of SocialLogin component.
 */
class simplifiedSocialShareController extends JControllerLegacy
{
    /**
     * @param bool $cachable
     * @param bool $urlparams
     * @return JControllerLegacy|void
     */
    public function display($cachable = false, $urlparams = false)
    {
        JRequest::setVar('view', JRequest::getCmd('view', 'SimplifiedSocialShare'));
        parent::display($cachable);
    }

    /**
     * Save settings
     */
    public function apply()
    {
        $mainframe = JFactory::getApplication();
        $model = $this->getModel();
        $result = $model->saveSettings();
        $mainframe->enqueueMessage($result['message'], $result['status']);
        $this->setRedirect(JRoute::_('index.php?option=com_simplifiedsocialshare&view=simplifiedsocialshare&layout=default', false));
    }

    /**
     * Save and close settings
     */
    public function save()
    {
        $mainframe = JFactory::getApplication();
        $model = & $this->getModel();
        $result = $model->saveSettings();
        $mainframe->enqueueMessage($result['message'], $result['status']);
        $this->setRedirect(JRoute::_('index.php', false));
    }

    /**
     * cancel settings
     */
    public function cancel()
    {
        $this->setRedirect(JRoute::_('index.php', false));
    }
}
