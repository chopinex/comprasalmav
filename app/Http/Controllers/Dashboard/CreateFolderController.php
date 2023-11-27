<?php

namespace App\Http\Controllers\Dashboard;

use Google_Client;
//use Google\Client;
use Google_Service_Drive;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateFolderController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // Set up the Google API client
            //$this->client = new Google_Client();
            $this->client = new Google\Client();
            //$this->client->setAuthConfig('path/to/your/credentials.json');
            $this->client->setClientId([client_id]);
            $client->setClientSecret([client_secret]);
            $client->refreshToken([refresh_token]);
            $client->setApplicationName('My Google Drive App');
            $this->client->addScope(Google_Service_Drive::DRIVE);

            return $next($request);
        });
    }

    public function createFolder(Request $request)
    {
        $this->client = new Google_Client();
        $this->client->setClientId(env("GOOGLE_CLIENT_ID", "default"));
        $this->client->setClientSecret(env("GOOGLE_CLIENT_SECRET", "default"));
        $this->client->refreshToken(env("GOOGLE_DRIVE_REFRESH_TOKEN", "default"));
        $this->client->setApplicationName('My Google Drive App');
        $this->client->addScope(Google_Service_Drive::DRIVE);
        $folderName = $request->input('folder');

        // Initialize the Drive service
        $driveService = new Google_Service_Drive($this->client);

        // Create a folder in Google Drive
        $folderMetadata = new \Google_Service_Drive_DriveFile([
            'name' => $folderName,
            'mimeType' => 'application/vnd.google-apps.folder',
        ]);

        $createdFolder = $driveService->files->create($folderMetadata, [
            'fields' => 'id',
        ]);

        return response()->json(['folder_id' => $createdFolder->id]);
    }
}
