<?php

namespace App\Traits;

use Illuminate\Support\Str;
use App\Models\Link;
use App\Traits\Slug;

trait HasLink
{
    use Slug;
    public function link()
    {
        return $this->morphOne(Link::class, 'belong');
    }

    function upLink()
    {
        $slug   =   $this->slug;
        
        return Link::create([
            'pretty'      =>  static::slug(empty($this->$slug) ? $this->code : $this->$slug),
            'belong_type' =>  get_class($this),
            'belong_id'   =>  $this->id
        ]);
    }
    function dropLink()
    {
        $this->link->delete();
    }
    /**
     * 
     * @return URL
     */
    function route($action = null, $tables = null)
    {
        $tables = $tables ?? $this->table ?? $this->table_alias ?? '';
        $actionList = [
            'index'     => $tables.'.index',
            'create'    => $tables.'.create',
            'store'     => $tables.'.store',
            'show'      => $tables.'.show',
            'edit'      => $tables.'.edit',
            'update'    => $tables.'.update',
            'destroy'   => $tables.'.destroy',
            'back'      => '',
            'export'    => $tables.'.export',
            'import'    => $tables.'.import',
        ];
        return $actionList[$action] ? route($actionList[$action], $this->__get('id')) : '';
    }
        /**
    * 
    * @return URL
    */
   function url($action = null, $table = null)
    {   
        $tables = $tables ?? $this->table ?? $this->table_alias ?? '';
        $actionList = [
            'index'     => '/'.$tables,
            'create'    => '/'.$tables.'/create',
            'store'     => '/'.$tables,
            'show'      => '/'.$tables.'/'.$this->id,
            'edit'      => '/'.$tables.'/'.$this->id.'/edit',
            'update'    => '/'.$tables.'/'.$this->id,
            'destroy'   => '/'.$tables.'/'.$this->id,
            'back'      => back()->getTargetUrl(),
            'export'    => '/'.$tables.'/export',
            'import'    => '/'.$tables.'/import',
        ];
        return $actionList[$action] ? url($actionList[$action]) : '';
    }
}
