<?php
class TeoriadeConjuntos {
    private $conjuntoA;
    private $conjuntoB;
    public function __construct($inputA, $inputB) {
        // Convertimos string a array, quitamos espacios y dejamos solo valores únicos
        $this->conjuntoA = array_unique($this->limpiarInput($inputA));
        $this->conjuntoB = array_unique($this->limpiarInput($inputB));
    }

    private function limpiarInput($input) {
        $limpio = str_replace(' ', '', $input);
        return explode(',', $limpio);
    }

    public function calcularUnion() {
        return array_unique(array_merge($this->conjuntoA, $this->conjuntoB));
    }

    public function calcularInterseccion() {
        return array_intersect($this->conjuntoA, $this->conjuntoB);
    }

    public function calcularDiferenciaAB() {
        return array_diff($this->conjuntoA, $this->conjuntoB);
    }

    public function calcularDiferenciaBA() {
        return array_diff($this->conjuntoB, $this->conjuntoA);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Operaciones de Conjuntos</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <h1>Operaciones de Conjuntos</h1>
        <form method="POST">
            <label>Conjunto A:</label>
            <input type="text" name="conjuntoA" placeholder="1, 2, 3, 4" required>
            
            <label>Conjunto B :</label>
            <input type="text" name="conjuntoB" placeholder="3, 4, 5, 6" required>
            
            <button type="submit">Calcular Operaciones</button>
        </form>

        <?php
        if ($_POST) {
            require_once 'conjuntos.php';
            $op = new teoriadeConjuntos($_POST['conjuntoA'], $_POST['conjuntoB']);

            echo "<div class='resultado'>";
            echo "<strong>Unión (A ∪ B):</strong> {" . implode(", ", $op->calcularUnion()) . "}<br>";
            echo "<strong>Intersección (A ∩ B):</strong> {" . implode(", ", $op->calcularInterseccion()) . "}<br>";
            echo "<strong>Diferencia (A - B):</strong> {" . implode(", ", $op->calcularDiferenciaAB()) . "}<br>";
            echo "<strong>Diferencia (B - A):</strong> {" . implode(", ", $op->calcularDiferenciaBA()) . "}";
            echo "</div>";
        }
        ?>
        <br>
        <a href="../index.php">Volver al Menú</a>
    </div>
</body>
</html>