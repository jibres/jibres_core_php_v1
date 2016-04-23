<?php
/**
 @ In the name Of Allah
 * This file has the configurations of MySQL settings and useful core settings
 */

// ** MySQL settings - You can get this info from your web host ** //
 /** The name of the database */
if(!defined('db_name'))
 define("db_name", 'jibres');

 /** MySQL database username */
if(!defined('db_user'))
 define("db_user", 'ermile');

 /** MySQL database password */
if(!defined('db_pass'))
 define("db_pass", 'Ermile@#$1233');

/**
 * For developers: Show comming soon page.
 * Default: false
 *
 * If you are developing this site enable option to redirect all request to /static/page/coming/
 * for see and work with site you can set with this address: YourSite.com?dev=yes
 * if your site is now ready for show to visitors, turn this option off
 */
define('CommingSoon', false);
?>