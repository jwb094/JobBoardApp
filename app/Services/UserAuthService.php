<?php

namespace App\Services;

use App\Models\Application;
use App\Models\JobListingsUser;
use App\Models\SavedJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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


    public function update(array $updatedUserData, int $updatedUserDataId): JobListingsUser
    {

        $updatedUser = JobListingsUser::findOrFail($updatedUserDataId);

        $updatedUserData['password'] = Hash::make($updatedUserData['password']);
        $updatedUserData['role'] = 'applicant';

        $updatedUser->update($updatedUserData);

        return $updatedUser->refresh();
    }


    public function dashboard(object $applicantUser)
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
}
