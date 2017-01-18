<?php
/**
 * @link      https://dukt.net/craft/twitter/
 * @copyright Copyright (c) 2016, Dukt
 * @license   https://dukt.net/craft/twitter/docs/license
 */

namespace Craft;

class TwitterHelper
{
    // Public Methods
    // =========================================================================

    /**
     * Returns a user image from a twitter user ID for given size. Default size is 48.
     *
     * @param int $twitterUserId
     * @param int $size
     * @return string|null
     */
    public function getUserProfileImageResourceUrl($twitterUserId, $size = 48)
    {
        return UrlHelper::getResourceUrl('twitteruserimages/'.$twitterUserId.'/'.$size);
    }

    /**
     * Format a duration in PHP Date Interval format (to seconds by default)
     */
    public static function formatDuration($cacheDuration, $format='%s')
    {
        $cacheDuration = new DateInterval($cacheDuration);
        $cacheDurationSeconds = $cacheDuration->format('%s');

        return $cacheDurationSeconds;
    }

    /**
     * Format Time in HH:MM:SS from seconds
     *
     * @param int $seconds
     */
    public static function formatTime($seconds)
    {
        return gmdate("H:i:s", $seconds);
    }

	public static function timeAgo($date)
	{
		if(is_string($date))
		{
			$date = new DateTime($date);
		}

		$now = new DateTime();

		$difference = $now->getTimestamp() - $date->getTimestamp();

		$durations = self::secondsToHumanTimeDuration($difference, true, false);

		$duration = Craft::t("{duration} ago", ['duration' => $durations[0]]);

		return $duration;
	}

	/**
	 * @param int  $seconds     The number of seconds
	 * @param bool $showSeconds Whether to output seconds or not
	 * @param bool $implodeComponents Whether to implode components or not for return
	 *
	 * @return string|array
	 */
	public static function secondsToHumanTimeDuration($seconds, $showSeconds = true, $implodeComponents = true)
	{
		$secondsInWeek   = 604800;
		$secondsInDay    = 86400;
		$secondsInHour   = 3600;
		$secondsInMinute = 60;

		$weeks = floor($seconds / $secondsInWeek);
		$seconds = $seconds % $secondsInWeek;

		$days = floor($seconds / $secondsInDay);
		$seconds = $seconds % $secondsInDay;

		$hours = floor($seconds / $secondsInHour);
		$seconds = $seconds % $secondsInHour;

		if ($showSeconds)
		{
			$minutes = floor($seconds / $secondsInMinute);
			$seconds = $seconds % $secondsInMinute;
		}
		else
		{
			$minutes = round($seconds / $secondsInMinute);
			$seconds = 0;
		}

		$timeComponents = array();

		if ($weeks)
		{
			$timeComponents[] = $weeks.' '.($weeks == 1 ? Craft::t('week') : Craft::t('weeks'));
		}

		if ($days)
		{
			$timeComponents[] = $days.' '.($days == 1 ? Craft::t('day') : Craft::t('days'));
		}

		if ($hours)
		{
			$timeComponents[] = $hours.' '.($hours == 1 ? Craft::t('hour') : Craft::t('hours'));
		}

		if ($minutes || (!$showSeconds && !$weeks && !$days && !$hours))
		{
			$timeComponents[] = $minutes.' '.($minutes == 1 ? Craft::t('minute') : Craft::t('minutes'));
		}

		if ($seconds || ($showSeconds && !$weeks && !$days && !$hours && !$minutes))
		{
			$timeComponents[] = $seconds.' '.($seconds == 1 ? Craft::t('second') : Craft::t('seconds'));
		}

		if($implodeComponents)
		{
			return implode(', ', $timeComponents);
		}
		else
		{
			return $timeComponents;
		}
	}
}
