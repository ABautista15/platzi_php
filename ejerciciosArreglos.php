<?php 
    $str = '';
    $arreglo = [
        'keyStr1' => 'lado',
        'keyStr3' => 'rueba',
        0 => 'ledo',
        'keyStr2' => 'lido',
        1 => 'lodo',
        2 => 'ludo'
    ];

    $str .= $arreglo['keyStr1'] . ',' . $arreglo[0] . ',' . $arreglo['keyStr2'] . ',' . $arreglo[1] . ',' . $arreglo[2] .'<br/>';
    $str .= 'decirlo al revés lo dudo.' . '<br/>';
    $str .= $arreglo[2] . ',' . $arreglo[1] . ',' . $arreglo['keyStr2'] . ',' . $arreglo[2] . ',' . $arreglo['keyStr1'] . '<br/>';
    $str .= '¡Qué trabajo me ha costado!';

    echo $str;

    $paises = [
        'Mexico' => [
                        'Quintana Roo',
                        'Yucatan',
                        'Campeche'
                    ],
        'Colombia' => [
                        'Bogota',
                        'Cartagena',
                        'Medellin'
                      ]

        ];

    foreach($paises as $pais => $ciudad){
        echo "$pais tiene ciudades como: ";
        foreach($ciudad as $c){
            echo "$c ";
        }
    }
    
?>