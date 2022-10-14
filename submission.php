<?php

    include_once "vendor/autoload.php"; 
    
    $access_token = "2yMj7ZXau6Y084cvLZcac8c7ZG6NXpCm0pQhOMF5FUhJFW7HvXv17";
    $locationid = 1;

    $pCloudApp = new pCloud\Sdk\App();
    $pCloudApp->setAccessToken($access_token);
    $pCloudApp->setLocationId(1);

    function uploadFile($id, $filename, $file_submitted) {
        global $pCloudApp; 
        
        $tmp_name = pathinfo($file_submitted, PATHINFO_BASENAME);
        $updated_filepath = str_replace($tmp_name, $filename, $file_submitted); 
        rename($file_submitted, $updated_filepath); 

        $params = array(
            "name" => $id,
            "folderid" => 0
        );

        // create user folder if it does not exist
        $request = new pCloud\Sdk\Request($pCloudApp);
        $request->get("createfolderifnotexists", $params); 

        $newFolder = new pCloud\Sdk\Folder($pCloudApp); 
        
        $folder = $newFolder->listFolder($id);      // get user folder

        $pcloudFile = new pCloud\Sdk\File($pCloudApp);

        $pcloudFile->upload($updated_filepath, $folder["folderid"]);        

    }

    function getFile($id, $filename, $filepath) {
        global $pCloudApp; 

        $newFolder = new pCloud\Sdk\Folder($pCloudApp); 
        
        $folder = $newFolder->listFolder($id);

        $files = $newFolder->getContent($folder["folderid"]); 

        $file = array(); 
        
        foreach($files as $f) {
            if ($f->name == $filename) {
                $file = $f; 
            }
        }

        $pcloudFile = new pCloud\Sdk\File($pCloudApp);

        $pcloudFile->download($file->fileid, $filepath); 

    }
?>

