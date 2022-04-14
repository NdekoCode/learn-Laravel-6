<?php

namespace App\Http\Controllers;

use App\user;

class FollowController extends Controller
{
    public function new () {
        // L'utilisateur qui veut suivre l'autre c'est l'utilisateur connecté
        $follower = auth()->user();
        // L'utilisateur dont on veut suivre ou l'utilisateur à qui on veut s'abonner
        $followed = User::where('email', strtolower(request('email')))->firstOrFail();

        $follower->follow()->attach($followed);
        flash("Vous suivez maintenant ".$followed->email)->success();

        return back();
    }

    public function remove () {
        $follower = auth()->user();
        $followed = User::where('email', request('email'))->firstOrFail();
        $follower->follow()->detach($followed);
        flash("Vous ne suivez plus ".$followed->email)->error();
        return back();

    }


}