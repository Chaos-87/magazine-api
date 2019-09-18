<?php

namespace App\Http\Controllers;

use App\Publisher;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function allOrderByName(Request $request)
   {
       $publishers = Publisher::orderBy('name', 'asc')->select(['id', 'name'])->get();
       return response()->json([
           'publishers' => $publishers
       ]);
   }
}
