<?php
class Fibonacci_factorial{
    private $numero;

    public function __construct($n) {
        $this->numero = (int)$n;
    }
    public function calcularFactorial() {
        if ($this->numero < 0) return "No definido para negativos";
        if ($this->numero == 0) return 1;
        $resultado = 1;
        for ($i = 1; $i <= $this->numero; $i++) {
            $resultado *= $i;
        }
        return $resultado;
    }
    public function generarFibonacci() {
        if ($this->numero <= 0) return [0];
        $serie = [0, 1];
        for ($i = 2; $i < $this->numero; $i++) {
            $serie[] = $serie[$i - 1] + $serie[$i - 2];
        }
        return array_slice($serie, 0, $this->numero);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sucesion de Fibonacci o factorial</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h1>CalculadoraF</h1>
        <form method="POST">
            <input type="number" name="num" placeholder="Ingresa un número" min="0" required>
            
            <select name="operacion">
                <option value="factorial">Factorial</option>
                <option value="fibonacci">Sucesión de Fibonacci</option>
            </select>
            
            <button type="submit">Calcular</button>
        </form>

        <?php
        if ($_POST) {
            require_once 'Calculadora.php';
            $calc = new Fibonacci_factorial($_POST['num']);
            $op = $_POST['operacion'];

            echo "<div class='resultado'>";
            if ($op == 'factorial') {
                echo "Factorial de {$_POST['num']}: <strong>" . $calc->calcularFactorial() . "</strong>";
            } else {
                $serie = $calc->generarFibonacci();
                echo "Serie Fibonacci ({$_POST['num']} términos): <br><strong>" . implode(", ", $serie) . "</strong>";
            }
            echo "</div>";
        }
        ?>
    </div>
     <a href="index.php">Volver al Menú</a>
</body>
</html>