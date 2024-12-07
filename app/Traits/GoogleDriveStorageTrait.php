<?php

namespace App\Traits;

use Google_Client;
use Google_Service_Drive;
use Google_Service_Drive_DriveFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait GoogleDriveStorageTrait
{
    /**
     * Initialize Google Drive Client
     * 
     * @return Google_Service_Drive
     * @throws \Exception
     */
    protected function initializeGoogleDriveClient()
    {
        try {
            // Get credentials path from config
            $credentialsPath = storage_path(
                config('services.google.drive.credentials_path', 'app/google-drive/google-drive-credentials.json')
            );

            // Validate credentials file exists
            if (!file_exists($credentialsPath)) {
                throw new \Exception("Google Drive credentials file not found at: {$credentialsPath}");
            }

            // Initialize Google Client
            $client = new Google_Client();
            $client->setAuthConfig($credentialsPath);
            $client->setScopes(Google_Service_Drive::DRIVE_FILE);

            // Create and return Drive service
            return new Google_Service_Drive($client);
        } catch (\Exception $e) {
            Log::error('Google Drive Client Initialization Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Create or get existing folder in Google Drive
     * 
     * @param Google_Service_Drive $driveService
     * @param string $folderName
     * @param string|null $parentFolderId
     * @return string Folder ID
     */
    protected function createGoogleDriveFolder(
        Google_Service_Drive $driveService, 
        string $folderName, 
        ?string $parentFolderId = null
    ): string {
        try {
            // Sanitize folder name (remove special characters)
            $sanitizedFolderName = preg_replace('/[^A-Za-z0-9\-_ ]/', '', $folderName);

            // Check if folder already exists
            $query = "name = '{$sanitizedFolderName}' and mimeType = 'application/vnd.google-apps.folder'";
            if ($parentFolderId) {
                $query .= " and '{$parentFolderId}' in parents";
            }

            $results = $driveService->files->listFiles([
                'q' => $query,
                'spaces' => 'drive',
                'fields' => 'files(id, name)'
            ]);

            // If folder exists, return its ID
            if (!empty($results->getFiles())) {
                return $results->getFiles()[0]->getId();
            }

            // Create new folder
            $folderMetadata = new Google_Service_Drive_DriveFile([
                'name' => $sanitizedFolderName,
                'mimeType' => 'application/vnd.google-apps.folder',
                'parents' => $parentFolderId ? [$parentFolderId] : []
            ]);

            $folder = $driveService->files->create($folderMetadata, [
                'fields' => 'id'
            ]);

            return $folder->getId();
        } catch (\Exception $e) {
            Log::error('Google Drive Folder Creation Failed', [
                'error' => $e->getMessage(),
                'folder_name' => $folderName
            ]);
            throw $e;
        }
    }

    /**
     * Upload file to Google Drive with applicant folder
     * 
     * @param string $localFilePath Local file path
     * @param string $fileName Desired filename in Google Drive
     * @param array $applicantInfo Applicant information for folder naming
     * @param string|null $mimeType File MIME type
     * @param string|null $parentFolderId Google Drive parent folder ID
     * @return string Google Drive file ID
     * @throws \Exception
     */
    protected function uploadToGoogleDrive(
        string $localFilePath, 
        string $fileName, 
        array $applicantInfo = [], 
        ?string $mimeType = null, 
        ?string $parentFolderId = null
    ): string {
        try {
            // Initialize Drive service
            $driveService = $this->initializeGoogleDriveClient();

            // Use configured or provided folder ID
            $baseFolderId = $parentFolderId ?? config('services.google.drive.folder_id');

            // Create or get base applicant folder
            $applicantFolderName = '';
            if (!empty($applicantInfo['last_name']) && !empty($applicantInfo['first_name'])) {
                $applicantFolderName = $applicantInfo['last_name'] . '_' . $applicantInfo['first_name'];
                $applicantFolderId = $this->createGoogleDriveFolder(
                    $driveService, 
                    $applicantFolderName, 
                    $baseFolderId
                );
            } else {
                $applicantFolderId = $baseFolderId;
            }

            // Prepare file metadata
            $fileMetadata = new Google_Service_Drive_DriveFile([
                'name' => $fileName,
                'parents' => [$applicantFolderId]
            ]);

            // Read file contents
            $content = file_get_contents($localFilePath);

            // Detect MIME type if not provided
            $mimeType = $mimeType ?? mime_content_type($localFilePath);

            // Upload file
            $file = $driveService->files->create($fileMetadata, [
                'data' => $content,
                'mimeType' => $mimeType,
                'uploadType' => 'multipart',
                'fields' => 'id'
            ]);

            // Log successful upload
            Log::info('File uploaded to Google Drive', [
                'file_name' => $fileName,
                'drive_file_id' => $file->id,
                'mime_type' => $mimeType,
                'folder_path' => $applicantFolderName
            ]);

            return $file->id;
        } catch (\Exception $e) {
            Log::error('Google Drive Upload Failed', [
                'error' => $e->getMessage(),
                'file' => $fileName,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    /**
     * Delete file from Google Drive
     * 
     * @param string $fileId Google Drive file ID
     * @return bool
     */
    protected function deleteFromGoogleDrive(string $fileId): bool
    {
        try {
            $driveService = $this->initializeGoogleDriveClient();
            $driveService->files->delete($fileId);
            
            Log::info('File deleted from Google Drive', ['file_id' => $fileId]);
            return true;
        } catch (\Exception $e) {
            Log::error('Google Drive File Deletion Failed', [
                'error' => $e->getMessage(),
                'file_id' => $fileId
            ]);
            return false;
        }
    }
}