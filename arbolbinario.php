<?php
class Nodo {
    public $valor;
    public $izq;
    public $der;
    public function __construct($valor) {
        $this->valor = $valor;
        $this->izq = null;
        $this->der = null;
    }
}

class ConstructorArbol {
    private $preIndex = 0;

    public function construirDesdePreIn($pre, $in) {
        $this->preIndex = 0;
        $pre = array_map('trim', $pre);
        $in = array_map('trim', $in);
        return $this->ejecutarConstruccion($pre, $in, 0, count($in) - 1);
    }
    private function ejecutarConstruccion($pre, $in, $inInicio, $inFin) {
        if ($inInicio > $inFin || $this->preIndex >= count($pre)) return null;

        $valorActual = $pre[$this->preIndex];
        $nodo = new Nodo($valorActual);
        $this->preIndex++;

        if ($inInicio == $inFin) return $nodo;
        $inIndex = array_search($valorActual, $in);
        if ($inIndex === false) return $nodo;
        $nodo->izq = $this->ejecutarConstruccion($pre, $in, $inInicio, $inIndex - 1);
        $nodo->der = $this->ejecutarConstruccion($pre, $in, $inIndex + 1, $inFin);
        return $nodo;
    }
    public function imprimirArbol($nodo) {
        if ($nodo == null) return "";
        return "<li><div class='nodo-v'>" . $nodo->valor . "</div>" . 
               "<ul>" . $this->imprimirArbol($nodo->izq) . $this->imprimirArbol($nodo->der) . "</ul></li>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Árbol Binarios</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedor">
        <h1>Constructor de Árboles</h1>
        <p>Ingresa los recorridos separados por comas (Ej: A,B,D,E,C)</p>
        
        <form method="POST">
            <label>Recorrido Preorden:</label>
            <input type="text" name="pre" placeholder="A,B,D,E,C" required>
            
            <label>Recorrido Inorden:</label>
            <input type="text" name="in" placeholder="D,B,E,A,C" required>
            
            <button type="submit">Construir Árbol</button>
        </form>

        <?php
        if ($_POST) {
            require_once 'arbolbinario.php';
            $pre = explode(',', str_replace(' ', '', $_POST['pre']));
            $in = explode(',', str_replace(' ', '', $_POST['in']));
            $constructor = new ConstructorArbol();
            $raiz = $constructor->construirDesdePreIn($pre, $in);

            echo "<div class='res-arbol'>";
            echo "<h3>Estructura Generada:</h3>";
            echo "<ul class='tree'>" . $constructor->imprimirArbol($raiz) . "</ul>";
            echo "</div>";
        }
        ?>
        <a href="index.php" > Volver al Menú</a>
    </div>
</body>
</html>