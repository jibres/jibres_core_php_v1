<?php
namespace lib\pagebuilder\header\announcement;


class announcement
{

	public static function input_condition($_args = [])
	{
		$_args['set_announcement'] = 'bit';
		$_args['status']           = 'bit';
		$_args['text']             = 'string_200';
		$_args['url']              = 'string_200';
		$_args['target']           = 'bit';
		return $_args;
	}


	public static function input_required()
	{
		return [];
	}


	public static function input_meta()
	{
		return [];
	}


	public static function ready($_data)
	{
		return $_data;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$announcement = [];

		if(isset($_data['set_announcement']) && $_data['set_announcement'])
		{
			$announcement['status'] = $_data['status'];
			$announcement['text']   = $_data['text'];
			$announcement['url']    = $_data['url'];
			$announcement['target'] = $_data['target'];
		}
		elseif(a($_saved_detail, 'detail', 'announcement'))
		{
			$announcement['announcement'] = a($_saved_detail, 'detail', 'announcement');
		}

		if(!is_array(a($_data, 'detail')))
		{
			$_data['detail'] = [];
		}

		$_data['detail'] = array_merge($_data['detail'], ['announcement' => $announcement]);

		\lib\pagebuilder\tools\tools::input_exception('detail');

		unset($_data['set_announcement']);
		unset($_data['status']);
		unset($_data['text']);
		unset($_data['url']);
		unset($_data['target']);

		return $_data;
	}
}
?>