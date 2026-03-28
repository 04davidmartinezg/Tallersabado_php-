<?php
class GeneradorAcronimo {
    private $frase = null;

    function __construct($texto) {
        $this->frase = $texto;
    }
    public function obtenerAcronimo() {
        $reemplazar = str_replace('-', ' ', $this->frase);
        $soloLetras = preg_replace('/[^\w\s]/', '', $reemplazar);
        $palabras = explode(' ', mb_strtoupper($soloLetras));
        
        $acronimo = "";
        foreach ($palabras as $palabrita) {
            if (!empty($palabrita)) {
                $acronimo .= $palabrita[0]; 
            }
        }
        return $acronimo;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de Acrónimos</title>
    <link rel="stylesheet" href="estilos.css">
    <body>
        <div class="contenedor">
        <h1>Genera tu acronimo</h1>
        <form method="POST">
            <input type="text" name="frase" required>
            <button type="Submit">Convertir</button>
        </form>
        <?php
        if ($_POST && isset($_POST['frase'])) {
            require_once 'acronimo.php';
            $objeto = new GeneradorAcronimo($_POST['frase']);
            echo "<div class='resultado'>Resultado: <strong>" . $objeto->obtenerAcronimo() . "</strong></div>";
        }
        ?>
        </div>
        <br>
         <a href="index.php">Volver al Menú</a>
    </body>
</head>
</html>
