<?php
class CalculadoraPro {
    public function calcular($n1, $n2, $op) {
        $res = 0;
        $simbolo = "";

        switch ($op) {
            case 'suma': $res = $n1 + $n2; $simbolo = "+"; break;
            case 'resta': $res = $n1 - $n2; $simbolo = "-"; break;
            case 'mult': $res = $n1 * $n2; $simbolo = "x"; break;
            case 'div': 
                $res = ($n2 != 0) ? $n1 / $n2 : "Error (Div 0)"; 
                $simbolo = "/"; 
                break;
            case 'porc': $res = ($n1 * $n2) / 100; $simbolo = "% de"; break;
        }

        return ["op" => "$n1 $simbolo $n2", "res" => $res];
    }
}
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora de pros</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <h1>Calculadora</h1>
        
        <form method="POST">
            <input type="number" step="any" name="n1"  required>
            <input type="number" step="any" name="n2"  required>
            
            <select name="operacion">
                <option value="suma">Suma (+)</option>
                <option value="resta">Resta (-)</option>
                <option value="mult">Multiplicación (x)</option>
                <option value="div">División (/)</option>
                <option value="porc">Porcentaje (%)</option>
            </select>
            
            <button type="submit" name="calcular">Calcular</button>
            <button type="submit" name="borrar">Borrar Historial</button>
        </form>

        <?php
        require_once 'calculadora.php';
        $calc = new CalculadoraPro();
        if (isset($_POST['borrar'])) {
            $_SESSION['historial'] = [];
        }
        if (isset($_POST['calcular'])) {
            $resultado = $calc->calcular($_POST['n1'], $_POST['n2'], $_POST['operacion']);
            if (!isset($_SESSION['historial'])) $_SESSION['historial'] = [];
            array_unshift($_SESSION['historial'], $resultado['op'] . " = " . $resultado['res']);
            
            echo "<div class='res-calculadora'>Resultado: <strong>" . $resultado['res'] . "</strong></div>";
        }
        ?>

        <div class="res-estadistica">
            <h3>Historial de Operaciones</h3>
            <ul>
                <?php 
                if (!empty($_SESSION['historial'])) {
                    foreach ($_SESSION['historial'] as $item) {
                        echo "<li>$item</li>";
                    }
                } else {
                    echo "<li>No hay operaciones registradas.</li>";
                }
                ?>
            </ul>
        </div>
        
        <a href="index.php" class="btn-volver">← Volver al Menú</a>
    </div>
</body>
</html>