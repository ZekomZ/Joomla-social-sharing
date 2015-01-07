<?php
defined('_JEXEC') or die ('Direct Access to this location is not allowed.');
jimport('joomla.application.component.modellist');
/**
 * Class SimplifiedSocialShareModelSimplifiedSocialShare
 */

class SimplifiedSocialShareModelSimplifiedSocialShare extends JModelList
{
    /**
     * @return string
     */
    public function saveSettings()
    {
        //Get database handle
        $db = $this->getDbo();

        $shareProvider = array("facebook", "twitter", "pinterest", "googleplus", "linkedin");
        $counterProvider = array("Facebook Like", "Twitter Tweet", "Google+ Share", "LinkedIn Share");

        //Read Settings
        $settings = JRequest::getVar('settings');
        $settings['apikey'] = isset($settings['apikey']) ? trim($settings['apikey']) : '';
        $settings['horizontalArticles'] = (sizeof(JRequest::getVar('horizontalArticles')) > 0 ? serialize(JRequest::getVar('horizontalArticles')) : "");
        $settings['verticalArticles'] = (sizeof(JRequest::getVar('verticalArticles')) > 0 ? serialize(JRequest::getVar('verticalArticles')) : "");
        $settings['horizontal_rearrange'] = (sizeof(JRequest::getVar('horizontal_rearrange')) > 0 ? serialize(JRequest::getVar('horizontal_rearrange')) : serialize($shareProvider));
        $settings['vertical_rearrange'] = (sizeof(JRequest::getVar('vertical_rearrange')) > 0 ? serialize(JRequest::getVar('vertical_rearrange')) : serialize($shareProvider));
        $settings['horizontalcounter'] = (sizeof(JRequest::getVar('horizontalcounter')) > 0 ? serialize(JRequest::getVar('horizontalcounter')) : serialize($counterProvider));
        $settings['verticalcounter'] = (sizeof(JRequest::getVar('verticalcounter')) > 0 ? serialize(JRequest::getVar('verticalcounter')) : serialize($counterProvider));

        if (!isset($settings['choosehorizontalshare'])) {
            $settings['shareontoppos'] = '1';
            $settings['shareonbottompos'] = '1';
        }

        $sql = "DELETE FROM #__loginradius_share_settings";
        $db->setQuery($sql);
        $db->query();

        $settings['horizontalScript'] = json_encode($this->horizontalShare($settings));
        $settings['verticalScript'] = json_encode($this->verticalShare($settings));

        //Insert new settings
        foreach ($settings as $k => $v) {
            $sql = "INSERT INTO #__loginradius_share_settings ( setting, value )" . " VALUES ( " . $db->Quote($k) . ", " . $db->Quote($v) . " );";
            $db->setQuery($sql);
            $db->query();
        }
        $result['status'] = "message";
        $result['message'] = JText::_('COM_SOCIAL_SHARE_SETTING_SAVED');
        return $result;
    }

