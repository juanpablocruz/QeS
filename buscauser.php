<?php
class Usuarios
{
    public function  __construct() {
	include_once "connect.php";    }

    public function buscarUsuario($nombreUsuario){
        $datos = array();

        $sql = "SELECT * FROM member
                WHERE loginName LIKE '%$nombreUsuario%'";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)){
            $datos[] = array("value" => $row['loginName']);
        }

        return $datos;
    }
}
?>