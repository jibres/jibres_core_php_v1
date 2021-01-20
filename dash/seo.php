<?php
namespace dash;


class seo
{
	public static function analyze($_detail)
	{
		$seo           = [];
		$seo['list']   = [];
		$seo['list'][] = self::analyze_title_length($_detail);
		$seo['list'][] = self::analyze_title_tag($_detail);
		$seo['list'][] = self::analyze_word_count($_detail);
		$seo['list'][] = self::analyze_seodesc($_detail);
		$seo['list'][] = self::analyze_tags($_detail);
		$seo['list'][] = self::analyze_tags_in_first_paragraph($_detail);
		$seo['list'][] = self::analyze_text_dificould($_detail);
		$seo['list'][] = self::analyze_mobile_friendly($_detail);
		$seo['list'][] = self::analyze_sitemap($_detail);
		$seo['list'][] = self::analyze_favicon($_detail);
		$seo['list'][] = self::analyze_favicon($_detail);

		$count_ok  = 0;
		$count_all = 0;
		foreach ($seo['list'] as $key => $value)
		{
			if(a($value, 'rate'))
			{
				$count_all++;

				if(a($value, 'ok') === true)
				{
					$count_ok += a($value, 'rate');
				}
			}
		}

		if(!$count_all)
		{
			$count_all = 1;
		}

		$percent = round($count_ok * 100 / $count_all);

		$seo['rank']   = $percent;

		$seo['star'] = round(($percent * 5 / 100));

		$seo['star_html'] = self::star_html($seo['star']);

		return $seo;
	}


	private static function star_html($_star)
	{
		$result = '';
		for ($i=1; $i <= 5 ; $i++)
		{
			if($i <= $_star)
			{
				$result .= '<i class="fc-gold sf-star"></i>';
			}
			else
			{
				$result .= '<i class="fc-gold sf-star-o"></i>';
			}
		}
		return $result;
	}

	/**
	 * Analyze title
	 *
	 * @param      <type>  $_detail  The detail
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	private static function analyze_title_length($_detail)
	{
		$ok     = null;
		$msg    = T_("Analyze title failed!");
		$length = 0;

		if(isset($_detail['title']) && is_string($_detail['title']))
		{
			$length = mb_strlen($_detail['title']);

			if($length >= 30 && $length <= 60)
			{
				$ok  = true;
				$msg = T_("Very good. You have set the title to :val words and this is the best number of words in the title.", ['val' => \dash\fit::number($length)]);
			}
			elseif($length >= 60 && $length <= 90)
			{
				$ok  = true;
				$msg = T_("Good. You have set the title to :val words and this number is appropriate for the title", ['val' => \dash\fit::number($length)]);
			}
			elseif($length < 30)
			{
				$ok  = false;
				$msg = T_("Weak. :val words found in title. The best case scenario for a title is 30 to 60 words", ['val' => \dash\fit::number($length)]);
			}
			elseif($length > 90)
			{
				$ok  = false;
				$msg = T_("Hard. :val words found in title. The best case scenario for a title is 30 to 60 words and a maximum of 90 words", ['val' => \dash\fit::number($length)]);
			}
		}

		$result =
		[
			'ok'     => $ok,
			'rate'   => 1,
			'msg'    => $msg,
			'length' => $length,
		];

		return $result;

	}


	/**
	 * Gets the word count.
	 *
	 * @param      <type>  $_text  The text
	 *
	 * @return     <type>  The word count.
	 */
	private static function _get_word_count($_text)
	{
		$_text = strip_tags($_text);

		// $word_count = str_word_count($_text);

		// if($_text && !$word_count)
		{
			// https://www.php.net/manual/en/function.str-word-count.php#107363
			$word_count = count(preg_split('~[^\p{L}\p{N}\']+~u', $_text));
		}

		return floatval($word_count);
	}


