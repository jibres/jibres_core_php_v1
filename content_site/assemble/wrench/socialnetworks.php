<?php
namespace content_site\assemble\wrench;


class socialnetworks
{
  public static function type1($_social)
  {
    $html = '<nav class="social">';
    {
      if(a($_social, 'linkedin', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/linkedin.svg';

        $html .= '<a target="_blank" href="'. a($_social, 'linkedin', 'link') .'">';
        $html .= '<img class="overflow-hidden rounded-full" src="'. $imgSrc. '" alt="'. T_("linkedin"). '"';
        $html .= '</a>';
      }

      if(a($_social, 'github', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/github.svg';

        $html .= '<a target="_blank" href="'. a($_social, 'github', 'link') .'">';
        $html .= '<img class="overflow-hidden rounded-full" src="'. $imgSrc. '" alt="'. T_("github"). '"';
        $html .= '</a>';
      }

      if(a($_social, 'facebook', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/facebook.svg';

        $html .= '<a target="_blank" href="'. a($_social, 'facebook', 'link') .'">';
        $html .= '<img class="overflow-hidden rounded-full" src="'. $imgSrc. '" alt="'. T_("facebook"). '"';
        $html .= '</a>';
      }

      if(a($_social, 'twitter', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/twitter.svg';

        $html .= '<a target="_blank" href="'. a($_social, 'twitter', 'link') .'">';
        $html .= '<img class="overflow-hidden rounded-full" src="'. $imgSrc. '" alt="'. T_("twitter"). '"';
        $html .= '</a>';
      }

      if(a($_social, 'email', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/email.svg';

        $html .= '<a target="_blank" href="'. a($_social, 'email', 'link') .'">';
        $html .= '<img class="overflow-hidden rounded-full" src="'. $imgSrc. '" alt="'. T_("email"). '"';
        $html .= '</a>';
      }

      if(a($_social, 'instagram', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/instagram.svg';

        $html .= '<a target="_blank" href="'. a($_social, 'instagram', 'link') .'">';
        $html .= '<img class="overflow-hidden rounded-full" src="'. $imgSrc. '" alt="'. T_("instagram"). '"';
        $html .= '</a>';
      }


      if(a($_social, 'telegram', 'link'))
      {
        $imgSrc = \dash\url::cdn(). '/img/social/type1/telegram.svg';

        $html .= '<a target="_blank" href="'. a($_social, 'telegram', 'link') .'">';
        $html .= '<img class="overflow-hidden rounded-full" src="'. $imgSrc. '" alt="'. T_("telegram"). '"';
        $html .= '</a>';
      }

    }
    $html .= '</nav>';

    return $html;
  }
}
