<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Carbon\Carbon;

trait Datetime
{
    public function getWeekDay($datetime = null, string $type = 'short', string $lang = 'vi')
    {
        $weekMap = [
            0 => [
                'vi'=>['short'=>'CN','full' => 'Chủ nhật']
            ],
            1 => [
                'vi'=>['short'=>'T2','full' => 'Thứ 2']
            ],
            2 => [
                'vi'=>['short'=>'T3','full' => 'Thứ 3']
            ],
            3 => [
                'vi'=>['short'=>'T4','full' => 'Thứ 4']
            ],
            4 => [
                'vi'=>['short'=>'T5','full' => 'Thứ 5']
            ],
            5 => [
                'vi'=>['short'=>'T6','full' => 'Thứ 6']
            ],
            6 => [
                'vi'=>['short'=>'T7','full' => 'Thứ 7']
            ],
        ];
        if(empty($datetime)){
            $datetime = Carbon::now();
        } elseif (is_string($datetime)) {
            $datetime = Carbon::create($datetime);
        }
        $dayOfTheWeek = $datetime->dayOfWeek;
        $byLang = $weekMap[$dayOfTheWeek][$lang] ?? [];
        return $byLang[$type] ?? '';
    }
}
