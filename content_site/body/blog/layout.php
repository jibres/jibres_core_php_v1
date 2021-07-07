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

		$html             = '';
		$container        = \content_site\options\container::class_name(a($_args, 'container'));
		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background       = \content_site\options\background\background_pack::get_full_backgroun_class(a($_args, 'background'));
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
		$type        = 'type1';



		$html .= "<$cnElement class='$container $height $background_class' $background_attr>";
		{

			switch ($type)
			{
				case 'type1':
					$html .= type1::html($_args, $blogList, $id);
					break;

				default:
					break;
			}
		}
		$html .= "</$cnElement>";


		return $html;
	}
}
?>