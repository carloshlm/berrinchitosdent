<?php
/**
 * El open_basedir del pool obliga a que los partials vivan dentro de public/,
 * así que nginx los sirve si alguien pide la URL directa. Esta constante es la
 * que los partials exigen para ejecutarse: sin ella devuelven 404.
 */
define('BERRINCHITOS', true);

require __DIR__ . '/partials/header.php';

/** La escala del berrinche: el elemento que define la marca. */
$escala = [
    ['n' => 1, 'cara' => 'Entra saludando',
     'titulo' => 'El que llega contento',
     'texto'  => 'Se sube solo a la silla y quiere ver todo. Aprovechamos: le enseñamos el espejo, el aire, el agua. Sale sabiendo cómo se llama cada cosa.'],
    ['n' => 2, 'cara' => 'Se esconde atrás de mamá',
     'titulo' => 'El precavido',
     'texto'  => 'No lo despegamos de ti. La primera cita puede hacerse contigo sentada en la silla y él encima. Nadie lo obliga a soltarse.'],
    ['n' => 3, 'cara' => 'Dice que no le duele nada',
     'titulo' => 'El negociador',
     'texto'  => 'Contamos los dientes en voz alta, sin instrumentos. Si a la mitad quiere parar, paramos. Se avanza lo que se pueda y se termina otro día.'],
    ['n' => 4, 'cara' => 'Llanto de negociación',
     'titulo' => 'El que llora antes de entrar',
     'texto'  => 'Bajamos el ritmo. Le explicamos con sus palabras qué va a pasar y le damos el control: él dice cuándo empezamos. Casi siempre alcanza con eso.'],
    ['n' => 5, 'cara' => 'Berrinche nivel experto',
     'titulo' => 'El que se tira al piso',
     'texto'  => 'Ya lo vimos. No hay regaños ni «ya no llores». Si hoy solo alcanza para sentarse y conocer el lugar, esa fue la cita y estuvo bien.'],
];

$servicios_ninos = [
    ['t' => 'Primera revisión',        'd' => 'La cita de conocerse. Revisamos, contamos y explicamos qué encontramos, sin tecnicismos.'],
    ['t' => 'Limpieza y flúor',        'd' => 'Quita la placa que el cepillo no alcanza y refuerza el esmalte contra la caries.'],
    ['t' => 'Selladores',              'd' => 'Una capa protectora en las muelas, donde se forman ocho de cada diez caries infantiles.'],
    ['t' => 'Resinas',                 'd' => 'Caries tratadas del color del diente. Cuanto antes, más chico el tratamiento.'],
    ['t' => 'Tratamiento de nervio',   'd' => 'Cuando la caries llegó profundo, se salva el diente de leche en lugar de sacarlo.'],
    ['t' => 'Coronas',                 'd' => 'Para dientes muy dañados que todavía tienen años de trabajo por delante.'],
    ['t' => 'Extracciones',            'd' => 'Solo cuando no hay otra salida, y con el diente permanente en el plan.'],
    ['t' => 'Mantenedores de espacio', 'd' => 'Si un diente de leche se pierde antes de tiempo, guardan el lugar del que viene.'],
    ['t' => 'Hábitos',                 'd' => 'Chupón, mamila y dedo. Cómo y cuándo dejarlos sin que sea una guerra en casa.'],
    ['t' => 'Golpes y urgencias',      'd' => 'Se cayó y se pegó en la boca. Qué hacer en la primera hora y qué no.'],
];

