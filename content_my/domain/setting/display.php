<?php

require_once "elements/nameservers.php";






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

if(a(\dash\data::domainDetail(), 'jibres_dns'))
{
  if(\dash\data::domainConnected() && \dash\data::domainConnectedToMyBusiness())
  {
      $result .= '<nav class="items long2">';
      $result .= '<ul>';
      $result .= '<li>';
      $result .= '<a class="f item" href="'. a(\dash\data::domainConnectedToMyBusiness(), 'detail', 'url'). '/a/setting/domain/manage?domain='. \dash\data::domainDetail_name(). '">';
      $result .= '<div class="key">'. T_("Connected to :val", ['val' => a(\dash\data::domainConnectedToMyBusiness(), 'detail', 'title')]) . '</div>';
      $result .= '<div class="value">'. T_("Manage Domain DNS record"). '</div>';
      $result .= '<div class="go"></div>';
      $result .= '</a>';
      $result .= '</li>';
      $result .= '</ul>';
      $result .= '</nav>';
    }
    else
    {
      $result .= '<nav class="items long2">';
      $result .= '<ul>';
      $result .= '<li>';
      $result .= '<a class="f item" href="'. \dash\url::that(). '/business?domain='. \dash\request::get('domain'). '">';
      $result .= '<div class="key">'. T_("Connect domain to business"). '</div>';
      $result .= '<div class="go"></div>';
      $result .= '</a>';
      $result .= '</li>';
      $result .= '</ul>';
      $result .= '</nav>';
    }


}

$result .= '<div class="row">';

$result .= '<div class="c-xs-12 c-sm-12 c-md-8">';

$result .= '<nav class="items long2">';
$result .= '<ul>';

    $result .= '<li>';
    $result .= '<a class="f item">';
    $result .= '<div class="key">'. T_("Domain"). '</div>';
    $result .= '<div class="value txtB">'. \dash\data::domainDetail_name(). '</div>';
    $result .= '<div class="go '. a(\dash\data::domainDetail(), 'status_icon').'"></div>';
    $result .= '</a>';
    $result .= '</li>';

    $result .= '<li>';
    $result .= '<a class="f item">';
    $result .= '<div class="key">'. T_("Status & Validity"). '</div>';
    $result .= '<div class="value">'. \dash\data::domainDetail_status_text(). '</div>';
    $result .= '<div class="go '.\dash\data::domainDetail_status_icon().'"></div>';
    $result .= '</a>';
    $result .= '</li>';

    if(\dash\data::domainDetail_registrar())
    {
      $result .= '<li>';
      $result .= '<a class="f item">';
      $result .= '<div class="key">'. T_("Registrar"). '</div>';
      $result .= '<div class="value">'. T_(ucfirst(\dash\data::domainDetail_registrar())). '</div>';
      $result .= '<div class="go detail"></div>';
      $result .= '</a>';
      $result .= '</li>';
    }

    if(\dash\data::domainDetail_dateregister())
    {
      $result .= '<li>';
      $result .= '<a class="f item">';
      $result .= '<div class="key">'. T_("Registered on"). '</div>';
      $result .= '<div class="value">'. \dash\fit::date(\dash\data::domainDetail_dateregister()). '</div>';
      $result .= '<div class="go detail"></div>';
      $result .= '</a>';
      $result .= '</li>';
    }

    if(\dash\data::domainDetail_dateexpire())
    {
      $result .= '<li>';
      $result .= '<a class="f item">';
      $result .= '<div class="key">'. T_("Expired on"). '</div>';
      $result .= '<div class="value txtB">'. \dash\fit::date(\dash\data::domainDetail_dateexpire()). '</div>';
      $result .= '<div class="go detail"></div>';
      $result .= '</a>';
      $result .= '</li>';
    }

    if(\dash\data::domainDetail_datemodified())
    {
      $result .= '<li>';
      $result .= '<a class="f item">';
      $result .= '<div class="key">'. T_("Last activity"). '</div>';
      $result .= '<div class="value">'. \dash\fit::date_time(\dash\data::domainDetail_datemodified()). '</div>';
      $result .= '<div class="go detail"></div>';
      $result .= '</a>';
      $result .= '</li>';
    }





$result .= '</ul>';
$result .= '</nav>';



