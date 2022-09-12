<?php
namespace lib\app\plan;

interface plan
{

	/**
	 * The plan key,
	 *
	 * @return string
	 * @example free, gold ...
	 */
	public function name() : string;


	/**
	 * Plan title
	 *
	 * @return string
	 * @example Free, ...
	 */
	public function title() : string;


	/**
	 * public | enterprise
	 *
	 * @return string
	 */
	public function type() : string;


	/**
	 * The plan price in IRT currency
	 *
	 * @return int
	 */
	public function priceIRT() : int;


	/**
	 * Plan description
	 *
	 * @return string
	 */
	public function description() : string;


	/**
	 * Contain caller key use in code
	 *
	 * @return array
	 * @example ['advance_discount', 'advance_report' , ...]
	 */
	public function contain() : array;


	public function smsCost() : int;


	/**
	 * Max file size in upload in MB
	 *
	 * @return int
	 */
	public function maxFileUploadSize() : int;


	/**
	 * Total storage limit in MB
	 *
	 * @return int
	 */
	public function totalStorageSize() : int;


	public function staffAccountCount() : int;

}
