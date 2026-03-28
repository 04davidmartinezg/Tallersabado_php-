<?php
class Estadistica {
    private $numeros;
    public function __construct($input) {
        $limpio = str_replace(' ', '', $input); 
        $partes = explode(',', $limpio);
        $this->numeros = array_map('floatval', array_filter($partes, 'is_numeric'));
        sort($this->numeros);
    }
    public function calcularPromedio() {
        $cantidad = count($this->numeros);
        if ($cantidad == 0) return 0;
        return array_sum($this->numeros) / $cantidad;
    }
    public function calcularMediana() {
        $n = count($this->numeros);
        if ($n == 0) return 0;
        $medio = floor(($n - 1) / 2);
        
        if ($n % 2) { 
            return $this->numeros[$medio];
        } else { 
            return ($this->numeros[$medio] + $this->numeros[$medio + 1]) / 2;
        }
    }
    public function calcularModa() {
        if (count($this->numeros) == 0) return "N/A";

        $frecuencias = array_count_values(array_map('strval', $this->numeros));
        arsort($frecuencias); 
        $maximaFrecuencia = reset($frecuencias);
        $modas = array_keys($frecuencias, $maximaFrecuencia);
        if ($maximaFrecuencia == 1 && count($frecuencias) > 1) {
            return "No hay moda (todos únicos)";
        }
        return implode(", ", $modas);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadística</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <h1>Cálculos Estadísticos</h1>
        <p>Ingresa los números separados por comas (Ej: 10, 5, 8.5, 10)</p>
        
        <form method="POST">
            <input type="text" name="datos" required>
            <button type="submit">Analizar</button>
        </form>

        <?php
        if ($_POST && isset($_POST['datos'])) {
            require_once 'medidastendenciacentral.php';
            $analizador = new Estadistica($_POST['datos']);
            
            echo "<div class='resultado'>";
            echo "Promedio: <strong>" . number_format($analizador->calcularPromedio(), 2) . "</strong><br>";
            echo "Mediana: <strong>" . $analizador->calcularMediana() . "</strong><br>";
            echo "Moda: <strong>" . $analizador->calcularModa() . "</strong>";
            echo "</div>";
        }
        ?>
    </div>
     <a href="index.php">Volver al Menú</a>
</body>
</html>