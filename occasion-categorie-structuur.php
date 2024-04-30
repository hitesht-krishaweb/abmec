<?php
/**
 * Author: Ken van der Eerden
 * Date: 27/09/2019
 * Time: 16:03
 */

// all categories marked 'fake' are categories that do not originate from the api,
// but are added by us to create structure within the categories.
// when a 'fake' category has the same name as an existing cat from the api, it is suffixed with ' -'.
// MAKE SURE THE NAMES ARE EXACTLY EQUAL TO THE NAMES FROM THE API
$occasionCategorieStructuur = array(

    'Tractor' => [ // fake
        'Tractoren',
        'Tractoren accesoires',
    ],

    'Verreikers en shovels' => [ // fake
        'Verreikers',
        'Laadapparatuur',
        'Knikladers',
    ],

    'Banden en wielen' => [],

    'Werktuigen' => [ // fake
        'Bedrijfsverzorging',
        'Beregening' => [ // fake
            'Regenhaspels', // 'Haspels',
            'Beregeningspompen', // 'Pompen',
        ],

        'Grondbewerking' => [ // fake
            'Ploegen',
            'Cultivatoren',
            'Rotorkopeggen',
            'Schijveneggen',
            'Vorenpakkers',
            'Frezen',
            'Wiedeggen / schoffelmachines', // 'Wiedeggen / Schoffels',
        ],

        'Hooibouw' => [ // fake
            'Maaimachines', // 'Maaiers',
            'Schudders',
            'Harken',
            'Persen',
            'Wikkelaars', // naam ?
            'Opraapwagens',
            'Kuilverdelers', // naam ?
        ],

        'Kip- en silagewagens', // 'Kip- en Silagewagens',

        'Mestverwerking' => [ // fake
            'Kunstmeststrooiers',
            'Mengmesttanks',
            'Stalmestverspreiders',
            'Zodebemesters', // 'Bemesters',
            'Bouwlandinjecteurs', // 'Bemesters',
        ],

        'Oogstmachines' => [ // fake
            'Aardappelrooiers', // 'Aardappelen',
            'Bietenrooiers', // naam ?
            'Hakselaars',
            'Inschuurmachines',
        ],

        'Zaai- en pootmachines' => [ // fake
            'Zaaimachines',
            'Pootmachines',
        ],

        'Spuiten' => [ // fake
            'Boomgaardspuiten',
            'Veldspuiten',
        ],

        'Sloten en bermenonderhoud', // 'Sloot- en bermonderhoud',

        'Tuinbouwmachines', // 'Tuinbouw & Fruitteelt',
        'Fruitteeltmachines', // 'Tuinbouw & Fruitteelt',

        'Tuin en park machines', // 'Tuin & Park',

        'Voertechniek' => [ // fake
            'Uitkuilapparatuur',
            'Voermengwagens',
        ],

        'Diverse werktuigen',
    ],

);