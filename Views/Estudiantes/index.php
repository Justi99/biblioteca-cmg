<?php include "Views/Templates/header.php"; ?>
<div class="app-title">
    <div>
        <h1><i class="fa fa-dashboard"></i> Estudiantes</h1>
    </div>
</div>
<button class="btn btn-primary mb-2" type="button" onclick="frmEstudiante()"><i class="fa fa-plus"></i></button>
<div class="row">
    <div class="col-lg-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tblEst">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Código</th>
                                <th>Dni</th>
                                <th>Nombre</th>
                                <th>Grado</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Estado</th>
                                <th></th>
                            </tr>
                            <tr id="fila-filtros">
        <th></th> 

                        <th><input type="text" class="form-control form-control-sm filtro-columna" data-index="1" placeholder="Código"></th>
                        
                        <th><input type="text" class="form-control form-control-sm filtro-columna" data-index="2" placeholder="Dni"></th>
                        
                        <th><input type="text" class="form-control form-control-sm filtro-columna" data-index="3" placeholder="Nombre"></th>
                        
                        <th><input type="text" class="form-control form-control-sm filtro-columna" data-index="4" placeholder="Grado"></th>
                        
                        <th><input type="text" class="form-control form-control-sm filtro-columna" data-index="5" placeholder="Dirección"></th>
                        
                        <th><input type="text" class="form-control form-control-sm filtro-columna" data-index="6" placeholder="Teléfono"></th>
                        
                        <th>
                            <select class="form-control form-control-sm filtro-columna" data-index="7">
                                <option value="">Todos</option>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </th>

                        <th></th>
                    </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="nuevoEstudiante" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white" id="title">Registro Estudiante</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEstudiante">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="hidden" id="id" name="id">
                                <input id="codigo" class="form-control" type="text" name="codigo" required placeholder="Codigo del estudiante">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dni">Dni</label>
                                <input id="dni" class="form-control" type="text" name="dni" required placeholder="Dni" maxlength="8" minlength="8" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" required placeholder="Nombre completo">
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label for="carrera">Grado (Seleccione)</label>
                            
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-6">
                                    <select class="form-control" id="lista_numero" onchange="combinarGrado()">
                                        <option value="" disabled selected>N°</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="col-6">
                                    <select class="form-control" id="lista_seccion" onchange="combinarGrado()">
                                        <option value="" disabled selected>Sec</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                    </select>
                                </div>
                            </div>

                            <input id="carrera" class="form-control" type="text" name="carrera" required placeholder="Ej: 1-A" readonly>
                        </div>
                    </div>

                    <script>
                    function combinarGrado() {
                        // Tomamos los valores
                        var num = document.getElementById('lista_numero').value;
                        var sec = document.getElementById('lista_seccion').value;

                        // Si ambos tienen valor, los juntamos en el input "carrera"
                        if (num && sec) {
                            document.getElementById('carrera').value = num + '-' + sec;
                        }
                    }
                    </script>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="telefono">Télefono</label>
                                <input id="telefono" class="form-control" type="text" name="telefono" required placeholder="Teléfono" maxlength="9" minlength="9" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input id="direccion" class="form-control" type="text" name="direccion" required placeholder="Dirección">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" onclick="registrarEstudiante(event)" id="btnAccion">Registrar</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">Atras</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>