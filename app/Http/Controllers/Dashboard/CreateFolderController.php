<?php

namespace App\Http\Controllers\Dashboard;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class CreateFolderController extends Controller
{
    private $client;
    private $newPermission;

    
    public function createFolder(Request $request)
    {
        $this->client = new Google_Client();
        $this->client->setClientId(env("GOOGLE_CLIENT_ID", "default"));
        $this->client->setClientSecret(env("GOOGLE_CLIENT_SECRET", "default"));
        $this->client->refreshToken(env("GOOGLE_DRIVE_REFRESH_TOKEN", "default"));
        //putenv('GOOGLE_APPLICATION_CREDENTIALS=' .base_path() .'/credentials.json');
        //$this->client->useApplicationDefaultCredentials();
        $this->newPermission = new Google_Service_Drive_Permission();
        $value=auth()->user()->email;
        $type="user";
        $role="owner";
        $this->newPermission->setEmailAddress($value);
        $this->newPermission->setType($type);
        $this->newPermission->setRole($role);
        $this->newPermission->allowFileDiscovery;
        $this->client->setApplicationName('My Google Drive App');
        $this->client->addScope(Google_Service_Drive::DRIVE);
        $folderName = $request->input('folder');
        $prefijo="";

        // Initialize the Drive service
        $driveService = new Google_Service_Drive($this->client);

        // Create a folder in Google Drive
        $folderMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder'
        ]);

        if($request->get('type')=="Campaña digital"){
            $folderMetadata->setParents(array('1hRbrp118QrstM6RPAzye8WNPQ8db5eOo'));
            $prefijo="Comercial ";
        }
        else{
            $folderMetadata->setParents(array('1-IDT2YwsegFDsk_KLzUDlcikscqe6QGC'));
            $prefijo="WORK ";
        }

        $createdFolder = $driveService->files->create($folderMetadata, [
            'fields' => 'id',
        ]);
        /*try {
            $res= $driveService->permissions->create($createdFolder->id, $this->newPermission, array('fields' => 'id', 'transferOwnership' => 'true'));
            //print_r($res); 
        } catch (Exception $e) {
            print "An error occurred: " . $e->getMessage();
        }*/
        $project = Project::create([
            'project_name' => $folderName,
            'year' => date('Y'),
            'area' => $request->get('area'),
            'scope' => $request->get('scope'),
            'type' => $request->get('type'),
            'drive_folder' => 'https://drive.google.com/file/d/' .$createdFolder->id .'/view?usp=sharing',
            'user_id' => auth()->user()->id
        ]);

        //return redirect('/projects');
        return response()->json(['folder_id' => $createdFolder->id]);
    }
}
