<?php

require_once 'modelo.php';
require_once 'vista.php';

class Controller
{
    private $model;
    private $view;
    private $db;

    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View();
        $this->db = new DB("hotelgd");
    }

    public function disponibles($db)
    {
        $this->model->habitacionesDisponibles($db);
    }

    public function mostrarBoton()
    {
        $this->view->boton();
    }

    public function actualizar($db)
    {
        $this->model->actualiza($db);
    }

    //Página Web
    public function mostrarCabecera()
    {
        $this->view->cabecera();
    }

    public function mostrarIntroduccion()
    {
        $this->view->introduccion();
    }

    public function mostrarCarousel()
    {
        $this->view->carousel();
    }

    public function mostrarServicios()
    {
        $this->view->servicios();
    }

    public function mostrarFooter()
    {
        $this->view->footer();
    }

    public function borrarMain()
    {
        $this->view->main();
    }

    public function borrarHeader()
    {
        $this->view->borrarHeader();
    }

    public function borrarFooter()
    {
        $this->view->borrarFooter();
    }

    public function mostrarFormularioContacto()
    {
        $this->view->formularioContacto();
    }

    public function mostrarModalContacto()
    {
        $this->view->modalContacto();
    }

    public function mostrarModalReserva()
    {
        $this->view->modalReserva();
    }

    public function habitacionEspecifica($db, $id)
    {
        $this->model->habitacionEspecifica($db, $id);
    }

    public function formularioSesion()
    {
        $this->view->formularioSesion();
    }

    public function modalSesion()
    {
        $this->view->modalSesion();
    }

    public function formularioRegistro()
    {
        $this->view->formularioRegistro();
    }

    public function modalRegistro()
    {
        $this->view->modalRegistro();
    }

    public function existeUsuario($usuario, $password, $db)
    {
        $this->model->existeUsuario($usuario, $password, $db);
    }

    public function registroClienteUsuario($nombre, $apellido, $usuario, $password, $email, $telefono, $db)
    {
        $this->model->registroClienteUsuario($nombre, $apellido, $usuario, $password, $email, $telefono, $db);
    }

    public function crearSesion($usuario)
    {
        $this->view->crearSesion($usuario);
    }

    public function cerrarSesion()
    {
        $this->view->cerrarSesion();
    }
}