    /**
     * @return array
     */
    public function getSettings()
    {
        $settings = array();

        $db = $this->getDbo();

        $db->setQuery("CREATE TABLE IF NOT EXISTS #__loginradius_share_settings (
						`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
						`setting` varchar(255) NOT NULL,
						`value` text NOT NULL,
						PRIMARY KEY (`id`),
						UNIQUE KEY `setting` (`setting`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
        $db->setQuery("SELECT * FROM #__loginradius_share_settings");
        $rows = $db->LoadAssocList();

        if (is_array($rows)) {
            foreach ($rows AS $key => $data) {
                $settings [$data['setting']] = $data ['value'];
            }
        }
        
        if (!isset($settings['choosehorizontalshare'])) {
            $settings['shareontoppos'] = '1';
            $settings['shareonbottompos'] = '1';
        }

        return $settings;
    }

    /**
     * @param $lr_settings
     * @return string
     */
    private function horizontalShare($lr_settings)
    {
        switch ($lr_settings['choosehorizontalshare']) {
            case 0:
                $size = '32';
                $interface = 'horizontal';
                break;
            case 1:
                $size = '16';
                $interface = 'horizontal';
                break;
            case 6:
                $size = '32';
                $interface = 'responsive';
                break;
            case 2:
                $size = '32';
                $interface = 'simpleimage';
                break;
            case 3:
                $size = '16';
                $interface = 'simpleimage';
                break;
            case 4:
                $ishorizontal = 'true';
                $interface = 'horizontal';
                break;
            case 5:
                $ishorizontal = 'true';
                $interface = 'vertical';
                break;
        }

        if (isset($size) && !empty($size)) {
            $sharescript = 'LoginRadius.util.ready(function () {$i = $SS.Interface.' . $interface . '; $SS.Providers.Top = ' . json_encode(@unserialize($lr_settings['horizontal_rearrange'])) . '; $u = LoginRadius.user_settings; $u.sharecounttype = \'url\';';
            if(isset($lr_settings['apikey']) && !empty($lr_settings['apikey'])){
                $sharescript .= '$u.apikey = "' . $lr_settings['apikey'] . '";';
            }
            $sharescript .= '$i.size = ' . $size . ';$i.show("lrsharecontainer"); });';
        } else if (isset($ishorizontal) && !empty($ishorizontal)) {
            $sharescript = 'LoginRadius.util.ready(function () { $SC.Providers.Selected = ' . json_encode(@unserialize($lr_settings['horizontalcounter'])) . '; $S = $SC.Interface.simple; $S.isHorizontal = ' . $ishorizontal . '; $S.countertype = "' . $interface . '"; $S.show("lrsharecontainer"); });';
        }
        return 'if(typeof LoginRadius != "undefined"){' . $sharescript . '}';
    }

    /**
     * @param $lr_settings
     * @return string
     */
    private function verticalShare($lr_settings)
    {
        if (isset($lr_settings['chooseverticalshare'])) {
            switch ($lr_settings['chooseverticalshare']) {
                case 0:
                    $size = '32';
                    $vinterface = 'Simplefloat';
                    break;
                case 1:
                    $size = '16';
                    $vinterface = 'Simplefloat';
                    break;
                case 2:
                    $isvertical = 'false';
                    $vinterface = 'horizontal';
                    break;
                case 3:
                    $isvertical = 'false';
                    $vinterface = 'vertical';
                    break;
            }

            switch ($lr_settings['verticalsharepos']) {
                case 0:
                    $vershretop = '0px';
                    $vershreright = '';
                    $vershrebottom = '';
                    $vershreleft = '0px';
                    break;
                case 1:
                    $vershretop = '0px';
                    $vershreright = '0px';
                    $vershrebottom = '';
                    $vershreleft = '';
                    break;
                case 2:
                    $vershretop = '0px';
                    $vershreright = '';
                    $vershrebottom = '0px';
                    $vershreleft = '0px';
                    break;
                case 3:
                    $vershretop = '0px';
                    $vershreright = '0px';
                    $vershrebottom = '0px';
                    $vershreleft = '';
                    break;
                default:
                    $vershretop = '0px';
                    $vershreright = '';
                    $vershrebottom = '';
                    $vershreleft = '';
                    break;
            }
            if (isset($size) && !empty($size)) {
                $vsharescript = 'LoginRadius.util.ready(function () {$i = $SS.Interface.' . $vinterface . '; $SS.Providers.Top = ' . json_encode(@unserialize($lr_settings['vertical_rearrange'])) . '; $u = LoginRadius.user_settings;';
                if(isset($lr_settings['apikey']) && !empty($lr_settings['apikey'])){
                    $vsharescript .= '$u.apikey = "' . $lr_settings['apikey'] . '";';
                }
                $vsharescript .= '$i.size = ' . $size . ';$i.left = "' . $vershreleft . '"; $i.top = "' . $vershretop . '";$i.right = "' . $vershreright . '";$i.bottom = "' . $vershrebottom . '"; $i.show("lrverticalsharecontainer"); });';
            } else if (isset($isvertical) && !empty($isvertical)) {
                $vsharescript = 'LoginRadius.util.ready(function () { $SC.Providers.Selected = ' . json_encode(@unserialize($lr_settings['verticalcounter'])) . '; $S = $SC.Interface.simple; $S.isHorizontal = ' . $isvertical . '; $S.countertype = "' . $vinterface . '"; $S.left = "' . $vershreleft . '"; $S.top = "' . $vershretop . '";$S.right = "' . $vershreright . '";$S.bottom = "' . $vershrebottom . '"; $S.show("lrverticalsharecontainer"); });';
            }
            return 'if(typeof LoginRadius != "undefined"){' . $vsharescript . '}';
        }
    }
}