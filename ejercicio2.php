<?php

class BaseDatos
{
    public function obtenerRegistros()
    {
        return [
            [
                "nombre" => "Auriculares Gamer",
                "precio" => 35000,
                "stock" => 0
            ],
            [
                "nombre" => "Teclado Mecánico",
                "precio" => 45000,
                "stock" => 5
            ],
            [
                "nombre" => "Placa de Video RTX",
                "precio" => 520000,
                "stock" => 0
            ]
        ];
    }
}

class ProductoModel extends BaseDatos
{
    public function listarAgotados()
    {
        $productos = $this->obtenerRegistros();
        $agotados = [];

        foreach ($productos as $producto) {
            if ($producto["stock"] == 0) {
                $agotados[] = $producto;
            }
        }

        return $agotados;
    }
}

$modelo = new ProductoModel();

$agotados = $modelo->listarAgotados();

echo "==============================\n";
echo "CONTROL DE STOCK CRÍTICO\n";
echo "==============================\n";

foreach ($agotados as $producto) {
    echo "[ALERTA AGOTADO] " . $producto["nombre"] . " - $" . $producto["precio"] . "\n";
}

echo "==============================\n";
echo "Total de productos sin stock: " . count($agotados) . "\n";

?>