<?php

class Producto
{
    public $id;
    public $nombre;
    public $precio;
    public $stock;

    public function calcularSubtotal($cantidad)
    {
        return $this->precio * $cantidad;
    }

    public function mostrarFicha()
    {
        echo "==============================<br>";
        echo "FICHA DE PRODUCTO<br>";
        echo "==============================<br>";
        echo "ID: " . $this->id . " | Nombre: " . $this->nombre . "<br>";
        echo "Precio: $" . $this->precio . " | Stock: " . $this->stock . " u.<br>";
        echo "------------------------------<br>";
    }
}


$producto1 = new Producto();
$producto1->id = 1;
$producto1->nombre = "Teclado Mecánico RGB";
$producto1->precio = 45000;
$producto1->stock = 6;

$producto2 = new Producto();
$producto2->id = 2;
$producto2->nombre = "Mouse Óptico Gamer";
$producto2->precio = 22000;
$producto2->stock = 10;


$producto1->mostrarFicha();
$producto2->mostrarFicha();


$subtotal = $producto1->calcularSubtotal(3);

echo "==============================<br>";
echo "Subtotal por 3 Teclado Mecánico RGB: $" . $subtotal;
?>
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
<?php

class Cliente
{
    public $nombre;
    protected $tarjeta;
    protected $codigoSeguridad;

    public function asignarTarjeta($numero, $cvv)
    {
        $this->tarjeta = $numero;
        $this->codigoSeguridad = $cvv;
    }

    public function obtenerTarjetaEnmascarada()
    {
        $ultimos4 = substr($this->tarjeta, -4);

        return "**** **** **** " . $ultimos4;
    }

    public function procesarPago($monto)
    {
        echo "========================================\n";
        echo "PASARELA DE PAGO SEGURO\n";
        echo "========================================\n";
        echo "Titular: " . $this->nombre . "\n";
        echo "Medio de pago: " . $this->obtenerTarjetaEnmascarada() . "\n";
        echo "Estado: Cobro aprobado por $" . $monto . "\n";
        echo "========================================\n";
    }
}

$cliente = new Cliente();

$cliente->nombre = "Matias Peralta";
$cliente->asignarTarjeta("4509-8877-6655-1234", "456");

$cliente->procesarPago(45000);

?>