<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id"         => $this->id,
            "title"      => $this->title_ar,
            "description"=> $this->description_ar,
            "overview"  => $this->overview_ar,
            "tag"       => $this->country_ar,
            "media"      => $this->image,
            "pdf"        => $this->pdf,
            "status"     => $this->status,
            "sort"       => $this->sort,
        ];
    }
}
