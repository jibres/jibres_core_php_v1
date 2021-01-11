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
		foreach ($_menu as $key => $value)
		{
			self::$result .= '<li>';

			if(isset($value['list']) && is_array($value['list']))
			{
				foreach ($value['list'] as $one_item)
				{
					self::$result .='<div class="f item">';
					self::$result .='<i class="sf-thumbnails" data-handle><input type="hidden" name="sort[]" data-id="'. a($one_item, 'id'). '"></i>';
					self::$result .='<div class="key">'. a($one_item, 'title');

					if(a($value, 'target'))
					{
						self::$result .= '<i class="sf-external-link fc-mute"></i>';
					}

					self::$result .= '</div>';
					self::$result .= '<div class="value addChild pRa20-f s0"><a href="'. \dash\url::that(). '/item'. \dash\request::full_get(['id' => a($one_item, 'id')]). '">'. T_("Add Subitem"). '</a></div>';
					self::$result .= '<div class="value"><a href="'. \dash\url::that(). '/item'. \dash\request::full_get(['id' => a($one_item, 'id')]). '">'. T_("Edit"). '</a></div>';
					self::$result .= '</div>';
				}
			}

			if(isset($value['child']) && is_array($value['child']))
			{
				self::$result .= '<ol data-sortable>';
				self::create_admin($value['child']);
				self::$result .='</ol>';
			}

			self::$result .= '</li>';
		}
	}

}
?>