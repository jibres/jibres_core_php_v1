<?php
namespace content_site\body\twitter;


class twitter1_html
{
	public static function html($_args, $_blogList)
	{
    // declare vaeiables
    $borderRadius   = a($_args, 'radius:class');
    $darkMode       = false;
    $theme          = 1;
    $size           = 'md';
    $twVerify       = true;
    $twUsername     = "@MrAdib";
    $twName         = "Javad Adib";
    $twTweet        = "Capture and share Twitter posts as beautiful images. Get started by pasting a tweet URL into the input above.";
    $twDetail       = true;
    // get theme colors
    $themeBgStyle = self::themeColor($theme);



    $html = \content_site\assemble\wrench\section::element_start($_args);
    {
      $html .= \content_site\assemble\wrench\section::container($_args);
      {
        $html .= \content_site\assemble\wrench\heading::simple1($_args);

        $boxStyle = 'background-image:'. $themeBgStyle;
        $boxClass = 'max-w-prose mx-auto w-full transition relative z-0 overflow-hidden bg-red-200 my-4 p-6 '. $borderRadius;
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
          $html .= '<header class="flex items-center mb-4">';
          {
            $avatarSrc = \dash\sample\img::avatar();
            $html .= '<img src="'. $avatarSrc. '" class="w-12 h-12 inline object-cover rounded-full transition">';

            $html .= '<div class="flex-grow px-2">';
            {
              // twitter display name
              $html .= '<div class="flex text-sm leading-6 font-bold">';
              {
                $html .= '<div class="whitespace-nowrap line-clamp-1">';
                $html .= $twName;
                $html .= "</div>";
                // verify badge
                $html .= \dash\utility\icon::bootstrap('patch-check-fill', 'self-start w-4 h-4 mx-1', ['fill' => '#1ea0f1']);
              }
              $html .= "</div>";

              // twitter user name
              $html .= '<div dir="ltr" class="whitespace-nowrap line-clamp-1 text-gray-500 leading-5 text-sm txtLa">';
              $html .= $twUsername;
              $html .= "</div>";
            }
            $html .= "</div>";

            $html .= \dash\utility\icon::bootstrap('twitter', 'self-start w-8 h-8', ['fill' => '#1ea0f1']);
          }
          $html .= "</header>";

          $html .= "<div class='tweet-text text-lg leading-6 text-gray-900 mb-4'>";
          {
            $html .= $twTweet;
          }
          $html .= "</div>";

          $html .= "<footer>";
          {

            if($twDetail)
            {

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


  private static function themeColor($_theme)
  {
    $bg = '';

    switch ($_theme)
    {
      case 1:
        $bg = 'linear-gradient(310deg,rgb(214,233,255),rgb(214,229,255),rgb(209,214,255),rgb(221,209,255),rgb(243,209,255),rgb(255,204,245),rgb(255,204,223),rgb(255,200,199),rgb(255,216,199),rgb(255,221,199))';
        break;

      case 2:
        $bg = 'linear-gradient(160deg,rgb(204,251,252),rgb(197,234,254),rgb(189,211,255))';
        break;

      case 3:
        $bg = 'linear-gradient(150deg,rgb(255,242,158),rgb(255,239,153),rgb(255,231,140),rgb(255,217,121),rgb(255,197,98),rgb(255,171,75),rgb(255,143,52),rgb(255,115,33),rgb(255,95,20),rgb(255,87,15))';
        break;

      case 4:
        $bg = 'linear-gradient(345deg,rgb(211,89,255),rgb(228,99,255),rgb(255,123,247),rgb(255,154,218),rgb(255,185,208),rgb(255,209,214),rgb(255,219,219))';
        break;

      case 5:
        $bg = 'linear-gradient(150deg,rgb(0,224,245),rgb(31,158,255),rgb(51,85,255))';
        break;

      case 6:
        $bg = 'linear-gradient(330deg,rgb(255,25,125),rgb(45,13,255),rgb(0,255,179))';
        break;

      case 7:
        $bg = 'linear-gradient(150deg,rgb(0,176,158),rgb(19,77,93),rgb(16,23,31))';
        break;

      case 8:
        $bg = 'linear-gradient(150deg,rgb(95,108,138),rgb(48,59,94),rgb(14,18,38))';
        break;

      default:
        break;
    }

    return $bg;
  }
}
?>