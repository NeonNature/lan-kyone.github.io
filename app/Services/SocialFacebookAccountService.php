<?php

namespace App\Services;
use App\SocialFacebookAccount;
use App\User;
use Carbon;
use Storage;
use File;
use DB;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderId($providerUser->getId())
            ->first();

        $id=Carbon::now()->format('dhisu');
        if ($account) {
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                //'user_id'=>$id,
                'provider_id' => $providerUser->getId(),
                'provider' => 'facebook',
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'id'=>$id,
                    'email' => $providerUser->getEmail(),
                    'userName' => $providerUser->getName(),
                    'password' => md5(rand(1,10000)),
                    'provider'=>'facebook',
                    'provider_id'=>$providerUser->getId(),
                    'profilepicture'=>$providerUser->getAvatar()
                ]);
                $filecontent=get_file_content($providerUser->getAvatar());
                
                //DB::table('social_facebook_accounts')->where('provider_id',$providerUser->getId())->update(['user_id'=>'abc']);
                File::put(public_path() . '/images/uploads/' . $id . ".jpg", $filecontent);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}