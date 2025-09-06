<?= $header ?>

<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-plus-circle"></i> Registrar Nuevo Recurso Educativo
                    </h4>
                    <small class="text-muted">Complete todos los campos obligatorios (*)</small>
                </div>
                <div class="card-body">
                    <form id="formRecurso" novalidate>
                        <div class="row">
                            <!-- Información básica -->
                            <div class="col-md-12 mb-3">
                                <h6 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-info-circle"></i> Información Básica
                                </h6>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="titulo" class="form-label">Título del Recurso *</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="categoria" class="form-label">Categoría *</label>
                                <select class="form-select" id="categoria" name="categoria" required>
                                    <option value="">Seleccione una categoría</option>
                                    <?php foreach ($categorias as $categoria => $subcategorias): ?>
                                        <option value="<?= esc($categoria) ?>"><?= esc($categoria) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="idsubcategoria" class="form-label">Subcategoría *</label>
                                <select class="form-select" id="idsubcategoria" name="idsubcategoria" required disabled>
                                    <option value="">Primero seleccione una categoría</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="ideditorial" class="form-label">Editorial *</label>
                                <select class="form-select" id="ideditorial" name="ideditorial" required>
                                    <option value="">Seleccione una editorial</option>
                                    <?php foreach ($editoriales as $editorial): ?>
                                        <option value="<?= $editorial['ideditorial'] ?>">
                                            <?= esc($editorial['editorial']) ?> (<?= esc($editorial['nacionalidad']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tipo" class="form-label">Tipo de Recurso *</label>
                                <select class="form-select" id="tipo" name="tipo" required>
                                    <option value="">Seleccione el tipo</option>
                                    <option value="Digital">Digital</option>
                                    <option value="Fisico">Físico</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Detalles del recurso -->
                            <div class="col-md-12 mb-3 mt-3">
                                <h6 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-book-open"></i> Detalles del Recurso
                                </h6>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="apublicacion" class="form-label">Año de Publicación *</label>
                                <input type="number" class="form-control" id="apublicacion" name="apublicacion" 
                                       min="1900" max="<?= date('Y') ?>" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="numpaginas" class="form-label">Número de Páginas *</label>
                                <input type="number" class="form-control" id="numpaginas" name="numpaginas" 
                                       min="1" required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="estado" class="form-label">Estado del Recurso *</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option value="">Seleccione el estado</option>
                                    <option value="Bueno">Bueno</option>
                                    <option value="Regular">Regular</option>
                                    <option value="Malo">Malo</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="isbn" class="form-label">ISBN *</label>
                                <input type="text" class="form-control" id="isbn" name="isbn" 
                                       placeholder="978-612-00-1234-5" maxlength="17" required>
                                <div class="form-text">13 dígitos (puede incluir guiones): 978-612-00-1234-5</div>
                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Archivos opcionales -->
                            <div class="col-md-12 mb-3 mt-3">
                                <h6 class="text-primary border-bottom pb-2">
                                    <i class="fas fa-file-upload"></i> Archivos (Opcional)
                                </h6>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="portada" class="form-label">Imagen de la Portada</label>
                                <input type="file" class="form-control" id="portada" name="portada" 
                                       accept="image/*">
                                <div class="form-text">Seleccione una imagen para la portada (JPG, PNG, etc.)</div>
                                <div class="invalid-feedback"></div>
                                <input type="hidden" id="rutaportada" name="rutaportada">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="recurso_digital" class="form-label">Archivo del Recurso Digital</label>
                                <input type="file" class="form-control" id="recurso_digital" name="recurso_digital" 
                                       accept=".pdf">
                                <div class="form-text">Seleccione un archivo PDF (solo para recursos digitales)</div>
                                <div class="invalid-feedback"></div>
                                <input type="hidden" id="rutarecurso" name="rutarecurso">
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('recursos') ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Volver
                                    </a>
                                    <div>
                                        <button type="reset" class="btn btn-outline-secondary me-2">
                                            <i class="fas fa-undo"></i> Limpiar
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="btnGuardar">
                                            <i class="fas fa-save"></i> Registrar Recurso
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Toast para notificaciones -->
<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="toastNotificacion" class="toast" role="alert">
        <div class="toast-header">
            <i class="fas fa-info-circle text-primary me-2" id="toastIcon"></i>
            <strong class="me-auto">Biblioteca</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body" id="toastMensaje">
            <!-- Mensaje dinámico -->
        </div>
    </div>
</div>

<!-- Loading overlay -->
<div id="loadingOverlay" class="position-fixed top-0 start-0 w-100 h-100 d-none" 
     style="background: rgba(0,0,0,0.5); z-index: 9999;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-center text-white">
            <div class="spinner-border mb-3" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <div>Registrando recurso...</div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Referencias a elementos
    const form = document.getElementById('formRecurso');
    const btnGuardar = document.getElementById('btnGuardar');
    const loadingOverlay = document.getElementById('loadingOverlay');
    const toastNotificacion = new bootstrap.Toast(document.getElementById('toastNotificacion'));
    const categoriaSelect = document.getElementById('categoria');
    const subcategoriaSelect = document.getElementById('idsubcategoria');
    const tipoSelect = document.getElementById('tipo');
    const rutaRecursoInput = document.getElementById('rutarecurso');

    // Datos de subcategorías por categoría
    const subcategoriasPorCategoria = <?= json_encode($categorias) ?>;

    // Función para mostrar toast
    function mostrarToast(mensaje, tipo = 'info') {
        const toastIcon = document.getElementById('toastIcon');
        const toastMensaje = document.getElementById('toastMensaje');
        
        // Cambiar icono y color según tipo
        const iconClass = tipo === 'success' ? 'fa-check-circle text-success' : 
                         tipo === 'error' ? 'fa-exclamation-circle text-danger' : 
                         tipo === 'warning' ? 'fa-exclamation-triangle text-warning' :
                         'fa-info-circle text-primary';
        
        toastIcon.className = `fas ${iconClass} me-2`;
        toastMensaje.textContent = mensaje;
        toastNotificacion.show();
    }

    // Función para mostrar/ocultar loading
    function toggleLoading(show) {
        if (show) {
            loadingOverlay.classList.remove('d-none');
            btnGuardar.disabled = true;
        } else {
            loadingOverlay.classList.add('d-none');
            btnGuardar.disabled = false;
        }
    }

    // Función para limpiar validaciones
    function limpiarValidaciones() {
        form.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
        form.querySelectorAll('.invalid-feedback').forEach(el => {
            el.textContent = '';
        });
    }

    // Función para mostrar errores de validación
    function mostrarErrores(errores) {
        limpiarValidaciones();
        
        Object.keys(errores).forEach(campo => {
            const input = form.querySelector(`[name="${campo}"]`);
            if (input) {
                input.classList.add('is-invalid');
                const feedback = input.parentNode.querySelector('.invalid-feedback');
                if (feedback) {
                    feedback.textContent = errores[campo];
                }
            }
        });
    }

    // Validaciones en tiempo real
    function validarCampo(input) {
        const valor = input.value.trim();
        let esValido = true;
        let mensaje = '';

        switch (input.name) {
            case 'titulo':
                if (!valor) {
                    esValido = false;
                    mensaje = 'El título es obligatorio';
                } else if (valor.length < 3) {
                    esValido = false;
                    mensaje = 'El título debe tener al menos 3 caracteres';
                } else if (valor.length > 200) {
                    esValido = false;
                    mensaje = 'El título no puede exceder 200 caracteres';
                }
                break;

            case 'apublicacion':
                const año = parseInt(valor);
                const añoActual = new Date().getFullYear();
                if (!valor) {
                    esValido = false;
                    mensaje = 'El año de publicación es obligatorio';
                } else if (año < 1900 || año > añoActual) {
                    esValido = false;
                    mensaje = `El año debe estar entre 1900 y ${añoActual}`;
                }
                break;

            case 'numpaginas':
                const paginas = parseInt(valor);
                if (!valor) {
                    esValido = false;
                    mensaje = 'El número de páginas es obligatorio';
                } else if (paginas < 1) {
                    esValido = false;
                    mensaje = 'El número de páginas debe ser mayor a 0';
                }
                break;

            case 'isbn':
                if (!valor) {
                    esValido = false;
                    mensaje = 'El ISBN es obligatorio';
                } else {
                    // Remover guiones y espacios para validar
                    const isbnLimpio = valor.replace(/[-\s]/g, '');
                    if (isbnLimpio.length !== 13) {
                        esValido = false;
                        mensaje = 'El ISBN debe tener exactamente 13 dígitos';
                    } else if (!/^\d{13}$/.test(isbnLimpio)) {
                        esValido = false;
                        mensaje = 'El ISBN debe contener solo números';
                    }
                }
                break;
        }

        // Aplicar validación visual
        if (esValido) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            const feedback = input.parentNode.querySelector('.invalid-feedback');
            if (feedback) {
                feedback.textContent = mensaje;
            }
        }

        return esValido;
    }

    // Event listener para cambio de categoría
    categoriaSelect.addEventListener('change', function() {
        const categoriaSeleccionada = this.value;
        subcategoriaSelect.innerHTML = '<option value="">Seleccione una subcategoría</option>';
        
        if (categoriaSeleccionada && subcategoriasPorCategoria[categoriaSeleccionada]) {
            subcategoriaSelect.disabled = false;
            subcategoriasPorCategoria[categoriaSeleccionada].forEach(sub => {
                const option = document.createElement('option');
                option.value = sub.idsubcategoria;
                option.textContent = sub.subcategoria;
                subcategoriaSelect.appendChild(option);
            });
        } else {
            subcategoriaSelect.disabled = true;
        }
        
        subcategoriaSelect.classList.remove('is-valid', 'is-invalid');
    });

    // Event listener para tipo de recurso
    const recursoDigitalInput = document.getElementById('recurso_digital');
    tipoSelect.addEventListener('change', function() {
        if (this.value === 'Fisico') {
            recursoDigitalInput.value = '';
            recursoDigitalInput.disabled = true;
            recursoDigitalInput.parentNode.querySelector('.form-text').textContent = 'No aplica para recursos físicos';
        } else {
            recursoDigitalInput.disabled = false;
            recursoDigitalInput.parentNode.querySelector('.form-text').textContent = 'Seleccione un archivo PDF (solo para recursos digitales)';
        }
    });

    // Validación en tiempo real para campos específicos
    ['titulo', 'apublicacion', 'numpaginas', 'isbn'].forEach(campo => {
        const input = form.querySelector(`[name="${campo}"]`);
        if (input) {
            input.addEventListener('blur', () => validarCampo(input));
            input.addEventListener('input', () => {
                if (input.classList.contains('is-invalid')) {
                    validarCampo(input);
                }
            });
        }
    });

    // Validación para selects
    form.querySelectorAll('select[required]').forEach(select => {
        select.addEventListener('change', function() {
            if (this.value) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            }
        });
    });

    // Envío del formulario
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Validar formulario
        let formularioValido = true;
        
        // Validar campos requeridos
        form.querySelectorAll('[required]').forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('is-invalid');
                formularioValido = false;
            } else {
                // Validaciones específicas
                if (['titulo', 'apublicacion', 'numpaginas', 'isbn'].includes(input.name)) {
                    if (!validarCampo(input)) {
                        formularioValido = false;
                    }
                }
            }
        });

        if (!formularioValido) {
            mostrarToast('Por favor, corrija los errores en el formulario', 'warning');
            return;
        }

        // Confirmar registro
        const confirmacion = await Swal.fire({
            title: '¿Registrar recurso?',
            text: 'Se creará un nuevo recurso educativo con la información proporcionada',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, registrar',
            cancelButtonText: 'Cancelar'
        });

        if (!confirmacion.isConfirmed) {
            return;
        }

        // Mostrar loading
        toggleLoading(true);

        try {
            // Preparar datos
            const formData = new FormData(form);

            // Enviar datos
            const response = await fetch('<?= base_url('recursos/guardar') ?>', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                // Ocultar loading inmediatamente
                toggleLoading(false);
                
                // Mostrar éxito
                await Swal.fire({
                    title: '¡Éxito!',
                    text: 'Recurso registrado exitosamente',
                    icon: 'success',
                    confirmButtonText: 'Continuar'
                });

                // Redirigir inmediatamente
                if (result.redirect) {
                    window.location.href = result.redirect;
                } else {
                    window.location.href = '<?= base_url('recursos') ?>';
                }
                return; // Salir de la función para evitar ejecutar el finally

            } else {
                if (result.errors) {
                    mostrarErrores(result.errors);
                    mostrarToast('Error de validación', 'error');
                } else {
                    mostrarToast(result.message || 'Error al registrar el recurso', 'error');
                }
            }

        } catch (error) {
            console.error('Error:', error);
            mostrarToast('Error de conexión. Inténtelo nuevamente', 'error');
        } finally {
            toggleLoading(false);
        }
    });

    // Limpiar formulario
    form.addEventListener('reset', function() {
        setTimeout(() => {
            limpiarValidaciones();
            subcategoriaSelect.disabled = true;
            subcategoriaSelect.innerHTML = '<option value="">Primero seleccione una categoría</option>';
            rutaRecursoInput.disabled = false;
            rutaRecursoInput.placeholder = 'recursos/archivo.pdf';
        }, 10);
    });
});
</script>

<!-- CDN para SweetAlert2 y FontAwesome -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?= $footer ?>
