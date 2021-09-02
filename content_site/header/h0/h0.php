<?php
namespace content_site\header\h0;


class h0
{

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		return
		[
			'title'        => T_("Without Header"),
			'default'      => [],
			'options'      =>
			[
				'msg' => 'my_msg',
			],

			'preview_list' =>
			[
				'p1',
			],
		];
	}


	public static function my_msg()
	{
		$html = '';
		$html .= '<div class="msg">';
		{
			$html .= T_("This is empty header");
		}
		$html .= '</div>';

		return $html;
	}


	/**
	 * Preview 1
	 */
	public static function p1()
	{
		return
		[
			'preview_title'  => T_("Preview :val", ['val' => \dash\fit::number(1)]),
			'version'        => 1,
			'options' =>
			[

			],
		];
	}


}
?>