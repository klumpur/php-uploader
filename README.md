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

Usage Help

There are restrictions in code level.

    To create accepted file types to allow 1 or more file types to upload you need to put file types to acceptedFiles: '', at line 61 of uploader_page.php file.
    Also there are restricted file types at inc.main.php file in line 9. By default those are "php,asp,aspx,jsp". Be careful of changing those because some hackers might upload some hacking php files and run it to hack your server.
    maxFilesize is the upload restriction of file size in MB. Use upload script.

    acceptedFiles: '',
    dictInvalidFileType: 'File type is not supported.',
    maxFilesize: 5,
    dictFileTooBig: "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
    C) Upload and Run - top

Finalizing the work.

    Exat all the files at "package.zip" to your local folder
    Upload all the files to your server
    Give chamod 777 to fileFolder
    Give Chamod 777 to log.txt at root.
    Access your code via web browser
    You're done


