<?php
/* no direct access*/
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.html.parameter');

/**
 * Class plgContentSimplifiedSocialShare
 */
class plgContentSimplifiedSocialShare extends JPlugin
{
    /**
     * @param object $subject
     */
    public function __construct(&$subject)
    {
        parent::__construct($subject);

        // Loading plugin parameters
        $lr_settings = $this->getSettings();
        $document = JFactory::getDocument();

        //Properties holding plugin settings
        $this->horizontalArticles = (!empty($lr_settings['horizontalArticles']) ? @unserialize($lr_settings['horizontalArticles']) : "");
        $this->verticalArticles = (!empty($lr_settings['verticalArticles']) ? @unserialize($lr_settings['verticalArticles']) : "");
        $this->sharehorizontal = (!empty($lr_settings['sharehorizontal']) ? $lr_settings['sharehorizontal'] : "");
        $this->sharevertical = (!empty($lr_settings['sharevertical']) ? $lr_settings['sharevertical'] : "");
        $this->shareontoppos = (!empty($lr_settings['shareontoppos']) ? $lr_settings['shareontoppos'] : "");
        $this->shareonbottompos = (!empty($lr_settings['shareonbottompos']) ? $lr_settings['shareonbottompos'] : "");

        if ($this->sharehorizontal == 1) {
            $document->addScriptDeclaration(json_decode($lr_settings['horizontalScript']));
        }
        if ($this->sharevertical == 1) {
            $document->addScriptDeclaration(json_decode($lr_settings['verticalScript']));
        }
    }

    /**
     * @return array
     */
    private function getSettings()
    {
        $lr_settings = array();

        $db = JFactory::getDBO();

        $sql = "SELECT * FROM #__loginradius_share_settings";
        $db->setQuery($sql);
        $rows = $db->LoadAssocList();

        if (is_array($rows)) {
            foreach ($rows AS $key => $data) {
                $lr_settings [$data['setting']] = $data['value'];
            }
        }
        return $lr_settings;
    }

    /**
     * Before display content method
     *
     * @param $context
     * @param $article
     * @param $params
     * @param int $limitstart
     * @return string
     */
    public function onContentBeforeDisplay($context, &$article, &$params, $limitstart = 0)
    {
        $beforediv = '';
        if ($this->shareontoppos == '1' && $this->sharehorizontal == '1') {
            if (is_array($this->horizontalArticles)) {
                if (in_array($article->id, $this->horizontalArticles)) {
                    $beforediv .= $this->shareScript($article);
                }
            }
        }
        if ($this->sharevertical == '1') {
            if (is_array($this->verticalArticles)) {
                if (in_array($article->id, $this->verticalArticles)) {
                    $document = JFactory::getDocument();
                    $document->addScript(JURI::root(true).'/plugins/content/simplifiedsocialshare/simplifiedsocialshare.js');
                    $beforediv .= "<div align='left' style='padding-bottom:10px;padding-top:10px;'><div class='lrverticalsharecontainer'></div></div>";
                }
            }
        }
        return $beforediv;
    }

    /**
     * After display content method
     *
     * @param $context
     * @param $article
     * @param $params
     * @param int $limitstart
     * @return string
     */
    public function onContentAfterDisplay($context, &$article, &$params, $limitstart = 0)
    {
        $afterdiv = '';
        if ($this->shareonbottompos == '1' && $this->sharehorizontal == '1') {
            if (is_array($this->horizontalArticles)) {
                if (in_array($article->id, $this->horizontalArticles)) {
                    $afterdiv .= $this->shareScript($article);
                }
            }
        }
        return $afterdiv;
    }

    /**
     * @param $article
     * @return string
     * LoginRadius Share Script call functionality
     */
    private function shareScript($article){
        $document = JFactory::getDocument();
        if (!isset($article->language) && empty($article->language)){
            $article->language = 0;
        }
        if (!isset($article->catid) && empty($article->catid)){
            $article->catid = 0;
        }
        $document->addScript(JURI::root(true).'/plugins/content/simplifiedsocialshare/simplifiedsocialshare.js');
        $articleLink = urlencode(JURI::root() . ContentHelperRoute::getArticleRoute($article->id, $article->catid, $article->language));
        $content = "<div align='left' style='padding-bottom:10px;padding-top:10px;'><div class='lrsharecontainer' data-share-url='" . $articleLink . "'></div></div>";
        return $content;
    }
}  