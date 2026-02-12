<?php

class CamisetaDTO implements JsonSerializable {

    public ?int $id;
    public string $equipo;
    public string $temporada;
    public string $talla;
    public float $precio_compra;
    public float $precio_venta;
    public string $estado;
    public string $fecha_alta;
    public ?int $pedido_id;

    public function __construct(
        ?int $id,
        string $equipo,
        string $temporada,
        string $talla,
        float $precio_compra,
        float $precio_venta,
        string $estado,
        string $fecha_alta,
        ?int $pedido_id
    ) {
        $this->id = $id;
        $this->equipo = $equipo;
        $this->temporada = $temporada;
        $this->talla = $talla;
        $this->precio_compra = $precio_compra;
        $this->precio_venta = $precio_venta;
        $this->estado = $estado;
        $this->fecha_alta = $fecha_alta;
        $this->pedido_id = $pedido_id;
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->id,
            'equipo' => $this->equipo,
            'temporada' => $this->temporada,
            'talla' => $this->talla,
            'precio_compra' => $this->precio_compra,
            'precio_venta' => $this->precio_venta,
            'estado' => $this->estado,
            'fecha_alta' => $this->fecha_alta,
            'pedido_id' => $this->pedido_id
        ];
    }
}
