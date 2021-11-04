<?php
namespace dash\layout\panelBuilder;

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

    $html .= '<div class="h-full flex flex-wrap content-center align-center px-3">';
    {
      // logo
      $html .= '<a class="logo" href="'. $masterUrl. '"';
      if($targetLink)
      {
        $html .= $targetLink;
      }
      $html .= '>';
      $html .= '<img class="h-12 w-12 rounded-lg" src="'. \dash\face::logo(). '" alt="'. \dash\face::site(). '">';
      $html .= '</a>';

      // title
      $html .= '<h1 class="mx-2 flex-grow">';
      $html .= '<a class="cauto logo" href="'. $masterUrl. '"';
      if($targetLink)
      {
        $html .= $targetLink;
      }
      $html .= '>';
      $html .= \dash\face::site();
      $html .= '</a>';
      $html .= '</h1>';


      if(\dash\url::support())
      {
        $html .= '<a class="h-12 w-12 p-3 mx-1 btn-light transition rounded-lg" href="'. \dash\url::support(). '" target="_blank" title="'. T_("Help Center"). '">';
        $html .= \dash\utility\icon::svg('Question Mark Inverse');
        $html .= '</a>';
      }

      if(\dash\user::id())
      {
        $html .= '<a class="h-12 w-12 p-3 mx-1 btn-light transition rounded-lg" href="'. \dash\url::kingdom(). '/a/order/unprocessed" title="'. T_("Unprocessed Orders"). '">';
        $html .= \dash\utility\icon::svg('First Order');
        $html .= '</a>';

        // notification
        $html .= '<a class="h-12 w-12 p-3 mx-1 btn-light transition rounded-lg" href="'. \dash\url::sitelang(). '/account/notification" title="'. T_("Notifications"). '">';
        $html .= \dash\utility\icon::svg('Notification');
        $html .= '</a>';

        // avatar
        $html .= '<a class="h-12 w-12 p-1 mx-1 btn-light transition rounded-lg" href="'. \dash\url::kingdom(). '/account" title="'. \dash\user::detail('displayname'). '">';
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
        $html .= '<a class="h-12 w-12 p-3 mx-1 btn-light transition rounded-lg" href="'. \dash\url::kingdom(). '/enter?referer='. urlencode(\dash\url::location()). '" title="'. T_("Enter to have better experience"). '">';
        $html .= \dash\utility\icon::svg('Circle Alert', null, '#c80a5a');
        $html .= '</a>';
      }




    }
    $html .= '</div>';




    return $html;
  }
}
?>