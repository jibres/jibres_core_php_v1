<?php
namespace content_a\setting\factor;


class model extends \content_a\main\model
{

	public static function getPost($_old_meta = [])
	{
		// @important!
		// if you want to change this array
		// must be change the array in view of factor/pay/view.php
		$default_meta =
		[
			'print_status'  => false,
			'print_size'    =>
			[
				'fishprint' => false,
				'a4'        => false,
				'a5'        => false,
			],
			'detault_print' => 'fishprint',

			'pay_status' => false,
			'pay'        =>
			[
				'cash'   => false,
				'pos'    => false,
				'cheque' => false,
			],

			'detault_pay' => 'cash',
			'pos_list'    =>  [],
			'default_pos' => null,
		];

		$meta                 = $default_meta;
		$meta['print_status'] = \lib\utility::post('printStatus') ? true : false;

		if(\lib\utility::post('print_size') && is_array(\lib\utility::post('print_size')))
		{
			$meta['print_size']['fishprint'] = in_array('fishprint', \lib\utility::post('print_size')) ? true : false;
			$meta['print_size']['a4']        = in_array('a4', \lib\utility::post('print_size')) ? true : false;
			$meta['print_size']['a5']        = in_array('a5', \lib\utility::post('print_size')) ? true : false;
		}

		if(\lib\utility::post('pay') && is_array(\lib\utility::post('pay')))
		{
			$meta['pay']['cash']   = in_array('cash', \lib\utility::post('pay')) ? true : false;
			$meta['pay']['pos']    = in_array('pos', \lib\utility::post('pay')) ? true : false;
			$meta['pay']['cheque'] = in_array('cheque', \lib\utility::post('pay')) ? true : false;
		}

		$pos_name = \lib\utility::post('posList');

		if(isset($_old_meta['pos_list']) && is_array($_old_meta['pos_list']))
		{
			array_push($_old_meta['pos_list'], $pos_name);
		}
		else
		{
			$_old_meta['pos_list'] = $default_meta['pos_list'];
		}

		$meta['pos_list'] = array_filter(array_unique($_old_meta['pos_list']));

		return $meta;
	}



	public function post_factor()
	{
		$old_meta = \lib\store::detail('meta');

		if(isset($old_meta['factor']))
		{
			$old_meta = $old_meta['factor'];
		}
		else
		{
			$old_meta = [];
		}

		$meta = self::getPost($old_meta);

		\lib\app\store::edit_meta(['factor' => $meta]);

		if(\lib\debug::$status)
		{
			\lib\debug::true(T_("Factor setting saved"));
			$this->redirector($this->url('full'));
		}
	}
}
?>