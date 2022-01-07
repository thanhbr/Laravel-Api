<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;
use Illuminate\Support\Str;
use App\Traits\{Datetime};

class FilterModel extends Component
{
    
    private $filterKeys = [];
    private $filterData = [];

    function __construct(){}

    /**
     * set value for keys
     * */
    public function setKey($keys, $value = null)
    {
        if (is_array($keys)) $this->filterKeys = $keys;
        elseif (is_string($keys)) $this->filterKeys[$keys] = $value;
        return $this;
    }
    /**
     * get value of keys
     * 
     */
    public function getKey($keys)
    {
        return $this->filterKeys[$keys] ?? null;
    }
    /**
     * to check keys was existed
     * 
     * 
      */
    public function hasKey($keys)
    {
        return isset($this->filterKeys[$keys]);
    }
    /**
     * to check empty keys
     * 
     */
    public function isEmptyData()
    {
        return empty($this->filterData);
    }
    /**
     * @author toannguyen.dev
     * @todo array normalization
     * @param array &$list
     * @param $selected = null
     * @return object 
     */
    public function with(string $attribute, array $list, $key_selected = null, $labelDefault = '-')
    {
        foreach ($list as $value => $label) {
            $element = ['value'=>'', 'selected'=>'', 'label'=>''];
            if (is_array($label) || is_object($label)) {return $this;} 
            else{
                $element['value'] = $value;
                $element['label'] = $label;
                $list[$value] = $element;
            }
        }
        $list['_default'] = ['value'=>'', 'selected'=>'selected', 'label'=> $labelDefault];
        ksort($list);
        $key_selected = is_array($key_selected) ? $key_selected : explode(',',$key_selected);
        foreach ($key_selected as $ki => $_key) {
            if (array_key_exists($_key, $list)) {
                $list[$_key]['selected'] = 'selected';
                $list['_default']['selected'] = '';
            }
        }
        if ($labelDefault === 'hide') unset($list['_default']);

        $this->filterData[$attribute] = $list;
        return $this;
    }
    public function toKeys(){return $this->filterKeys;}
    public function toData(){return $this->filterData;}
    /**
     * 
     * 
     */
    public function trans($list = [])
    {
        dd($this->filterData);
    }
    /**
    * @param  $option = null
    * @return array
    */
    public function toArray($option = null){return ['filterData' => $this->filterData, 'filterKeys' => $this->filterKeys];}
    
    public function render()
    {
        // code...
    }
}
