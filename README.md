# berrinchitosdent.com

Sitio del consultorio odontopediátrico Berrinchitos — Dra. Arleth Luna, Ciudad de México.
Contenido informativo sobre cuidado dental infantil; atención de adultos como
servicio secundario.

En producción: **https://berrinchitosdent.com**

## Decisiones de arquitectura

- **Sin base de datos.** El contacto es un enlace directo a WhatsApp, no un
  formulario. Nada que persistir → nada que proteger.
- **Sin build.** PHP plano con `include` para header/footer. No hay npm, no hay
  bundler, no hay paso de compilación. Se edita un archivo y ya está en producción.
- **Sin uploads.** El pool de PHP corre con `file_uploads = Off` y el código
  montado read-only. Todo el contenido (textos, fotos) vive en este repo y viaja
  por rsync.
- **Sin JavaScript.** El selector interactivo de la primera visita usa radios
  nativos y selectores hermanos de CSS. Accesible por teclado de fábrica.

## Estructura

```
public/              # ÚNICO directorio servido (webroot)
├── index.php
├── partials/
│   ├── config.php   # todos los datos del consultorio se editan acá
│   ├── header.php
│   └── footer.php
└── assets/{css,img}
deploy.sh            # rsync a producción
deploy.env.example   # plantilla de configuración del servidor
```

Los datos del negocio (teléfono, dirección, horarios, servicios) están
centralizados en `public/partials/config.php`. Un cambio de horario se hace ahí
y se propaga solo a la tabla, al hero y al JSON-LD de Google.

> Todo `.php` dentro de `public/` es alcanzable por URL en este servidor. Por eso
> los partials exigen la constante `BERRINCHITOS` y devuelven 404 si se los pide
> directamente. Cualquier include nuevo necesita el mismo guard.

## Desarrollo local

```bash
php -S localhost:8080 -t public/
```

No hace falta Postgres ni Docker: el sitio no tiene backend con estado.

## Deploy

La primera vez, configurá el destino:

```bash
cp deploy.env.example deploy.env   # completá con los datos de tu servidor
```

Después, cada publicación:

```bash
./deploy.sh
```

Los cambios se sirven al instante — php-fpm lee el archivo en cada request, no
hay restart ni build.

## Verificar producción

```bash
curl -sI https://berrinchitosdent.com/ | head -3
```