$result .= '<nav class="items long2">';
  $result .= '<ul>';

    if(!\dash\data::internationalDomain())
    {
        $result .= '<li>';
          $result .= '<a class="f item" ';
          $go_class = 'detail';
          if(\dash\data::domainDetail_verify())
          {
            $go_class = 'go';
            $result .= 'href="'. \dash\url::that(). '/holder?domain='. \dash\request::get('domain'). '"';
          }
          $result .= '>';
          $result .= '<div class="key">'. T_("IRNIC holder"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_holder(). '</div>';
          $result .= '<div class="go '.$go_class.'"></div>';
          $result .= '</a>';
          $result .= '</li>';

          $result .= '<li>';
          $result .= '<a class="f item" ';
          if(\dash\data::domainDetail_verify())
          {
            $result .= 'href="'. \dash\url::that(). '/holder?domain='. \dash\request::get('domain'). '"';
          }
          $result .= '>';
          $result .= '<div class="key">'. T_("IRNIC admin"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_admin(). '</div>';
          $result .= '<div class="go '.$go_class.'"></div>';
          $result .= '</a>';
          $result .= '</li>';

          $result .= '<li>';
          $result .= '<a class="f item" ';
          if(\dash\data::domainDetail_verify())
          {
            $result .= 'href="'. \dash\url::that(). '/holder?domain='. \dash\request::get('domain'). '"';
          }
          $result .= '>';
          $result .= '<div class="key">'. T_("IRNIC billing"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_bill(). '</div>';
          $result .= '<div class="go '.$go_class.'"></div>';
          $result .= '</a>';
          $result .= '</li>';

          $result .= '<li>';
          $result .= '<a class="f item" ';
          if(\dash\data::domainDetail_verify())
          {
            $result .= 'href="'. \dash\url::that(). '/holder?domain='. \dash\request::get('domain'). '"';
          }
          $result .= '>';
          $result .= '<div class="key">'. T_("IRNIC technical"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_tech(). '</div>';
          $result .= '<div class="go '.$go_class.'"></div>';
          $result .= '</a>';
          $result .= '</li>';

        if(\dash\data::domainDetail_reseller())
        {
          $result .= '<li>';
          $result .= '<a class="f item">';
          $result .= '<div class="key">'. T_("Reseller"). '</div>';
          $result .= '<div class="value">'. \dash\data::domainDetail_reseller(). '</div>';
          $result .= '<div class="go detail ok"></div>';
          $result .= '</a>';
          $result .= '</li>';
        }

    }

$result .= '</ul>';
$result .= '</nav>';




  if(\dash\data::domainDetail_nicstatus_array())
  {

      $result .= '<nav class="items long2">';
      $result .= '<ul>';
      foreach (\dash\data::domainDetail_nicstatus_array() as $key => $value)
      {
         $result .= '<li>';
            $result .= '<a class="f item">';
              if(mb_strtolower($value) === 'ok')
              {
                $result .= '<div class="key">'. T_("Domain is OK"). '</div>';
              }
              else
              {
                $result .= '<div class="key">'. T_($value). '</div>';
              }
              if(\dash\language::current() === 'fa')
              {
                $result .= '<div class="value">'. $value. '</div>';
              }
              $result .= '<div class="go detail"></div>';
            $result .= '</a>';
          $result .= '</li>';
      }

      $result .= '</ul>';
      $result .= '</nav>';
  }

$result .= '</div>';

// ----------------------------------------------------------------------------------------------------------------------- side left

$result .= '<div class="c-xs-12 c-sm-12 c-md-4">';

$result .= '<nav class="items long2">';
  $result .= '<ul>';
  $result .= '<li>';
    if(\dash\data::domainDetail_autorenew())
      {
        $result .= '<a class="f item" data-confirm data-data=\'{"myaction" : "autorenew", "op" :"unset"}\'>';
        $result .= '<div class="key">'. T_("Auto renew"). ' <small class="fc-mute">'. T_("Click to deactive").'</small></div>';
        $result .= '<div class="value txtB">'. T_("Enable"). '</div>';
        $result .= '<div class="go check ok"></div>';
      }
      else
      {
        $result .= '<a class="f item" data-confirm data-data=\'{"myaction" : "autorenew", "op" :"set"}\'>';
        $result .= '<div class="key" >'. T_("Auto renew"). ' <small class="fc-mute">'. T_("Click to active").'</small></div>';
        $result .= '<div class="value txtB">'. T_("Off"). '</div>';
        $result .= '<div class="go times nok"></div>';
      }
      $result .= '</a>';
      $result .= '</li>';

    if(\dash\data::domainDetail_can_renew())
    {
      $result .= '<li>';
      $result .= '<a class="f item" href="'. \dash\url::this(). '/renew?domain='. \dash\request::get('domain').'">';
      $result .= '<div class="key">'. T_("Renew domain now"). '</div>';
      $result .= '<div class="go plus ok"></div>';
      $result .= '</a>';
      $result .= '</li>';
    }
  $result .= '</ul>';
$result .= '</nav>';


    if(\dash\data::domainDetail_verify())
    {
      $result .= '<nav class="items long2">';
      $result .= '<ul>';
      $result .= '<li>';
        $result .= '<a class="f item" ';
          if(\dash\data::domainDetail_verify())
          {
            $result .= 'href="'. \dash\url::that(). '/transfer?domain='. \dash\request::get('domain'). '"';
          }
          $result .= '>';
          $result .= '<div class="key">'. T_("Transfer lock"). '</div>';
          if(\dash\data::domainDetail_lock())
          {
            $result .= '<div class="value">'. T_("Locked"). '</div>';
            $result .= '<div class="go check ok"></div>';
          }
          elseif(\dash\data::domainDetail_lock() == '0')
          {
            $result .= '<div class="value txtB">'. T_("Unlocked"). '</div>';
            $result .= '<div class="go times nok"></div>';
          }
          else
          {
            $result .= '<div class="value">'. T_("Unknown"). '</div>';
            $result .= '<div class="go detail"></div>';
          }
        $result .= '</a>';
      $result .= '</li>';
      $result .= '</ul>';
      $result .= '</nav>';
    }


$result .= '<nav class="items long2">';
  $result .= '<ul>';
    if(\dash\data::domainDetail_verify())
    {
        $result .= '<li>';
        $result .= '<a class="f item" href="'. \dash\url::that(). '/dns?domain='. \dash\request::get('domain'). '">';
        $result .= '<div class="key">'. T_("Manage Domain DNS").'</div>';
        $result .= '<div class="go"></div>';
        $result .= '</a>';
        $result .= '</li>';
    }

  $result .= '</ul>';
$result .= '</nav>';


    if(!\dash\data::internationalDomain())
    {
       if(\dash\data::domainDetail_verify())
        {
            $result .= '<nav class="items long2">';
            $result .= '<ul>';
            $result .= '<li>';
            $result .= '<a class="f item" ';
            $result .= 'href="'. \dash\url::that(). '/holder?domain='. \dash\request::get('domain'). '">';
            $result .= '<div class="key">'. T_("Manage Domain Holder").'</div>';
            $result .= '<div class="go"></div>';
            $result .= '</a>';
            $result .= '</li>';
            $result .= '</ul>';
            $result .= '</nav>';
        }
    }


    $result .= '<nav class="items long2">';
    $result .= '<ul>';
    $result .= '<li>';
    $result .= '<a class="f item" href="'. \dash\url::that(). '/action?domain='. \dash\request::get('domain'). '">';
    $result .= '<div class="key">'. T_("Action history"). '</div>';
    $result .= '<div class="go"></div>';
    $result .= '</a>';
    $result .= '</li>';
    $result .= '</ul>';
    $result .= '</nav>';






  if(!\dash\data::domainDetail_verify())
  {
    $result .= '<nav class="items long2">';
    $result .= '<ul>';
    $result .= '<li>';
    $result .= '<a class="f item">';
    $result .= '<div class="key" data-confirm data-data=\'{"status" : "remove"}\'>'. T_("Remove this domain from your account"). '</div>';
    $result .= '<div class="go ban nok"></div>';
    $result .= '</a>';
    $result .= '</li>';
    $result .= '</ul>';
    $result .= '</nav>';
  }


  if(\dash\permission::supervisor())
  {
    $result .= '<nav class="items long2">';
    $result .= '<ul>';
    $result .= '<li>';
    $result .= '<a class="f item">';
    $result .= '<div class="key" data-confirm data-data=\'{"clean" : "lastfetch"}\'>'. T_("Last fetch"). '</div>';
    $result .= '<div class="value">'. \dash\fit::date_human(\dash\data::domainDetail_lastfetch()). '</div>';
    $result .= '<div class="go detail ok"></div>';
    $result .= '</a>';
    $result .= '</li>';
    $result .= '</ul>';
    $result .= '</nav>';
  }

  $result .= '</div>';
$result .= '</div>';


echo $result;

?>