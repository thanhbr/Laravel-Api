<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use App\Casts\Json;
use Auth;
use \Exception;
use \Throwable;

class Location extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

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
    protected $hidden = [];

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
        'id',
        'code',
        'name',
        'short_name',
        'note',
        'warehouse_goods_note_id',
        'type',
        'status',
        'package_product_group_id',
        'package_material_id',
        'package_dimension_id',
        'dim_length',
        'dim_width',
        'dim_height',
        'dim_unit',
        'weight',
        'weight_unit',
        'shipcode',
        'upc',
        'ean',
        'color',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
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
    /**
     * 
     * @todo get path store file
     * @return string
    */
    public function getPathStore():string
    {
        return  $this->table . DIRECTORY_SEPARATOR . Auth::user()->id . DIRECTORY_SEPARATOR;
    }
    /**
     * @author 
     * @todo get path store file
     * @return string
    */
    public function getPathFileUpload()
    {
        return (array) json_decode($this->path_file_upload);
    }
    public function removePathFileUpload(string $path_file_upload)
    {
        $pathArray = array_flip(json_decode($this->path_file_upload, true));
        unset($pathArray[$path_file_upload]);
        $this->path_file_upload = json_encode(array_keys($pathArray));
        return $this;
    }    
    /**
     * @author 
     * @todo get path store file
     * @return string
    */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by')->get()->first();
    }
}
