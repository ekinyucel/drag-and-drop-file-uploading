<?php
    header('Content-Type: application/json');
    $uploaded = array();
    
    if(!empty($_FILES['file']['name'][0])){
        foreach($_FILES['file']['name'] as $position => $name){
            $filename = $_FILES['file']['tmp_name'][$position];
            $destination = 'upload/'. $name;
            if(move_uploaded_file($filename, $destination)){
                $uploaded[] = array(
                    'name' => $name,
                    'file' => 'uploads/' . $name
                );
            }
        }
    }
    echo json_encode($uploaded);