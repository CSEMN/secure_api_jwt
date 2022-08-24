<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->avatar){
            $avatar = asset($this->avatar);
        }else{
            $avatar = asset('default_avatar.png');
        }

        return [
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'avatar'=>$avatar
        ];
    }
}
