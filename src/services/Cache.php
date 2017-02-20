<?php
/**
 * @link      https://dukt.net/craft/twitter/
 * @copyright Copyright (c) 2017, Dukt
 * @license   https://dukt.net/craft/twitter/docs/license
 */

namespace dukt\twitter\services;

use Craft;
use yii\base\Component;
use dukt\twitter\helpers\TwitterHelper;

/**
 * Cache Service
 *
 * @author Dukt <support@dukt.net>
 * @since  3.0
 */
class Cache extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * Get cache
     *
     * @param $id
     *
     * @return mixed
     */
    public function get($id)
    {
        if(Craft::$app->getConfig()->get('enableCache', 'twitter') === true)
        {
            $cacheKey = $this->getCacheKey($id);

            return Craft::$app->cache->get($cacheKey);
        }
    }

    /**
     * Set cache
     *
     * @param      $id
     * @param      $value
     * @param null $expire
     * @param null $dependency
     *
     * @return mixed
     */
    public function set($id, $value, $expire = null, $dependency = null)
    {
        if(Craft::$app->getConfig()->get('enableCache', 'twitter') === true)
        {
            $cacheKey = $this->getCacheKey($id);

            if(!$expire)
            {
                $expire = Craft::$app->getConfig()->get('cacheDuration', 'twitter');
                $expire = TwitterHelper::formatDuration($expire);
            }

            return Craft::$app->cache->set($cacheKey, $value, $expire, $dependency);
        }
    }

    // Private Methods
    // =========================================================================

    /**
     * Get cache key
     *
     * @param array $request
     *
     * @return string
     */
    private function getCacheKey(array $request)
    {
        $dataSourceClassName = 'Twitter';

        unset($request['CRAFT_CSRF_TOKEN']);

        $request[] = $dataSourceClassName;

        $hash = md5(serialize($request));

        return substr('twitter'.$hash, 0, 32);
    }
}
