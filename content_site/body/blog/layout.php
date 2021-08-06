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

		if(!\content_site\utility::fill_by_default_data())
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
		if(empty($blogList) || \content_site\utility::fill_by_default_data())
		{
			$blogList = fill_default::get(a($_args, 'count'));
		}


		$html             = '';

		switch (a($_args, 'type'))
		{
			case 'b1':
				$html .= b1::html($_args, $blogList);
				break;

			case 'b2':
				$html .= b2::html($_args, $blogList);
				break;


			case 'b3':
				$html .= b3::html($_args, $blogList);
				break;


			case 'b4':
				$html .= b4::html($_args, $blogList);
				break;

			case 'b5':
				$html .= b5::html($_args, $blogList);
				break;

			case 'b6':
				$html .= b6::html($_args, $blogList);
				break;

			default:
				break;
		}


		return $html;
	}
}
?>