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
			'tag_id'            => a($_args, 'post_tag'),
			'subtype'           => a($_args, 'post_template'),
			'limit'             => a($_args, 'count'),
			'post_show_author'  => a($_args, 'post_show_author'),
			'btn_viewall_check' => a($_args, 'btn_viewall_check'),
		];

		$dataList = \dash\app\posts\load::sitebuilder_template($line_detail);

		$blogList = null;

		if(isset($dataList['list']) && is_array($dataList['list']))
		{
			$blogList = $dataList['list'];
		}

		if(!is_array($blogList))
		{
			// error
			// it will not happend because we fill it in all conditions
			return null;
		}

		if(empty($blogList))
		{
			$blogList = fill_default::get(a($_args, 'count'));
		}

		// link of view all btn
		$btn_viewall_link = a($dataList, 'link');

		$html             = '';
		$container        = \content_site\options\container::class_name(a($_args, 'container'));
		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background       = \content_site\options\background\background_pack::get_full_backgroun_class(a($_args, 'style'));
		$background_class = a($background, 'class');
		$background_attr  = a($background, 'attr');
		$element          = a($background, 'element');

		$html .= $element;

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
		$type        = 'b1';


		$html .= "<$cnElement data-type='$type' class='$height $background_class' $background_attr";
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
						$html .= b1::html($_args, $blogList, $id, a($_args, 'post_show_author'), a($_args, 'post_show_date'));
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