<?php
namespace lib\app\website\generator;

class title
{
	public static function html($_line_detail, $_link = null)
	{
		$html              = null;
		$title             = a($_line_detail, 'value', 'title');
		$more_link         = a($_line_detail, 'value', 'more_link');
		$more_link_caption = a($_line_detail, 'value', 'more_link_caption');
		$show_title = a($_line_detail, 'value', 'show_title');

		if($more_link === 'hide' || !$_link)
		{
			if($show_title === 'no')
			{
				// don't show title
			}
			else
			{
				$html  = '<h2>';
				$html .= $title;
				$html .= '</h2>';
			}
		}
		else
		{
			$more_link_caption = $more_link_caption ? $more_link_caption : T_("Show more");

			$html .= "<div class='row'>";
			$html .="<div class='c-xs c-sm'>";

			if($show_title === 'no')
			{
				// don't show title
			}
			else
			{
				$html .= "<h2>". $title ."</h2>";
			}

			$html .= "</div><div class='c-xs-auto c-sm-auto'><a class='btn link' href='" . $_link . "'>". $more_link_caption . "</a></div></div>";
		}

		return $html;
	}
}
?>