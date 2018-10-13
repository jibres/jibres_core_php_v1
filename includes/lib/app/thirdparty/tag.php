<?php
namespace lib\app\thirdparty;

class tag
{

	public static function add($_tag, $_id)
	{
		\dash\permission::access('aThirdpartyAssignTag');

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid thirdparty id"));
			return false;
		}

		if(!\dash\permission::check('cpThirdpartyTagAdd'))
		{
			$current_tag = \dash\db\terms::get(['type' => 'thirdparty_tag']);
			if(is_array($current_tag))
			{
				$tag_titles = array_column($current_tag, 'title');
				$new_tag    = $_tag;
				$new_tag    = explode(',', $new_tag);
				foreach ($new_tag as $key => $value)
				{
					if(!in_array($value, $tag_titles))
					{
						\dash\notif::error(T_("Please select tag from list"), 'tag');
						return false;
					}
				}
			}
		}

		\dash\app::variable(['thirdparty_tag' => $_tag]);

		\dash\app\posts::set_post_term($id, 'thirdparty_tag', 'userstores', $_tag);

		\dash\log::set('thirdpartyAddTag', ['code' => $_id, 'tag' => $_tag]);
		\dash\notif::ok(T_("Tag was saved"));
		return true;

	}


	public static function list($_id, $_limit = 100)
	{
		$get_log =
		[
			'caller' => 'thirdpartyNote',
			'code'   => $_id,
			'limit'  => $_limit
		];

		$get_log = \dash\db\logs::get($get_log, ['join_user' => true]);
		return $get_log;

	}

}
?>