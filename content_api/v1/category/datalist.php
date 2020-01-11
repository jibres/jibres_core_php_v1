<?php
namespace content_api\v1\category;


class datalist
{
	public static function route()
	{
		if(\dash\request::is('get'))
		{
			$result = self::list();
			\content_api\v1::say($result);
		}
		else
		{
			\content_api\v1::invalid_method();
		}
	}


	private static function list()
	{
		$list = \lib\app\category\search::list();

		if(!is_array($list))
		{
			$list = [];
		}

		$new_list = [];
		foreach ($list as $key => $value)
		{
			if(!is_array($value))
			{
				continue;
			}

			$temp                 = [];
			$temp['id']           = array_key_exists('id', $value) ? $value['id'] : null;
			$temp['title']        = array_key_exists('title', $value) ? $value['title'] : null;
			$temp['slug']         = array_key_exists('slug', $value) ? $value['slug'] : null;
			$temp['language']     = array_key_exists('language', $value) ? $value['language'] : null;
			$temp['desc']         = array_key_exists('desc', $value) ? $value['desc'] : null;
			$temp['seotitle']     = array_key_exists('seotitle', $value) ? $value['seotitle'] : null;
			$temp['seodesc']      = array_key_exists('seodesc', $value) ? $value['seodesc'] : null;
			$temp['file']         = array_key_exists('file', $value) ? $value['file'] : null;
			$temp['count']        = array_key_exists('count', $value) ? $value['count'] : null;
			$temp['parent_slug']  = array_key_exists('parent_slug', $value) ? $value['parent_slug'] : null;
			$temp['parent_title'] = array_key_exists('parent_title', $value) ? $value['parent_title'] : null;
			$temp['full_slug']    = array_key_exists('full_slug', $value) ? $value['full_slug'] : null;
			$temp['full_title']   = array_key_exists('full_title', $value) ? $value['full_title'] : null;
			$temp['have_child']   = array_key_exists('have_child', $value) ? $value['have_child'] : null;
			$temp['have_product'] = array_key_exists('have_product', $value) ? $value['have_product'] : null;

			$new_list[] = $temp;
		}

		return $new_list;
	}
}
?>