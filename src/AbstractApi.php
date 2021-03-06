<?php
namespace Katapoka\Ahgora;

use Katapoka\Ahgora\Contracts\IAhgoraApi;

/**
 * Class AbstractApi.
 */
abstract class AbstractApi implements IAhgoraApi
{
    use Loggable;

    /** @var string */
    protected $datetimeFormat = 'Y-m-d H:i:s';

    /**
     * Validate if the given month is valid.
     *
     * @param int $month
     *
     * @return bool
     */
    protected function isValidMonth($month)
    {
        return is_int($month) && ($month >= 1 && $month <= 12);
    }

    /**
     * Validate if the given year is "valid".
     *
     * @param int $year
     *
     * @return bool
     */
    protected function isValidYear($year)
    {
        return $year <= date('Y');
    }

    /**
     * Validate if the given period is valid.
     *
     * @param int $month
     * @param int $year
     *
     * @return bool
     */
    protected function isValidPeriod($month, $year)
    {
        return $this->isValidMonth($month) && $this->isValidYear($year) && !$this->isFutureDate($month, $year);
    }

    /**
     * Check if the given time period is in the future.
     *
     * @param int $month
     * @param int $year
     *
     * @return bool
     */
    private function isFutureDate($month, $year)
    {
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('m');

        return $year > $currentYear || ($year === $currentYear && $month > $currentMonth);
    }

    /**
     * Set the Datetime parse format. Default 'Y-m-d H:i:s'.
     *
     * @param $format
     *
     * @return $this
     */
    public function setDateTimeFormat($format)
    {
        $this->datetimeFormat = $format;

        return $this;
    }
}
