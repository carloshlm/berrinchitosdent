<?php if (!defined('BERRINCHITOS')) { http_response_code(404); exit; } ?>
</main>

<footer class="pie">
  <div class="caja pie__caja">
    <p class="pie__marca">Berrinchitos<span class="marca__dent">dent</span></p>
    <p class="pie__linea">
      <?= e($cfg['doctora']) ?> · <?= e($cfg['calle']) ?>, <?= e($cfg['ciudad']) ?>
    </p>
    <p class="pie__legal">© <?= date('Y') ?> <?= e($cfg['nombre']) ?>. La información de este sitio es orientativa y no sustituye una consulta.</p>
  </div>
</footer>

</body>
</html>
