<?php
namespace content_site\ganje\imagetext;


class layout
{


	/**
	 * Layout imagetext html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{

		$html = '';

		$html .= '<div class="'. a($_args, 'avand').'">';
		{
			$html .= '<div class="row">';
			{
				$html .= '<div class="c-xs-12 c-sm-6">';
				{
					$html .= '<h2>';
					{
						$html .= a($_args, 'heading');
					}
					$html .= '</h2>';

					$html .= '<p>';
					{
						$html .= a($_args, 'text');
					}
					$html .= '</p>';

				}
				$html .= '</div>';

				$html .= '<div class="c-xs-12 c-sm-6">';
				{
					$file = \dash\utility\icon::url('Image', 'major');

					if(isset($_args['file']) && $_args['file'])
					{
						$file = \lib\filepath::fix($_args['file']);
					}

					$html .= '<img class="w300" src="'. $file. '" alt="'. a($_args, 'heading'). '">';
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}
}
?>