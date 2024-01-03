<?php
    // Check if session is already running before starting
    if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE){
        session_start();
    }
    
    function GetRootDirectory(){ // Gets the root directory, regardless of the reference point when requiring by using index.php
        $currentDirectory = getcwd();
        while (true){
            $found = false;
            foreach(glob($currentDirectory.'/*.php')as $file) // Scans directory for index.
            {
                if (str_contains($file,"index.php")){
                    $found = true;
                }
            }
            if ($found == false){
                $currentDirectory = dirname($currentDirectory); // Will keep going up a directory until the index is found.
            }else{
                break;
            }
    
        }
        return $currentDirectory;
       
    }

    foreach(glob(GetRootDirectory().'/classes/*.php') as $file) // Get current working directory to scan regardless of require reference location.
    {
        require_once $file; ///Include all PHP classes
    }

    $controllers = new Controllers(); //Instantiate controllers

    




?>