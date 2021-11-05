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

    $html .= '<div class="h-full flex content-center align-center px-3">';
    {
      // logo
      $html .= '<a class="btn-light transition flex-none rounded-lg h-12 flex align-center max-w-sm overflow-hidden logo mx-1" href="'. $masterUrl. '"';
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
      $html .= '<div class="mx-1 flex-grow flex-shrink1 search">';
      {
        $html .= '<div class="mx-auto max-w-md">';
        $html .= '<select class="select22 rounded-lg mx-auto" data-model="html" data-ajax--url="'. \dash\url::here(). '/setting/search/full" data-shortkey-search data-placeholder="'. T_("Search"). '"></select>';
        $html .= '</div>';
      }
      $html .= '</div>';
      // $html .= '<div class="flex-grow">';
      // $html .= '</div>';


      if(\dash\url::support())
      {
        $html .= '<a class="flex-none h-12 w-12 p-3 mx-1 btn-light transition rounded-lg" href="'. \dash\url::support(). '" target="_blank" title="'. T_("Help Center"). '">';
        $html .= \dash\utility\icon::svg('Question Mark Inverse');
        $html .= '</a>';
      }

      if(\dash\user::id())
      {
        $html .= '<a class="flex-none h-12 w-12 p-3 mx-1 btn-light transition rounded-lg orders" href="'. \dash\url::kingdom(). '/a/order/unprocessed" title="'. T_("Unprocessed Orders"). '">';
        $html .= \dash\utility\icon::svg('First Order');
        $html .= '</a>';

        // notification
        $html .= '<a class="flex-none h-12 w-12 p-3 mx-1 btn-light transition rounded-lg notification" href="'. \dash\url::sitelang(). '/account/notification" title="'. T_("Notifications"). '" data-direct>';
        $html .= \dash\utility\icon::svg('Notification');
        $html .= '</a>';

        // avatar
        $html .= '<a class="flex-none h-12 w-12 p-1 mx-1 btn-light transition rounded-lg" href="'. \dash\url::kingdom(). '/account" title="'. \dash\user::detail('displayname'). '">';
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
        $html .= '<a class="flex-none h-12 w-12 p-3 mx-1 btn-light transition rounded-lg" href="'. \dash\url::kingdom(). '/enter?referer='. urlencode(\dash\url::location()). '" title="'. T_("Enter to have better experience"). '">';
        $html .= \dash\utility\icon::svg('Circle Alert', null, '#c80a5a');
        $html .= '</a>';
      }




    }
    $html .= '</div>';




    return $html;
  }
}
?>