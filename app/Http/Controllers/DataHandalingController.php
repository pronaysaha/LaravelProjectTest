<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessImage;

class DataHandalingController extends Controller
{
    public function uploadImage(Request $request)
{
   
    ProcessImage::dispatch($uploadedImagePath);

    return redirect()->back()->with('success', 'Image uploaded. It will be processed shortly.');

}
}