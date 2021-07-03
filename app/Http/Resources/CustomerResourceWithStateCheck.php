<?php

namespace App\Http\Resources;

use App\Traits\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResourceWithStateCheck extends JsonResource
{
    use Helper;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $code  = $this->generateCodeFromPhoneNumber($this->phone);
        $pattern = config('codes.+'.$code.'.pattern');
        $is_valid = $this->checkPhoneNumberValidation($pattern,str_replace(' ','',$this->phone));
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'code' => $code,
            'country' =>  config('codes.+'.$code.'.country'),
            'is_valid' => $is_valid

        ];

    }
}
