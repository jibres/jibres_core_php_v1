<?php
$result = '';
if(\dash\data::domainDetail_available() !== '0')
{
  $result .= '<div class="f justify-center fs14">';
  $result .= '<div class="c6 s12">';
  $result .= '<div class="msg info2 txtC">';
  $result .= '<p class="txtB fs12">'. \dash\data::domainDetail_name(). '</p>';
  $result .= '<p>'. T_("Domain is Available for buy"). '</p>';
  $result .= '<a class="btn success" href="'. \dash\url::this() . '/buy/'. \dash\data::domainDetail_name(). '">'. T_("Buy now"). '</a>';
  $result .= '</div>';
  $result .= '</div>';
  $result .= '</div>';
  echo $result;
  return;
}

if(\dash\data::domainDetail_needverifyemail())
{
  \dash\data::needVerifyEmail([\dash\data::domainDetail_needverifyemail()]);
  require_once(root. 'content_my/domain/need_verify_email.php');
}

require_once "elements/detail.php";
require_once "elements/nameservers.php";
if(!\dash\data::internationalDomain())
{
  require_once "elements/irnic.php";
}

require_once "elements/renew.php";
require_once "elements/lock.php";
require_once "elements/business.php";
require_once "elements/history.php";
require_once "elements/remove.php";
require_once "elements/superdetail.php";

?>