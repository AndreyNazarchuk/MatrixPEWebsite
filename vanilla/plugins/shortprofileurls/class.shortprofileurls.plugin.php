<?php
/**
 * @author Lincoln Russell <lincolnwebs@gmail.com>
 * @copyright 2015 Lincoln Russell
 * @package shortprofileurls
 */

$PluginInfo['shortprofileurls'] = array(
    'Name' => 'Short Profile URLs',
    'Description' => 'Change profile URL structure to just /@name.',
    'Version' => '1.0',
    'MobileFriendly' => true,
    'Author' => "Lincoln Russell",
    'AuthorEmail' => 'lincolnwebs@gmail.com',
);

/**
 * Class ShortProfileUrlsPlugin
 */
class ShortProfileUrlsPlugin extends Gdn_Plugin {

    public function setup() {
        Gdn::router()->setRoute('^@(.*)', 'profile/$1', 'Internal');
    }

    public function onDisable() {
        Gdn::router()->deleteRoute('^@(.*)');
    }
}

if (!function_exists('userUrl')) :
/**
 * Override default userUrl().
 *
 * @param $User
 * @param string $Px
 * @param string $Method
 * @param null $Get
 * @return string
 */
function userUrl($User, $Px = '', $Method = '', $Get = null) {
    static $NameUnique = null;
    if ($NameUnique === null) {
        $NameUnique = c('Garden.Registration.NameUnique');
    }

    $UserName = val($Px.'Name', $User);
    $UserName = preg_replace('/([\?&]+)/', '', $UserName);

    $Result = '/@'. // Only line changed
        ($Method ? trim($Method, '/').'/' : '').
        ($NameUnique ? '' : val($Px.'UserID', $User, 0).'/').
        rawurlencode($UserName);

    if (!empty($Get)) {
        $Result .= '?'.http_build_query($Get);
    }

    return $Result;
}
endif;
