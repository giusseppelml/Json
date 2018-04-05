<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "Conexion.php";

class Datos extends Conexion
{

    #REGISTRO DE USUARIOS
    #-------------------------------------
    public function createUsuarioModel($datosModel, $tabla)
    {

        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, password, email) VALUES (:usuario,:password,:email)");

        #bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.

        $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

        #execute() devuelve un resultado booleano, devolvera un true si la consulta se a ejecutado correctamente, de lo contrario devolvera un false

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }

    public function readUsuariosModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id, usuario, password, email FROM $tabla");
        $stmt->execute();

        #binColumn() El número (de primer índice 1) o el nombre de la columna del conjunto de resultados. Si se utiliza el nombre de la columna, tenga en cuenta que el nombre debería coincidir en mayúsculas/minúsculas con la columna, tal como la devuelve el controlador.

        $stmt->bindColumn("id", $id);
        $stmt->bindColumn("usuario", $usuario);
        $stmt->bindColumn("password", $password);
        $stmt->bindColumn("email", $email);

        $usuarios = array();

        while ($fila = $stmt->fetch(PDO::FETCH_BOUND)) {
            $user              = array();
            $user[':id']       = utf8_encode($id);
            $user['u:suario']  = utf8_encode($usuario);
            $user[':password'] = utf8_encode($password);
            $user[':email']    = utf8_encode($email);

            array_push($usuarios, $user);
        }

        return $usuarios;
    }

    #EDITAR USUARIO
    #-------------------------------------

    public function updateUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE id = :id");

        $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return true;

        } else {

            return false;

        }

        $stmt->close();

    }

#BORRAR USUARIO
    #------------------------------------
    public function deleteUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }
}

//$a = new Datos();
//$a->getUsuariosModel("usuarios");
