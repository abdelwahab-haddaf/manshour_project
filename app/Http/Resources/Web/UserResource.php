<?php

namespace App\Http\Resources\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $Object['id'] = $this->id;
        $Object['name'] = $this->name;
        $Object['mobile'] = $this->mobile;
        $Object['email'] = $this->email;
        $Object['city_id'] = $this->city_id;
        $Object['City'] = new CityResource($this->city);
        $Object['avatar'] = $this->avatar;
        $Object['app_locale'] = $this->app_locale;
        $Object['is_active'] = $this->is_active;
        return $Object;
    }

}
