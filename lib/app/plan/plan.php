<?php
namespace lib\app\plan;

interface plan 
{

	/**
	 * The plan key,
	 * @example free, gold ...
	 * @return string
	 */
    public function name(): string;


	/**
	 * Plan title
	 * @example Free, ...
	 * @return string
	 */
    public function title(): string;


	/**
	 * public | enterprise
	 * @return string
	 */
    public function type(): string;


	/**
	 * The plan price in IRT currency
	 * @return int
	 */
	public function  priceIRT() : int;

	/**
	 * Plan description
	 * @return string
	 */
    public function description(): string;


	/**
	 * Contain caller key use in code
	 * @example ['advance_discount', 'advance_report' , ...]
	 * @return array
	 */
    public function contain() : array;

}
