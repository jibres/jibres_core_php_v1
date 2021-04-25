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



	public static function get_html($_item)
	{
		if(isset($_item['type']))
		{
			self::$item_type = $_item['type'];

			$ready = \lib\pagebuilder\tools\tools::global_ready_show('body', $_item['type'], $_item);

			if(!is_array($ready))
			{
				$ready = [];
			}

			self::$item = $ready;

			self::draw();
		}

		return self::$html;
	}



	private static function draw()
	{
		// var_dump($this);exit();

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
		if(isset(self::$set_avand) && self::$set_avand)
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

	}





}
?>