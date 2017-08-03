<?php
/**
 * @category    ArchApps
 * @package     ArchApps_EmailSpellCheck
 * @author      Raivis Vitols <raivis.vitols@raivis.com>
 * @license     https://opensource.org/licenses/osl-3.0.php OSL 3.0
 */

class ArchApps_EmailSpellCheck_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLED_IN_FRONT = 'archapps_emailspellcheck/general/enabled_in_front';
    const XML_PATH_ENABLED_IN_ADMIN = 'archapps_emailspellcheck/general/enabled_in_admin';
    const XML_PATH_SUGGESTION_TEXT  = 'archapps_emailspellcheck/general/suggestion_text';

    const XML_PATH_FRONT_FIELD_SELECTOR = 'archapps_emailspellcheck/general/front_field_selector';
    const XML_PATH_ADMIN_FIELD_SELECTOR = 'archapps_emailspellcheck/general/admin_field_selector';

    const XML_PATH_DOMAINS              = 'archapps_emailspellcheck/advanced/domains';
    const XML_PATH_TOP_LEVEL_DOMAINS    = 'archapps_emailspellcheck/advanced/top_level_domains';
    const XML_PATH_SECOND_LEVEL_DOMAINS = 'archapps_emailspellcheck/advanced/second_level_domains';

    /**
     * @var array Array of default second level domains that are used for email suggestions
     */
    protected $_defaultSLDomains = array('yahoo', 'hotmail', 'mail', 'live', 'outlook', 'gmx');

    /**
     * @var array Array of default domains that are used for email suggestions
     */
    protected $_defaultDomains = array(
        'msn.com', 'bellsouth.net', 'telus.net', 'comcast.net', 'optusnet.com.au', 'web.de',
        'earthlink.net', 'qq.com', 'sky.com', 'icloud.com', 'mac.com', 'sympatico.ca', 'googlemail.com', 'att.net',
        'xtra.co.nz', 'cox.net', 'gmail.com', 'ymail.com', 'aim.com', 'rogers.com', 'verizon.net', 'rocketmail.com',
        'google.com', 'optonline.net', 'sbcglobal.net', 'aol.com', 'me.com', 'btinternet.com', 'charter.net', 'shaw.ca'
    );

    /**
     * @var array Array of default top level domains that are used for email suggestions
     */
    protected $_defaultTLDomains = array(
        'com', 'com.au', 'com.tw', 'ca', 'co.nz', 'co.uk', 'de', 'fr', 'it', 'ru', 'net', 'org', 'edu', 'gov', 'jp',
        'nl', 'kr', 'se', 'eu', 'ie', 'co.il', 'us', 'at', 'be', 'dk', 'hk', 'es', 'gr', 'ch', 'no', 'cz', 'in', 'net',
        'net.au', 'info', 'biz', 'mil', 'co.jp', 'sg', 'hu'
    );

    /**
     * Whether email spell check is enabled on frontend
     *
     * @return bool
     */
    public function isEnabledInFront()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED_IN_FRONT);
    }

    /**
     * Whether email spell check is enabled on admin side
     *
     * @return bool
     */
    public function isEnabledInAdmin()
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED_IN_ADMIN);
    }

    /**
     * Returns front-end field selector specified in config
     *
     * @return mixed
     */
    public function getFrontFieldSelector()
    {
        return Mage::getStoreConfig(self::XML_PATH_FRONT_FIELD_SELECTOR);
    }

    /**
     * Returns admin field selector specified in config
     *
     * @return mixed
     */
    public function getAdminFieldSelector()
    {
        return Mage::getStoreConfig(self::XML_PATH_ADMIN_FIELD_SELECTOR);
    }

    /**
     * Returns suggestion text specified in config
     *
     * @return mixed
     */
    public function getSuggestionText()
    {
        return Mage::getStoreConfig(self::XML_PATH_SUGGESTION_TEXT);
    }

    /**
     * Returns array of domains specified in config
     *
     * @return array
     */
    public function getDomains()
    {
        $config = (string) Mage::getStoreConfig(self::XML_PATH_DOMAINS);
        $domains = explode(',', str_replace(' ', '', $config));

        return array_merge($this->_defaultDomains, $domains);
    }

    /**
     * Returns array of top level domains specified in config
     *
     * @return array
     */
    public function getTopLevelDomains()
    {
        $config = (string) Mage::getStoreConfig(self::XML_PATH_TOP_LEVEL_DOMAINS);
        $domains = explode(',', str_replace(' ', '', $config));

        return array_merge($this->_defaultTLDomains, $domains);
    }

    /**
     * Returns array of second level domains specified in config
     *
     * @return array
     */
    public function getSecondLevelDomains()
    {
        $config = (string) Mage::getStoreConfig(self::XML_PATH_SECOND_LEVEL_DOMAINS);
        $domains = explode(',', str_replace(' ', '', $config));

        return array_merge($this->_defaultSLDomains, $domains);
    }

    /**
     * Returns JSON config for initialization of spell check object in front
     *
     * @return string
     */
    public function getJsonConfig()
    {
        $config = $this->_getJsonConfig();
        $config['selector'] = $this->getFrontFieldSelector();

        return Mage::helper('core')->jsonEncode($config);
    }

    /**
     * Returns JSON config for initialization of spell check object in admin
     *
     * @return string
     */
    public function getAdminJsonConfig()
    {
        $config = $this->_getJsonConfig();
        $config['selector'] = $this->getAdminFieldSelector();

        return Mage::helper('core')->jsonEncode($config);
    }

    /**
     * Returns common JSON config for initialization of spell check object
     *
     * @return string
     */
    protected function _getJsonConfig()
    {
        return array(
            'domains' => $this->getDomains(),
            'suggestionText' => $this->getSuggestionText(),
            'topLevelDomains' => $this->getTopLevelDomains(),
            'secondLevelDomains' => $this->getSecondLevelDomains(),
        );
    }
}
