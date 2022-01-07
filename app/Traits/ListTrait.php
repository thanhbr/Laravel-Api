<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Carbon\Carbon;

trait ListTrait
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public static function getListKVByPrefix($prefix = null, $atribute = 'name')
    {
        $list = [];
        try {
            $collection = is_null($prefix) ? self::All() : self::where('prefix', $prefix)->get();
            foreach ($collection as $key => $_item) {
                $list[$_item->id] = $_item->__get($atribute);
            }
        } catch (Exception $e) {
            logger($e);
        }
        return $list;
    }
}
