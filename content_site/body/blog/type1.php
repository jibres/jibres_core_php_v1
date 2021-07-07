<?php
namespace content_site\body\blog;


class type1
{
	public static function html($_args, $_blogList)
	{
		$html             = '';

		if(a($_args, 'heading') !== null)
		{
			$html .= '<header>';
			{
				$html .= '<h2';

				if(a($_args, 'id'))
				{
					$sync = 'heading-'. a($_args, 'id');
					if($sync)
					{
						$html .= " data-sync='$sync'";
					}
				}
				$html .= '>';
				{
					$html .= a($_args, 'heading');
				}
				$html .= '</h2>';
			}
			$html .= '</header>';
		}

		$html .= '<nav>';
		{
			foreach ($_blogList as $key => $value)
			{
				$html .= '<a class="block" href="'. a($value, 'link'). '">';
				$html .= a($value, 'title');
				$html .= '</a>';
			}
		}
		$html .= '</nav>';

		return $html;
	}
}
?>