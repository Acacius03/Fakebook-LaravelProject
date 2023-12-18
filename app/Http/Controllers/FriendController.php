<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        $authUser = auth()->user();
        $friendRequestsSent = $authUser->friendRequestsSent()->whereNull('accepted_at')->get();
        $friendRequestsReceived = $authUser->friendRequestsReceived()->whereNull('accepted_at')->get();
        $friendsConfirmed = $authUser->friends()->get();

        $excludes =
            $friendRequestsSent->pluck('friend_id')
            ->merge($friendRequestsReceived->pluck('user_id'))
            ->merge($friendsConfirmed->pluck('id'))
            ->push($authUser->id)
            ->unique()
            ->toArray();

        $users = User::select('id', 'name', 'profile_photo')
            ->inRandomOrder()
            ->whereNotIn('id', $excludes)
            ->get();

        return view("user.index")->with(
            [
                'users' => $users,
                'friendRequestsReceived' => $friendRequestsReceived
            ]
        );
    }
}
