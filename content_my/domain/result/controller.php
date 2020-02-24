<?php
namespace content_my\domain\result;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		$id = \dash\coding::decode($id);
		$detail = \lib\app\nic_domain\get::by_id($id);

		if(!$detail)
		{
			\dash\redirect::to(\dash\url::this());
		}

		\dash\data::dataRow($detail);
	}
}
?>