<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommunicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'phone'=> $this->phone,
             'email'=> $this->email,
              'whatsup'=> $this->whatsup ,
               'facebook' => $this->facebpok, 
               'twitter' =>$this->twitter ,
                'instgram'=>$this->instgram
        ];
    }
}
