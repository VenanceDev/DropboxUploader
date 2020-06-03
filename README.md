# AUTHOR AND DATE
 * Created by Venance Konan
 * Date: 03.06.20
 * Time: 17:00

# NOTE
	This Package has been coded on basis of the package "spatie/dropbox-api" and does only implements an easy way of FileUpload to Dropbox.
	You must at first create a Dropbox-App (https://www.dropbox.com/developers) and generate a tocken before using the function Upload of this package.

# INSTALLATION
	This Package has not been sent to the "Packagist", so the User has to pasteit in his project and require it locally with composer.
	Follow these guidelines below on how to install and use the package:

	1. Copy-Paste this Package into a location in your project


 	2. Add these lines of code to your "composer.json" file

		"repositories": [
	        {
	            "type": "path",
	            "url": "RELATIVE_OR_ABSOLUTE_PATH_TO_WHERE_YOU_PASTED_THE_PACKAGE_DIRECTORY",
	            "options": {
	                "symlink": true
	            }
	        }
	    ],
	    "require": {
	        "venance/dropbox-uploader": "@dev"
	    }

	3. Run the command: "composer install" / "composer update" to the root of
	   your project

	4. Using DropboxUploader API in your code like that:

		use Venance\DropboxUploader\DropboxUploader;	
		try {
            $dropbox = new DropboxUploader(YOUR_DROPBOX_TOCKEN);
            $dropbox->upload($_FILES['file'], 'DIR');
            $dropbox->upload('/path/to/file.txt', 'DIR');
        } catch (Exception $e) {
            
        }
	   
