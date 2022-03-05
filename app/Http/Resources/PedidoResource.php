<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductoResource;
use App\Models\User;

class PedidoResource extends JsonResource
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
            'fecha' => $this->fecha,
            'estado' => $this->estado,
            'gastos_envio' => $this->gastos_envio,
            'user' => User::find($this->user_id)->name,
            'productos' => ProductoResource::collection($this->productos),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
