<?php
namespace lib\pagebuilder\tools;


class current_post
{


	public static function id()
	{
		$id = \dash\request::get('id');
		$id = \dash\validate::code($id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			return false;
		}

		return $id;
	}


	public static function load($_id)
	{
		if($_id && is_numeric($_id))
		{
			// ok
		}
		else
		{
			return false;
		}
		// load post detail
		$post_detail = \dash\db\posts\get::by_id_type($_id, 'pagebuilder');

		if(isset($post_detail['id']) && floatval($post_detail['id']) === floatval(\lib\store::detail('homepage_builder_post_id')))
		{
			$post_detail['ishomepage'] = true;
		}

		\dash\temp::get('not_load_cms_setting', true);

		$ready = \dash\app\posts\ready::row($post_detail);

		return $ready;
	}

}
?>