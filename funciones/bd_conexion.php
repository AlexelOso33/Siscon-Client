<?php

    // Conexión Admin
    $user = 'sisconsy_pol_onl_admin';
    $password = 'polietileno25@33';
    $db = 'sisconsy_admin_data';
    $host = 'localhost';
    
    $conna = mysqli_connect($host, $user, $password, $db);
    $conna->set_charset('utf8');

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
    }

    if(isset($_GET['b']) && $_GET['b'] > 0){
        $business = $_GET['b'];

        // Llamado a la tabla de información de la empresa //
        try {
            $sql = "SELECT * FROM `empresa` JOIN `business_data` ON `empresa`.`link_business`=`business_data`.`number_business` WHERE `link_business` = $business";
            $cons = mysqli_query($conna, $sql);
            $emp = mysqli_fetch_assoc($cons);
            $bd = $emp['bd_business_d'];
            $razon = $emp['emp_razon_social'];
            if($emp['emp_facebook'] !== ''){
                $face = explode(".com/", $emp['emp_facebook']);
                $fb = $face[0].".com/<br>".$face[1];
            } else {
                $fb = null;
            }
            $imagen = $emp['emp_logo'];
            if($imagen == '../img/siscon160.png'){
                $imagen = null;
            }
        } catch (\Throwable $th) {
            die("Error: ".$th->getMessage());
        }
    }

?>