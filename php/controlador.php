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
        $this->db = new DB("epiz_34160839_hotelgd");
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

    public function modalNoRegistro()
    {
        $this->view->modalNoRegistro();
    }

    public function datosUsuarioLogin($db, $usuario)
    {
        $this->model->datosUsuarioLogin($db, $usuario);
    }

    public function modalCarrito()
    {
        $this->view->modalCarrito();
    }

    public function pruebaJSON($db, $type)
    {
        $this->model->pruebaJSON($db, $type);
    }

    public function formularioReserva()
    {
        $this->view->formularioReserva();
    }

    public function reservaHabitacion($db, $fechaInicio, $fechaFin, $usuario, $id_habitacion)
    {
        $this->model->reservaHabitacion($db, $fechaInicio, $fechaFin, $usuario, $id_habitacion);
    }

    public function modalReservaConfirmacion()
    {
        $this->view->modalReservaConfirmacion();
    }

    public function actualizarReservas($db)
    {
        $this->model->actualizarReservas($db);
    }

    public function modalLoginIncorrecto()
    {
        $this->view->modalLoginIncorrecto();
    }

    public function cancelarReserva($db, $id)
    {
        $this->model->cancelarReserva($db, $id);
    }

    public function mostrarMapa()
    {
        $this->view->mostrarMapa();
    }

    public function mostrarTipoHabitacion()
    {
        $this->view->mostrarTipoHabitacion();
    }

    public function opiniones()
    {
        $this->view->opiniones();
    }

    public function modalCancelarReserva()
    {
        $this->view->modalCancelarReserva();
    }

    public function modalFalloReserva()
    {
        $this->view->modalFalloReserva();
    }

    public function modalConfirmacionCancelacionReserva()
    {
        $this->view->modalConfirmacionCancelacionReserva();
    }

}