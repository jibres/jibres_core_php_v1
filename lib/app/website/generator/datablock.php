<?php
namespace lib\app\website\generator;

class datablock
{
	public static function html($_blockSetting, $_data)
	{
		if(!is_array($_blockSetting) || !is_array($_data))
		{
			return null;
		}
		$dataList = a($_data, 'list');
		if(!is_array($dataList))
		{
			return null;
		}

		$html = '<section class="puzzle imgLine"';
		$html .= ' data-mode="'. a($_blockSetting, 'value', 'type'). '"';
		$html .= ' data-design="'. a($_blockSetting, 'value', 'design'). '"';
		$html .= '>';
		{
			$html .= '<div class="'. a($_blockSetting, 'value', 'avand'). '">';
			{
				// get title line if need to show
				$html .= \lib\app\website\generator\title::html($_blockSetting, a($_data, 'line_link'));
				$html .= '<div class="row padMore2">';
				{
					$html .= self::everyItem($dataList, $_blockSetting);
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</section>';
		return $html;
	}

	private static function everyItem($_list, $_blockSetting)
	{
		$html = '';
		foreach ($_list as $key => $value)
		{
			$myPuzzle = \lib\app\website\puzzle::layout($key, $_blockSetting);
			$html = '<div class="'. a($myPuzzle, 'class'). '">';
		}
		return $html;
	}

}
?>