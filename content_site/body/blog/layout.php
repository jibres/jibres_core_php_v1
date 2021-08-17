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

		$view_all_link = \dash\url::kingdom(). '/n';

		if(!\content_site\utility::fill_by_default_data())
		{
			$line_detail =
			[
				'tag_id'                  => a($_args, 'post_tag'),
				'subtype'                 => a($_args, 'post_template'),
				'limit'                   => a($_args, 'count'),
				'post_show_author'        => a($_args, 'post_show_author'),
				'btn_viewall_check'       => a($_args, 'btn_viewall_check'),
				'post_order'              => a($_args, 'post_order'),
				'post_show_comment_count' => a($_args, 'post_show_comment_count'),
			];

			$dataList = \dash\app\posts\load::sitebuilder_template($line_detail);

			if(isset($dataList['list']) && is_array($dataList['list']))
			{
				$blogList = $dataList['list'];
			}

			if(isset($dataList['link']))
			{
				$view_all_link = $dataList['link'];
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
			$blogList = \content_site\assemble\fill_default::blog(a($_args, 'count'), a($_args, 'preview_mode'));
		}

		// send the view all link to every layout of blog
		$_args['btn_viewall_link'] = $view_all_link;
		if(!a($_args, 'btn_viewall'))
		{
			$_args['btn_viewall'] = T_("View all");
		}


		$html             = '';


		$type      = a($_args, 'type');

		$namespace = sprintf('%s\%s\%s', __NAMESPACE__, 'html', $type);

		if(is_callable([$namespace, 'html']))
		{
			$html .= call_user_func_array([$namespace, 'html'],[$_args, $blogList]);
		}

		return $html;
	}
}
?>