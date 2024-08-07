<?php
namespace dash\app\telegram;

class filter
{

	use \dash\datafilter;


	public static function sort_list_array($_module = null)
	{
		// public => true means show in api and site
		$sort_list   = [];
		// $sort_list[] = ['title' => T_("None"), 				'query' => [], 												'public' => true];
		$sort_list[] = ['title' => T_("Date ASC"), 	'query' => ['sort' => 'date',		 'order' => 'asc'], 	'public' => false];
		$sort_list[] = ['title' => T_("Date DESC"), 'query' => ['sort' => 'date',		 'order' => 'desc'], 	'public' => false];


		return $sort_list;
	}



	private static function list_of_filter()
	{

		$list = [];

		// $list['image']      = ['key' => 'image', 		'group' => T_("File Type"), 'title' => T_('Image'), 	'query' => ['type' => 'image'], 	'public' => true];
		// $list['audio']      = ['key' => 'audio', 		'group' => T_("File Type"), 'title' => T_('Audio'), 	'query' => ['type' => 'audio'], 	'public' => true];
		// $list['archive']    = ['key' => 'archive', 		'group' => T_("File Type"), 'title' => T_('archive'), 	'query' => ['type' => 'archive'], 	'public' => true];
		// $list['pdf']        = ['key' => 'pdf', 			'group' => T_("File Type"), 'title' => T_('PDF'), 		'query' => ['type' => 'pdf'], 		'public' => true];
		// $list['video']      = ['key' => 'video', 		'group' => T_("File Type"), 'title' => T_('Video'), 	'query' => ['type' => 'video'], 	'public' => true];
		// $list['word']       = ['key' => 'word', 		'group' => T_("File Type"), 'title' => T_('Word'), 		'query' => ['type' => 'word'], 		'public' => true];
		// $list['excel']      = ['key' => 'excel', 		'group' => T_("File Type"), 'title' => T_('Excel'), 	'query' => ['type' => 'excel'], 	'public' => true];
		// $list['powerpoint'] = ['key' => 'powerpoint', 	'group' => T_("File Type"), 'title' => T_('Power point'),'query' => ['type' => 'powerpoint'],'public' => true];
		// $list['code']       = ['key' => 'code', 		'group' => T_("File Type"), 'title' => T_('code'), 		'query' => ['type' => 'code'], 		'public' => true];
		// $list['text']       = ['key' => 'text', 		'group' => T_("File Type"), 'title' => T_('text'), 		'query' => ['type' => 'text'], 		'public' => true];
		// $list['file']       = ['key' => 'file', 		'group' => T_("File Type"), 'title' => T_('file'), 		'query' => ['type' => 'file'], 		'public' => true];
		$list['other']      = ['key' => 'other', 		'group' => T_("File Type"), 'title' => T_('Other'), 	'query' => ['type' => 'other'], 	'public' => true];

		return $list;

	}

}
?>