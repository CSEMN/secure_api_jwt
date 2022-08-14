<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function Symfony\Component\Translation\t;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        if($request->has('lang')){
            if($request->lang =='ar' && !empty($this->title_ar)){
                $title = $this->title_ar;
            }else{
                $title = $this->title;
            }
        }else{
            if($request->cookie('lang') =='ar' && !empty($this->title_ar)){
                $title = $this->title_ar;
            }else{
                $title = $this->title;
            }
        }

        return [
            'id'=>$this->id,
            'title' => $title,
            'price' => $this->price,
            'user' => new UserResource($this->user),
        ];
    }
}
