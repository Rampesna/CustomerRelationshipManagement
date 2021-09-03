<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Exception;

class FileService
{
    private $file;

    /**
     * @return File
     */
    public function getFile(): File
    {
        return $this->file;
    }

    /**
     * @param File $file
     */
    public function setFile(File $file): void
    {
        $this->file = $file;
    }

    public function save(Request $request)
    {
        $relationType = explode('\\', $request->relation_type);
        $path = 'files/' . end($relationType) . '/' . $request->relation_id . '/';
        $this->file->relation_type = $request->relation_type;
        $this->file->relation_id = $request->relation_id;
        $this->file->name = $request->file('file')->getClientOriginalName();
        $this->file->mime_type = $request->file('file')->getClientMimeType();
        $this->file->path = $path;
        $this->file->created_by = $request->id ? $this->file->created_by : $request->auth_user_id;
        try {
            $request->file('file')->move($path);
            $this->file->save();

            return $this->file;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function saveRelation(
        $path,
        $name,
        $mimeType,
        $createdBy,
        $file
    )
    {
        $this->file->name = $name;
        $this->file->mime_type = $mimeType;
        $this->file->path = $path;
        $this->file->created_by = $createdBy;
        try {
            $file->move($path, $file->getClientOriginalName());
            $this->file->save();

            return $this->file;
        } catch (Exception $exception) {
            return null;
        }
    }
}
