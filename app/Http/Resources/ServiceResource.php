<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'id' => $this->id,
       'name' => $this->name,
       'price' => $this->price,
       'description'=>$this->description,
       'count'=> $this->count,
       'rate'=> $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count()) : 'No Rate Yet',
       'discount'=> $this->discount,
       'area'=> $this->area,
       'latitude' => $this->lat,
       'longitude' => $this->long,
       'size'=> new SizeResource($this->size),
       'category'=> new CategoryResource($this->category),
       'available_from' => $this->date_from,
       'available_to' => $this->date_to,
       'created_at'=>$this->created_at->format('Y-m-d'),
       
      /* 'link'=> [
         'reviews'=>route('reviews.index' , $this->id),
       ]*/

        ];
    }
}
