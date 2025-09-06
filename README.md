# 📚 Sistema de Gestión de Biblioteca - Recursos Educativos

## Descripción del Proyecto

Sistema web desarrollado en **CodeIgniter 4** para la gestión integral de recursos educativos en bibliotecas. Permite administrar tanto recursos físicos como digitales con funcionalidades completas de registro, visualización y descarga de contenido.

## 🎯 Características Principales

### Gestión de Recursos Educativos
- **Registro completo** de recursos físicos y digitales
- **Categorización** por áreas académicas (Matemáticas, Comunicación, Computación)
- **Subcategorías** específicas para cada área de conocimiento
- **Información detallada**: título, año de publicación, ISBN, número de páginas, estado
- **Gestión de editoriales** con información de nacionalidad

### Funcionalidades de Archivos
- **Subida de imágenes de portada** para identificación visual
- **Carga de archivos PDF** para recursos digitales
- **Previsualización y descarga** de documentos PDF
- **Almacenamiento seguro** en directorio `public/uploads/`

### Interfaz de Usuario
- **Diseño limpio y moderno** siguiendo principios UX/UI
- **Lista organizada** con información esencial
- **Formato profesional** del ISBN (978-612-00-1234-5)
- **Indicadores visuales** de estado y tipo de recurso
- **Responsive design** para diferentes dispositivos

## 🛠️ Tecnologías Utilizadas

- **Framework**: CodeIgniter 4
- **Lenguaje**: PHP 8.1+
- **Base de Datos**: MySQL
- **Frontend**: Bootstrap 5, FontAwesome, SweetAlert2
- **Servidor**: Laragon (Windows)

## 📋 Estructura de Datos

### Tabla: recursos
- `idrecurso` - ID único del recurso
- `idsubcategoria` - Relación con subcategoría
- `ideditorial` - Relación con editorial
- `tipo` - Físico o Digital
- `titulo` - Título del recurso
- `apublicacion` - Año de publicación
- `isbn` - Código ISBN (13 dígitos)
- `numpaginas` - Número de páginas
- `rutaportada` - Ruta de imagen de portada
- `rutarecurso` - Ruta de archivo PDF
- `estado` - Bueno, Regular, Malo
- `creado` - Fecha de creación
- `modificado` - Fecha de modificación

### Relaciones
- **Categorías → Subcategorías → Recursos**
- **Editoriales → Recursos**
- **Ubicación geográfica** (Departamentos → Provincias → Distritos)

## 🚀 Instalación y Configuración

### Requisitos Previos
- PHP 8.1 o superior
- MySQL 5.7 o superior
- Composer
- Laragon (o cualquier otro servidor web)

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/xdasd13/biblioteca.git
   cd biblioteca
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar base de datos**
   - Copiar `.env.example` a `.env`
   - Configurar credenciales de base de datos
   - Importar `app/Database/Database.sql`



## 📁 Estructura del Proyecto

```
biblioteca/
├── app/
│   ├── Controllers/
│   │   ├── RecursoController.php    # Gestión de recursos
│   │   ├── EditorialController.php  # Gestión de editoriales
│   │   └── PersonaController.php    # Gestión de personas
│   ├── Models/
│   │   ├── Recurso.php             # Modelo de recursos
│   │   ├── Editorial.php           # Modelo de editoriales
│   │   └── Categoria.php           # Modelo de categorías
│   ├── Views/
│   │   └── recursos/
│   │       ├── index.php           # Lista de recursos
│   │       └── crear.php           # Formulario de registro
│   └── Database/
│       └── Database.sql            # Estructura de BD
├── public/
│   └── uploads/                    # Archivos subidos
└── README.md
```

## 🎨 Funcionalidades por Módulo

### Módulo de Recursos
- ✅ **Crear** nuevos recursos con validaciones
- ✅ **Listar** recursos con información completa
- ✅ **Eliminar** recursos con confirmación
- ✅ **Subir archivos** (imágenes y PDFs)
- ✅ **Descargar/Previsualizar** documentos PDF

### Validaciones Implementadas
- ISBN único de 13 dígitos
- Año de publicación válido (1900 - actual)
- Campos obligatorios con mensajes personalizados
- Validación de tipos de archivo (imágenes/PDF)

### Características UX/UI
- Interfaz limpia y profesional
- Feedback visual inmediato
- Carga de archivos drag & drop
- Confirmaciones de acciones críticas
- Mensajes de estado claros

## 🔧 Uso del Sistema

### Registrar un Nuevo Recurso
1. Acceder a "Nuevo Recurso"
2. Completar información básica
3. Seleccionar categoría y subcategoría
4. Subir imagen de portada (opcional)
5. Para recursos digitales: subir archivo PDF
6. Guardar el recurso

### Gestionar Recursos Existentes
- **Ver lista**: Acceso directo desde página principal
- **Descargar PDF**: Click en enlace "PDF" en la columna Archivo
- **Eliminar**: Botón de eliminar con confirmación

## 🌟 Características Destacadas

- **Sistema de archivos robusto** con nombres únicos
- **Validación integral** de datos de entrada
- **Interfaz responsive** para móviles y escritorio
- **Gestión de errores** con mensajes informativos
- **Código limpio** siguiendo estándares PSR
- **Base de datos normalizada** con relaciones bien definidas


---

**Desarrollado con ❤️ usando CodeIgniter 4**

## 🔒 Configuración de Seguridad

### Configuración del Servidor Web
- Configurar el servidor web para apuntar a la carpeta `public/`
- **NO** apuntar al directorio raíz del proyecto
- Configurar un virtual host para mayor seguridad

### Variables de Entorno
```bash
# Ejemplo de configuración .env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost/biblioteca/public/'

database.default.hostname = localhost
database.default.database = biblioteca
database.default.username = tu_usuario
database.default.password = tu_password
database.default.DBDriver = MySQLi
```

## 📝 Licencia

Este proyecto está desarrollado para fines educativos y de gestión bibliotecaria.