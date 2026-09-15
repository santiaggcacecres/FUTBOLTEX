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