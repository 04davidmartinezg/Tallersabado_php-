<?php
class Binario {
    private $decimal;
    public function __construct($num) {
        $this->decimal = (int)$num;
    }    public function BBinario() {
        if ($this->decimal === 0) return "0";
        $n = $this->decimal;
        $binario = "";
        while ($n > 0) {
            $residuo = $n % 2; 
            $binario = $residuo . $binario; 
            $n = floor($n / 2); 
        }
        return $binario;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Decimal a Binario</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        /* CSS Específico para el Punto 5 */
        .resultado strong {
            font-family: 'Courier New', Courier, monospace;
            font-size: 2rem;
            color: var(--azul-barca);
            background: #eef2f7;
            padding: 5px 15px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>Conversor a Binario</h1>
        <form method="POST">
            <label>Número Entero:</label>
            <input type="number" name="decimal" min="0" required>
            <button type="submit">Convertir</button>
        </form>

        <?php
        if ($_POST) {
            require_once 'binario.php';
            $conv = new Binario($_POST['decimal']);
            echo "<div class='resultado'>";
            echo "El número {$_POST['decimal']} en binario es:<br>";
            echo "<strong>" . $conv->BBinario() . "</strong>";
            echo "</div>";
        }
        ?>
        <br>
        <a href="../index.php">Volver al Menú</a>
    </div>
</body>
</html>