	/**
	 * Analyze word count
	 *
	 * @param      <type>  $_detail  The detail
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	private static function analyze_word_count($_detail)
	{
		$ok         = null;
		$msg        = T_("No content");
		$word_count = 0;

		if(isset($_detail['content']) && is_string($_detail['content']))
		{
			$word_count = self::_get_word_count($_detail['content']);

			if($word_count >= 300)
			{
				$ok  = true;
				$msg = T_("Very Good, Your content contain :val words", ['val' => \dash\fit::number($word_count)]);
			}
			else
			{
				$ok  = false;
				$msg = T_("Your content contain :val words, Content must be contain at least 300 words", ['val' => \dash\fit::number($word_count)]);
			}
		}

		$result =
		[
			'ok'    => $ok,
			'msg'   => $msg,
			'rate'  => 1,
			'count' => $word_count,
		];

		return $result;
	}

	/**
	 * Analyze word count
	 *
	 * @param      <type>  $_detail  The detail
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	private static function analyze_content_length($_detail)
	{
		$ok         = null;
		$msg        = T_("No content");
		$word_count = 0;

		if(isset($_detail['content']) && is_string($_detail['content']))
		{

			$word_count = mb_strlen($_detail['content']);

			if($word_count >= 300)
			{
				$ok  = true;
				$msg = T_("Very Good, Your content contain :val words", ['val' => \dash\fit::number($word_count)]);
			}
			else
			{
				$ok  = false;
				$msg = T_("Your content contain :val words, Content must be contain atlease 300 words", ['val' => \dash\fit::number($word_count)]);
			}
		}

		$result =
		[
			'ok'    => $ok,
			'msg'   => $msg,
			'rate'  => 0,
			'count' => $word_count,
		];

		return $result;
	}


	/**
	 * Analyze sentens
	 *
	 * @param      <type>  $_detail  The detail
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	private static function analyze_sentences($_detail)
	{
		$ok    = false;
		$score = 0;
		$count = 0;

		if(isset($_detail['content']) && is_string($_detail['content']))
		{
			$content = strip_tags($_detail['content']);

			$content = strip_tags($_detail['content']);
			$content = preg_replace("/\؟/", "?", $content);
			$content = preg_replace("/\?{2,}/", "?", $content);
			$content = preg_replace("/\!{2,}/", "!", $content);
			$content = preg_replace("/\.{2,}/", ".", $content);


			$count = count(preg_split("/\?|\!|\./", $content));

		}


		$result =
		[
			'ok'    => $ok,
			'score' => $score,
			'count' => $count,
			'rate'  => 1,
		];

		return $result;
	}




	private static function analyze_syllables($_detail)
	{
		$ok    = false;
		$score = 0;
		$count = 0;

		if(isset($_detail['content']) && is_string($_detail['content']))
		{
			$content = strip_tags($_detail['content']);

			$content = strip_tags($_detail['content']);
			$content = preg_replace("/\؟/", "?", $content);
			$content = preg_replace("/\?{2,}/", "?", $content);
			$content = preg_replace("/\!{2,}/", "!", $content);
			$content = preg_replace("/\.{2,}/", ".", $content);


			$list = preg_split("/\s/", $content);

			// var_dump($list);exit();

			foreach ($list as $key => $value)
			{
				if(mb_strlen($value) < 7)
				{
					$count += 1;
				}
				elseif(mb_strlen($value) < 15)
				{
					$count += 2;
				}
				elseif(mb_strlen($value) < 30)
				{
					$count += 3;
				}
				elseif(mb_strlen($value) < 40)
				{
					$count += 4;
				}
				else
				{
					$count += 5;
				}
			}


		}


		$result =
		[
			'ok'    => $ok,
			'score' => $score,
			'count' => $count,
			'rate'  => 1,
		];

		return $result;
	}

	private static function analyze_text_dificould($_detail)
	{
		$ok    = true;
		$score = 0;
		$note  = null;
		$level = null;

		if(isset($_detail['content']) && is_string($_detail['content']))
		{
			$content = strip_tags($_detail['content']);
			$content = preg_replace("/\؟/", "?", $content);
			$content = preg_replace("/\?{2,}/", "?", $content);
			$content = preg_replace("/!{2,}/", "!", $content);
			$content = preg_replace("/\.{2,}/", ".", $content);

			$totla_words = self::_get_word_count($content);

			$analyze_sentences = self::analyze_sentences($_detail);
			$total_sentences = $analyze_sentences['count'];


			$analyze_syllables = self::analyze_syllables($_detail);
			$total_syllables = $analyze_syllables['count'];


			$score = 206.835 - 1.015 * ($totla_words / $total_sentences) - 84.6 * ($total_syllables / $totla_words);


			if($score > 90)
			{
				$level = '5th grade';
				$note = T_('Very easy to read. Easily understood by an average 11-year-old student.');
			}
			elseif($score <= 90 && $score > 80)
			{
				$level = '6th grade';
				$note = T_('Easy to read.');
			}
			elseif($score <= 80 && $score > 70)
			{
				$level = '7th grade';
				$note = T_('Fairly easy to read.');
			}
			elseif($score <= 70 && $score > 60)
			{
				$level = '8th & 9th grade';
				$note = T_('Plain English. Easily understood by 13- to 15-year-old students.');
			}
			elseif($score <= 60 && $score > 50)
			{
				$level = '10th to 12th grade';
				$note = T_('Fairly difficult to read.');
			}
			elseif($score <= 50 && $score > 30)
			{
				$level = 'College';
				$note = T_('Difficult to read.');
			}
			elseif($score <= 30 && $score > 10)
			{
				$level = 'College graduate';
				$note = T_('Very difficult to read. Best understood by university graduates.');
			}
			elseif($score <= 10)
			{
				$level = 'Professional';
				$note = T_('Extremely difficult to read. Best understood by university graduates.');
			}


		}


		$result =
		[
			'ok'    => $ok,
			'score' => $score,
			'level' => $level,
			'msg'   => $note,
			'rate'  => 0,

		];

		return $result;
	}



	private static function analyze_tags($_detail)
	{
		$ok      = false;
		$percent = 0;
		$count   = 0;
		$msg     = T_("It is better to use a keyword");


		if(isset($_detail['tags']) && is_array($_detail['tags']) && $_detail['tags'])
		{
			$ok  = null;
			$msg = T_("The keyword used in the text could not be found");

			if(isset($_detail['content']) && is_string($_detail['content']))
			{
				foreach ($_detail['tags'] as $key => $value)
				{
					$count += substr_count($_detail['content'], $value['title']);
				}

				$totla_words = self::_get_word_count($_detail['content']);

				if(!$totla_words)
				{
					$totla_words = 1;
				}

				$percent = round(($count * 100) / $totla_words, 2);

				$ok = true;
				if($percent > 100)
				{
					$percent = 100;
				}

				if($percent <= 0)
				{
					$ok = null;
					$percent = 0;
				}

				$msg = T_("The frequency of use of the keyword in the text is :val percent and count use keyword in your content is :count", ['val' => \dash\fit::number($percent), 'count' => \dash\fit::number($count)]);
			}
		}


		$result =
		[
			'ok'      => $ok,
			'percent' => $percent,
			'count'   => $count,
			'msg'     => $msg,
			'rate'    => 1,
		];


		return $result;
	}


	private static function analyze_seodesc($_detail)
	{
		$ok      = false;
		$count   = 0;
		$msg     = T_("The seo description is not set");

		if(isset($_detail['seodesc']) && is_string($_detail['seodesc']))
		{
			$ok  = null;
			$msg = T_("The seo description is set but not tags founded");

			if(isset($_detail['tags']) && is_array($_detail['tags']) && $_detail['tags'])
			{
				$ok  = null;
				$msg = T_("It is better to use keywords in the text of social networking");

				if(isset($_detail['seodesc']) && is_string($_detail['seodesc']))
				{
					foreach ($_detail['tags'] as $key => $value)
					{
						$count += substr_count($_detail['seodesc'], $value['title']);
					}

					if($count >= 1)
					{
						$ok = true;
						$msg = T_("Very good. Keywords are used in the social media sharing text");
					}

				}
			}
		}


		$result =
		[
			'ok'    => $ok,
			'count' => $count,
			'msg'   => $msg,
			'rate'  => 1,
		];


		return $result;
	}

	private static function analyze_tags_in_first_paragraph($_detail)
	{
		$ok      = false;
		$count   = 0;
		$msg     = T_("Tags not use in first paragraph");

		if(isset($_detail['content']) && is_string($_detail['content']))
		{
			$ok  = null;
			$msg = T_("No tag added and not use in first paragraph");

			if(isset($_detail['tags']) && is_array($_detail['tags']) && $_detail['tags'])
			{
				$ok  = null;
				$msg = T_("Tags not use in first paragraph");

				$paragraphs = preg_split("/\n|\<br\s?\/?\>|\<\/p\>/", $_detail['content']);
				if(isset($paragraphs[0]))
				{
					foreach ($_detail['tags'] as $key => $value)
					{
						$count += substr_count($paragraphs[0], $value['title']);
					}

					if($count >= 1)
					{
						$ok = true;
						$msg = T_("Very good. Keywords are used in the first paragraph");
					}
				}
			}
		}

		$result =
		[
			'ok'   => $ok,
			'msg'  => $msg,
			'rate' => 1,
		];

		return $result;
	}




	private static function analyze_title_tag($_detail)
	{
		$ok      = false;
		$count   = 0;
		$msg     = T_("The title is not set");

		if(isset($_detail['title']) && is_string($_detail['title']))
		{
			$ok  = null;
			$msg = T_("The title is set but not tags founded");

			if(isset($_detail['tags']) && is_array($_detail['tags']) && $_detail['tags'])
			{
				$ok  = null;
				$msg = T_("It is better to use keywords in the title");

				if(isset($_detail['title']) && is_string($_detail['title']))
				{
					foreach ($_detail['tags'] as $key => $value)
					{
						$count += substr_count($_detail['content'], $value['title']);
					}

					if($count >= 1)
					{
						$ok = true;
						$msg = T_("Very good. Keywords are used in the title");
					}

				}
			}
		}


		$result =
		[
			'ok'    => $ok,
			'count' => $count,
			'msg'   => $msg,
			'rate'  => 1,
		];


		return $result;
	}



	private static function analyze_mobile_friendly($_detail)
	{
		$ok      = true;
		$msg     = T_("very good. The website is fully responsive and specially displayed on mobile");

		$result =
		[
			'ok'   => $ok,
			'msg'  => $msg,
			'rate' => 1,
		];

		return $result;
	}


	private static function analyze_sitemap($_detail)
	{
		$ok      = true;
		$msg     = T_("Your post is indexed in sitemap");

		$result =
		[
			'ok'   => $ok,
			'msg'  => $msg,
			'rate' => 1,
		];

		return $result;
	}

	private static function analyze_favicon($_detail)
	{
		if(\lib\store::logo())
		{
			$ok  = true;
			$msg = T_("Your website favicon is set");
		}
		else
		{
			$ok  = false;
			$msg = T_("Your website favicon is not set");
		}

		$result =
		[
			'ok'   => $ok,
			'msg'  => $msg,
			'rate' => 1,
		];

		return $result;
	}


}
?>