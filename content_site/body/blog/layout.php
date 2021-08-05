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
		$blogList = [];
		$dataList = [];

		if(!a($_args, 'fill_defult_data'))
		{
			$line_detail =
			[
				'tag_id'            => a($_args, 'post_tag'),
				'subtype'           => a($_args, 'post_template'),
				'limit'             => a($_args, 'count'),
				'post_show_author'  => a($_args, 'post_show_author'),
				'btn_viewall_check' => a($_args, 'btn_viewall_check'),
				'post_order'        => a($_args, 'post_order'),
			];

			$dataList = \dash\app\posts\load::sitebuilder_template($line_detail);

			if(isset($dataList['list']) && is_array($dataList['list']))
			{
				$blogList = $dataList['list'];
			}

			if(!is_array($blogList))
			{
				// error
				// it will not happend because we fill it in all conditions
				$blogList = [];
			}
		}


		// fill_default_data receive from preview function
		if(empty($blogList) || a($_args, 'fill_defult_data'))
		{
			$blogList = fill_default::get(a($_args, 'count'));
		}

		// link of view all btn
		$btn_viewall_link = a($dataList, 'link');

		$html             = '';
		$container        = \content_site\options\container::class_name(a($_args, 'container'));
		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background_style = \content_site\assemble\background::full_style($_args);


		// element type
		$cnElement = 'div';
		if(a($_args, 'heading') !== null)
		{
			$cnElement = 'section';
		}

		// define variables
		$previewMode = a($_args, 'preview_mode');
		$id          = a($_args, 'id');
		$type        = a($_args, 'type');
		// $type        = 'b1';

		$my_args =
		[
			$_args,
			$blogList,
			$id,
			a($_args, 'post_show_author'),
			a($_args, 'post_show_date'),
			a($_args, 'post_show_excerpt'),
			a($_args, 'post_show_readingtime'),
		];


		$html .= "<$cnElement data-type='$type' class='$height' $background_style";
		if($previewMode)
		{
			$html .= " data-xhr='pageBuilderSection_$id'";
		}
		$html .= ">";
		{
			$html .= "<div class='$container'>";
			{
				switch ($type)
				{
					case 'b1':
						$html .= b1::html(...$my_args);
						break;

					case 'b2':
						$html .= b2::html(...$my_args);
						break;

					default:
						break;
				}

			}
			$html .= "</div>";
		}
		$html .= "</$cnElement>";

		return $html;
	}
}
?>