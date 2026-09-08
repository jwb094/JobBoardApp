<?php

namespace App\Services;

use App\Models\Application;
use App\Models\JobListingsUser;
use App\Models\SavedJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserAuthService
{

    public function register(array $userData): JobListingsUser
    {
        $userData['password'] = Hash::make($userData['password']);
        $userData['role'] = 'applicant';

        //dd($userData);
        $user = JobListingsUser::create($userData);

        return $user;
    }


    public function login(array $loginDetails): bool
    {

        return Auth::attempt([
            'email' => $loginDetails['email'],
            'password' => $loginDetails['password']
        ]);
    }


    public function update(array $updatedUserData, int $updatedUserDataId,string $userType): JobListingsUser
    {

        $updatedUser = JobListingsUser::findOrFail($updatedUserDataId);

        $updatedUserData['password'] = Hash::make($updatedUserData['password']);
        // $updatedUserData['role'] = 'applicant';
             $updatedUserData['role'] = $userType;

        $updatedUser->update($updatedUserData);

        return $updatedUser->refresh();
    }


    public function dashboard(object $applicantUser): array
    {
        return [
            "userSavedJobsCount" =>  SavedJob::where('user_id', '=', $applicantUser->id)->count(),
            "userApplicationsCount" =>  Application::where('user_id', '=', $applicantUser->id)->count()
        ];
    }


    public function deleteUser(int $id)
    {

        DB::transaction(function () use ($id) {

            Application::where('user_id', $id)->delete();

            JobListingsUser::findOrFail($id)->delete();
        });
    }

    public function userSavedJobs(){
        
    }

    public function createApplication(object $requestData ,string $jobId , string $userId , object $user){    

        $doesPathExists = public_path('uploads/' . $user->first_name . '-' . $user->last_name);

        $path = "";
        if (Storage::exists($doesPathExists)) {
            $path =  $doesPathExists;
        }


        $data = $requestData->validate([
            'job_id' => 'required|exists:job_listings,id',
            'resume_path' => 'required',
            'cover_letter' => 'required',
        ]);

    

        //create datas array for sql query
        $data['job_id'] = $jobId;
        $data['user_id'] = $userId;
        $data['resume_path'] = $path . '/' . $data['resume_path'];
        $data['cover_letter'] = $path . '/' . $data['cover_letter'];
        $data['status'] = 'Received/Submitted';


        $newApplicationCreated = Application::create($data);

        return $newApplicationCreated;
        
    }
}
