<?php
namespace lib\pagebuilder\draw;


class body_item
{
	/**
	 * The html content
	 *
	 * @var        <type>
	 */
	private $html = '';


	/**
	 * Item detail
	 *
	 * @var        array
	 */
	public $item  = [];

	private $item_type = null;


	/**
	 * Constructs a new instance.
	 *
	 * @param      <type>  $_item  The item
	 */
	public function __construct($_item)
	{
		if(isset($_item['type']))
		{
			$this->item_type = $_item['type'];

			$ready = \lib\pagebuilder\tools\tools::global_ready_show('body', $_item['type'], $_item);

			if(!is_array($ready))
			{
				$ready = [];
			}

			$this->item = $ready;

			$this->draw();
		}
	}


	public function get_html()
	{
		return $this->html;
	}



	private function draw()
	{
		// var_dump($this);exit();

		$this->avand();
		{
			$this->puzzle();
			{
				$this->element();
			}
			$this->_puzzle();
		}
		$this->_avand();
	}



	/**
	 * Add avand element
	 */
	private function avand()
	{
		if(isset($this->item['avand']['code']) && is_string($this->item['avand']['code']))
		{
			$this->html .= '<div class="'. $this->item['avand']['code']. '">';
			$this->set_avand = true;
		}
	}


	/**
	 * Close avand element
	 */
	private function _avand()
	{
		if(isset($this->set_avand) && $this->set_avand)
		{
			$this->html .= '</div>';
		}
	}


	private function puzzle()
	{
		$this->html .= '<div>';
	}

	private function _puzzle()
	{
		$this->html .= '</div>';
	}

	private function element()
	{

	}





}
?>