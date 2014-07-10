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

        $result = $this->saveConfiguration($settings);

        if ($result['status'] == 'message') {
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
        }

        if (!isset($settings['choosehorizontalshare'])) {
            $result['status'] = 'notice';
            $result['message'] = JText::_('COM_SOCIAL_SHARE_SETTING_NOTICE');
        }

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
            $sharescript = 'LoginRadius.util.ready(function () {$i = $SS.Interface.' . $interface . '; $SS.Providers.Top = ' . json_encode(@unserialize($lr_settings['horizontal_rearrange'])) . '; $u = LoginRadius.user_settings; $u.sharecounttype = \'url\'; $u.apikey = "' . $lr_settings['apikey'] . '"; $i.size = ' . $size . ';$i.show("lrsharecontainer"); });';
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
                $vsharescript = 'LoginRadius.util.ready(function () {$i = $SS.Interface.' . $vinterface . '; $SS.Providers.Top = ' . json_encode(@unserialize($lr_settings['vertical_rearrange'])) . '; $u = LoginRadius.user_settings; $u.apikey = "' . $lr_settings['apikey'] . '"; $i.size = ' . $size . ';$i.left = "' . $vershreleft . '"; $i.top = "' . $vershretop . '";$i.right = "' . $vershreright . '";$i.bottom = "' . $vershrebottom . '"; $i.show("lrverticalsharecontainer"); });';
            } else if (isset($isvertical) && !empty($isvertical)) {
                $vsharescript = 'LoginRadius.util.ready(function () { $SC.Providers.Selected = ' . json_encode(@unserialize($lr_settings['verticalcounter'])) . '; $S = $SC.Interface.simple; $S.isHorizontal = ' . $isvertical . '; $S.countertype = "' . $vinterface . '"; $S.left = "' . $vershreleft . '"; $S.top = "' . $vershretop . '";$S.right = "' . $vershreright . '";$S.bottom = "' . $vershrebottom . '"; $S.show("lrverticalsharecontainer"); });';
            }
            return 'if(typeof LoginRadius != "undefined"){' . $vsharescript . '}';
        }
    }

    /**
     * check server connection method
     */
    private function getAPIMethod()
    {
        if (function_exists('curl_version')) {
            return '1';
        }
        return '0';
    }

    /**
     * @param $lr_settings
     */
    private function saveConfiguration($lr_settings)
    {
        if (empty($lr_settings['apikey'])) {
            $db = $this->getDbo();

            $sql = "DELETE FROM #__loginradius_share_settings";
            $db->setQuery($sql);
            $db->query();
        } else if (!$this->isValidApiSettings($lr_settings['apikey'])) {
            $results['status'] = "error";
            $results['message'] = JText::_('COM_SOCIAL_SHARE_ADVANCE_MESSAGE_APIKEY');
        } else {
            $result = $this->saveapisetting($lr_settings);
            $results = $this->loginRadiusApiClient($result['url'], http_build_query($result['data']));
        }
        return $results;
    }

    /**
     * Check apikey and secret is valid.
     */
    private function isValidApiSettings($apikey)
    {
        return preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/i', $apikey);
    }

    /**
     * @param $settings
     */
    private function saveApiSetting($settings)
    {
        $result['url'] = 'http://api.loginradius.com/api/v2/app/validatekey?apikey=' . $settings['apikey'];

        $string = "~1#";
        foreach ($settings as $k => $v) {
            if (in_array($k, array("apikey", "apisecret"))) {
            } elseif (is_numeric($v)) {
                $string .= '|' . $v;
            } elseif (@unserialize($v)) {
                $string .= '|' . json_encode(@unserialize($v));
            } elseif (is_string($v)) {
                $string .= '|"' . $v . '"';
            }
        }

        $result['data'] = array(
            'addon' => 'Joomla Simplified Social Share',
            'version' => '3.8',
            'agentstring' => $_SERVER["HTTP_USER_AGENT"],
            'clientip' => $_SERVER["REMOTE_ADDR"],
            'configuration' => $string
        );

        return $result;
    }


    /**
     * @param $ValidateUrl
     * @return mixed|string
     */
    private function loginRadiusApiClient($ValidateUrl, $data)
    {
        if ($this->getAPIMethod()) {
            $response = $this->curlApiMethod($ValidateUrl, $data);
        } else {
            $response = $this->fsockopenApiMethod($ValidateUrl, $data);
        }
        $message = isset($response->Messages[0]) ? trim($response->Messages[0]) : '';
        $results['status'] = "message";
        $results['message'] = JText::_('COM_SOCIAL_SHARE_SETTING_SAVED');
        switch ($message) {
            case 'API_KEY_NOT_VALID':
                $results['status'] = "error";
                $results['message'] = JText::_('COM_SOCIAL_SHARE_SAVE_SETTING_ERROR_ONE') . " <a href='http://www.loginradius.com' target='_blank'>LoginRadius</a>";
                break;
            case 'API_SECRET_NOT_VALID':
                $results['status'] = "error";
                $results['message'] = JText::_('COM_SOCIAL_SHARE_SAVE_SETTING_ERROR_TWO') . " <a href='http://www.loginradius.com' target='_blank'>LoginRadius</a>";
                break;
            case 'API_KEY_NOT_FORMATED':
                $results['status'] = "error";
                $results['message'] = JText::_('COM_SOCIAL_SHARE_SAVE_SETTING_ERROR_THREE');
                break;
            case 'API_SECRET_NOT_FORMATED':
                $results['status'] = "error";
                $results['message'] = JText::_('COM_SOCIAL_SHARE_SAVE_SETTING_ERROR_FOUR');
                break;
        }
        return $results;
    }

    /**
     * @param $ValidateUrl
     * @return mixed|string
     */
    private function fsockopenApiMethod($ValidateUrl, $data)
    {
        if (!empty($data)) {
            $options = array('http' =>
                array(
                    'method' => 'POST',
                    'timeout' => 15,
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $data
                )
            );
            $context = stream_context_create($options);
        } else {
            $context = NULL;
        }
        $JsonResponse = file_get_contents($ValidateUrl, false, $context);
        if (strpos(@$http_response_header[0], "400") !== false || strpos(@$http_response_header[0], "401") !== false || strpos(@$http_response_header[0], "403") !== false || strpos(@$http_response_header[0], "404") !== false || strpos(@$http_response_header[0], "500") !== false || strpos(@$http_response_header[0], "503") !== false) {
            return JTEXT::_('COM_SOCIAL_SHARE_SERVICE_TIMEOUT_ERROR');
        } else {
            return json_decode($JsonResponse);
        }
    }

    /**
     * @param $ValidateUrl
     * @return mixed|string
     */
    private function curlApiMethod($ValidateUrl, $data)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $ValidateUrl);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        if (!empty($data)) {
            curl_setopt($curl_handle, CURLOPT_POST, 1);
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        }
        if (ini_get('open_basedir') == '' && (ini_get('safe_mode') == 'Off' or !ini_get('safe_mode'))) {
            curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        } else {
            curl_setopt($curl_handle, CURLOPT_HEADER, 1);
            $url = curl_getinfo($curl_handle, CURLINFO_EFFECTIVE_URL);
            curl_close($curl_handle);
            $curl_handle = curl_init();
            $url = str_replace('?', '/?', $url);
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        }
        $JsonResponse = curl_exec($curl_handle);
        $httpCode = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        if (in_array($httpCode, array(400, 401, 403, 404, 500, 503, 0)) && $httpCode != 200) {
            return JTEXT::_('COM_SOCIAL_SHARE_SERVICE_TIMEOUT_ERROR');
        } else {
            if (curl_errno($curl_handle) == 28) {
                return JTEXT::_('COM_SOCIAL_SHARE_SERVICE_TIMEOUT_ERROR');
            }
        }
        $results = json_decode($JsonResponse);
        curl_close($curl_handle);
        return $results;

    }

    /**
     * @param $email
     * @return string
     */
    public function apiRegistration($email)
    {
        $results = 'lr1100="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_0') . '"; ';
        $results .= 'lr1101="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_1') . '"; ';
        $results .= 'lr1102="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_2') . '"; ';
        $results .= 'lr1103="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_3') . '"; ';
        $results .= 'lr1104="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_4') . '"; ';
        $results .= 'lr1105="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_5') . '"; ';
        $results .= 'lr1106="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_6') . '"; ';
        $results .= 'lr1107="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_7') . '"; ';
        $results .= 'lr1108="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_8') . '"; ';
        $results .= 'lr1109="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_9') . '"; ';
        $results .= 'lr1110="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_10') . '"; ';
        $results .= 'lr1111="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_11') . '"; ';
        $results .= 'lr1112="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_12') . '"; ';
        $results .= 'lr1113="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_13') . '"; ';
        $results .= 'lr1114="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_14') . '"; ';
        $results .= 'lr1115="' . JText::_('COM_SOCIAL_SHARE_LRSITE_MEG_15') . '"; ';
        $results .= '(function (q, r, m) {
    var s = { required: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE1') . '", matches: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE2') . '", "default": "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE3') . '", valid_email: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE4') . '", valid_emails: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE5') . '", min_length: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE6') . '", max_length: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE7') . '", exact_length: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE8') . '", greater_than: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE9') . '", less_than: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE10') . '", alpha: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE11') . '", alpha_numeric: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE12') . '", alpha_dash: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE13') . '", numeric: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE14') . '", integer: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE15') . '", decimal: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE16') . '", is_natural: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE17') . '", is_natural_no_zero: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE18') . '", valid_ip: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE19') . '", valid_base64: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE20') . '", valid_credit_card: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE21') . '", is_file_type: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE22') . '", valid_url: "' . JText::_('COM_SOCIAL_SHARE_AIA_MESSAGE23') . '" }, t = function (a) {
    }, u = /^(.+?)\[(.+)\]$/, h = /^[0-9]+$/, v = /^\-?[0-9]+$/, k = /^\-?[0-9]*\.?[0-9]+$/, p = /\w+([-+.\']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/, w = /^[a-z]+$/i, x = /^[a-z0-9]+$/i, y = /^[a-z0-9_\-]+$/i, z = /^[0-9]+$/i, A = /^[1-9][0-9]*$/i, B = /^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i, C = /[^a-zA-Z0-9\/\+=]/i, D = /^[\d\-\s]+$/, E = /^((http|https):\/\/(\w+:{0,1}\w*@)?(\S+)|)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/, e = function (a, b, c) {
        this.callback = c || t;
        this.errors = [];
        this.fields = {};
        this.form = this._formByNameOrNode(a) || {};
        this.messages = {};
        this.handlers = {};
        a = 0;
        for (c = b.length; a < c; a++) {
            var d = b[a];
            if ((d.name || d.names) && d.rules) if (d.names) for (var l = 0; l < d.names.length; l++) this._addField(d, d.names[l]); else this._addField(d, d.name)
        }
        var g = this.form.onsubmit;
        this.form.onsubmit = function (a) {
            return function (b) {
                try {
                    return a._validateForm(b) && (g === m || g())
                } catch (c) {
                }
            }
        }(this)
    }, n = function (a, b) {
    var c;
    if (0 < a.length && ("radio" === a[0].type || "checkbox" === a[0].type)) for (c = 0; c < a.length; c++) {
        if (a[c].checked) return a[c][b]
        } else return a[b]
    };
e.prototype.setMessage = function (a, b) {
    this.messages[a] = b;
        return this
    };
e.prototype.registerCallback = function (a, b) {
    a && ("string" === typeof a && b && "function" === typeof b) && (this.handlers[a] = b);
        return this
    };
e.prototype._formByNameOrNode = function (a) {
    return "object" === typeof a ? a : r.forms[a]
    };
e.prototype._addField = function (a, b) {
    this.fields[b] = { name: b, display: a.display || b, rules: a.rules, id: null, type: null, value: null, checked: null }
    };
e.prototype._validateForm = function (a) {
    this.errors = [];
    for (var b in this.fields) if (this.fields.hasOwnProperty(b)) {
        var c = this.fields[b] || {}, d = this.form[c.name];
            d && d !== m && (c.id = n(d, "id"), c.type = 0 < d.length ? d[0].type : d.type, c.value = n(d, "value"), c.checked = n(d, "checked"), this._validateField(c))
        }
        "function" === typeof this.callback && this.callback(this.errors, a);
        0 < this.errors.length && (a && a.preventDefault ? a.preventDefault() : event && (event.returnValue = !1));
        return !0
    };
e.prototype._validateField = function (a) {
    for (var b = a.rules.split("|"), c = a.rules.indexOf("required"), d = !a.value || "" === a.value || a.value === m, l = 0, g = b.length; l < g; l++) {
        var f = b[l], e = null, h = !1, k = u.exec(f);
            if (-1 !== c || -1 !== f.indexOf("!callback_") || !d) if (k && (f = k[1], e = k[2]), "!" === f.charAt(0) && (f = f.substring(1, f.length)), "function" === typeof this._hooks[f] ? this._hooks[f].apply(this, [a, e]) || (h = !0) : "callback_" === f.substring(0, 9) && (f = f.substring(9, f.length), "function" === typeof this.handlers[f] && !1 === this.handlers[f].apply(this, [a.value, e]) && (h = !0)), h) {
            b = this.messages[f] || s[f];
                c = "An error has occurred with the " + a.display + " field.";
                b && (c = b.replace("%s", a.display), e && (c = c.replace("%s", this.fields[e] ? this.fields[e].display : e)));
                this.errors.push({ id: a.id, name: a.name, message: c, rule: f });
                break
            }
        }
    };
e.prototype._hooks = { required: function (a) {
    var b = a.value;
    return "checkbox" === a.type || "radio" === a.type ? !0 === a.checked : null !== b && "" !== b
    }, "default": function (a, b) {
    return a.value !== b
    }, matches: function (a, b) {
    var c = this.form[b];
        return c ? a.value === c.value : !1
    }, valid_email: function (a) {
    return p.test(a.value)
    }, valid_emails: function (a) {
    a = a.value.split(",");
    for (var b = 0; b < a.length; b++) if (!p.test(a[b])) return !1;
        return !0
    }, min_length: function (a, b) {
    return h.test(b) ? a.value.length >= parseInt(b, 10) : !1
    }, max_length: function (a, b) {
    return h.test(b) ? a.value.length <= parseInt(b, 10) : !1
    }, exact_length: function (a, b) {
    return h.test(b) ? a.value.length === parseInt(b, 10) : !1
    }, greater_than: function (a, b) {
    return k.test(a.value) ? parseFloat(a.value) > parseFloat(b) : !1
    }, less_than: function (a, b) {
    return k.test(a.value) ? parseFloat(a.value) < parseFloat(b) : !1
    }, alpha: function (a) {
    return w.test(a.value)
    }, alpha_numeric: function (a) {
    return x.test(a.value)
    }, alpha_dash: function (a) {
    return y.test(a.value)
    }, numeric: function (a) {
    return h.test(a.value)
    }, integer: function (a) {
    return v.test(a.value)
    }, decimal: function (a) {
    return k.test(a.value)
    }, is_natural: function (a) {
    return z.test(a.value)
    }, is_natural_no_zero: function (a) {
    return A.test(a.value)
    }, valid_ip: function (a) {
    return B.test(a.value)
    }, valid_base64: function (a) {
    return C.test(a.value)
    }, valid_url: function (a) {
    return E.test(a.value)
    }, valid_credit_card: function (a) {
    if (!D.test(a.value)) return !1;
    var b = 0, c = 0, d = !1;
        a = a.value.replace(/\D/g, "");
        for (var e = a.length - 1; 0 <= e; e--) c = a.charAt(e), c = parseInt(c, 10), d && 9 < (c *= 2) && (c -= 9), b += c, d = !d;
        return 0 === b % 10
    }, is_file_type: function (a, b) {
    if ("file" !== a.type) return !0;
    var c = a.value.substr(a.value.lastIndexOf(".") + 1), d = b.split(","), e = !1, g = 0, f = d.length;
        for (g; g < f; g++) c == d[g] && (e = !0);
        return e
    } };
q.FormValidator = e
})(window, document);
$SL.util.serialize = function (form) {
    if (!form || form.nodeName !== "FORM") {
        return
    }
    var i, j, q = [];
    for (i = form.elements.length - 1; i >= 0; i = i - 1) {
        if (form.elements[i].name === "") {
            continue
        }
        switch (form.elements[i].nodeName) {
        case "INPUT":
                switch (form.elements[i].type) {
            case "text":
                    case "hidden":
                    case "password":
                    case "button":
                    case "reset":
                    case "submit":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break;
                    case "checkbox":
                    case "radio":
                        if (form.elements[i].checked) {
                    q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value))
                        }
                        break;
                    case "file":
                        break
                }
                break;
            case "TEXTAREA":
                q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                break;
            case "SELECT":
                switch (form.elements[i].type) {
            case "select-one":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break;
                    case "select-multiple":
                        for (j = form.elements[i].options.length - 1; j >= 0; j = j - 1) {
                    if (form.elements[i].options[j].selected) {
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].options[j].value))
                            }
                        }
                        break
                }
                break;
            case "BUTTON":
                switch (form.elements[i].type) {
            case "reset":
                    case "submit":
                    case "button":
                        q.push(form.elements[i].name + "=" + encodeURIComponent(form.elements[i].value));
                        break
                }
                break
        }
    }
    return q.join("&")
};
//server erro : description,errorCode,message,isProviderError,providerErrorResponse
LoginRadiusAIA = (function (lr, doc) {
    var idprefix = "loginradius-aia-";
    var classprefix = "loginradius-aia-";
    var apidomain = "https://secure.loginradius.com/";
    var lraia = {};
    var aiaOptions = {};
    //start hook model
    lraia.$hooks = {};
    lraia.$hooks.process = { startProcess: function () {
    }, endProcess: function () {
    } };
    lraia.$hooks.socialLogin = { onFormRender: function () {
    } };
    lraia.$hooks.setProcessHook = function (startProcess, endProcess) {
        lraia.$hooks.process.startProcess = startProcess;
        lraia.$hooks.process.endProcess = endProcess;
    };
    //end hook model
    //hookify jsonpCall method
    lr.util.jsonpCall = function (url, handle) {
        if (LoginRadiusAIA.$hooks.process.startProcess) {
            LoginRadiusAIA.$hooks.process.startProcess();
        }
        var func = \'Loginradius\' + Math.floor((Math.random() * 1000000000000000000) + 1);
        window[func] = function (data) {
            handle(data);
            if (LoginRadiusAIA.$hooks.process.endProcess) {
                LoginRadiusAIA.$hooks.process.endProcess();
            }
            window[func] = undefined;
            try {
                delete window[func];
            } catch (e) {
            }
        };
        var endurl = url.indexOf(\'?\') != -1 ? url + \'&callback=\' + func : url + \'?callback=\' + func;
        var js = lr.util.addJs(endurl);
    };
    function urlData(url) {
        // object for data that will be returned
        var redata = { protocol: \'\', domain: \'\', maindomain: \'\', port: 80, path: \'\', file: \'\', search: \'\', hash: \'\' };
        // creates an anchor element, and adds the url in "href" attribute
        var a_elm = document.createElement(\'a\');
        a_elm.href = url;
        // adds URL data in redata object, and returns it
        redata.protocol = a_elm.protocol.replace(\':\', \'\');
        redata.domain = a_elm.hostname.replace(\'www.\', \'\');
        var mdomain = redata.domain.split(".");
        redata.maindomain = mdomain[0];
        if (a_elm.port != \'\') redata.port = a_elm.port;
        redata.path = a_elm.pathname;
        if (a_elm.pathname.match(/[^\/]+[\.][a-z0-9]+$/i) != null) redata.file = a_elm.pathname.match(/[^\/]+[\.][a-z0-9]+$/i);
        redata.search = a_elm.search.replace(\'?\', \'\');
        redata.hash = a_elm.hash.replace(\'#\', \'\');
        return redata;
    }
    function isValidDate(dateString) {
        // First check for the pattern
        if (!/^\d{2}\/\d{2}\/\d{4}$/.test(dateString))
            return false;
        // Parse the date parts to integers
        var parts = dateString.split("/");
        var day = parseInt(parts[1], 10);
        var month = parseInt(parts[0], 10);
        var year = parseInt(parts[2], 10);
        // Check the ranges of month and year
        if (year < 1000 || year > 3000 || month == 0 || month > 12)
            return false;
        var monthLength = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        // Adjust for leap years
        if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
            monthLength[1] = 29;
        // Check the range of the day
        return day > 0 && day <= monthLength[month - 1];
    };
    function loginRadiusErrorToJsError(lrerror) {
        var jserror = [];
        jserror.push(lrerror);
        return jserror;
    }
    function createForm(schema, name, containerId, buttonName, onSuccess, onError) {
        if (schema.length > 0) {
            var validationSchema = [];
            var form = doc.createElement(\'form\');
            form.setAttribute("name", name);
            form.setAttribute("method", "POST");
            for (var i = 0; i < schema.length; i++) {
                if (schema[i]) {
                    validationSchema[i] = {};
                    validationSchema[i].name = schema[i].name;
                    validationSchema[i].display = schema[i].display;
                    validationSchema[i].rules = schema[i].rules;
                    var elem;
                    switch (schema[i].type) {
                    case \'text\':
                        {
                            elem = doc.createElement(\'textarea\');
                            break;
                        }
                        case \'html\':
                        {
                            elem = doc.createElement(\'div\');
                            break;
                        }
                        case \'captcha\':
                        {
                            elem = doc.createElement(\'div\');
                            break;
                        }
                        case \'password\':
                        {
                            elem = doc.createElement(\'input\');
                            elem.type = "password";
                            break;
                        }
                        case \'hidden\':
                        {
                            elem = doc.createElement(\'input\');
                            elem.type = "hidden";
                            elem.value = schema[i].value;
                            break;
                        }
                        case \'option\':
                        {
                            elem = doc.createElement(\'select\');
                            var selectLable = doc.createElement(\'option\');
                            selectLable.appendChild(doc.createTextNode("-- select --"));
                            selectLable.setAttribute(\'value\', \'\');
                            elem.appendChild(selectLable);
                            for (var j = 0; j < schema[i].options.length; j++) {
                            var option = doc.createElement(\'option\');
                            option.setAttribute(\'value\', schema[i].options[j].value);
                                option.appendChild(doc.createTextNode(schema[i].options[j].text));
                                elem.appendChild(option);
                            }
                            break;
                        }
                        case \'multi\':
                        {
                            elem = doc.createElement(\'input\');
                            elem.type = "checkbox";
                            break;
                        }
                        default:
                        {
                            elem = doc.createElement(\'input\');
                            elem.type = "text";
                            if (typeof schema[i].value != \'undefined\') {
                            elem.value = schema[i].value;
                                if (schema[i].name == \'emailid\' && name != \'login\') {
                                elem.disabled = true;
                            }
                            }
                            break;
                        }
                    }
                    if (schema[i].type == \'html\') {
                        var div = doc.createElement(\'div\');
                        div.setAttribute("class", classprefix + \'-form-element-content\' + \' content-\' + idprefix + schema[i].name);
                        div.innerHTML = schema[i].html;
                        form.appendChild(div);
                    } else if (schema[i].type == \'captcha\') {
                        var div = doc.createElement(\'div\');
                        div.setAttribute("class", classprefix + \'-form-element-content\' + \' content-\' + idprefix + schema[i].name);
                        div.innerHTML = schema[i].html;
                        if (aiaOptions.inFormvalidationMessage) {
                            var validationdiv = doc.createElement(\'div\');
                            validationdiv.setAttribute("id", "validation-" + idprefix + name + "-" + schema[i].name);
                            validationdiv.setAttribute("class", classprefix + "validation-message" + " validation-" + idprefix + schema[i].name);
                            div.appendChild(validationdiv);
                        }
                        form.appendChild(div);
                    }
                    else {
                        elem.setAttribute("name", schema[i].name);
                        elem.setAttribute("id", idprefix + name + "-" + schema[i].name);
                        if (schema[i].type == \'hidden\') {
                            form.appendChild(elem);
                        } else {
                            var label = doc.createElement(\'label\');
                            label.setAttribute("for", idprefix + name + "-" + schema[i].name);
                            label.innerHTML = schema[i].display;
                            elem.setAttribute("class", classprefix + schema[i].type + \' \' + idprefix + schema[i].name);
                            elem.setAttribute("placeholder",schema[i].placeholder);
                            var containerDiv = doc.createElement(\'div\');
                            containerDiv.setAttribute("class", classprefix + \'-form-element-content\' + \' content-\' + idprefix + schema[i].name);
                            containerDiv.appendChild(label);
                            containerDiv.appendChild(elem);
                            if (aiaOptions.inFormvalidationMessage) {
                                var validationdiv = doc.createElement(\'div\');
                                validationdiv.setAttribute("id", "validation-" + idprefix + name + "-" + schema[i].name);
                                validationdiv.setAttribute("class", classprefix + "validation-message" + " validation-" + idprefix + schema[i].name);
                                containerDiv.appendChild(validationdiv);
                            }
                            form.appendChild(containerDiv);
                        }
                    }
                }
            }
            var submit = doc.createElement(\'input\');
            submit.type = "submit";
            submit.value = buttonName;
            submit.id = idprefix + "submit-" + buttonName;
            submit.setAttribute("class", classprefix + "submit" + " submit-" + idprefix + buttonName + "btn btn-small");
            form.appendChild(submit);
            var containerElem = doc.getElementById(containerId);
            containerElem.innerHTML = \'\';
            containerElem.appendChild(form);
            var validator = new FormValidator(name, validationSchema, function (errors, evt) {
                var validationdivs = lr.util.elementsByClass(classprefix + "validation-message");
                for (var i = 0; i < validationdivs.length; i++) {
                    validationdivs[i].innerHTML = \'\';
                }
                if (errors.length > 0) {
                    if (aiaOptions.inFormvalidationMessage) {
                        for (var i = 0; i < errors.length; i++) {
                            doc.getElementById("validation-" + idprefix + name + "-" + errors[i].name).innerHTML = errors[i].message;
                            jQuery(".message-container").html(\'<div id="Error">\'+errors[i].message+\'</div>\');
                            return false;
                        }
                    }
                    onError(errors);
                } else {
                    onSuccess(lr.util.serialize(form));
                }
                if (evt && evt.preventDefault) {
                    evt.preventDefault();
                } else if (event) {
                    event.returnValue = false;
                }
            });
            validator.registerCallback(\'valid_date\',function (value) {
                return isValidDate(value);
            }).setMessage(\'valid_date\', \'The %s field must contain a valid date (mm/dd/yyyy).\');
        }
    }
    function login(containerId, onSuccess, onError) {
        if (typeof (aiaOptions.Emailid) != \'undefined\') {
            lraia.LoginFormSchema[0].value = aiaOptions.Emailid;
        }
        createForm(lraia.LoginFormSchema, "login", containerId, "' . JText::_('COM_SOCIAL_SHARE_AIA_LOGIN') . '", function (data) {
        lr.util.jsonpCall(apidomain + "/api/v2/user/login?" + data, function (regResponse) {
                if (regResponse.errorCode) {
                    onError(loginRadiusErrorToJsError(regResponse));
                } else {
                    onSuccess(regResponse);
                }
            });
        }, function (errors) {
            onError(errors);
        });
    };
    function registration(containerId, onSuccess, onError) {
        lr.util.addJs("http://www.google.com/recaptcha/api/js/recaptcha_ajax.js");
        if (typeof (aiaOptions.website) != "undefined") {
            lraia.RegistrationFormSchema[4].value = aiaOptions.website;
            var pathArray = aiaOptions.website.split(\'/\');
            var urlOb = urlData(aiaOptions.website);
            lraia.RegistrationFormSchema[3].value = urlOb.maindomain;
        }
        if (typeof (aiaOptions.WebTechnology) != "undefined") {
            lraia.RegistrationFormSchema[5].value = aiaOptions.WebTechnology;
        }
        if (typeof (aiaOptions.Emailid) != \'undefined\') {
            lraia.RegistrationFormSchema[0].value = aiaOptions.Emailid;
            lraia.RegistrationFormSchema[0].disabled = true;
        }
        createForm(lraia.RegistrationFormSchema, "registration", containerId, "' . JText::_('COM_SOCIAL_SHARE_AIA_REGISTER') . '", function (data) {
                lr.util.jsonpCall(apidomain + "api/v2/user/registration?" + data, function (regResponse) {
                        if (regResponse.errorCode) {
                            Recaptcha.reload();
                            onError(loginRadiusErrorToJsError(regResponse));
                        } else {
                            onSuccess(regResponse);
                        }
                    });
            }, function (errors) {
                Recaptcha.reload();
                onError(errors);
            });
        var intval = setInterval(function () {
            if (Recaptcha) {
                Recaptcha.create("6LcRA80SAAAAALXljvxXelk_pTASi0sjx8oBrL2H",
                    "loginradius-recaptcha",
                    {
                        theme: \'custom\',
                        custom_theme_widget: \'recaptcha_widget\',
                        callback: function () {
                    doc.getElementById(\'recaptcha_widget\').style.display = \'block\';
                }
                    }
                );
                clearInterval(intval);
            }
        }, 1000);
    };
    lraia.init = function (options, action, onSuccess, onError, containerId) {
        aiaOptions = options || {};
        initModuleSelector(action, containerId, onSuccess, onError);
    };
    lraia.RegistrationFormSchema = [
        {
            type: "string",
            name: "emailid",
            display: "' . JText::_('COM_SOCIAL_SHARE_AIA_EMAILID') . '",
            rules: "required|valid_email|max_length[100]",
            permission: "r",
            placeholder: "' . JText::_('COM_SOCIAL_SHARE_AIA_PLACEHOLDER_EMAIL') . '"
        },
        {
            type: "hidden",
            name: "password",
            display: "' . JText::_('COM_SOCIAL_SHARE_AIA_PASSWORD') . '",
            rules: "",
            permission: "r",
            placeholder: "' . JText::_('COM_SOCIAL_SHARE_AIA_PLACEHOLDER_PASSWORD') . '"
        },
        {
            type: "hidden",
            name: "confirmpassword",
            display: "Confirm Password",
            rules: "",
            permission: "r",
            placeholder: "' . JText::_('COM_SOCIAL_SHARE_AIA_PLACEHOLDER_PASSWORD') . '"
        },
        {
            type: "string",
            name: "appname",
            display: "' . JText::_('COM_SOCIAL_SHARE_AIA_SITE_NAME') . '",
            rules: "required|min_length[4]|max_length[25]",
            permission: "w",
            placeholder: "' . JText::_('COM_SOCIAL_SHARE_AIA_PLACEHOLDER_LRSITE') . '"
        },
        {
            type: "hidden",
            name: "domain",
            display: "Domain",
            rules: "",
            permission: "r"
        },
        {
            type: "hidden",
            name: "webtechnology",
            display: "Webtechnology",
            rules: "",
            permission: "r"
        },
        {
            type: \'captcha\',
            name: \'recaptcha_response_field\',
            html: \'<div id="recaptcha_widget" style="display:none;" class="recaptcha_widget"><div id="recaptcha_image"></div><div class="recaptcha_only_if_incorrect_sol" style="color:red">Incorrect. Please try again.</div><div class="recaptcha_input"><label class="recaptcha_only_if_image" style = "width:auto !important" for="recaptcha_response_field">' . JText::_('COM_SOCIAL_SHARE_AIA_CAPTCHA') . '</label><label class="recaptcha_only_if_audio" for="recaptcha_response_field">Enter the numbers you hear:</label><input type="text" id="recaptcha_response_field" runat="server" clientidmode="Static" name="recaptcha_response_field" /></div><ul class="recaptcha_options"><li><a href="javascript:Recaptcha.reload()"><img id="recaptcha_reload" width="25" height="17" src="http://www.google.com/recaptcha/api/img/white/refresh.gif" alt="Get a new challenge"/><span class="captcha_hide">Get another CAPTCHA</span></a></li><li class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type(&quot;audio&quot;)"><img id="Img1" width="25" height="17" alt="Get an audio challenge" src="http://www.google.com/recaptcha/api/img/white/audio.gif"></img><span class="captcha_hide"> Get an audio CAPTCHA</span></a></li><li class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type(&quot;image&quot;)"><img id="recaptcha_reload" width="25" height="17" src="http://www.google.com/recaptcha/api/img/white/text.gif" alt="Get a visual challenge"/><span class="captcha_hide"> Get an image CAPTCHA</span></a></li><li><a href="javascript:Recaptcha.showhelp()"><img id="recaptcha_whatsthis" width="25" height="17" src="http://www.google.com/recaptcha/api/img/white/help.gif" alt="Help"/><span class="captcha_hide"> Help</span></a></li></ul></div>\',
            display: "Captcha",
            rules: "required",
        }
    ];
    lraia.LoginFormSchema = [
        {
            type: "string",
            name: "emailid",
            display: "' . JText::_('COM_SOCIAL_SHARE_AIA_EMAILID') . '",
            rules: "required|valid_email|max_length[100]",
            permission: "r",
            placeholder: "' . JText::_('COM_SOCIAL_SHARE_AIA_PLACEHOLDER_EMAIL') . '"
        },
        {
            type: "password",
            name: "password",
            display: "' . JText::_('COM_SOCIAL_SHARE_AIA_PASSWORD') . '",
            rules: "required|min_length[6]|max_length[32]",
            permission: "w",
            placeholder: "' . JText::_('COM_SOCIAL_SHARE_AIA_PLACEHOLDER_PASSWORD') . '"
        }];
    function initModuleSelector(action, containerId, onSuccess, onError) {
        switch (action) {
            case \'login\':
            {
                login(containerId, onSuccess, onError);
                break;
            }
            case \'registration\':
            {
                registration(containerId, onSuccess, onError);
                break;
            }
            default:
                {
                throw new Error("This action is not valid");
                }
        }
    }
    return lraia;
})(LoginRadius_SocialLogin, document);
function getAppFromLoginRadius(appdetails, id){
    if(appdetails.length<=0){
        jQuery(".message-container").html(\'<div id="Error">' . JText::_('COM_SOCIAL_SHARE_AIA_NO_APP') . '</div>\');
        return;
    }
    var contaner = \'<tbody><tr><th colspan="2" class="head">' . JText::_('COM_SOCIAL_SHARE_SELECT_HEAD') . '</th></tr><tr class="social_row_white"><td colspan="2"><span class="social_subhead">' . JText::_('COM_SOCIAL_SHARE_SELECT_SUBHEAD') . '</span><br><br>\' +
        \'<select name="settings[apikey]"><option value="">' . JText::_('COM_SOCIAL_SHARE_SELECT_OPTION') . '</option>\';
    for(var $i=0; $i<appdetails.length; $i++){
        contaner += \'<option value="\'+appdetails[$i].apikey+\'">\'+appdetails[$i].appName+\'</option>\';
    }
    contaner += \'</select></td></tr></table>\';
    jQuery("#loginradius-"+id+"-account").html(contaner);
}
function getErrorFromLoginRadius(errors){
    if (eval(\'lr\'+errors[0].errorCode) != \'undefined\') {
        jQuery(".message-container").html(\'<div id="Error">\'+eval(\'lr\'+errors[0].errorCode)+\'</div>\');
    }else if (errors[0].message != null) {
        jQuery(".message-container").html(\'<div id="Error">\'+errors[0].message+\'</div>\');
    }
}
function accountFormToggle(action){
    jQuery("#loginradius-registration-account").hide();
    jQuery("#loginradius-login-account").hide();
    jQuery("#loginradius-"+action+"-account").show();
    jQuery(".message-container").html(\'\');
}';
        $results .= 'LoginRadiusAIA.$hooks.setProcessHook(function () {
            jQuery(".message-container").html(\'<div id="loading">' . JText::_('COM_SOCIAL_SHARE_REGISTER_LOADING') . '</div>\');
        }, function () {
        });
        $SL.util.ready(function () {
        var aiaOptions = {};
        var regorlogin;
        aiaOptions.inFormvalidationMessage = true;
        aiaOptions.website = window.location.host;
        aiaOptions.WebTechnology = "Joomla";
        aiaOptions.Emailid = "' . $email . '";
        LoginRadiusAIA.init(aiaOptions, "registration", function (response) {
            getAppFromLoginRadius(response, "registration");
        },
        function (errors) {
            getErrorFromLoginRadius(errors);
        },
       "registration-container");
        LoginRadiusAIA.init(aiaOptions, "login", function (response) {
            getAppFromLoginRadius(response, "login");
        },
        function (errors) {
            getErrorFromLoginRadius(errors);
        }, "login-container");
    });';
        return $results;
    }
}