$en_casa = [
    [
      'edad' => '0 a 2 años',
      'hito' => 'Sale el primer diente cerca de los 6 meses',
      'puntos' => [
        'Antes de los 6 meses no es necesario limpiar las encías ni la boca del bebé. La higiene empieza a partir de los 6 meses con la llegada del primer diente y la alimentación complementaria (papillas o sólidos): cepilla 2 veces al día con un cepillo infantil suave y pasta con flúor del tamaño de un grano de arroz.',
        'Nada de dormir con la mamila puesta: la leche que queda toda la noche produce caries en los dientes de adelante.',
        'La primera visita al dentista es al cumplir un año, aunque todo se vea bien.',
      ],
    ],
    [
      'edad' => '3 a 5 años',
      'hito' => 'Ya están los 20 dientes de leche',
      'puntos' => [
        'Hasta los 6 o 7 años el cepillado lo haces tú. Él practica, pero tú repasas.',
        'Pasta con flúor del tamaño de un chícharo, y que escupa en lugar de enjuagarse.',
        'Cuando dos dientes se tocan, ahí ya entra el hilo dental.',
        'Los jugos y las gomitas hacen más daño por la frecuencia que por la cantidad.',
      ],
    ],
    [
      'edad' => '6 a 12 años',
      'hito' => 'A los 6 llega la primera muela permanente',
      'puntos' => [
        'Esa muela sale atrás, sin que se caiga ninguna. Muchos papás creen que es de leche y no lo es: esa ya es para siempre.',
        'Es el mejor momento para los selladores, apenas terminan de salir.',
        'Ya puede cepillarse solo, pero revisa una vez al día que lo esté haciendo bien.',
        'Si usa protector bucal en el deporte, se evitan la mayoría de los dientes rotos.',
      ],
    ],
];

$servicios_adultos = ['Limpieza dental', 'Resinas', 'Endodoncia', 'Coronas y prótesis', 'Blanqueamiento', 'Extracciones'];
?>

<section class="hero">
  <div class="hero__caja">
    <p class="eyebrow">Odontopediatría · Ciudad de México</p>
    <h1 class="hero__titulo">Aquí los berrinches <br class="br-md">también tienen cita</h1>
    <p class="hero__bajada">
      La <?= e($cfg['doctora']) ?> atiende la boca de tu hijo y, de paso, su miedo al dentista.
      Sin apuros, sin regaños y sin un solo <em>«ya no llores»</em>.
    </p>
    <div class="hero__acciones">
      <a class="btn btn--wa btn--grande" href="<?= e($wa) ?>" target="_blank" rel="noopener">Agendar por WhatsApp</a>
      <a class="btn btn--fantasma btn--grande" href="#primera-visita">Cómo es la primera visita</a>
    </div>

    <?php if ($cfg['horarios_confirmados']): ?>
      <?php
        // Todos los días que abren, no solo el primero: si mañana agregan
        // un día al config, el hero lo muestra sin tocar esta línea.
        $abiertos = array_filter($cfg['horarios'], fn($h) => !empty($h['abre']));
      ?>
      <div class="hero__horario">
        <?php foreach ($abiertos as $h): ?>
          <span class="hero__horario-dia"><?= e($h['dias']) ?></span>
          <span class="hero__horario-horas"><?= e($h['horas']) ?></span>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="dientes" aria-hidden="true">
      <?php for ($i = 0; $i < 7; $i++): ?>
        <?php
          $clase = 'dientes__uno';
          if ($i === 3) { $clase .= ' dientes__uno--flojo'; }  // el que está por caerse
          if ($i === 4) { $clase .= ' dientes__uno--hueco';  }  // el que ya se cayó
        ?>
        <span class="<?= $clase ?>">
          <svg viewBox="0 0 24 32"><path d="M0 10C0 2 5 0 12 0s12 2 12 10c0 10-4 22-7 22s-3-8-5-8-2 8-5 8S0 20 0 10Z"/></svg>
        </span>
      <?php endfor; ?>
    </div>
    <p class="dientes__pie">Se cae uno, viene otro. Nosotros cuidamos los dos.</p>
  </div>
</section>

