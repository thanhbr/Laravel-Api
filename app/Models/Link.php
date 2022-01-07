<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Slug;

class Link extends Model
{
  use HasFactory, Slug;

  protected $guarded  = ['id'];

  function prettyFix()
  {
    if (static::wherePretty($this->pretty)->exists())
      $this->pretty .= '.' . $this->short;
  }

  public function belong()
  {
    return $this->morphTo();
  }

  public static function findPretty($pretty)
  {
    return static::wherePretty($pretty)->first();
  }



  static function boot()
  {
    parent::boot();
    static::saving(function ($model) {

      $model->short  = uniqid();
      $model->prettyFix();
    });
  }
}
