<?php
namespace dash\layout\m2;

class header
{
  public static function html()
  {
    $html = '';

    $masterUrl  = \dash\url::kingdom();
    $targetLink = '';
    if(\dash\engine\store::inStore())
    {
      $masterUrl  = \lib\store::url();
      $targetLink = ' target="_blank"';
    }
    // btn class
    $btnClass = 'btn-light transition rounded-lg overflow-hidden h-12 flex-none flex items-center';
    $btnIconClass = 'text-gray-500';
    if(\dash\data::include_m2() === 'dark')
    {
      $btnClass = 'btn-dark transition rounded-lg overflow-hidden h-12 flex-none flex items-center';
      $btnIconClass = 'text-gray-200';
    }

    $html .= '<div class="h-full flex content-center align-center px-3">';
    {
      // logo
      $html .= '<a class="'. $btnClass. ' align-center max-w-sm overflow-hidden logo mx-1" href="'. $masterUrl. '"';
      if($targetLink)
      {
        $html .= $targetLink;
      }
      $html .= '>';
      $html .= '<img class="h-8 w-8 rounded-lg" src="'. \dash\face::logo(). '" alt="'. \dash\face::site(). '">';
      $html .= '<h1 class="pLa10 line-clamp-1">';
      $html .= \dash\face::site();
      $html .= '</h1>';
      $html .= '</a>';

      // empty
      if(\dash\data::include_m2_search())
      {
        $placeHolder = \dash\data::include_m2_searchPlaceHolder();
        if(!$placeHolder)
        {
          $placeHolder = T_("Search");
        }

        $html .= '<div class="mx-1 flex-grow flex-shrink1 search">';
        {
          $html .= '<div class="mx-auto max-w-md">';
          $html .= '<select class="select22 rounded-lg mx-auto" data-model="html" data-ajax--url="'. \dash\data::include_m2_search(). '" data-shortkey-search data-placeholder="'. $placeHolder. '"></select>';
          $html .= '</div>';
        }
        $html .= '</div>';
      }
      else
      {
        $html .= '<div class="flex-grow">';
        $html .= '</div>';
      }


      if(\dash\url::support())
      {
        $html .= '<a class="'. $btnClass. ' w-12 p-3 mx-1" href="'. \dash\url::support(). '" target="_blank" title="'. T_("Help Center"). '">';
        $html .= \dash\utility\icon::bootstrap('info-circle', $btnIconClass);
        $html .= '</a>';
      }

      if(\dash\user::id())
      {
        $in_customer_specail_domain = false;
        $account_profile_url = \dash\url::kingdom(). '/account';
        if(\dash\engine\store::inStore() && !\dash\url::store() && \dash\engine\store::enable_plugin_admin_special_domain())
        {
          $in_customer_specail_domain = true;
          $account_profile_url = \dash\url::kingdom(). '/profile/detail';
        }

        $html .= '<a class="'. $btnClass. ' w-12 p-3 mx-1 orders" href="'. \dash\url::kingdom(). '/a/order/unprocessed" title="'. T_("Unprocessed Orders"). '">';
        $html .= \dash\utility\icon::bootstrap('App indicator', $btnIconClass);
        // $html .= \dash\utility\icon::svg('First Order');
        $html .= '</a>';

        if(!$in_customer_specail_domain)
        {
          // notification
          $html .= '<a class="'. $btnClass. ' w-12 p-3 mx-1 notification" href="'. \dash\url::sitelang(). '/account/notification" title="'. T_("Notifications"). '" data-direct>';
          // $html .= \dash\utility\icon::svg('Notification');
          $html .= \dash\utility\icon::bootstrap('envelope', $btnIconClass);
          $html .= '</a>';
        }

        // avatar
        $html .= '<a class="'. $btnClass. ' w-12 p-1 mx-1 avatar" ' . $targetLink . ' href="'. $account_profile_url .'" title="'. \dash\user::detail('displayname'). '">';
        if(\dash\user::detail('avatar'))
        {
          $html .= '<img class="rounded-full" src="'. \dash\fit::img(\dash\user::detail('avatar')). '" alt="'. \dash\user::detail('displayname'). '">';
        }
        else
        {
          $html .= '<img class="rounded-full" src="'. \dash\url::cdn(). '/img/avatar/guest.png" alt="'. T_('Default Avatar'). '">';
        }
        $html .= '</a>';


      }
      else
      {
        // enter to jibres
        $html .= '<a class="'. $btnClass. ' w-12 p-3 mx-1" href="'. \dash\url::kingdom(). '/enter?referer='. urlencode(\dash\url::location()). '" title="'. T_("Enter to have better experience"). '">';
        $html .= \dash\utility\icon::svg('Circle Alert', null, '#c80a5a');
        $html .= '</a>';
      }




    }
    $html .= '</div>';




    return $html;
  }
}
?>