<section class="seccion seccion--lila" id="primera-visita">
  <div class="caja">
    <div class="par">
      <div>
        <p class="eyebrow">La primera visita</p>
        <h2 class="titulo">¿Qué tan berrinchudo viene hoy?</h2>
        <p class="entrada">
          Ningún niño llega igual, así que ninguna primera cita es igual. Elige cómo se pone el tuyo
          y te decimos qué pasa cuando cruza la puerta.
        </p>
      </div>
      <figure class="foto">
        <img src="<?= e(v('/assets/img/en-accion.webp')) ?>" alt="La Dra. Arleth Luna atendiendo a un paciente pequeño en el consultorio" width="1200" height="1200" loading="lazy">
        <figcaption>Así se ve una cita: con calma, con colores y sin batas que asusten.</figcaption>
      </figure>
    </div>

    <div class="escala">
      <?php foreach ($escala as $i => $paso): ?>
        <input class="escala__radio" type="radio" name="berrinche" id="nivel<?= $paso['n'] ?>" <?= $i === 0 ? 'checked' : '' ?>>
      <?php endforeach; ?>

      <div class="escala__barra" role="group" aria-label="Nivel de berrinche">
        <?php foreach ($escala as $paso): ?>
          <label class="escala__tecla" for="nivel<?= $paso['n'] ?>">
            <span class="escala__num"><?= $paso['n'] ?></span>
            <span class="escala__cara"><?= e($paso['cara']) ?></span>
          </label>
        <?php endforeach; ?>
      </div>

      <div class="escala__panel">
        <?php foreach ($escala as $paso): ?>
          <article class="ficha ficha--<?= $paso['n'] ?>">
            <h3 class="ficha__titulo"><?= e($paso['titulo']) ?></h3>
            <p class="ficha__texto"><?= e($paso['texto']) ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>

    <p class="escala__cierre">
      Los cinco terminan la cita. Unos el mismo día, otros en tres visitas. Ninguno sale de aquí odiando al dentista.
    </p>
  </div>
</section>

