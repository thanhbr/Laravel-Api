<?php
namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use \Exception;
use \Throwable;
class Import extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'import';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are hidden.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        // 'type',
        // 'status',
        'data_json',
        'row_success',
        'row_failed',
        'row_total',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'            => 'integer',
        'user_id'       => 'string',
        'type'          => 'string',
        'status'        => 'string',
        'row_success'   => 'integer',
        'row_failed'    => 'integer',
        'row_total'     => 'integer',
    ];
    /**/
    private static $status_list = [];
    
    function __construct($attributes = []){
        parent::__construct($attributes);
    }
    
    /**
     * @author toannguyen
     * @todo get status
     * @param $key = null
     * @param array $option = []
     * @return string
    */
    public static function getStatus($key = null, array $option = [])
    {
        return self::$status_list[$key] ?? null;
    }
    /**
     * @author toannguyen
     * @todo get status list
     * @param $key = null
     * @param array $option = []
     * @return array
    */
    public static function getStatusList(array $option = [])
    {
        return (array)self::$status_list;
    }
}
