<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
// use App\Models;
class ActionModel extends Component
{
    /**
     * @author toannguyen.dev
     * @todo 
     * @version 1.0.1
     */
    public $tagHTML;
    public $model;
    private $type;
    private $data;
    private $tableRoute;

    private static $typelist = [
        'create' =>[
            'attr' => ['class'=>'pr-1 btn-action btn-create', 'href'=>'', 'title'=>'Tạo mới'],
            'icon'  => 'fa ',
            'label' => 'create',
        ],
        'show' =>[
            'attr' => ['class'=>'pr-1 btn-action btn-show', 'href'=>'', 'title'=>'Chi tiết'],
            'icon'  => 'fa fa-eye',
            'label' => 'show',
        ],
        'edit' =>[
            'attr' => ['class'=>'pr-1 btn-action btn-edit', 'href'=>'', 'title'=>'Chỉnh sửa'],
            'icon'  => 'fa fa-pencil',
            'label' => 'edit',
        ],
        'delete' =>[
            'attr' => ['class'=>'pr-1 btn-action btn-delete', 'href'=>'', 'title'=>'Xóa'],
            'icon'  => 'fa fa-trash',
            'label' => 'delete',
        ],
    ];

    function __construct(Model $Model){
        $this->model = $Model;
        $this->tableRoute = !is_null($this->model->table_alias) ? $this->model->table_alias : $this->model->getTable();
    }
    /**
    * 
    * @return string Get the table associated with the model.
    */
    public function getTableRoute(){return $this->tableRoute;}
    /**
    * Set the table associated with the model.
    *
    * @param  string $table
    * @return $this
    */
    public function setTableRoute(string $tableName)
    {
        $this->tableRoute = $tableName;
        return $this;
    }
    /**
    * Set a action on the model.
    *
    * @param  string $type
    * @param   string $accName = null
    * @param  string $title = null
    * @return $this
    */
    public function setAction(string $accType, string $accName = null, string $title = null, string $label = null)
    {
        $attributes = self::$typelist[$accType] ?? [];
        if (!is_null($accName)) $attributes['label'] = $accName;
        if (!is_null($title)) $attributes['attr']['title'] = $title;
        $table_slug = $this->tableRoute;
        switch ($accType) {
            case 'create':
                $attributes['attr']['href'] = url($table_slug.'/create');
                break;
            case 'show':
                $attributes['attr']['href'] = url($table_slug.'/'.$this->model->id);
                break;
            case 'edit':
                $attributes['attr']['href'] = url($table_slug.'/'.$this->model->id.'/edit');
                break;
            case 'destroy': case 'delete':
                $attributes['attr']['href'] = url($table_slug.'/'.$this->model->id);
                $label = !is_null($label) ? $label : $this->model->code ?? $this->model->id;
                $label = empty($label) ? '' : ' ('.$label.')';
                $attributes['attr']['label'] = __('titles.'.$this->model->getTable()) . $label;
                break;
            default:
                break;
        }
        $this->data[$accType] = $attributes;
        return $this;
    }
    public function modify(string $accType, $value)
    {
        
    }
    /**    
    * @return String URL Show mdoel
    */
    public function getAction()
    {
        

    }
    /*end set and get*/
    /**
    * @param  array $pieces
    * @param  string $glueCombine default '='
    * @param  string $glueQuoteKey
    * @param  string $glueQuoteVal
    * @return $this
    */
    private function attrToString(array $pieces, $glueCB = '=', $glueQK = '', $glueQV = '"'):string
    {
        return implode(' ',
            array_map(
                function ($v, $k, $c, $qk, $qv) {
                    if (preg_match('/required|hidden|multiple|readonly/', $k))return $qk.$k;
                    if (preg_match('/required|hidden|multiple|readonly/', $v))return $qk.$v;
                    return $qk.$k.$qk.$c.$qv.$v.$qv;
                },
                $pieces, 
                array_keys($pieces),
                array_fill_keys(array_keys($pieces), $glueCB),
                array_fill_keys(array_keys($pieces), $glueQK),
                array_fill_keys(array_keys($pieces), $glueQV),
            )
        );
    }
    public function toArray()
    {
        return $this->data;
    }
    public function toHTML()
    {
        $html = [];
        foreach ((array)$this->data as $_type => $_attributes) {
            $html[] = $this->getTypeHTML($_type);
        }
        return $html;
    }
    public function getTypeHTML($type)
    {
        $attributes = $this->data[$type];
        $attrString = $this->attrToString($attributes['attr'] ?? []);
        $iconString = $attributes['icon'] ?? '';
        $label      = $attributes['label'] ?? '';
        return '<a '.$attrString.' href=""><span class="fonticon-wrap-"><i class="'.$iconString.'"></i></span>'.$label.'</a>';
    }
     /**
     * 
     *
     * @return 
     */
    public function render(string $viewPath = null)
    {        
        
    }
}
