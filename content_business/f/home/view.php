<?php

namespace content_business\f\home;

class view
{

	public static function config()
	{
		if (\dash\data::formDetail_title())
		{
			\dash\face::title(\dash\data::formDetail_title());
		}
		else
		{
			$store_title = \lib\store::detail('title');
			if ($store_title)
			{
				\dash\face::title(T_("Forms"));
			}
		}

		if (\dash\data::formDetail_desc())
		{
			\dash\face::desc(strip_tags(\dash\data::formDetail_desc()));
		}
		else
		{
			\dash\face::desc(\dash\data::formDetail_title());
		}

		if (\dash\data::formDetail_file())
		{
			\dash\face::cover(\dash\data::formDetail_file());
			\dash\face::twitterCard('summary_large_image');
		}

		if (\dash\data::inquiryForm())
		{
			if (\dash\data::formDetail_inquiryimage())
			{
				\dash\face::cover(\dash\data::formDetail_inquiryimage());
				\dash\face::twitterCard('summary_large_image');
			}

			if (\dash\data::formDetail_inquirymsg())
			{
				\dash\face::desc(strip_tags(\dash\data::formDetail_inquirymsg()));
			}
		}

		self::static_var();

		self::resultPage();
	}


	private static function static_var()
	{
		$countryList = \dash\utility\location\countres::$data;
		\dash\data::countryList($countryList);

		$cityList    = \dash\utility\location\cites::$data;
		$proviceList = \dash\utility\location\provinces::key_list('localname');

		$new = [];
		foreach ($cityList as $key => $value)
		{
			$temp = '';

			if (isset($value['province']) && isset($proviceList[$value['province']]))
			{
				$temp .= $proviceList[$value['province']] . ' - ';
			}
			if (isset($value['localname']))
			{
				$temp .= $value['localname'];
			}
			$new[$key] = $temp;
		}
		asort($new);

		\dash\data::cityList($new);
	}


	private static function resultPage()
	{
		if (!\dash\data::resultPage())
		{
			return false;
		}

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\form\answer\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\form\answer\filter::sort_list());
		\dash\data::listEngine_cleanFilterUrl(\dash\url::current());

		$args            = [];
		$args['form_id'] = \dash\data::formId();
		//		$args['sort']        = \dash\request::get('sort');
		//		$args['order']       = \dash\request::get('order');

		if (a(\dash\data::formDetail(), 'resultpagesetting', 'tag_id'))
		{
			$args['tag_id'] = a(\dash\data::formDetail(), 'resultpagesetting', 'tag_id');
		}

		$args['not_deleted'] = true;
		$q                   = \dash\validate::search_string();


		$answerList = \lib\app\form\answer\search::list($q, $args, true);

		if (!$answerList)
		{
			$answerList = [];
		}

		$result        = [];
		$allowShowItem = [];
		if (is_array(a(\dash\data::formDetail(), 'resultpagesetting', 'question')))
		{
			$allowShowItem = a(\dash\data::formDetail(), 'resultpagesetting', 'question');
			$allowShowItem = array_map('floatval', $allowShowItem);
		}

		$form_id = \dash\data::formId();


		$load_items = \dash\data::formItems();

		foreach ($load_items as $key => $item)
		{
			if (!in_array(floatval($item['id']), $allowShowItem))
			{
				unset($load_items[$key]);
			}
		}

		$col   = [];
		$clone = [];
		foreach ($load_items as $load_item)
		{
			$clone[$load_item['id']] = null;
			$col[$load_item['id']]   =
				[
					'title' => $load_item['title'],
				];

		}

		$result = [];

		foreach ($answerList as $answer)
		{
			$loadAnswerDetailargs                 = [];
			$loadAnswerDetailargs['answer_id']    = $answer['id'];
			$loadAnswerDetailargs['form_id']      = $form_id;
			$loadAnswerDetailargs['sort_by_item'] = true;

			$getAnserDetailList = \lib\db\form_answer\get::for_result_page($form_id, $answer['id'], $allowShowItem);
			foreach ($getAnserDetailList as $oneAnswerDetail)
			{
				if (!isset($result[$answer['id']]))
				{
					$result[$answer['id']] = $clone;
				}

				$myAnswer = $oneAnswerDetail['answer'];

				if ($myAnswer)
				{
					switch ($oneAnswerDetail['type'])
					{
						case 'short_answer':
							//						$myAnswer = $myAnswer;
							break;

						case 'nationalcode':
							$myAnswer = substr($myAnswer, 0, 3) . ' * * * * * ' . substr($myAnswer, 8, 2);
							$myAnswer = \dash\fit::text($myAnswer);
							$myAnswer = '<div class="ltr ">' . $myAnswer . '</div>';

							break;
						case 'birthdate':

							break;
						case 'displayname':
							break;
						case 'mobile':
							$myAnswer = substr($myAnswer, 0, 5) . ' * * * * ' . substr($myAnswer, 8, 4);
							$myAnswer = \dash\fit::text($myAnswer);
							$myAnswer = '<div class="ltr ">' . $myAnswer . '</div>';
							break;
					}
				}

				$result[$answer['id']][$oneAnswerDetail['item_id']] = $myAnswer;

			}


		}

		\dash\data::col($col);
		\dash\data::dataTable($result);

	}

}

?>