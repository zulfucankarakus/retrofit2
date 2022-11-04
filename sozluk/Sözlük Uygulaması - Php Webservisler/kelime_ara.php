<?php
    
    $response = array();
    
    if (isset($_POST['ingilizce'])) {
        $ingilizce = $_POST['ingilizce'];
        
        //DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE değişkenleri alınır.
        require_once __DIR__ . '/db_config.php';
        
        // Bağlantı oluşturuluyor.
        $baglanti = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        
        // Bağlanti kontrolü yapılır.
        if (!$baglanti) {
            die("Hatalı bağlantı : " . mysqli_connect_error());
        }
        
        $sqlsorgu = "SELECT * FROM kelimeler WHERE kelimeler.ingilizce like '%$ingilizce%'";
        $result = mysqli_query($baglanti, $sqlsorgu);
        
        // result kontrolü yap
        if (mysqli_num_rows($result) > 0) {
            
            $response["kelimeler"] = array();
            
            while ($row = mysqli_fetch_assoc($result)) {
                // temp user array
                $kelimeler = array();
                
                $kelimeler["kelime_id"] = $row["kelime_id"];
                $kelimeler["ingilizce"] = $row["ingilizce"];
                $kelimeler["turkce"] = $row["turkce"];
                
                // push single product into final response array
                array_push($response["kelimeler"], $kelimeler);
            }
            // success
            $response["success"] = 1;
            
            // echoing JSON response
            echo json_encode($response);
            
        } else {
            // no products found
            $response["success"] = 0;
            $response["message"] = "No data found";
            
            // echo no users JSON
            echo json_encode($response);
        }
        
        //bağlantı koparılır.
        mysqli_close($baglanti);
        
        
    } else {
        
        $response["success"] = 0;
        $response["message"] = "Required field(s) is missing";
        
        echo json_encode($response);
    }
    ?>




