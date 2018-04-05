<?php

require_once "ModeloJson.php";

class ControllerJson
{

    #REGISTRO DE USUARIOS
    #------------------------------------
    public function createUsuarioController($usuario, $password, $email)
    {
        $datosController = array("usuario" => $usuario,
            "password"                         => $password,
            "email"                            => $email);

        $respuesta = Datos::createUsuarioModel($datosController, "usuarios");

        return $respuesta;
    }

    #VISTA DE USUARIOS
    #------------------------------------

    public function readUsuariosController()
    {

        $respuesta = Datos::readUsuariosModel("usuarios");
        return $respuesta;
    }

    #ACTUALIZAR USUARIO
    #------------------------------------
    public function updateUsuarioController($id, $usuario, $password, $email)
    {

        $datosController = array("id" => $id,
            "usuario"                     => $usuario,
            "password"                    => $password,
            "email"                       => $email);

        $respuesta = Datos::updateUsuarioModel($datosController, "usuarios");
        return $respuesta;

    }

    #BORRAR USUARIO
    #------------------------------------
    public function deleteUsuarioController($id)
    {
        $respuesta = Datos::deleteUsuarioModel($id, "usuarios");
        return $respuesta;
    }
}

//$a = new ControllerJson();
//$a->editarUsuarioController();
