<?php
namespace dash;

/**
 * Class for application.
 */
class tag
{

	private $html     = null;
	private $tag_name = null;
	private $style    = [];
	private $attr     = [];
	private $class    = [];
	private $id       = null;


	public function __construct($_tag_name)
	{
		$this->tag_name = $_tag_name;
		return $this;
	}


	public function style($_style)
	{
		$this->style[] = $_style;
		return $this;
	}


	public function attr($_attr, $_value = null)
	{
		if($_value !== null)
		{
			$this->attr[] = $_attr. '="'. $_value. '"';
		}
		else
		{
			$this->attr[] = $_attr;
		}
		return $this;
	}


	public function class($_class)
	{
		$this->class[] = $_class;
		return $this;
	}



	public function get()
	{
		if(!$this->tag_name)
		{
			return null;
		}

		$html = [];

		$html[] = '<'. $this->tag_name;

		if($this->class)
		{
			$html[] =  'class="'. implode(' ', $this->class). '"';
		}

		if($this->style)
		{
			$html[] =  'style="'. implode(' ', $this->style). '"';
		}

		if($this->attr)
		{
			$html[] = implode(' ', $this->attr);
		}

		$html[] = '>';

		$html = implode(' ', $html);

		return $html;

	}
}
?>