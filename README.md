# Password Generator

Generador web en PHP para crear contraseñas seguras compatibles con escenarios SOAP/XML.

## Estado del Proyecto
- Version actual: `V1.0.1`
- Licencia: Apache License 2.0
- Rama principal: `main`
- Release automatizado: si, en cada push a `main` usando `.github/workflows/release.yml`

## Que Hace el Programa
- Genera contraseñas seguras entre 4 y 20 caracteres.
- Garantiza al menos:
	- 1 letra minuscula
	- 1 letra mayuscula
	- 1 numero
	- 1 caracter especial seguro para SOAP/XML
- Excluye caracteres problematicos para XML/SOAP como `&`, `<`, `>`, `"`, `'`.
- Expone un endpoint JSON para integraciones.
- Permite copiar la contraseña al portapapeles desde la UI.

## Endpoints
### `GET /api/password.php?length=14`
Respuesta ejemplo:

```json
{
	"password": "A7f!k2Q#m9Lp",
	"version": "V1.0.1"
}
```

## Dependencias
### Runtime backend
- PHP 5.4 o superior
- Extension OpenSSL opcional (si no esta disponible, se usa fallback con `mt_rand`)

### Frontend (CDN)
- Bootstrap 5.3.0
- jQuery 3.6.0
- Animate.css 4.1.1

## Estructura del Repositorio
- `index.php`: capa de presentacion (frontend server-side rendering)
- `backend/password_service.php`: logica de negocio (version y generacion de password)
- `api/password.php`: endpoint JSON del backend
- `assets/css/app.css`: estilos del frontend
- `assets/js/app.js`: comportamiento del frontend
- `VERSION`: fuente unica de verdad del versionado (`Vx.x.x`)
- `CHANGELOG.md`: historial de cambios
- `.github/workflows/release.yml`: crea tag/release en cada push a `main`
- `LICENSE`: texto legal Apache 2.0

## Politica de Versionado (Best Practice)
Este repositorio usa Semantic Versioning con prefijo `V`:
- `VMAJOR.MINOR.PATCH`
- `MAJOR`: cambios incompatibles
- `MINOR`: nuevas funcionalidades compatibles
- `PATCH`: correcciones

Regla operativa del proyecto:
- Cada commit que llegue a `main` debe tener nueva version.
- Antes de commit:
	1. Actualiza `VERSION`
	2. Actualiza `CHANGELOG.md`
	3. Verifica que la app muestre la misma version
- El workflow de release usa exactamente el valor de `VERSION` para tag y release.

## Flujo Recomendado para Nueva Version
1. Editar `VERSION` (por ejemplo, `V1.0.1`)
2. Documentar cambios en `CHANGELOG.md`
3. Commit con mensaje claro
4. Push a `main`
5. GitHub Actions crea/asegura tag y genera Release automaticamente

## Ejecucion Local
Sirve el proyecto con tu stack PHP (EasyPHP en tu caso) y abre `index.php` en navegador.

## Seguridad
- Evita exponer este generador sin HTTPS si se usa en produccion.
- Si necesitas entropia criptografica fuerte, habilita OpenSSL en PHP.

## Licencia
Distribuido bajo Apache License 2.0. Ver archivo `LICENSE`.
