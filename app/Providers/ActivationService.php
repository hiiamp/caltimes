<?php
namespace App\Providers;

use App\Repositories\UserRepository;
use Carbon\Carbon;
use Mail;
use App\Mail\UserActivationEmail;
use App\Entities\User;

class ActivationService
{
    protected $resendAfter = 24; // Sẽ gửi lại mã xác thực sau 24h nếu thực hiện sendActivationMail()
    protected $user;

    protected $userRepo;

    public function __construct(User $user, UserRepository $userRepo)
    {
        $this->user = $user;
        $this->userRepo = $userRepo;
    }

    public function sendActivationMail($user)
    {
        if (($user->level != 0)) return;
        $token = $this->userRepo->createActivation($user->id);
        $link = route('user.activate', $token);
        $mailable = new UserActivationEmail($link);
        Mail::to($user->email)->send($mailable);
    }

    public function activateUser($token)
    {
        $user = null;
        $user = $this->userRepo->findByField('remember_token', $token)->first();
        if($user == null) return null;
        $user->level = 1;
        $user->save();
        $this->userRepo->update([
            'level' => 1,
            'remember_token' => null,
            'updated_at' => new Carbon()
        ], $user->id);
        return $user;
    }

    private function shouldSend($user)
    {
        return $user === null || strtotime($user->updated_at) + 60 * 60 * $this->resendAfter < time();
    }

}
