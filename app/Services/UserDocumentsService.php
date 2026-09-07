<?php

namespace App\Services;

use App\Models\JobListingsUser;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserDocumentsService
{


    public function uploadDocuments(object $files, string $user_first_name, string $user_last_name, int $user_id)
    {
        $path = public_path('uploads/' . $user_first_name . '-' . $user_last_name);


        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0777, true, true);
        }

        $cover_letter = $files->file('cover_letter');
        $cv = $files->file('cv');

        $files->cover_letter->move($path, $cover_letter->getClientOriginalName());
        $files->cv->move($path, $cv->getClientOriginalName());


        $data['cover_letter'] = $cover_letter->getClientOriginalName();
        $data['cv'] = $cv->getClientOriginalName();

        $updatedUserDocuments =   JobListingsUser::where('id', $user_id)->update($data);

        return $updatedUserDocuments;
    }


    public function DeleteApplicantDocuments(string $userDocumentDirName)
    {

        $path = public_path('uploads/' . $userDocumentDirName);

        File::deleteDirectory($path);
    }
}
