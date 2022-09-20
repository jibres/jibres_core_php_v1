<?php

$html .= '<div class="box shareBox">';
{
  $html .= '<nav class="row align-center">';
  {
    $html .= '<div class="c">';
    {
		if(\dash\data::dataRow_parent())
		{

			$html .= '<a data-copy="'. \dash\url::kingdom(). '/p/'. \dash\data::dataRow_parent(). '" href="'. \dash\url::kingdom(). '/p/'. \dash\data::dataRow_parent(). '">';
			{
				$html .= T_("Parent product id");
				$html .= ' <span class="font-bold">';
				{
					$html .= \dash\fit::text(\dash\data::dataRow_parent());
				}
				$html .= '</span>';
			}
			$html .= '</a> / ';
		}

      $html .= '<a data-copy="'. \dash\url::kingdom(). '/p/'. \dash\data::dataRow_id(). '" href="'. \dash\url::kingdom(). '/p/'. \dash\data::dataRow_id(). '">';
      {
        $html .= T_("Product Code");
        $html .= ' <span class="font-bold">';
        {
          $html .= \dash\fit::text(\dash\data::dataRow_id());
        }
        $html .= '</span>';
      }
      $html .= '</a>';

    }
    $html .= '</div>';

    $html .= '<div class="c-auto share1">';
    {
        $html .= '<a target="_blank" title="'. T_("facebook").'" href="https://www.facebook.com/sharer/sharer.php?u='. \dash\url::pwd(). '" class="facebook">';
        {
          $html .= \dash\face::site(). ' '. T_("facebook");
        }
        $html .= '</a>';

        $html .= '<a target="_blank" title="'. T_("twitter").'" href="https://twitter.com/intent/tweet?url='. urlencode(\dash\url::pwd()). '&amp;text='. urlencode(\dash\face::desc()). '" class="twitter">';
        {

          $html .= \dash\face::site(). ' '. T_("twitter");
        }
        $html .= '</a>';

        $html .= '<a target="_blank" title="'. T_("linkedin").'" href="https://www.linkedin.com/shareArticle?mini=true&amp;url='. \dash\url::pwd(). '&amp;title='. urlencode(\dash\face::title()). '&amp;summary='. urlencode(\dash\face::desc()). '" class="linkedin">';
        {
          $html .= \dash\face::site(). ' '. T_("linkedin");
        }
        $html .= '</a>';

        $html .= '<a target="_blank" title="'. T_("telegram").'" href="https://t.me/share/url?url='. \dash\url::pwd(). '&amp;text='. urlencode(\dash\face::title()). '" class="telegram">';
        {
          $html .= \dash\face::site(). ' '. T_("telegram");
        }
        $html .= '</a>';

    }
    $html .= '</div>';
  }
  $html .= '</nav>';

}
$html .= '</div>';

?>