<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function setPublic(Request $request)
    {
        $table = $request->table;
        $id = $request->id;
        $public = $request->public;

        \DB::table($table)->whereId($id)->update([
            'public' => $public
        ]);
    }
}
