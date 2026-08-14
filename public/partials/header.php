<?php
if (!defined('BERRINCHITOS')) { http_response_code(404); exit; }

$cfg = require __DIR__ . '/config.php';

/** Escape de salida. Todo texto que llegue al HTML pasa por acá. */
function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$wa = 'https://wa.me/' . $cfg['whatsapp'] . '?text=' . rawurlencode($cfg['whatsapp_msg']);

/**
 * Cache busting. Cloudflare cachea los estáticos 4 horas: sin esto, un cambio
 * de CSS tarda hasta 4 h en verse y hay que purgar la caché a mano cada deploy.
 * La marca de tiempo del archivo cambia sola con cada rsync, así que la URL
 * cambia sola y Cloudflare la sirve fresca.
 */
function v(string $rutaPublica): string {
    $abs = __DIR__ . '/..' . $rutaPublica;
    $t = is_file($abs) ? filemtime($abs) : null;
    return $rutaPublica . ($t ? '?v=' . $t : '');
}

$titulo = $titulo ?? 'Berrinchitosdent · Odontopediatría en la Ciudad de México';
$desc   = $desc   ?? 'Consultorio de odontopediatría de la Dra. Arleth Luna en la Ciudad de México. Atención dental para niños, sin apuros y sin regaños. También atendemos adultos.';
?>
<!doctype html>
<html lang="es-MX">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($titulo) ?></title>
<meta name="description" content="<?= e($desc) ?>">
<link rel="canonical" href="https://berrinchitosdent.com/">

<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($titulo) ?>">
<meta property="og:description" content="<?= e($desc) ?>">
<meta property="og:url" content="https://berrinchitosdent.com/">
<meta property="og:locale" content="es_MX">
<?php /* JPG y no WebP: WhatsApp y Facebook no siempre renderizan WebP en la vista previa */ ?>
<meta property="og:image" content="https://berrinchitosdent.com<?= e(v('/assets/img/og-berrinchitos.jpg')) ?>">
<meta property="og:image:width" content="534">
<meta property="og:image:height" content="641">

<link rel="icon" href="<?= e(v('/assets/img/favicon.svg')) ?>" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gabarito:wght@500;700;800;900&family=Karla:ital,wght@0,400;0,500;0,700;1,400&display=swap">
<link rel="stylesheet" href="<?= e(v('/assets/css/style.css')) ?>">

<?php
$negocio = [
    '@context' => 'https://schema.org',
    '@type'    => 'Dentist',
    'name'     => $cfg['nombre'],
    'url'      => 'https://berrinchitosdent.com/',
    'telephone' => $cfg['telefono_tel'],
    'email'    => $cfg['email'],
    'medicalSpecialty' => 'Pediatric',
    'address'  => [
        '@type' => 'PostalAddress',
        'streetAddress'   => $cfg['calle'],
        'postalCode'      => $cfg['cp'],
        'addressLocality' => $cfg['ciudad'],
        'addressCountry'  => 'MX',
    ],
];

// Los horarios solo se declaran a Google si están confirmados. Publicar un
// horario equivocado en el panel de búsqueda es peor que no publicar ninguno.
if ($cfg['horarios_confirmados']) {
    foreach ($cfg['horarios'] as $h) {
        if (empty($h['abre'])) { continue; }
        $negocio['openingHoursSpecification'][] = [
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => $h['schema'],
            'opens'     => $h['abre'],
            'closes'    => $h['cierra'],
        ];
    }
}
?>
<script type="application/ld+json">
<?= json_encode($negocio, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
</head>
<body>

<a class="saltar" href="#contenido">Saltar al contenido</a>

<header class="barra">
  <div class="barra__caja">
    <a class="marca" href="/">
      <?php /* Logo arriba del pliegue: sin lazy, que cargue con la página */ ?>
      <img class="marca__logo" src="<?= e(v('/assets/img/logo-berrinchitos.webp')) ?>" alt="Berrinchitosdent · Consultorio Dental" width="900" height="198">
    </a>

    <nav class="nav" aria-label="Secciones">
      <a href="#primera-visita">Primera visita</a>
      <a href="#ninos">Niños</a>
      <a href="#en-casa">En casa</a>
      <a href="#adultos">Adultos</a>
      <a href="#ubicacion">Ubicación</a>
    </nav>

    <a class="btn btn--wa barra__cta" href="<?= e($wa) ?>" target="_blank" rel="noopener">
      Agendar cita
    </a>
  </div>
</header>

<main id="contenido">
