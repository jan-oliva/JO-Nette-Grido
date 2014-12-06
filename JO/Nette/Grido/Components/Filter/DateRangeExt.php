<?php

namespace JO\Nette\Grido\Components\Filters;

use Grido\Components\Container;
use Grido\Components\Filters\DateRange;
use Nette\Utils\Strings;
use Grido\Grid;
use Nette\Diagnostics\Debugger;
use Nette\Diagnostics\Dumper;

/**
 * Description of DateRange
 * Extends to possibility single date value or empty string
 *
 * @author Jan Oliva
 */
class DateRangeExt extends DateRange
{
	/** @var string */
    protected $maskSingle = '/(.*)\s?/';

	/**
	 * register method Grido\Components\Container::addFilterDateRangeExt()
	 * @return type
	 */
	public static function register()
	{
		Container::extensionMethod('addFilterDateRangeExt',function(Grid $grid,$colName,$label){
			return new static($grid,$colName,$label);
		});
	}

	/**
	 * Condition accepts single date or empty string
	 * @param type $value
	 * @return string
	 */
	public function __getCondition($value)
	{
		$aa = Strings::match($value, $this->mask); //not two dates
		$single = Strings::match($value, $this->maskSingle); //single date
		if($aa === null && $single !== null){
			if($value == ""){
				return "";
			}
			$dtm = \DateTime::createFromFormat($this->dateFormatInput, trim($value));
			$condition = \Grido\Components\Filters\Condition::setup($this->getColumn(), "= ?", $dtm->format($this->dateFormatOutput[0]));
			return $condition;
		}
		return parent::__getCondition($value);
	}

	/**
	 *
	 * @param string $maskSingle patter for single date value
	 * @return \JO\Nette\Grido\Components\Filters\DateRangeExt
	 */
	public function setMaskSingle($maskSingle)
	{
		$this->maskSingle = $maskSingle;
		return $this;
	}
}
