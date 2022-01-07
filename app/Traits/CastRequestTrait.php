<?php
namespace App\Traits;
use Illuminate\Support\Str;
use Carbon\Carbon;

trait CastRequestTrait
{
    /**
    * cast attributes to datetime format
    *
    * @param array &$input
    * @param string $attributes
    * @param string $fromFormat = 'd-m-Y'
    * @return boolean
    * @throws 
    */
    protected static function castDatetime(array &$input, string $attributes, string $fromFormat = 'd-m-Y')
    {
        try {
            if (array_key_exists($attributes, $input)) {
                $_value = str_replace('/', '-', $input[$attributes]);
                if(empty($_value)) return false;
                $input[$attributes] = Carbon::createFromFormat($fromFormat, $_value);
            }
        } catch (Exception $e) {
            logger($e);
        }
        return true;
    }
    /**
    * cast:: set default value
    *
    * @param array &$input,
    * @param string $attributes,
    * @param mix $value,
    * @return boolean
    * @throws 
    */ 
    public function castDefault(array &$input, string $attributes, $value)
    {
        try {
            // if (array_key_exists($attributes, $input)) {
                $input[$attributes] = $value;
            // }
        } catch (Exception $e) {
            logger($e);
        }
        return true;
    }
    /**
    * cast:: implode 
    *
    * @param array &$input
    * @param string $attributes
    * @param string $glue
    * @return boolean
    *
    * @throws 
    */ 
    protected static function castImplode(array &$input, string $attributes, string $glue = ',')
    {
        try {
            if (array_key_exists($attributes, $input)) {
                $_value = (array) $input[$attributes];
                $input[$attributes] = implode($glue, $_value);
            }
        } catch (Exception $e) {
            logger($e);
        }
        return true;
    }
    /**
    * cast attribute to JSON 
    *
    * @param array &$input
    * @param string $attribute
    * @return boolean
    *
    * @throws 
    */ 
    protected static function castJSON(array &$input, string $attribute)
    {
        try {
            if (array_key_exists($attribute, $input)) {
                $_value = (array) $input[$attribute];
                $input[$attribute] = json_encode($_value);
            }
        } catch (Exception $e) {
            logger($e);
        }
        return true;
    }
    /**
    * cast attributes to string 
    *
    * @param  array  &$attributes
    * @return boolean
    *
    * @throws 
    */ 
    protected static function castTrim(array &$input, $attributes, $pattern = '/\D/i', $replacement = '')
    {
        try {
            if (array_key_exists($attributes, $input)) {
                $subject = (string) $input[$attributes];
                $input[$attributes] = preg_replace($pattern, $replacement, $subject);
            }
        } catch (Exception $e) {
            logger($e);
        }
        return true;
    }
    /**
    * cast attributes to decimal money 
    *
    * @param  array  &$attributes
    * @return boolean
    *
    * @throws 
    */ 
    protected static function castMoney(array &$input, $attributes, $pattern = '/\D/i')
    {
        try {
            if (array_key_exists($attributes, $input)) {
                $subject = (string) $input[$attributes];
                $subject = preg_replace($pattern, '', $subject);
                $input[$attributes] = (int)$subject;
            }
        } catch (Exception $e) {
            logger($e);
        }
        return true;
    }
    /**
    * cast attributes to decimal money 
    * @param array &$input
    * @param string $attributes
    * @param string $slugSign
    * @return boolean
    * @throws 
    */ 
    public function castSlug(array &$input, string $attributes, string $slugSign = '-')
    {
        try {
            if (array_key_exists($attributes, $input)) {
                $subject = (string) $input[$attributes];
                $subject = Str::of($subject)->slug($slugSign);
                $input[$attributes] = strtolower((string)$subject);
            }
        } catch (Exception $e) {
            logger($e);
        }
        return true;
    }
}
