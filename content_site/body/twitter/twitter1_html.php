<?php
namespace content_site\body\twitter;


class twitter1_html
{
	public static function html($_args, $_blogList)
	{
    // declare vaeiables
    $borderRadius   = a($_args, 'radius:class');
    $darkMode       = true;
    $theme          = 1;
    // get theme colors
    $sectionBgStyle = self::themeColor($theme, 'section');
    $cardBgStyle    = self::themeColor($theme, 'card');



    $html = \content_site\assemble\wrench\section::element_start($_args);
    {
      $html .= \content_site\assemble\wrench\section::container($_args);
      {
        $html .= \content_site\assemble\wrench\heading::simple1($_args);

        $boxClass     = 'max-w-xl mx-auto w-full transition relative z-0 overflow-hidden bg-red-200 py-4 h-40 '. $borderRadius;


        $html .= '<div class="'. $boxClass. '">';
        {
          // background
          $cardOverlayStyle = 'z-index:-1;background:linear-gradient(-50deg,rgba(255,255,255,.5),rgba(255,255,255,.95) 80%);';
          if($darkMode)
          {
            $cardOverlayStyle = 'z-index:-1;background:linear-gradient(-50deg,rgba(0,0,0,.94),rgba(0,0,0,.58) 100%);';
          }
          $cardBgClass = 'absolute inset-0 z-0 '. $borderRadius;
          $html .= '<div style="'. $cardOverlayStyle. '" class="'. $cardBgClass. '"></div>';

          $html .= "hi";

        }
        $html .= "</div>";
      }
      $html .= "</div>";
    }
    $html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}
}


private static function themeColor($_theme, $request = null)
{
  $bg
  [
    'section' => '',
    'card'    => '',
  ];

  switch ($_theme)
  {
    case 1:
      $bg['section'] = '';
      $bg['card']    = '';
      break;

    default:
      break;
  }


  if($request === 'section')
  {
    return $bg['section'];
  }
  if($request === 'card')
  {
    return $bg['card'];
  }
  return $bg;
}

?>