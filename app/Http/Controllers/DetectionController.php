<?php

namespace App\Http\Controllers;

use App\Models\Detection;
use App\Models\DetectionImage;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\ErrorHandler\Debug;

class DetectionController extends BaseController
{
    public function index() {
        $user = User::with('detections.image')->find(Auth::user()->id);

        return $this->sendResponse($user, 'Successfully retrieve history');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'result' => 'required',
            'recommendation' => 'required',
            'image' => 'required|file'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Invalid input json', $validator->errors(), 422);
        }

        $user = User::find(Auth::user()->id);
        $detection = new Detection($validator->validated());
        $user->detections()->save($detection);

        if ($request->file('image')) {
	        $storagePath = Storage::disk('google')->putFile('', $request->file('image'));;
	
	        $image = $detection->image()->create([
                'path' => $storagePath
            ]);
	
	        return response()->json([
	            'message' => 'Uploaded!',
	            'image' => $image
	        ]);
        }

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

    public function printDetection(Request $request, $id) {
        $user = User::find(Auth::user()->id);
        $detection = Detection::find($id);

        $pdf = FacadePdf::loadView('detection-print', [
            'detection' => $detection,
            'user' => $user
        ]);

        return $pdf->stream('kys-detection.pdf');
    }
}
