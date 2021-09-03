<?php
namespace lib\pagebuilder\draw;


class body_item
{
	/**
	 * The html content
	 *
	 * @var        <type>
	 */
	private static $html = '';


	/**
	 * Item detail
	 *
	 * @var        array
	 */
	public static $item  = [];

	private static $item_type = null;


	private static $set_avand = null;


	private static function reset()
	{
		self::$html      = '';
		self::$item      = [];
		self::$item_type = null;
		self::$set_avand = null;
	}


	public static function get_html($_item)
	{
		self::reset();

		if(isset($_item['type']))
		{
			self::$item_type = $_item['type'];

			self::$item = $_item;

			self::draw();
		}

		return self::$html;
	}



	private static function draw()
	{
		self::avand();
		{
			self::puzzle();
			{
				self::element();
			}
			self::_puzzle();
		}
		self::_avand();
	}



	/**
	 * Add avand element
	 */
	private static function avand()
	{
		if(isset(self::$item['avand']['code']) && is_string(self::$item['avand']['code']))
		{
			self::$html .= '<div class="'. self::$item['avand']['code']. '">';
			self::$set_avand = true;
		}
	}


	/**
	 * Close avand element
	 */
	private static function _avand()
	{
		if(self::$set_avand)
		{
			self::$html .= '</div>';
		}
	}


	private static function puzzle()
	{
		self::$html .= '<div>';
	}


	private static function _puzzle()
	{
		self::$html .= '</div>';
	}


	private static function element()
	{

		if(is_callable(\lib\pagebuilder\tools\tools::get_fn('body', self::$item_type, 'draw')))
		{
			$draw = \lib\pagebuilder\tools\tools::call_fn_args('body', self::$item_type, 'draw', self::$item);

			if(is_string($draw))
			{
				self::$html .= $draw;
			}
		}
	}
}
?>