<?php
    namespace Venance\DropboxUploader;

    require_once 'debugger.php';
    # edit this line to match the path to your vendor
    require_once __DIR__ . '/vendor/autoload.php';

    use Spatie\Dropbox\Client;

    class DropboxUploader {
        # you can define a default tocken of your dropbox app here
        private const DEFAULT_TOCKEN = 'YOUR_DROPBOX_APP_TOCKEN'; 
        private $client;
        
        public function __construct() {
            $argv = func_get_args();
            switch( func_num_args() ) {
                case 0:
                    // Initialize Dropbox client with default tocken
                    $this->client = new Client(self::DEFAULT_TOCKEN);
                    break;
                case 1:
                    // Initialize Dropbox client with client tocken
                        $this->client = new Client($argv[0]);
                    break;
                default:
                    throw new Exception("You must give at most 1 parameter to the constructor !");
            }
        }

        
        /**
         * Upload a file or a list of files from a user's Disk to the Dropbox-App.
         *
         * @param $files : it can be an array of $_FILES or the path to a specific file on the user's disk
         *
         */
        public function upload($files, $destinationPath='/') {
            if(empty($files) || (!is_array($files) && !file_exists($files)))
                throw new Exception("<p style='color:red;'>Unable to upload file !</p>");
            if(substr($destinationPath, -1)!='/') $destinationPath[strlen($destinationPath)] = "/";
            // when file with post submitted
            if(is_array($files) && array_key_exists('tmp_name', $files)){
                if(!is_array($files['tmp_name']))
                    $this->client->upload($destinationPath.$files['name'],  file_get_contents($files['tmp_name']));
                else
                {
                    // Number of files to upload
                    $num_files = count($files['tmp_name']);
                    /** loop through the array of files **/
                    for($i=0; $i < $num_files; $i++)
                        $this->client->upload($destinationPath.$files['name'][$i],  file_get_contents($files['tmp_name'][$i]));
                }
            }
            // when path of file on the disk
            else{ 
                $this->client->upload($destinationPath.basename(realpath($files)),  file_get_contents(realpath($files)));
            }
        }
        
        
    }

?>