<?php

namespace App\Http\Controllers;

use App\Models\Detection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\ErrorHandler\Debug;

class DetectionController extends BaseController
{
    public function index() {
        $user = User::with('detections')->find(Auth::user()->id);

        return $this->sendResponse($user, 'Successfully retrieve history');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'recommendation' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Invalid input json', $validator->errors(), 422);
        }

        $user = User::find(Auth::user()->id);
        $detection = new Detection($validator->validated());
        $user->detections()->save($detection);

        return $this->sendResponse($detection, 'Saved successfully!');
    }

    public function preDetect() {
        $user = User::find(Auth::user()->id);

        if ($user->credits_prediction == 0) {
            return $this->sendError('No more detection credit!', [], 403);
        }

        $user->credits_prediction -= 1;
        $user->save();

        return $this->sendResponse($user, 'Detection allowed!');
    }
}
