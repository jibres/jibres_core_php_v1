<?php
namespace content_site\body\blog;


class layout
{


	/**
	 * Layout blog html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$line_detail =
		[
			'title'     => a($_args, 'heading'),
			'tag_id'    => a($_args, 'tag_id'),
			'subtype'   => a($_args, 'post_template'),
			'limit'     => a($_args, 'limit'),
		];

		$data = \dash\app\posts\load::sitebuilder_template($line_detail);

		if(isset($data['list']))
		{
			$data = $data['list'];
		}

		if(!is_array($data))
		{
			$data = [];
		}



		$html = '';

		$html .= '<div class="'. a($_args, 'avand').'">';
		{
			$html .= '<div class="">';
			{
				$html .= '<div class="">';
				{
					$html .= '<h2>';
					{
						$html .= a($_args, 'heading');
					}
					$html .= '</h2>';

					foreach ($data as $key => $value)
					{

						$html .= '<div>';
						$html .= a($value, 'title');
						$html .= '</div>';
					}
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