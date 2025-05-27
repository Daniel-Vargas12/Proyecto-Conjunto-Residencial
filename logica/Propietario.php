<?php
require_once("persistencia/Conexion.php");
require_once("logica/Usuario.php");
require_once("persistencia/PropietarioDAO.php");

class Propietario extends Usuario {
    private $apartamentos = array();
    private $estadoGeneral;
    public function __construct($id = "", $nombre = "", $apellido = "", $correo = "", $clave = "", $telefono = "", $estadoGeneral = "") {
        parent::__construct($id, $nombre, $apellido, $correo, $clave, $telefono);
        $this->estadoGeneral = $estadoGeneral;
    }

    public function autenticar(){
        $conexion = new Conexion();
        $propDAO = new PropietarioDAO("","","", $this -> email, $this -> clave,"");
        $conexion -> abrir();
        $conexion -> ejecutar($propDAO -> autenticar());
        if($conexion -> filas() == 1){            
            $this -> id = $conexion -> registro()[0];
            $conexion->cerrar();
            return true;
        }else{
            $conexion->cerrar();
            return false;
        }
    }

    public function consultar(){
        $conexion = new Conexion();
        $propDAO = new PropietarioDAO($this -> id);
        $conexion -> abrir();
        $conexion -> ejecutar($propDAO -> consultar());
        $datos = $conexion -> registro();
        $this -> nombre = $datos[0];
        $this -> apellido = $datos[1];
        $this -> email = $datos[2];
        $this -> telefono = $datos[3];
        $conexion->cerrar();
    }

    public static function consultarTodos() {
        $conexion = new Conexion();
        $apartamentoDAO = new ApartamentoDAO();
        $conexion->abrir();
        $conexion->ejecutar($apartamentoDAO->consultar());
        $propietarios = [];

        while ($registro = $conexion->registro1()) {
            $idPropietario = $registro["id"];
            // Verifica si ya existe un propietario en la lista
            if (!isset($propietarios[$idPropietario])) {
                $propietario = new Propietario(
                    $idPropietario,
                    $registro["nombre"],
                    $registro["apellido"],
                    $registro["email"],
                    "",
                    $registro["telefono"],
                    $registro["estadoGeneral"]//estado actual de pagos
                );
                $propietarios[$idPropietario] = $propietario;
            }

            // Crea el apartamento y lo agrega al propietario
            $apartamento = [
                "numero" => $registro["numero"],
                "torre" => $registro["torre"],
                "metrosCuadrados" => $registro["metrosCuadrados"]
            ];
            $propietarios[$idPropietario]->apartamentos[] = $apartamento;
        }
        $conexion->cerrar();
        return array_values($propietarios); // Para devolver un array indexado
    }

    public function getApartamentos() {
            return $this->apartamentos;
    }
    public function setApartamentos($apartamentos) {
        $this->apartamentos = $apartamentos;
    }
    public function getEstadoGeneral() {
        return $this->estadoGeneral;
    }
    public function setEstadoGeneral($estadoGeneral){
        $this -> estadoGeneral = $estadoGeneral;
    }
}
?>