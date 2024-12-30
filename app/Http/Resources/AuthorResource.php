<?php

namespace App\Http\Resources;



use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    // ini yang akan kita kirim ke bagian controller
    //define property

    // cara kayak gini bisa, selama masih 1 modifier
    public $status, $message, $resource;

    // cara pak irul
    // public $status;
    // public $message;
    // public $resource;


    //define constructor
    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
        $this->resource = $resource;
    }



    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'success' => $this->status,
                'message' => $this->message,
                'data' => $this->resource
        ];
    }
}
