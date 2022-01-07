<?php
namespace App\Traits;
use App\Models\Media;
trait HasMedia
{
    public function medias(){
        return $this->morphMany(Media::class, 'belong');
    }

    public function avatar(){
        return  $this->belongsTo(Media::class,'id','avatar');
    }

    public function upMedia($file){
        Media::create([
            'name'         =>  Media::name($file->getClientOriginalExtension()),
            'belong_type'  =>  get_class($this),
            'belong_id'    =>  $this->id,
        ])->up($file);
    }

    public function upAvatar($file){
        if(empty($this->avatar)){
            Media::create([
                'name'         =>  Media::name($file->getClientOriginalExtension()),
                'belong_type'  =>  get_class($this),
                'belong_id'    =>  $this->id,
                'avatar'       =>  $this->id,
            ])->up($file);
        }else {
            $this->avatar->change($file);
        }
    }

    public function dropMedia(){
      foreach ($this->medias as $media) {
          $media->delete();
      }
    }
}
