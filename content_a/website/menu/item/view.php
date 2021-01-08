<?php
namespace content_a\website\menu\item;



class view
{
	public static function config()
	{
		\dash\face::title(T_('Add menu items'));


		$list = \dash\data::menuDetail_list();

		if(!$list || !is_array($list))
		{
			$list = [];
		}

		\dash\data::menuDetailList($list);

		if($list)
		{
			// back
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::that(). '/roster'. \dash\request::full_get());
		}
		else
		{
			// back
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this(). '/menu');
		}


	}
}
?>
