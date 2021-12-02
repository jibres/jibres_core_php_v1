<?php
namespace content_site\body\twitter;


class twitter1_html
{
	public static function html($_args, $_tweet)
	{
    $twTweet        = a($_tweet, 'twcontent');

    if(!$twTweet)
    {
      return '';
    }

    $darkMode       = a($_args, 'twitter_darkmode');
    $theme          = a($_args, 'twitter_theme');
    $size           = a($_args, 'twitter_size');


    $borderRadius   = a($_args, 'radius:class');

    if($twUsername = a($_tweet, 'twusername'))
    {
      $twUsername     = "@". $twUsername;
    }
    $twName         = a($_tweet, 'twname');

    $twTweetThumb     = null;

    if(a($_tweet, 'twthumb'))
    {
      $twTweetThumb     = \lib\filepath::fix(a($_tweet, 'twthumb'));
    }

    $twImage = [];
    if(is_array(a($_tweet, 'twimage')))
    {
      $twImage = $_tweet['twimage'];
    }


    $twAvatar   = \lib\filepath::fix(a($_tweet, 'twavatar'));
    $twVerified = a($_tweet, 'twverified');


    $twDetail       = a($_args, 'twitter_show_detail') !== false;

    $twStatRetweet  = floatval(a($_tweet, 'twretweetcount'));
    $twStatQuote    = floatval(a($_tweet, 'twquotecount'));
    $twStatLike     = floatval(a($_tweet, 'twlikescount'));

    $twDateTime     = a($_tweet, 'twcreatedat');
    // get theme colors
    $themeBgStyle = a($_args, 'background:style');

    $twprofileurl   = 'https://twitter.com/'. a($_tweet, 'twusername');
    $twurl          = a($_tweet, 'twurl');

    $twreplycount   = a($_tweet, 'twreplycount');


    $html = \content_site\assemble\wrench\section::element_start($_args);
    {
      $html .= \content_site\assemble\wrench\section::container($_args);
      {
        $html .= \content_site\assemble\wrench\heading::simple1($_args);

        $boxStyle = /*'background-image:'.*/ $themeBgStyle;
        $boxClass = 'max-w-prose mx-auto w-full transition relative z-0 overflow-hidden bg-blue-200 p-6 '. $borderRadius;
        if($size === 'lg')
        {
          $boxClass .= ' text-lg';
        }

        $html .= '<div class="'. $boxClass. '" style="'. $boxStyle. '">';
        {
          // background
          $cardOverlayStyle = 'z-index:-1;background:linear-gradient(-50deg,rgba(255,255,255,.5),rgba(255,255,255,.95) 80%);';
          if($darkMode)
          {
            $cardOverlayStyle = 'z-index:-1;background:linear-gradient(-50deg,rgba(0,0,0,.94),rgba(0,0,0,.58) 100%);';
          }
          $cardBgClass = 'absolute inset-0 z-0 '. $borderRadius;
          $html .= '<div style="'. $cardOverlayStyle. '" class="'. $cardBgClass. '"></div>';



          // user line
          $linkTitle = T_("Twitter"). ' - '. $twName;
          $html .= '<header class="flex items-center mb-2 md:mb-4">';
          {
            if($twAvatar)
            {
              $html .= '<a rel="noopener" href="'. $twprofileurl. '" target="_blank" class="w-12 h-12" aria-label="'. $linkTitle .'">';
              {
                $html .= '<img alt="Twitter user" src="'. \dash\sample\img::blank() . '" data-src="'. $twAvatar. '" class="w-12 h-12 inline object-cover rounded-full transition" alt="'. $twName. '">';
              }
              $html .= '</a>';
            }

            $html .= '<div class="flex-grow px-2">';
            {
              // twitter display name
              $html .= '<div class="flex text-sm leading-6 font-bold">';
              {
                $html .= '<div class="whitespace-nowrap line-clamp-1">';
                {
                  $html .= '<a rel="noopener" href="'. $twprofileurl. '" target="_blank" aria-label="'. $linkTitle. '">';
                  {
                    $html .= $twName;
                  }
                  $html .= '</a>';
                }
                $html .= "</div>";
                // verify badge
                if($twVerified)
                {
                  $html .= \dash\utility\icon::bootstrap('patch-check-fill', 'self-start w-4 h-4 mx-1', ['fill' => '#1ea0f1']);
                }
              }
              $html .= "</div>";

              // twitter user name
              $html .= '<div dir="ltr" class="whitespace-nowrap line-clamp-1 text-gray-600 leading-5 text-sm txtLa">';
              {
                $html .= '<a rel="noopener" href="'. $twprofileurl. '" target="_blank" aria-label="'. $linkTitle. '">';
                {
                  $html .= $twUsername;
                }
                $html .= '</a>';
              }
              $html .= "</div>";
            }
            $html .= "</div>";

            $html .= '<a rel="noopener" href="'. $twurl. '" target="_blank" aria-label="'. $linkTitle. '">';
            {
              $html .= \dash\utility\icon::bootstrap('twitter', 'self-start w-8 h-8', ['fill' => '#1ea0f1']);
            }
            $html .= '</a>';

          }
          $html .= "</header>";

          $html .= "<div class='tweet-text text-lg leading-6 text-gray-900 mb-2 md:mb-4'>";
          {
            $html .= $twTweet;
            if($twImage)
            {
              $html .= '<div class="row">';
              {
                foreach ($twImage as $key => $value)
                {
                  $html .= '<div class="c-xs-12 c-sm-6 c-md-6">';
                  {
                    $html .= "<div class='w-full relative overflow-hidden rounded-xl mt-2 md:mt-4'>";
                    {
                      $html .= "<img src='". \lib\filepath::fix($value). "' class='w-full' alt='Twiiter'>";
                    }
                    $html .= "</div>";
                  }
                  $html .= '</div>';
                }
              }
              $html .= '</div>';
            }
            else
            {
              if($twTweetThumb)
              {
                $html .= "<div class='w-full relative overflow-hidden rounded-xl mt-2 md:mt-4'>";
                $html .= "<img src='". $twTweetThumb. "' class='w-full' alt='Twiiter'>";

                // https://pbs.twimg.com/media/FCmhwHTXIAcVqxx?format=jpg&name=small
                $html .= "</div>";
              }
            }
          }
          $html .= "</div>";

          $html .= "<footer class='text-gray-600 text-sm leading-6'>";
          {
            if($twDetail)
            {
              $html .= "<div class='flex'>";
              {
                // retweets
                if($twStatRetweet)
                {
                  $html .= "<div class='whitespace-nowrap mRa10'>";
                  {
                    $html .= "<span class='text-gray-900 font-bold mx-1'>";
                    $html .= \dash\fit::number($twStatRetweet);
                    $html .= "</span>";
                    if($twStatRetweet === 1)
                    {
                      $html .= T_("Retweet");
                    }
                    else
                    {
                      $html .= T_("Retweets");
                    }
                  }
                  $html .= "</div>";
                }

                // Quote Tweet
                if($twStatQuote)
                {
                  $html .= "<div class='whitespace-nowrap mRa10'>";
                  {
                    $html .= "<span class='text-gray-900 font-bold mx-1'>";
                    $html .= \dash\fit::number($twStatQuote);
                    $html .= "</span>";
                    $html .= T_("Quote Tweet");
                  }
                  $html .= "</div>";
                }

                // likes
                if($twStatLike)
                {
                  $html .= "<div class='whitespace-nowrap'>";
                  {
                    $html .= "<span class='text-gray-900 font-bold mx-1'>";
                    $html .= \dash\fit::number($twStatLike);
                    $html .= "</span>";
                    if($twStatLike === 1)
                    {
                      $html .= T_("Like");
                    }
                    else
                    {
                      $html .= T_("Likes");
                    }
                  }
                  $html .= "</div>";
                }

                if($twDateTime)
                {
                  $html .= "<time class='flex-grow txtRa whitespace-nowrap' datetime='". $twDateTime. "'>";
                  // $html .= "11:31 AM · 27 Nov, 2021";
                  if(\dash\language::dir() === 'rtl')
                  {
                    $html .= \dash\fit::date_time($twDateTime, 'G:i · j F Y');
                  }
                  else
                  {
                    $html .= \dash\fit::date_time($twDateTime, 'g:i A · M j, Y');
                  }
                  $html .= "</time>";
                }

              }
              $html .= "</div>";
            }
          }
          $html .= "</footer>";
        }
        $html .= "</div>";
      }
      $html .= "</div>";
    }
    $html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>