<?php
namespace lib\app\menu;


class generate
{
	private static $result = '';
	public static function admin($_menu)
	{
		if(!is_array($_menu))
		{
			return null;
		}

		self::$result = '';
		self::$result .= '<ol class="items2" data-layer-limit="4" data-sortable>';

		self::create_admin($_menu);

		self::$result .= '</ol>';


		return self::$result;

	}


	private static function create_admin($_menu)
	{
		foreach ($_menu as $index => $one_item)
		{
			self::$result .= '<li>';
			self::$result .= '<div class="f item">';
			self::$result .= '<i class="sf-thumbnails" data-handle><input type="hidden" name="sort[]" data-id="'. a($one_item, 'id'). '"></i>';
			self::$result .= '<div class="key">'. a($one_item, 'title');

			if(a($one_item, 'target'))
			{
				self::$result .= '<i class="sf-external-link fc-mute"></i>';
			}

			self::$result .= '</div>';
			self::$result .= '<div class="value addChild pRa20-f s0"><a href="'. \dash\url::that(). '/item?'. \dash\request::build_query(['id' => a($one_item, 'parent1'), 'parent' => a($one_item, 'id')]). '">'. T_("Add Subitem"). '</a></div>';
			self::$result .= '<div class="value"><a href="'. \dash\url::that(). '/item?'. \dash\request::build_query(['id' => a($one_item, 'parent1'), 'edit' => a($one_item, 'id')]). '">'. T_("Edit"). '</a></div>';
			self::$result .= '</div>';

			if(isset($one_item['child']) && is_array($one_item['child']) && $one_item['child'])
			{
				self::$result .= '<ol data-sortable>';
				self::create_admin($one_item['child']);
				self::$result .='</ol>';
			}
			else
			{
				self::$result .= '<ol data-sortable></ol>';
			}

			self::$result .= '</li>';
		}
	}

}
?>