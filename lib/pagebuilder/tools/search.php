<?php
namespace lib\pagebuilder\tools;


class search
{


	public static function list($_args = [])
	{
		if(isset($_args['id']))
		{
			$id = $_args['id'];
		}
		else
		{
			$id = \dash\request::get('id');
		}

		$id = \dash\validate::code($id);

		$id = \dash\coding::decode($id);

		if(!$id)
		{
			return false;
		}

		$post_detail = \lib\pagebuilder\tools\current_post::load($id);

		$need_load_body = true;

		if(isset($_args['homepage_builder']) && $_args['homepage_builder'])
		{
			if(isset($post_detail['meta']['template']))
			{
				if(in_array($post_detail['meta']['template'], ['comingsoon', 'visitcard']))
				{
					\dash\temp::set('pagebuilder_template', $post_detail['meta']['template']);

					switch ($post_detail['meta']['template'])
					{
						case 'comingsoon':
							\dash\face::disablePWA_Header(true);
							\dash\face::css(["business/comingsoon-1/comingsoon-1.css"]);
							break;

						case 'visitcard':
							\dash\face::disablePWA_Header(true);
							\dash\face::css(
								[
									"business/visitcard-1/visitcard-1.css",
									"https://fonts.googleapis.com/css?family=Quicksand:300,400"
								]
							);
							\dash\face::twitterCard('summary_large_image');
							break;

						default:
							break;
					}


					$need_load_body = false;
				}
			}
		}

		$list = [];

		if($need_load_body)
		{
			$list = \lib\db\pagebuilder\get::line_list($id);
		}

		$result                = [];

		$result['post_detail'] = $post_detail;

		if(isset($_args['ready']) && $_args['ready'])
		{
			self::ready($result, $list);
		}
		else
		{
			$result['list']        = $list;
		}


		return $result;
	}


	private static function ready(&$result, $list)
	{
		$result['header'] = [];
		$result['body']   = [];
		$result['footer'] = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['mode']) && isset($value['type']) && is_string($value['type']))
			{
				if(in_array($value['mode'], ['header', 'footer', 'body']))
				{
					$result[$value['mode']][] = \lib\pagebuilder\tools\tools::global_ready_show($value['mode'], $value['type'], $value);
				}
			}
		}
	}

}
?>