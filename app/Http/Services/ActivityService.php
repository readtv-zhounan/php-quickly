<?php
/** * Created by PhpStorm.
 * User: zhounan
 * Date: 2023-03-28
 * Time: 09:54
 */

namespace App\Http\Services;


use App\Http\Models\ActivityModel;

class ActivityService
{
    private static $_instance;

    /**
     * Notes:
     * User: zhounan
     * Date: 2023-03-28
     * Time: 09:58
     * @return ActivityService
     */
    public static function getInstance(): ActivityService
    {
        // 单例模式的访问接口，通过访问此方法，返回由静态属性 $_instance 管理的具体的搜索对象实例
        //返回的是调用此方法的类对象的实例
        if (empty(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Notes: 获取当前是否有正在进行的活动
     * User: zhounan
     * Date: 2023-03-28
     * Time: 09:57
     */
    public function hasActivityCurrent($activityId)
    {
        // 判断活动是否存在

    }

    /**
     * Notes: 获取活动
     * User: zhounan
     * Date: 2023-03-28
     * Time: 10:13
     * @param $id
     * @param string $time
     */
    public function getActvityBy($id, $time = '', $status = 1, $selects = [])
    {
        $query = ActivityModel::query()
            ->where('id', $id)
            ->where('status', $status)
        ;
        if ($selects) {
            $query->select($selects);
        }
        if ($time) {
            $query->where('start_time', '<=', $time)
                ->where('end_time', '>=', $time);
        }
        return $query->limit(1)->get()->toArray();
    }
}
