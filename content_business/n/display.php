<?php
if(\dash\data::displayShowPostList())
{
	$html = '';
	$html .= '<nav class="items">';
	{

	  $html .= '<ul>';
	  {

	    foreach (\dash\data::dataTable() as $key => $value)
	    {
	      $date_title = '';
	      if(a($value, 'datemodified'))
	      {
	        $date_title .= T_("Date modified"). ': '. \dash\fit::date_time(a($value, 'datemodified')). "\n";
	      }
	      if(a($value, 'publishdate'))
	      {
	        $date_title .= T_("Publish date"). ': '. \dash\fit::date_time(a($value, 'publishdate'));
	      }

	     $html .= '<li>';
	     {

		     $html .= '<a class="item f align-center" href="'.  a($value, 'link') . '">';
		     {

				if(a($value, 'thumb'))
				{
			        $html .= '<img src="'. \dash\fit::img(a($value, 'thumb')). '" alt="'. T_("Post image"). '">';
				}

		        $html .= '<div class="key">'.  a($value, 'title'). '</div>';
		        $html .= '<time class="value" datatime="'. $date_title. '">'. \dash\fit::date_time(a($value, 'datecreated')). '</time>';
		        $html .= '<div class="go '. $value['icon_list']. '"></div>';
		     }
		     $html .= '</a>';
	     }
	     $html .= '</li>';
	    } // endfi
	  }
	  $html .= '</ul>';
	}
	$html .= '</nav>';

	echo $html;

	\dash\utility\pagination::html();
}
else
{
	require_once(core. '/layout/post/layout-v2.php');
}
?>