<section class="seccion" id="ninos">
  <div class="caja">
    <div class="par">
      <div>
        <p class="eyebrow">Para los chiquitos</p>
        <h2 class="titulo">Lo que hacemos</h2>
        <p class="entrada">
          Los dientes de leche no son un ensayo: guardan el espacio de los definitivos, y una infección
          en ellos afecta al diente que viene abajo. Por eso se tratan, no se esperan.
        </p>
      </div>
      <figure class="foto">
        <img src="<?= e(v('/assets/img/unidad-dental.webp')) ?>" alt="Unidad dental del consultorio, con sillón azul" width="750" height="500" loading="lazy">
      </figure>
    </div>

    <ul class="rejilla">
      <?php foreach ($servicios_ninos as $s): ?>
        <li class="tarjeta">
          <h3 class="tarjeta__titulo"><?= e($s['t']) ?></h3>
          <p class="tarjeta__texto"><?= e($s['d']) ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="seccion seccion--celeste" id="en-casa">
  <div class="caja">
    <p class="eyebrow">Cuidado en casa</p>
    <h2 class="titulo">La mayor parte del trabajo <br class="br-md">pasa en tu baño, no aquí</h2>
    <p class="entrada">
      Vemos a tu hijo dos o tres veces al año. Tú lo ves dos veces al día. Esto es lo que cambia según su edad.
    </p>

    <div class="etapas">
      <?php foreach ($en_casa as $etapa): ?>
        <article class="etapa">
          <header class="etapa__cabeza">
            <h3 class="etapa__edad"><?= e($etapa['edad']) ?></h3>
            <p class="etapa__hito"><?= e($etapa['hito']) ?></p>
          </header>
          <ul class="etapa__lista">
            <?php foreach ($etapa['puntos'] as $p): ?>
              <li><?= e($p) ?></li>
            <?php endforeach; ?>
          </ul>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="seccion" id="adultos">
  <div class="caja caja--par">
    <div>
      <p class="eyebrow">También para grandes</p>
      <h2 class="titulo">¿Y tú, hace cuánto <br class="br-md">que no te revisas?</h2>
      <p class="entrada">
        El consultorio cuenta con especialistas para atender adultos. Puedes traer a tu hijo
        y resolver lo tuyo el mismo día, en el mismo lugar.
      </p>
      <p class="nota">
        Los niños aprenden lo que ven. El que acompaña a un papá que se atiende, se atiende.
      </p>
    </div>
    <div>
      <figure class="foto">
        <img src="<?= e(v('/assets/img/sala-espera.webp')) ?>" alt="Sala de espera del consultorio" width="1066" height="800" loading="lazy">
      </figure>
      <ul class="pastillas pastillas--con-foto">
        <?php foreach ($servicios_adultos as $s): ?>
          <li class="pastilla"><?= e($s) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<section class="seccion seccion--tinta" id="ubicacion">
  <div class="caja caja--par">
    <div>
      <p class="eyebrow eyebrow--claro">Quién atiende</p>
      <h2 class="titulo titulo--claro"><?= e($cfg['doctora']) ?></h2>
      <p class="entrada entrada--claro">
        Odontopediatra, egresada de <?= e($cfg['formacion']) ?>. Atiende en su consultorio
        de la <?= e($cfg['ciudad']) ?>, donde el objetivo de la primera cita no es
        terminar el tratamiento: es que tu hijo quiera volver.
      </p>
      <a class="btn btn--wa btn--grande" href="<?= e($wa) ?>" target="_blank" rel="noopener">Escribir por WhatsApp</a>

      <figure class="foto foto--consultorio">
        <img src="<?= e(v('/assets/img/odontopediatra.webp')) ?>" alt="La Dra. Arleth con los adornos infantiles que ella tejió" width="1200" height="1200" loading="lazy">
      </figure>
    </div>

    <div class="datos">
      <div class="dato">
        <h3 class="dato__rotulo">Dónde</h3>
        <p class="dato__valor">
          <?= e($cfg['calle']) ?><br>
          <?= e($cfg['colonia']) ?>, <?= e($cfg['alcaldia']) ?><br>
          C.P. <?= e($cfg['cp']) ?>, <?= e($cfg['ciudad']) ?>
        </p>
        <p class="dato__referencia"><?= e($cfg['referencia']) ?></p>
        <a class="enlace" href="<?= e($cfg['maps']) ?>" target="_blank" rel="noopener">Ver en Google Maps</a>

        <figure class="foto foto--fachada">
          <img src="<?= e(v('/assets/img/fachada.webp')) ?>" alt="Fachada del edificio de Avenida Baja California 218" width="1024" height="649" loading="lazy">
          <figcaption class="foto__pie-claro">Busca el 218 en la columna de la entrada.</figcaption>
        </figure>
      </div>

      <div class="dato">
        <h3 class="dato__rotulo">Horarios</h3>
        <?php if ($cfg['horarios_confirmados']): ?>
          <ul class="horarios">
            <?php foreach ($cfg['horarios'] as $h): ?>
              <li class="<?= empty($h['abre']) ? 'horarios__cerrado' : '' ?>">
                <span><?= e($h['dias']) ?></span><span><?= e($h['horas']) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <p class="dato__valor">Escríbenos por WhatsApp y te confirmamos el horario disponible más cercano.</p>
        <?php endif; ?>
      </div>

      <div class="dato">
        <h3 class="dato__rotulo">Contacto</h3>
        <p class="dato__valor">
          <a class="enlace" href="tel:<?= e($cfg['telefono_tel']) ?>"><?= e($cfg['telefono']) ?></a><br>
          <a class="enlace" href="mailto:<?= e($cfg['email']) ?>"><?= e($cfg['email']) ?></a>
        </p>
      </div>
    </div>
  </div>
</section>

<a class="flotante" href="<?= e($wa) ?>" target="_blank" rel="noopener">
  <span class="flotante__texto">Agendar cita</span>
</a>

<?php require __DIR__ . '/partials/footer.php'; ?>
