<?php
namespace lib\app\website\generator;

class title
{
	public static function html($_line_detail, $_link = null)
	{
		if(a($_line_detail, 'value', 'show_title') === 'no')
		{
			return '';
		}

		$html              = '';
		$title             = a($_line_detail, 'value', 'title');
		$more_link         = a($_line_detail, 'value', 'more_link');
		$more_link_caption = a($_line_detail, 'value', 'more_link_caption');


		if($more_link === 'hide' || !$_link)
		{
			$html = '<div class="eTitle">';
			{
				$html = '<h2 class="title">'. $title. '</h2>';
			}
			$html = '</div>';
		}
		else
		{
			$html .= "<div class='eTitle row'>";
			{
				$html .= "<div class='c'>";
				{
					$html .= '<h2 class="title">'. $title .'</h2>';
				}
				$html .= "</div>";
				$html .= "<div class='c-auto os'>";
				{
					$html .= "<a class='more' href='" . $_link . "'>". $more_link_caption . "</a>";
				}
				$html .= "</div>";
			}
			$html .= "</div>";
		}

		return $html;
	}
}
?>