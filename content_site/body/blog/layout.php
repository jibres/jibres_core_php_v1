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
		// var_dump($_args);exit;
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

		$html             = '';
		$container        = \content_site\options\container::class_name(a($_args, 'container'));
		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background       = \content_site\options\background\background_pack::get_full_backgroun_class(a($_args, 'background'));
		$background_class = a($background, 'class');
		$background_attr  = a($background, 'attr');
		$element          = a($background, 'element');

		$html .= $element;

		$html .= "<div class='$container $height $background_class ' $background_attr>";
		{
			$html .= '<h2>';
			{
				$html .= a($_args, 'heading');
			}
			$html .= '</h2>';

			$html .= '<nav>';
			{
				foreach ($data as $key => $value)
				{
					$html .= '<a class="block" href="'. a($value, 'link'). '">';
					$html .= a($value, 'title');
					$html .= '</a>';
				}
			}
			$html .= '</nav>';
		}
		$html .= '</div>';


		return $html;
	}
}
?>