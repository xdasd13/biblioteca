<?= $header ?>

<style>
.recursos-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #dee2e6;
    padding: 1.5rem 0;
    margin-bottom: 1.5rem;
}

.recursos-title {
    color: #495057;
    font-weight: 600;
}

.recursos-subtitle {
    color: #6c757d;
    font-size: 0.95rem;
}

.card-recursos {
    border: 1px solid #e9ecef;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.04);
}

.table-header {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    color: #495057;
    font-weight: 600;
    font-size: 0.9rem;
}

.table-striped > tbody > tr:nth-of-type(odd) {
    background-color: #fafbfc;
}

.table-hover tbody tr:hover {
    background-color: #f1f3f4;
    transition: background-color 0.15s ease;
}

.portada-img {
    width: 45px;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #dee2e6;
}

.isbn-formatted {
    font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
    font-size: 0.85rem;
    color: #495057;
    font-weight: 500;
}

.badge-custom {
    font-size: 0.75rem;
    font-weight: 500;
    padding: 0.35em 0.65em;
}

.btn-action {
    padding: 0.25rem 0.5rem;
    font-size: 0.8rem;
    border-radius: 4px;
    transition: all 0.15s ease;
}

.btn-action:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.pdf-preview {
    color: #dc3545;
    text-decoration: none;
    font-size: 0.9rem;
}

.pdf-preview:hover {
    color: #c82333;
    text-decoration: underline;
}

.no-pdf {
    color: #6c757d;
    font-style: italic;
    font-size: 0.85rem;
}
</style>

<div class="recursos-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-1 recursos-title">
                    <i class="fas fa-book-open me-2"></i>Lista de Recursos Educativos
                </h2>
            </div>
            <div class="col-md-4 text-end">
                <a href="<?= base_url('recursos/crear') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Nuevo Recurso
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-recursos">
                <div class="card-body p-0">

                    <!-- Tabla de recursos -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-header">
                                <tr>
                                    <th class="text-center" style="width: 80px;">Portada</th>
                                    <th style="width: 25%;">Título</th>
                                    <th style="width: 12%;">Categoría</th>
                                    <th style="width: 15%;">Editorial</th>
                                    <th style="width: 8%;">Tipo</th>
                                    <th style="width: 8%;">Año</th>
                                    <th style="width: 12%;">ISBN</th>
                                    <th style="width: 8%;">Páginas</th>
                                    <th style="width: 8%;">Estado</th>
                                    <th class="text-center" style="width: 10%;">Archivo</th>
                                    <th class="text-center" style="width: 8%;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($recursos)): ?>
                                    <tr>
                                        <td colspan="11" class="text-center text-muted py-5">
                                            <i class="fas fa-book-open fa-4x mb-3 opacity-50"></i>
                                            <br><h5>No hay recursos registrados</h5>
                                            <p>Comience agregando su primer recurso educativo</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php 
                                    function formatIsbn($isbn) {
                                        if (strlen($isbn) === 13) {
                                            return substr($isbn, 0, 3) . '-' . substr($isbn, 3, 3) . '-' . substr($isbn, 6, 2) . '-' . substr($isbn, 8, 4) . '-' . substr($isbn, 12, 1);
                                        }
                                        return $isbn;
                                    }
                                    ?>
                                    <?php foreach ($recursos as $recurso): ?>
                                        <tr data-id="<?= $recurso['idrecurso'] ?>">
                                            <td class="text-center">
                                                <?php if (!empty($recurso['rutaportada']) && file_exists(FCPATH . $recurso['rutaportada'])): ?>
                                                    <img src="<?= base_url($recurso['rutaportada']) ?>" 
                                                         alt="Portada" class="portada-img" 
                                                         title="<?= esc($recurso['titulo']) ?>">
                                                <?php else: ?>
                                                    <div class="portada-img d-flex align-items-center justify-content-center bg-light border">
                                                        <i class="fas fa-book text-muted"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <strong class="text-primary"><?= esc($recurso['titulo']) ?></strong>
                                                <br><small class="text-muted">
                                                    <?= esc($recurso['subcategoria']) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary badge-custom">
                                                    <?= esc($recurso['categoria']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <strong><?= esc($recurso['editorial']) ?></strong>
                                                <br><small class="text-muted">
                                                    <i class="fas fa-flag"></i> <?= esc($recurso['nacionalidad']) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <?php if ($recurso['tipo'] == 'Digital'): ?>
                                                    <span class="badge bg-info badge-custom">
                                                        <i class="fas fa-laptop me-1"></i>Digital
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-primary badge-custom">
                                                        <i class="fas fa-book me-1"></i>Físico
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <strong><?= $recurso['apublicacion'] ?></strong>
                                            </td>
                                            <td>
                                                <span class="isbn-formatted">
                                                    <?= formatIsbn($recurso['isbn']) ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <strong><?= number_format($recurso['numpaginas']) ?></strong>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                $estadoClass = match($recurso['estado']) {
                                                    'Bueno' => 'bg-success',
                                                    'Regular' => 'bg-warning text-dark',
                                                    'Malo' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                                ?>
                                                <span class="badge <?= $estadoClass ?> badge-custom">
                                                    <?= $recurso['estado'] ?>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <?php if (!empty($recurso['rutarecurso']) && file_exists(FCPATH . $recurso['rutarecurso'])): ?>
                                                    <a href="<?= base_url($recurso['rutarecurso']) ?>" 
                                                       target="_blank" 
                                                       class="pdf-preview"
                                                       title="Ver/Descargar PDF">
                                                        <i class="fas fa-file-pdf me-1"></i>PDF
                                                    </a>
                                                <?php else: ?>
                                                    <span class="no-pdf">Sin archivo</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-danger btn-sm btn-action btn-eliminar" 
                                                        data-id="<?= $recurso['idrecurso'] ?>"
                                                        title="Eliminar recurso">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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

    // Eliminar recurso
    async function eliminarRecurso(id) {
        try {
            const response = await fetch(`<?= base_url('recursos/eliminar') ?>/${id}`, {
                method: 'POST'
            });

            const result = await response.json();

            if (result.success) {
                mostrarToast('Recurso eliminado exitosamente', 'success');
                // Recargar página para actualizar la lista
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                mostrarToast(result.message || 'Error al eliminar recurso', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarToast('Error de conexión', 'error');
        }
    }

    // Event listeners para botones eliminar
    document.querySelectorAll('.btn-eliminar').forEach(btn => {
        btn.addEventListener('click', async function() {
            const id = this.dataset.id;
            
            const result = await Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#007bff',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            });

            if (result.isConfirmed) {
                await eliminarRecurso(id);
            }
        });
    });

    // Efecto hover mejorado para las filas
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.boxShadow = '0 4px 8px rgba(0, 123, 255, 0.2)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.boxShadow = 'none';
        });
    });
});
</script>

<!-- CDN para SweetAlert2 y FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?= $footer ?>
