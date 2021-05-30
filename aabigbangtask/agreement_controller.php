<?php
function modify($company_name)
{
    //modify and hash file name
    $except = array('\\', '/', ':',';', '*', '?', '"', '<', '>', '|','.',' ');
    $modified_name = strtolower($company_name);
    $modified_name = str_replace($except,'',$modified_name);
    $modified_name = hash('md2',$modified_name);
    return $modified_name;
}
function download($company_name){
    $modified_name = modify($company_name);
    $modified_name .= '.pdf';
    $attachment_location = "agreements/";
    //check if file exists and download it
    if (file_exists($attachment_location.$modified_name)) {
        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Cache-Control: public"); // needed for internet explorer
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:".filesize($attachment_location.$modified_name));
        header("Content-Disposition: attachment; filename=".$modified_name);
        readfile($attachment_location.$modified_name);
        die();
    } else {
        die("Error: File not found.");
    }
}
function upload($company_name){

    //check if folder exists and create it
    if (!mkdir("agreements") && !is_dir("agreements")) {
        throw new \RuntimeException(sprintf('Directory "%s" was not created', "agreements"));
    }

    $modified_name = modify($company_name);
    $modified_name .= '.pdf';
    $target_dir = "agreements/";
    $target_file = $target_dir . $modified_name;
    $response = "";
    // Check file size
    if ($_FILES["agreement"]["size"] > 1000000) {
        $response =  "Sorry, your file is too large.";
    }

    // if everything is ok, try to upload file
    else {
        if (move_uploaded_file($_FILES["agreement"]["tmp_name"],$target_file)) {
            $response = "The file ". htmlspecialchars( basename( $_FILES["agreement"]["name"])). " has been uploaded.";
        } else {
            $response = "Sorry, there was an error uploading your file.";
        }
    }
    return $response;
}

?>