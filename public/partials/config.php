<?php
if (!defined('BERRINCHITOS')) { http_response_code(404); exit; }

/**
 * Datos del consultorio. ÚNICO lugar donde se editan.
 * Todo el sitio lee de acá — no hardcodear teléfonos ni direcciones en el HTML.
 */

return [
    'nombre'      => 'Berrinchitosdent',
    'doctora'     => 'Dra. Arleth Luna',
    'formacion'   => 'Imesap, generación 2020',

    // WhatsApp: solo dígitos, con código de país. 52 = México.
    'whatsapp'    => '525571314033',
    'whatsapp_msg' => 'Hola, quiero agendar una cita.',

    'telefono'      => '+52 55 7131 4033',
    'telefono_tel'  => '+525571314033', // para el href="tel:"
    'email'         => 'berrinchitosdentdraluna@gmail.com',

    'calle'    => 'Avenida Baja California 218, int. 103',
    'colonia'  => 'Col. Roma Sur',
    'alcaldia' => 'Alcaldía Cuauhtémoc',
    'cp'       => '06760',
    'ciudad'   => 'Ciudad de México',
    'maps'     => 'https://www.google.com/maps/search/?api=1&query=Avenida+Baja+California+218+06760+Ciudad+de+Mexico',

    // Referencia de transporte. Ajustar el número de cuadras cuando esté
    // confirmado en el terreno — no publicar distancias inventadas.
    'referencia' => 'A unas cuadras del Metrobús Centro Médico (Línea 3)',

    /**
     * Si esto pasa a false, el sitio deja de publicar horarios y vuelve a
     * invitar a preguntar por WhatsApp. Nunca mostrar un horario sin confirmar:
     * una madre que llega con un niño a puerta cerrada no vuelve.
     *
     * 'abre' y 'cierra' alimentan el schema.org de Google (formato 24h).
     * El día cerrado va sin ellos: se muestra, pero no se declara.
     */
    'horarios_confirmados' => true,
    'horarios' => [
        [
            'dias'   => 'Lunes a viernes',
            'horas'  => '9:00 am – 9:00 pm',
            'schema' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'abre'   => '09:00',
            'cierra' => '21:00',
        ],
        [
            'dias'   => 'Sábado',
            'horas'  => '9:00 am – 3:00 pm',
            'schema' => ['Saturday'],
            'abre'   => '09:00',
            'cierra' => '15:00',
        ],
        [
            'dias'  => 'Domingo',
            'horas' => 'Cerrado',
        ],
    ],
];
