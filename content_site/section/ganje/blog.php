<?php
namespace content_site\section\ganje;


class blog
{

	public static function allow()
	{
		return true;
	}


	public static function detail()
	{
		$detail =
		[
			'group' => T_("Blog"),
			'title' => T_("Blog posts"),
			'key'   => 'blog',
			'icon'  => \dash\utility\icon::url('Blog'),
		];

		return $detail;
	}


	public static function options()
	{
		$options =
		[
			'heading',
			'view_all_btn',
			'post_tag',
			'post_template',
			'limit',
			'avand',
			'padding',
			'radius',
		];

		return $options;
	}


	public static function default()
	{
		$default =
		[
			'heading'        => T_("Post blog"),
			'post_template'  => 'video',
			'post_play_item' => 'all',
		];

		return $default;
	}


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