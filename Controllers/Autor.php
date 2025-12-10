<?php
class Autor extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Autor");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar()
    {
        $data = $this->model->getAutor();
        for ($i = 0; $i < count($data); $i++) {
            // SE ELIMINÓ LA LÍNEA QUE CREABA LA ETIQUETA IMG
            
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-primary" type="button" onclick="btnEditarAutor(' . $data[$i]['id'] . ');"><i class="fa fa-pencil-square-o"></i></button>
                <button class="btn btn-danger" type="button" onclick="btnEliminarAutor(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
                <div/>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarAutor(' . $data[$i]['id'] . ');"><i class="fa fa-reply-all"></i></button>
                <div/>';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
        $autor = strClean($_POST['autor']);
        $id = strClean($_POST['id']);
        
        // SE ELIMINÓ TODA LA LÓGICA DE $_FILES, $img, $fecha, validaciones de foto, etc.

        if (empty($autor)) {
            $msg = array('msg' => 'El nombre es requerido', 'icono' => 'warning');
        } else {
            if ($id == "") {
                // Insertar: Solo pasamos el nombre
                $data = $this->model->insertarAutor($autor);
                
                if ($data == "ok") {
                    $msg = array('msg' => 'Autor registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'El autor ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {
                // Actualizar: Solo pasamos nombre e ID (ya no borramos fotos antiguas)
                $data = $this->model->actualizarAutor($autor, $id);
                
                if ($data == "modificado") {
                    $msg = array('msg' => 'Autor modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editAutor($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->estadoAutor(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Autor dado de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id)
    {
        $data = $this->model->estadoAutor(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Autor restaurado', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al restaurar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarAutor()
    {
        if (isset($_GET['q'])) {
            $valor = $_GET['q'];
            $data = $this->model->buscarAutor($valor);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
}