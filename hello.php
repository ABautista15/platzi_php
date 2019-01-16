<?php 

    $Inicio="modulos/login/login.php";
    function core_reverse_strrchr($haystack, $needle)
    {
        $pos = strrpos($haystack, $needle);
        
        if($pos === false) {
            return $haystack;
        }
        
        return substr($haystack, 0, $pos + 1);
    }
    $Modulo_raiz=core_reverse_strrchr($Inicio,'/');
    echo $Modulo_raiz;
?>