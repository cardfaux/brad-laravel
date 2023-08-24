<?php

namespace App\Http\Controllers\Follow;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Follow;

class FollowController extends Controller
{
    public function createFollow(Request $request, User $user)
    {
        //! You can't follow yourself
        if ($user->id === auth()->user()->id) {
            return back()->with('failure', 'You cannot follow yourself.');
        }
        //! You can't follow someone you already follow
        $existCheck = Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->count();
        if ($existCheck) {
            return back()->with('failure', 'You already follow this user.');
        }

        $newFollow = new Follow;
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followeduser = $user->id;
        $newFollow->save();

        return back()->with('success', 'You are now following ' . $user->username . '.');
    }

    public function removeFollow(User $user)
    {
        Follow::where([['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id]])->delete();
        return back()->with('success', 'You have unfollowed ' . $user->username . '.');
    }
}
