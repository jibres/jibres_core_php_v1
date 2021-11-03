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


      $html .= '<a class="h-12 w-12 p-3 mx-1 btn-light rounded-lg" href="'. \dash\url::support(). '" target="_blank" title="'. T_("Help Center"). '">';
      $html .= \dash\utility\icon::svg('Question Mark Inverse');
      $html .= '</a>';

      $html .= '<a class="h-12 w-12 p-3 mx-1 btn-light rounded-lg" href="'. \dash\url::sitelang(). '/account/notification" title="'. \dash\user::detail('displayname'). '">';
      $html .= \dash\utility\icon::svg('Notification');
      $html .= '</a>';

      $html .= '<a class="h-12 w-12 p-1 mx-1 btn-light rounded-lg" href="'. \dash\url::kingdom(). '/account">';
      // $html .= '<img class="" href="'. \dash\fit::img(\dash\user::detail('avatar')). '" title="'. T_("Avatar of you"). '">';
      $html .= '<img class="" href="'. \dash\face::logo(). '" title="'. T_("Avatar of you"). '">';
      $html .= '</a>';

    }
    $html .= '</div>';




    return $html;
  }
}
?>