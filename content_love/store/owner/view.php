<?php
namespace content_love\store\owner;


class view extends \content_love\store\setting\view
{
	public static function config()
	{
		\dash\face::title(T_("Change owner"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/setting?id='. \dash\request::get('id'));

		$store_data = \lib\app\store\get::data_by_id(\dash\request::get('id'));

		if(a($store_data, 'owner'))
		{
			$owner = \dash\coding::encode($store_data['owner']);
			$owner = \dash\app\user::get($owner);
			\dash\data::currentOwner($owner);

		}

		$creator = \dash\data::dataRow_creator();
		if($creator)
		{
			$creator = \dash\coding::encode($creator);
			$creator = \dash\app\user::get($creator);
			\dash\data::currentCreator($creator);
		}

		$newowner = \dash\request::get('newowner');
		if($newowner)
		{
			$newowner = \dash\validate::mobile($newowner);
			if($newowner)
			{
				$newowner = \dash\db\users::get_by_mobile($newowner);
				if(!$newowner)
				{
					\dash\notif::error(T_("Use not found"));
					return false;
				}


				$newowner = \dash\app\user::ready($newowner);
				\dash\data::newOwner($newowner);

			}
		}
	}
}
?>
