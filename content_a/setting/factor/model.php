<?php
namespace content_a\setting\factor;


class model extends \content_a\main\model
{

	public static function getPost($_old_pos_list = [])
	{
		if(!is_array($_old_pos_list))
		{
			$_old_pos_list = [];
		}

		$meta                 = $_old_pos_list;
		$meta['print_status'] = \lib\utility::post('printStatus') ? true : false;

		if(\lib\utility::post('print_size') && is_array(\lib\utility::post('print_size')))
		{
			$meta['print_size']   = array_values(\lib\utility::post('print_size'));
		}
		else
		{
			$meta['print_size']   = null;
		}

		if(\lib\utility::post('pay') && is_array(\lib\utility::post('pay')))
		{
			$meta['pay']          = array_values(\lib\utility::post('pay'));
		}
		else
		{
			$meta['pay']          = null;
		}

		$pos_name             = \lib\utility::post('posList');

		if($pos_name)
		{
			if(isset($_old_pos_list['pos_list']))
			{
				if(!in_array($pos_name, $_old_pos_list['pos_list']))
				{
					$meta['pos_list'][] = $pos_name;
				}
			}
			else
			{
				$meta['pos_list'] = [$pos_name];
			}
		}


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