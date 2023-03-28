<?php
/**
 * Created by PhpStorm.
 * User: zhounan
 * Date: 2023-03-27
 * Time: 16:25
 */

namespace App\Http\Controllers;


use App\Http\Models\RewardModel;
use App\Http\Services\ActivityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LotteryController extends Controller
{
    /**
     * Notes: 抽奖
     * User: zhounan
     * Date: 2023-03-27
     * Time: 16:28
     */
    public function draw(Request $request)
    {
        // 传活动id
        $activityId = $request->id;
        if (!$activityId) {
            return response()->json([
                'code' => 20001,
                'msg' => '参数错误',
            ]);
        }
        // 用户登录状态

        // 判断当前用户是否有权限抽奖

        // 判断当前时间是否有正在进行的活动
        $activity = ActivityService::getInstance()->getActvityBy($activityId, time());
        if (!$activity) {
            return $this->apiReturn(20001, [], '没有此活动');
        }

        // 判断当前活动是否已参加


        // 判断当前活动奖品是否有剩余

        // 剩余减

        // 抽奖日志记日志

        // 记mq

    }

    /**
     * Notes: 库存直接减的方式
     * User: zhounan
     * Date: 2023-03-28
     * Time: 16:21
     */
    public function sqlWay()
    {
        $reward = RewardModel::query()
            ->where('id', 1)
            ->first()
        ;
        if ($reward->num < 1) {
            return $this->apiReturn(20002, [], '秒杀空了');
        }

        // 减库存返回成功
        $reward->num = $reward->num-1;
        $reward->save();

        return $this->apiReturn(200, [$reward->num]);
    }

    public function sqlWay1()
    {
        $res = RewardModel::query()
            ->where('id', 1)
            ->where('num', '>', 0)
            ->decrement('num')
        ;
        if ($res) {
            $reward = RewardModel::query()->find(1);
            return $this->apiReturn(200, [$reward->num], '', true);
        }

        return $this->apiReturn(20022, [], '啥也没了', true);
    }
}
