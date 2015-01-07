<?php
defined('_JEXEC') or die ('Restricted access');
jimport('joomla.application.component.view');

/**
 * Class SimplifiedSocialShareViewSimplifiedSocialShare
 */
class SimplifiedSocialShareViewSimplifiedSocialShare extends JViewLegacy
{
    public $settings;

    /**
     * SocialLogin - Display administration area
     */
    public function display($tpl = null)
    {
        $version = '3';
        if (JVERSION < 3) {
            $version = '2';
        }
        $document = JFactory::getDocument();
        $document->addStyleSheet('components/com_simplifiedsocialshare/assets/css/simplifiedsocialshare' . $version . '.css');
        $document->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
        $document->addScript('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js');
        $model = $this->getModel();
        $this->settings = $this->initialSetting($model);
        
        $document->addScriptDeclaration('$(function(){$("#horsortable").sortable({revert: true});});');
        $document->addScriptDeclaration('$(function(){$("#versortable").sortable({revert: true});});');
        $document->addScript('components/com_simplifiedsocialshare/assets/simplifiedsocialshare.php?url=' . urlencode(json_encode($this->settings['horizontal_rearrange']) . '/' . json_encode($this->settings['vertical_rearrange']) . '/' . json_encode($this->settings['horizontalcounter']) . '/' . json_encode($this->settings['verticalcounter'])));
        $document->addScript(JURI::root().'plugins/content/simplifiedsocialshare/simplifiedsocialshare.js');
        
        $this->rows = $this->selectArticles();
        $this->form = $this->get('Form');
        $this->addToolbar();
        parent::display($tpl);
    }

    /**
     * @return mixed
     */
    private function selectArticles()
    {
        $db = JFactory::getDBO();
        $query = "SELECT id, title FROM #__content WHERE state = '1' ORDER BY ordering";
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        return $rows;
    }

    /**
     * @param $model
     * @return mixed
     */
    private function initialSetting($model)
    {
        $shareProvider = array("facebook", "twitter", "pinterest", "googleplus", "linkedin");
        $counterProvider = array("Facebook Like", "Twitter Tweet", "Google+ Share", "LinkedIn Share");
        $settings = $model->getSettings();
        $settings['apikey'] = (isset($settings['apikey']) ? trim($settings['apikey']) : "");
        $settings['horizontal_rearrange'] = (!empty($settings['horizontal_rearrange']) ? (@unserialize($settings['horizontal_rearrange'])) : $shareProvider);
        $settings['vertical_rearrange'] = (!empty($settings['vertical_rearrange']) ? (@unserialize($settings['vertical_rearrange'])) : $shareProvider);
        $settings['horizontalcounter'] = (!empty($settings['horizontalcounter']) ? (@unserialize($settings['horizontalcounter'])) : $counterProvider);
        $settings['verticalcounter'] = (!empty($settings['verticalcounter']) ? (@unserialize($settings['verticalcounter'])) : $counterProvider);
        $settings['sharehorizontal'] = (isset($settings['sharehorizontal']) ? $settings['sharehorizontal'] : "");
        $settings['choosehorizontalshare'] = (isset($settings['choosehorizontalshare']) ? $settings['choosehorizontalshare'] : "");
        $settings['chooseverticalshare'] = (isset($settings['chooseverticalshare']) ? $settings['chooseverticalshare'] : "");
        $settings['shareontoppos'] = isset($settings['shareontoppos']) == '1' ? 'checked="checked"' : "";
        $settings['shareonbottompos'] = isset($settings['shareonbottompos']) == '1' ? 'checked="checked"' : "";
        $settings['sharevertical'] = (isset($settings['sharevertical']) ? $settings['sharevertical'] : "");
        $settings['verticalsharepos'] = (isset($settings['verticalsharepos']) ? $settings['verticalsharepos'] : "");
        $settings['verticalArticles'] = (isset($settings['verticalArticles']) ? @unserialize($settings['verticalArticles']) : "");
        $settings['horizontalArticles'] = (isset($settings['horizontalArticles']) ? @unserialize($settings['horizontalArticles']) : "");
        return $settings;
    }

    /**
     * SocialLogin - Add admin option on toolbar
     */
    protected function addToolbar()
    {
        JRequest::setVar('hidemainmenu', false);
        JToolBarHelper::title(JText::_('COM_SIMPLIFIEDSOCIALSHARE').' '.JText::_('Component'), 'configuration.gif');
        JToolBarHelper::apply('apply');
        JToolBarHelper::save('save', 'JTOOLBAR_SAVE');
        JToolBarHelper::cancel('cancel');
    }
}