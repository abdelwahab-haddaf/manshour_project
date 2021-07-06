<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Object['id'] = $this->getId();
        $Object['ref_id'] = $this->getRefId();
        $Object['file'] = $this->getFile();
        $Object['media_type'] = $this->getMediaType();
        return $Object;
    }

}
