<?= $header ?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-book"></i> Gestión de Recursos Educativos
                    </h4>
                    <a href="<?= base_url('recursos/crear') ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nuevo Recurso
                    </a>
                </div>
                <div class="card-body">
                    <!-- Buscador -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" id="buscarTitulo" placeholder="Buscar por título...">
                                <button class="btn btn-outline-secondary" type="button" id="btnBuscar">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                <button class="btn btn-outline-secondary" type="button" id="btnLimpiar">
                                    <i class="fas fa-times"></i> Limpiar
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <span class="badge bg-info fs-6" id="totalRecursos">
                                Total: <?= count($recursos) ?> recursos
                            </span>
                        </div>
                    </div>

                    <!-- Tabla de recursos -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Categoría</th>
                                    <th>Subcategoría</th>
                                    <th>Editorial</th>
                                    <th>Tipo</th>
                                    <th>Año</th>
                                    <th>ISBN</th>
                                    <th>Páginas</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tablaRecursos">
                                <?php if (empty($recursos)): ?>
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3"></i>
                                            <br>No hay recursos registrados
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($recursos as $recurso): ?>
                                        <tr data-id="<?= $recurso['idrecurso'] ?>">
                                            <td><?= $recurso['idrecurso'] ?></td>
                                            <td>
                                                <strong><?= esc($recurso['titulo']) ?></strong>
                                                <?php if (!empty($recurso['rutaportada'])): ?>
                                                    <br><small class="text-muted">
                                                        <i class="fas fa-image"></i> Con portada
                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    <?= esc($recurso['categoria']) ?>
                                                </span>
                                            </td>
                                            <td><?= esc($recurso['subcategoria']) ?></td>
                                            <td>
                                                <?= esc($recurso['editorial']) ?>
                                                <br><small class="text-muted">
                                                    <i class="fas fa-flag"></i> <?= esc($recurso['nacionalidad']) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <?php if ($recurso['tipo'] == 'Digital'): ?>
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-laptop"></i> Digital
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-book"></i> Físico
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $recurso['apublicacion'] ?></td>
                                            <td>
                                                <small class="font-monospace">
                                                    <?= esc($recurso['isbn']) ?>
                                                </small>
                                            </td>
                                            <td><?= number_format($recurso['numpaginas']) ?></td>
                                            <td>
                                                <?php
                                                $estadoClass = match($recurso['estado']) {
                                                    'Bueno' => 'bg-success',
                                                    'Regular' => 'bg-warning',
                                                    'Malo' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $estadoClass ?>">
                                                    <?= $recurso['estado'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-outline-info btn-ver" 
                                                            data-id="<?= $recurso['idrecurso'] ?>"
                                                            title="Ver detalles">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-warning btn-editar" 
                                                            data-id="<?= $recurso['idrecurso'] ?>"
                                                            title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger btn-eliminar" 
                                                            data-id="<?= $recurso['idrecurso'] ?>"
                                                            title="Eliminar">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver detalles -->
<div class="modal fade" id="modalDetalles" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle"></i> Detalles del Recurso
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detallesRecurso">
                <!-- Contenido dinámico -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast para notificaciones -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="toastNotificacion" class="toast" role="alert">
        <div class="toast-header">
            <i class="fas fa-info-circle text-primary me-2"></i>
            <strong class="me-auto">Biblioteca</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body" id="toastMensaje">
            <!-- Mensaje dinámico -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Referencias a elementos
    const buscarInput = document.getElementById('buscarTitulo');
    const btnBuscar = document.getElementById('btnBuscar');
    const btnLimpiar = document.getElementById('btnLimpiar');
    const tablaRecursos = document.getElementById('tablaRecursos');
    const totalRecursos = document.getElementById('totalRecursos');
    const modalDetalles = new bootstrap.Modal(document.getElementById('modalDetalles'));
    const toastNotificacion = new bootstrap.Toast(document.getElementById('toastNotificacion'));

    // Función para mostrar toast
    function mostrarToast(mensaje, tipo = 'info') {
        const toastElement = document.getElementById('toastNotificacion');
        const toastHeader = toastElement.querySelector('.toast-header i');
        const toastMensaje = document.getElementById('toastMensaje');
        
        // Cambiar icono y color según tipo
        toastHeader.className = `fas me-2 ${tipo === 'success' ? 'fa-check-circle text-success' : 
                                           tipo === 'error' ? 'fa-exclamation-circle text-danger' : 
                                           'fa-info-circle text-primary'}`;
        
        toastMensaje.textContent = mensaje;
        toastNotificacion.show();
    }

    // Buscar recursos
    async function buscarRecursos(titulo = '') {
        try {
            const formData = new FormData();
            formData.append('titulo', titulo);

            const response = await fetch('<?= base_url('recursos/buscar') ?>', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                actualizarTabla(result.data);
                totalRecursos.textContent = `Total: ${result.data.length} recursos`;
            } else {
                mostrarToast('Error al buscar recursos', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarToast('Error de conexión', 'error');
        }
    }

    // Actualizar tabla
    function actualizarTabla(recursos) {
        if (recursos.length === 0) {
            tablaRecursos.innerHTML = `
                <tr>
                    <td colspan="11" class="text-center text-muted">
                        <i class="fas fa-search fa-3x mb-3"></i>
                        <br>No se encontraron recursos
                    </td>
                </tr>
            `;
            return;
        }

        let html = '';
        recursos.forEach(recurso => {
            const estadoClass = recurso.estado === 'Bueno' ? 'bg-success' : 
                               recurso.estado === 'Regular' ? 'bg-warning' : 'bg-danger';
            
            const tipoClass = recurso.tipo === 'Digital' ? 'bg-success' : 'bg-info';
            const tipoIcon = recurso.tipo === 'Digital' ? 'fas fa-laptop' : 'fas fa-book';

            html += `
                <tr data-id="${recurso.idrecurso}">
                    <td>${recurso.idrecurso}</td>
                    <td>
                        <strong>${recurso.titulo}</strong>
                        ${recurso.rutaportada ? '<br><small class="text-muted"><i class="fas fa-image"></i> Con portada</small>' : ''}
                    </td>
                    <td><span class="badge bg-secondary">${recurso.categoria}</span></td>
                    <td>${recurso.subcategoria}</td>
                    <td>
                        ${recurso.editorial}
                        <br><small class="text-muted"><i class="fas fa-flag"></i> ${recurso.nacionalidad}</small>
                    </td>
                    <td><span class="badge ${tipoClass}"><i class="${tipoIcon}"></i> ${recurso.tipo}</span></td>
                    <td>${recurso.apublicacion}</td>
                    <td><small class="font-monospace">${recurso.isbn}</small></td>
                    <td>${new Intl.NumberFormat().format(recurso.numpaginas)}</td>
                    <td><span class="badge ${estadoClass}">${recurso.estado}</span></td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-info btn-ver" data-id="${recurso.idrecurso}" title="Ver detalles">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-editar" data-id="${recurso.idrecurso}" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-eliminar" data-id="${recurso.idrecurso}" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        });
        
        tablaRecursos.innerHTML = html;
        agregarEventListeners();
    }

    // Agregar event listeners a botones dinámicos
    function agregarEventListeners() {
        // Botones eliminar
        document.querySelectorAll('.btn-eliminar').forEach(btn => {
            btn.addEventListener('click', async function() {
                const id = this.dataset.id;
                
                const result = await Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                });

                if (result.isConfirmed) {
                    await eliminarRecurso(id);
                }
            });
        });
    }

    // Eliminar recurso
    async function eliminarRecurso(id) {
        try {
            const response = await fetch(`<?= base_url('recursos/eliminar') ?>/${id}`, {
                method: 'POST'
            });

            const result = await response.json();

            if (result.success) {
                mostrarToast('Recurso eliminado exitosamente', 'success');
                // Recargar tabla
                buscarRecursos(buscarInput.value);
            } else {
                mostrarToast(result.message || 'Error al eliminar recurso', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarToast('Error de conexión', 'error');
        }
    }

    // Event listeners
    btnBuscar.addEventListener('click', () => {
        buscarRecursos(buscarInput.value.trim());
    });

    btnLimpiar.addEventListener('click', () => {
        buscarInput.value = '';
        buscarRecursos();
    });

    buscarInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            buscarRecursos(buscarInput.value.trim());
        }
    });

    // Inicializar event listeners
    agregarEventListeners();
});
</script>

<!-- CDN para SweetAlert2 y FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?= $footer ?>
