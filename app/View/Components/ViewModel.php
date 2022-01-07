<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use Illuminate\Support\Str;
use App\Traits\{Datetime};
class ViewModel extends Component
{
    use Datetime;
    /**
     * @author toannguyen.dev
     * @todo 
     * @version 1
     */
    public $tagHTML;
    public $viewPath;
    public $layoutPath;
    public $hiddenDefault = [];
    public $guardedDefault = ['id','created_at', 'updated_at', 'updated_user', 'deleted_at-'];

    private $visible = [];
    private $model;
    private $type;
    private $data;
    private $tableRoute;

    const TYPELIST = ['index','create', 'edit', 'show'];
    const PATENTINPUT = ['tag', 'label', 'value', 'attr', 'option', 'attr_str'];

    function __construct($model, string $type ='create'){
        $this->model = is_string($model) ? new $model : $model;
        $this->tableRoute = strtolower((string)$this->model->table_alias ?: $this->model->getTable());
        $this->type = $type;
        $this->tagHTML = 'div';
        $this->viewPath = '';
        $this->layoutPath = 'layouts.' . (request()->input('layout') ?? 'default');
        $this->model->setHidden(array_unique(array_merge($this->hiddenDefault, $this->model->getHidden())));
        $this->model->guard(array_unique(array_merge($this->guardedDefault, $this->model->getGuarded())));
        $this->ini();
    }
    private function ini()
    {
        foreach ($this->model->getFillable() as $key => $_attr) {
            $this->visible[$_attr] = array_fill_keys(self::PATENTINPUT, NULL);
            $this->visible[$_attr]['tag'] = 'input';
            $this->visible[$_attr]['label'] = $_attr;
            $this->visible[$_attr]['value'] = $this->model->__get($_attr);
            $this->visible[$_attr]['attr']['name'] = $_attr;
            // $this->visible[$_attr]['attr']['class'] = $this->attrToClassName($_attr);
            
            if(in_array($_attr, $this->model->getHidden())){$this->visible[$_attr]['attr']['hidden'] = true;}
            if(in_array($_attr, $this->model->getGuarded())){$this->visible[$_attr]['attr']['guard'] = true;}
            switch ($this->type) {
                case 'index':
                    break;
                case 'show':
                    $this->visible[$_attr]['tag'] = 'span';
                    break;
                case 'create': case 'edit':
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
    /**
    * 
    * @return 
    */
    public function set(string $key, $value)
    {
        return $this->model->__set($key, $value);
    }
    /**
    * 
    * @return string Get the attribute of the model.
    */
    public function get(string $key)
    {
        return $this->model->__get($key);
    }
    public function setBackLink($param = null, $option = 'url')
    {
        if (is_null($param)) {
            return ['href' => back()->getTargetUrl(), 'label' => __('titles.back-page')];
        }else{
            
        }
    }
    /**
    * @param string $action = null, 
    * @param $option = 'url'
    * @return string link.
    */
    public function getLink(string $action = null, $option = 'url', $tables = null)
    {
        $action = is_null($action) ? $this->type : $action;
        $tables = $tables ?? $this->tableRoute;
        $id = $this->model->__get('id');
        $actionLink = [
            'index'     => ['url' => '/'.$tables, 'route' =>$tables.'.index'],
            'create'    => ['url' => '/'.$tables.'/create', 'route' =>$tables.'.create'],
            'store'     => ['url' => '/'.$tables, 'route' => $tables.'.store'],
            'show'      => ['url' => '/'.$tables.'/'.$id, 'route' => $tables.'.show'],
            'edit'      => ['url' => '/'.$tables.'/'.$id.'/edit', 'route' => $tables.'.edit'],
            'update'    => ['url' => '/'.$tables.'/'.$id, 'route' => $tables.'.update'],
            'destroy'   => ['url' => '/'.$tables.'/'.$id, 'route' => $tables.'.destroy'],
            'back'      => ['url' => back()->getTargetUrl(), 'route' => ''],
            'export'    => ['url' => '/'.$tables.'/export', 'route' => $tables.'.export'],
            'import'    => ['url' => '/'.$tables.'/import', 'route' => $tables.'.import'],
        ];
        $href = $actionLink[$action][$option] ?? '';
        return $option === 'url' ? url($href) : ($href);
    }
    /**
    * 
    * @return url and check route
    */
    public function route($action = null, $tables = null)
    {
        $action = is_null($action) ? $this->type : $action;
        $tables = $tables ?? $this->tableRoute;
        $id = $this->model->__get('id');
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
        return $actionList[$action] ? route($actionList[$action], $id) : '';
    }
    /**
    * 
    * @return url
    */
   public function url($action = null, $tables = null)
    {
        $action = is_null($action) ? $this->type : $action;
        $tables = $tables ?? $this->tableRoute;
        $id = $this->model->__get('id');
        $actionList = [
            'index'     => '/'.$tables,
            'create'    => '/'.$tables.'/create',
            'store'     => '/'.$tables,
            'show'      => '/'.$tables.'/'.$id,
            'edit'      => '/'.$tables.'/'.$id.'/edit',
            'update'    => '/'.$tables.'/'.$id,
            'destroy'   => '/'.$tables.'/'.$id,
            'back'      => back()->getTargetUrl(),
            'export'    => '/'.$tables.'/export',
            'import'    => '/'.$tables.'/import',
        ];
        return $actionList[$action] ? url($actionList[$action]) : '';
    }
    /**
    * 
    * @return string Get the table associated with the model.
    */
    public function getTable(){return $this->model->getTable();}
    /**
    * Set the table associated with the model.
    *
    * @param  string $table
    * @return $this
    */
    public function setTable(string $table)
    {
        $this->model->setTable($table);
        return $this;
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
    * Set a given attribute on the model.
    *
    * @param  string $attribute
    * @param  string $tagHTML
    * @return $this
    */
    public function setTagHTML(string $attribute, string $tagHTML)
    {
        $this->visible[$attribute]['tag'] = $tagHTML;
        return $this;
    }
    /**
    * Set a label given of attribute on the view model.
    *
    * @param  string $attribute
    * @param  string $label
    * @return $this
    */
    public function setLabel(string $attribute, string $label)
    {
        $this->visible[$attribute]['label'] = $label;
        return $this;
    }
    /**
    * Set a given attribute on the model.
    *
    * @param  string $attribute
    * @param  mixed  $value
    * @return $this
    */
    public function setValue(string $attribute, $value)
    {
        $this->visible[$attribute]['value'] = $value;
        return $this;
    }
    public function getValue(string $attribute)
    {
        return $this->visible[$attribute]['value'] ?? null;
    }
    /**
    * Set a given attribute on the model.
    *
    * @param  string $attribute
    * @param  array $attrValue
    * @return $this
    */
    public function setAttr(string $attribute, array $attrValue)
    {
        $this->visible[$attribute]['attr'] = $attrValue;
        return $this;
    }
    /**
    * Set a given attribute on the model.
    *
    * @param  string $attribute
    * @param  mixed  $attrValue
    * @return $this
    */
    public function setOption(string $attribute, $attrValue)
    {
        $this->visible[$attribute]['option'] = $attrValue;
        return $this;
    }
    /**
     * Get a attributes of model
     * @author 
     * @param string $property
     * @return mixed
    */
    public function setProperty(string $property, $value)
    {
        $this->visible[$property] = $value;
        return $this;
    }
    /**
     * Get a attributes of model
     * @author 
     * @param string $property
     * @param string $atribute
     * @return mixed|null
    */
    public function getProperty(string $property, string $atribute = null)
    {
        if (isset($this->visible[$property]) && !is_null($atribute)) {
            return $this->visible[$property][$atribute] ?? null;
        }
        return $this->visible[$property] ?? null;
    }
    /**
    *| @author toannguyen.dev
    *| @todo get tag
    *| @return string
    */
    public function setReadonly($key)
    {
        
    }
    /**
    *| @author toannguyen.dev
    *| @todo get tag
    *| @return string
    */
    public function getTag():string{return $this->tagHTML;}
    /**
    *| @author toannguyen.dev
    *| @todo set tag name
    *| @param string $tagHTML
    *| @return object
    */
    public function setTag(string $tagHTML):object
    {
        $this->tagHTML = $tagHTML; 
        return $this;
    }
    /**
    *| @author toannguyen.dev
    *| @todo 
    *| @param string $viewPath
    *| @return $this
    */
    public function setView(string $viewPath)
    {
        $this->viewPath = $viewPath;
        return $this;
    }
    /**
    *| @author toannguyen.dev
    *| @todo 
    *| @return object
    */
    public function getView():string{return $this->viewPath;}
    /**
    *| @author toannguyen.dev
    *| @todo 
    *| @param string $layoutPath
    *| @return $this
    */
    public function setLayout(string $layoutPath)
    {
        $this->layoutPath = $layoutPath;
        return $this;
    }
    /**
    *| @author toannguyen.dev
    *| @todo 
    *| @return object
    */
    public function getGuard()
    {
        return $this->model->getGuarded();
    }
    /**
    * Set the guarded attributes for the model.
    *
    * @param  array  $guarded
    * @return $this
    */
    public function setGuard(array $guarded)
    {
        $this->model->guard($guarded);
        $this->visible = array_diff_key($this->visible, array_flip($guarded));
        return $this;
    }
    /**
    * Set the hidden attributes for the model.
    *
    * @param  array  $hidden
    * @return $this
    */
    public function setHidden(array $hidden)
    {
        $this->model->setHidden($hidden);
        return $this;
    }
    public function setVisible(array $param, $option = null):object
    {
        $this->visible = [];
        foreach ($param as $_attr => $_attrValue) {
            $_patentInput = array_fill_keys(self::PATENTINPUT, NULL);
            if (is_string($_attrValue)) {
                $_attrValue = ['label' => $_attrValue];
            }
            foreach ($_attrValue['attr'] ?? [] as $__key => $__value) {
                if (!is_string($__key)) {
                    unset($_attrValue['attr'][$__key]);
                    $_attrValue['attr'][$__value] = $__key;
                }
            }
            $className = $_attrValue['attr']['class'] ?? '';
            $this->visible[$_attr] = array_merge($_patentInput, $_attrValue);
            $this->visible[$_attr]['attr']['name'] = $_attr;
            $this->visible[$_attr]['value'] = $_attrValue['value'] ?? $this->get($_attr);
        }
        return $this;
    }
    /**
    * @return $this
    */
    public function getVisible()
    {
        return $this->visible;
    }
    /**
    * @return String URL Show mdoel
    */
    public function getActionTool($type)
    {
        $typeList = [
            'show' =>[
                'class' => '',
                'icon'  => '',
                'label' => '',
            ],
            'edit' =>[
                'class' => '',
                'icon'  => '',
                'label' => '',
            ],
            'destroy' =>[
                'class' => '',
                'icon'  => '',
                'label' => '',
            ],
        ];
    }      
    /**
    *
    * @param  string $attribute
    * @return String
    */
    public function attrToClassName(string $attribute)
    {
        return ' form-control txt-' . str_replace('_', '-', $attribute);
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
    /**
     * @author toannguyen.dev
     * @todo array normalization
     * @param array &$list
     * @param $selected = null
     * @return $this 
     */
    public function attrToSelect(string $attr, array $list, $key_selected = null, $labelDefault = '-')
    {

        foreach ($list as $value => $label) {
            $element = ['value'=>'', 'selected'=>'', 'label'=>''];
            if (is_array($label) || is_object($label)) {
                return $this;
            } else{
                $element['value'] = $value;
                $element['label'] = $label;
                $element['selected'] = '';
                $list[$value] = $element;
            }
        }
        $list['_default'] = ['value'=>'', 'selected'=>'selected', 'label'=> $labelDefault];
        ksort($list);
        $key_selected = is_array($key_selected) ? $key_selected : explode(',',$key_selected);
        foreach ($key_selected as $key => $_key) {
            if (array_key_exists($_key, $list)) {
                $list[$_key]['selected'] = 'selected';
                $list['_default']['selected'] = '';
            }
        }
        if ($this->attrHas($attr, 'multiple,required')) {
            unset($list['_default']);
        }elseif($this->attrHas($attr, 'multiple')){
            $list['_default']['selected'] = '';
        }
        $this->visible[$attr]['option'] = $list;
        return $this;
    }
    public function attrToRadio(string $attr, array &$list, $checked = null, $labelDefault = 'hide')
    {
        if (is_null($checked)) {
            $checked = old($attr) ?? $this->visible[$attr]['value'] ?? null;
        }
        $this->toRadioTag($list, $checked, $labelDefault);
        $this->visible[$attr]['option'] = $list;
        return $this;
    }
    /**
    * @param  string $attribute
    * @param  string $key
    * @return boolean
    */
    public function attrHas(string $attr, string $keyStrList):bool
    {
        $keysArr = explode(',', $keyStrList);
        foreach ($keysArr as $_index => $_key) {
            if (!isset($this->visible[$attr]['attr'][$_key])) return false;
        }
        return true;
    }
    /**
    * @param  string $attribute
    * @return $this
    */
    public function isVisible(string $attribute)
    {
        return isset($this->{$attribute});
    }
    /**
    * @param  string $attribute
    * @return $this
    */
    public function translate($_patentInput = 'label', $_fileTrans = 'site')
    {
        foreach ($this->visible as $_attr => $_attrValue) {
            $oLang = $_attrValue[$_patentInput] ?? null;
            if(!is_string($oLang)) continue;
            $tLang = __($_fileTrans.'.'.$oLang);
            $tLang = str_replace($_fileTrans.'.', '', $tLang);
            $this->visible[$_attr][$_patentInput] = $tLang;
        }
        return $this;
    }
    /**
    * @param  $option = null
    * @return $this
    */
    public function toArray($option = null)
    {
        return $this->visible;
    }
    /**
    * translate by tran()
    * @param  array &$array
    * @return $this
    */
    public function toTrans(array &$atributes, $_fileTrans = 'site'):array
    {
        foreach ($atributes as $_index => $_kw) {
            $atributes[$_index] = str_replace($_fileTrans.'.', '', __($_fileTrans.'.'.$_kw));
        }
        return $atributes;
    }
    //---------------------------------------------------------------------------------
    /**
    *| @author toannguyen.dev
    *| @todo 
    *| @param string $glue
    *| @param array $pieces
    *| @param ?string $glueCombine = '='
    *| @param ?string $glueQuoteKey = ''
    *| @param ?string $glueQuoteVal = ''
    *| @return string
    *| @version 2.0
    */
    public static function implode_kv(string $glue, array $pieces, ?string $glueCombine = '=', ?string $glueQuoteKey = '', ?string $glueQuoteVal = ''):string
    {
        $glueCombineArr = array_fill_keys(array_keys($pieces), $glueCombine);
        $glueQuoteKeyArr = array_fill_keys(array_keys($pieces), $glueQuoteKey);
        $glueQuoteValArr = array_fill_keys(array_keys($pieces), $glueQuoteVal);
        return implode($glue,
            array_map(
                function ($v, $k, $c, $qk, $qv) {return $qk.$k.$qk.$c.$qv.$v.$qv;},
                $pieces, 
                array_keys($pieces),
                $glueCombineArr,
                $glueQuoteKeyArr,
                $glueQuoteValArr,
            )
        );
    }
    /**
    *| @author toannguyen.dev
    *| @todo sort by key of node child
    *| @param array 
    *| @param string keyword,..
    *| @return pass value of array
    *| @version 1
    */
    public static function toMSort(array &$array, array $sort = []) 
    {
        try{
            $ka = array_map('strtolower', array_keys($sort));
            foreach ($sort as $key => $value) {
                if (is_numeric($key)) {
                    $ik = array_search(strtolower((string)$key), $ka);
                    $sort = array_slice($sort, 0, $ik, true) 
                    + [$value => 1] + array_slice($sort, $ik+1, count($sort), true);
                }
            }
            usort($array, function($a, $b) use($sort) {
                $a = (array)$a;
                $b = (array)$b;
                $i = 0;
                $c = count($sort);
                $v = array_keys($sort);
                $s = array_values($sort);
                $cmp = 0;
                while($cmp == 0 && $i < $c){
                    $sa = $s[$i] === 1 ? 1: -1;
                    $cmp = $sa * strcmp((string) ($a[$v[$i]] ?? ''), (string) ($b[$v[$i]]??''));
                    $i++;
                }
                return $cmp;
            });
        } catch(Exception $e){}
        return $array;
    }
    /**
     * @author toannguyen.dev
     * @todo array normalization
     * @param array &$list
     * @param $selected = null
     * @return object 
     */
    public static function toCheckboxTag(array &$list, $key_checked = null, $labelDefault = '')
    {
        try {
            foreach ($list as $value => $label) {
                $element = ['value'=>'', 'checked'=>'', 'label'=>'', 'type'=>'checkbox'];
                if (is_array($label) || is_object($label)) {
                    return $this;
                } else{
                    $element['value'] = $value;
                    $element['label'] = $label;
                    $list[$value] = $element;
                }
            }
            // $list['_default'] = ['value'=>'', 'checked'=>'checked', 'label'=> $labelDefault];
            ksort($list);
            $key_checked = is_array($key_checked) ? $key_checked : explode(',',$key_checked);
            foreach ($key_checked as $key => $_key) {
                if (array_key_exists($_key, $list)) {
                    $list[$_key]['checked'] = 'checked';
                }
            }
        } catch (Exception $e) {
            logger($e);
        }
    }
    /**
     * @author toannguyen.dev
     * @todo array normalization
     * @param array &$list
     * @param $selected = null
     * @return object 
     */
    public static function toRadioTag(array &$list, $key_checked = null, $labelDefault = 'hide')
    {
        try {
            foreach ($list as $value => $label) {
                $element = ['value'=>'', 'checked'=>'', 'label'=>'', 'type'=>'radio'];
                if (is_array($label) || is_object($label)) {
                    return $this;
                } else{
                    $element['value'] = $value;
                    $element['label'] = $label;
                    $list[$value] = $element;
                }
            }
            $list['_default'] = ['value'=>'', 'checked'=>'checked', 'label'=> $labelDefault];
            ksort($list);
            $key_checked = is_array($key_checked) ? $key_checked : explode(',',$key_checked);
            foreach ($key_checked as $key => $_key) {
                if (array_key_exists($_key, $list)) {
                    $list[$_key]['checked'] = 'checked';
                    $list['_default']['checked'] = '';
                }
            }
            if ($labelDefault === 'hide') unset($list['_default']);
        } catch (Exception $e) {
            logger($e);
        }
    }
    /**
     * @author toannguyen.dev
     * @todo array normalization
     * @param array &$list
     * @param $selected = null
     * @return object 
     */
    public static function toSelectTag(array &$list, $key_selected = null, $labelDefault = '-')
    {
        foreach ($list as $value => $label) {
            $element = ['value'=>'', 'selected'=>'', 'label'=>''];
            if (is_array($label) || is_object($label)) {
                return $this;
            } else{
                $element['value'] = $value;
                $element['label'] = $label;
                $list[$value] = $element;
            }
        }
        $list['_default'] = ['value'=>'', 'selected'=>'selected', 'label'=> $labelDefault];
        ksort($list);
        $key_selected = is_array($key_selected) ? $key_selected : explode(',',$key_selected);
        foreach ($key_selected as $key => $_key) {
            if (array_key_exists($_key, $list)) {
                $list[$_key]['selected'] = 'selected';
                $list['_default']['selected'] = '';
            }
        }
        if ($labelDefault === 'hide' || is_null($labelDefault)) unset($list['_default']);
    }
    /**
    *| @author toannguyen.dev
    *| @todo set data
    *| @param mixed $key 
    *| @param mixed $value
    *| @return $this
    */
    public function with($key, $value = null)
    {
        if (is_array($key)) $this->data = array_merge((array)$this->data, $key);
        elseif(is_string($key)) $this->data[$key] = $value;
        return $this;
    }
     /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(string $viewPath = null)
    {
        if(!is_null($viewPath)) $this->viewPath = $viewPath;
        foreach ($this->visible as $_attr => $_attrValue) {
            $slugAttr = str_replace('_', '-', $_attr);
            $value = $_attrValue['value'] ?? null;
            $className = $_attrValue['attr']['class'] ?? '';
            if (in_array($_attr, $this->model->getGuarded())) {
                unset($this->visible[$_attr]);
                continue;
            }
            /**/
            if (array_key_exists('multiple', $_attrValue['attr'] ?? [])) {
                $this->visible[$_attr]['attr']['name'] = $_attr . '[]';
            }
            /**/
            $this->visible[$_attr]['attr']['class'] = $className .$this->attrToClassName($_attr);
            $this->visible[$_attr]['attr_str'] = $this->attrToString($this->visible[$_attr]['attr'] ?? []);
            
            $optionValue = (array)($_attrValue['option'] ?? null);
            if ($optionValue) {
                $this->attrToSelect($_attr, $optionValue, $value);
            }
        }
        $data = $this->data;
        $data['viewModel'] = $this;
        return view($this->layoutPath)->with(['view' => view($this->viewPath)->with($data)]);
    }
}
