<?php
class ApartamentoDAO{
    private $id;
    private $numero;
    private $torre;
    private $metrosCuadrados;
    private $idPropietario;
    private $propietario;

    public function __construct($id = "", $numero = "", $torre = "", $metrosCuadrados = "", $idPropietario = "") {
        $this->id = $id;
        $this->numero = $numero;
        $this->torre = $torre;
        $this->metrosCuadrados = $metrosCuadrados;
        $this->idPropietario = $idPropietario;
    }

    public function consultar($idP = null) {
        $sentencia = "SELECT 
                        a.id, a.numero, a.torre, a.metrosCuadrados, a.idPropietario,
                        p.id AS idPropietario, p.nombre, p.apellido, p.email, p.telefono,
                        (
                            SELECT 
                                CASE 
                                    WHEN COUNT(*) > 0 THEN 'En mora'
                                    ELSE 'Al día'
                                END
                            FROM cuentaCobro cc
                            INNER JOIN apartamento a2 ON cc.idApartamento = a2.id
                            WHERE a2.idPropietario = p.id AND cc.estado != 'pago'
                        ) AS estadoGeneral
                    FROM apartamento a
                    INNER JOIN propietario p ON a.idPropietario = p.id";
        if (!empty($idP)) {
            $sentencia .= " WHERE a.idPropietario = " . $idP;
        }
        return $sentencia;
    }
}

?>