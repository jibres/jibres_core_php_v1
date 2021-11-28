<?php
namespace content_site\assemble\wrench;


class socialnetworks
{
  public static function type1($_social, $_size = 9)
  {
    $html = '<nav class="social flex flex-row justify-center mt-5 mb-2">';
    {
      $linkClass = 'block transition opacity-60 hover:opacity-80 focus:opacity-100 p-0.5';
      $imgClass = 'block overflow-hidden rounded h-'. $_size. ' w-'. $_size;


      if(a($_social, 'linkedin', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/linkedin.svg';

        $html .= '<a class="'. $linkClass. '" target="_blank" href="'. a($_social, 'linkedin', 'link') .'">';
        $html .= '<img class="'. $imgClass. '" src="'. $imgSrc. '" alt="'. T_("linkedin"). '">';
        $html .= '</a>';
      }

      if(a($_social, 'github', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/github.svg';

        $html .= '<a class="'. $linkClass. '" target="_blank" href="'. a($_social, 'github', 'link') .'">';
        $html .= '<img class="'. $imgClass. '" src="'. $imgSrc. '" alt="'. T_("github"). '">';
        $html .= '</a>';
      }

      if(a($_social, 'facebook', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/facebook.svg';

        $html .= '<a class="'. $linkClass. '" target="_blank" href="'. a($_social, 'facebook', 'link') .'">';
        $html .= '<img class="'. $imgClass. '" src="'. $imgSrc. '" alt="'. T_("facebook"). '">';
        $html .= '</a>';
      }

      if(a($_social, 'twitter', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/twitter.svg';

        $html .= '<a class="'. $linkClass. '" target="_blank" href="'. a($_social, 'twitter', 'link') .'">';
        $html .= '<img class="'. $imgClass. '" src="'. $imgSrc. '" alt="'. T_("twitter"). '">';
        $html .= '</a>';
      }

      if(a($_social, 'email', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/email.svg';

        $html .= '<a class="'. $linkClass. '" target="_blank" href="'. a($_social, 'email', 'link') .'">';
        $html .= '<img class="'. $imgClass. '" src="'. $imgSrc. '" alt="'. T_("email"). '">';
        $html .= '</a>';
      }

      if(a($_social, 'instagram', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/instagram.svg';

        $html .= '<a class="'. $linkClass. '" target="_blank" href="'. a($_social, 'instagram', 'link') .'">';
        $html .= '<img class="'. $imgClass. '" src="'. $imgSrc. '" alt="'. T_("instagram"). '">';
        $html .= '</a>';
      }


      if(a($_social, 'telegram', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/telegram.svg';

        $html .= '<a class="'. $linkClass. '" target="_blank" href="'. a($_social, 'telegram', 'link') .'">';
        $html .= '<img class="'. $imgClass. ' rounded-full" src="'. $imgSrc. '" alt="'. T_("telegram"). '">';
        $html .= '</a>';
      }


      if(a($_social, 'whatsapp', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/whatsapp.svg';

        $html .= '<a class="'. $linkClass. '" target="_blank" href="'. a($_social, 'whatsapp', 'link') .'">';
        $html .= '<img class="'. $imgClass. '" src="'. $imgSrc. '" alt="'. T_("Whatsapp"). '">';
        $html .= '</a>';
      }

    }
    $html .= '</nav>';

    return $html;
  }


  public static function type2($_social, $_size = 9, $_arg = null)
  {
    if(!$_size)
    {
      $_size = 9;
    }
    $navClass = 'social flex';
    if(a($_arg, 'navClass'))
    {
      $navClass .= ' '. a($_arg, 'navClass');
    }

    $html = '<nav class="'. $navClass. '">';
    {
      $linkClass = 'block transition p-1 lg:mx-0.5 transition opacity-90 hover:opacity-100 focus:opacity-100';
      if(a($_arg, 'linkColor'))
      {
        $linkStyle = 'style="color:'. a($_arg, 'linkColor'). ';"';
      }
      else
      {
        $linkClass .= ' text-gray-50';
      }
      $imgClass = 'block overflow-hidden rounded h-'. $_size. ' w-'. $_size;


      $html .= self::createLink('linkedin', a($_social, 'linkedin', 'link'), $linkClass, $imgClass);
      $html .= self::createLink('github', a($_social, 'github', 'link'), $linkClass, $imgClass);
      $html .= self::createLink('facebook', a($_social, 'facebook', 'link'), $linkClass, $imgClass);
      $html .= self::createLink('twitter', a($_social, 'twitter', 'link'), $linkClass, $imgClass);
      $html .= self::createLink('instagram', a($_social, 'instagram', 'link'), $linkClass, $imgClass);
      $html .= self::createLink('telegram', a($_social, 'telegram', 'link'), $linkClass, $imgClass);

    }
    $html .= '</nav>';

    return $html;
  }


  private static function createLink($_type, $_link, $_linkClass, $_imgClass)
  {
    if(!$_linkClass)
    {
      return null;
    }

    $html = '';
    $html .= '<a rel="noopener" class="'. $_linkClass. '" target="_blank" href="'. $_link .'">';
    $html .= '<span class="hidden">'. $_type. '</span>';
    $html .= \dash\utility\icon::bootstrap($_type, $_imgClass);
    $html .= '</a>';

    return $html;
  }
}
