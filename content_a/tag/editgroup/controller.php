<?php
namespace content_a\tag\editgroup;

class controller extends \content_a\tag\edit\controller
{
	public static function routing()
	{
		parent::routing();

		// disable allow file
		\dash\allow::file(false);

		$group = \dash\request::get('group');
		if(!$group && $group != '0')
		{
			\dash\redirect::to(\dash\url::this(). '/property'. \dash\request::full_get(['group' => null]));
		}

		$property = \dash\data::dataRow_properties();
		if(!is_array($property))
		{
			$property = [];
		}

		$find = false;
		foreach ($property as $key => $value)
		{
			if(isset($value['group']) && $value['group'] === $group)
			{
				$find = true;
			}
		}

		if(!$find)
		{
			\dash\redirect::to(\dash\url::this(). '/property'. \dash\request::full_get(['group' => null]));
		}

	}
}
?>