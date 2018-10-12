# php-uploader
-Download and Upload file


Script Files and Structure - top

This Editor script contains nearly 10 php files and nearly 4 folders which includes all the libraries. "inc-main.php" is main include file which contains E_All and other functions related to all pages.

fileFolder/ is the file folder so you need to give full writing permission (chamod 777) to this folder to run this script. Also log.txt at the root folder also need chamod 777 because it logs all the file uploaded. If file is not uploaded error will be logged at the log.txt file.

Since this script does not have a database, username and password is located at file_manager_admin-inc-main.php. you need to change your username and password to your own using a code editor.

    Username for Admin:
    $AdminUserName="administrator";
    Password for Admin:
    $AdminPassWord="admin";

Also you need to chnage other main two settings.

    Your Files Folder (fileFolder) folder should be given chamod 777 (Full writing permission) because this is where all the flat files will be stored.
    $fileFolder="fileFolder";

pages starting "file_manager_admin....php" are the admin files to manage uploaded files. You can move all files starting fromm file_manager_admin.. if you need to run admin part in seperate folder eg. adminFolder. but when you move admin files you need to get a copy of css and img folder also along with those admin files. Also you will need to change the file path of $fileFolder at file_manager_admin-inc-main.php line 12.
