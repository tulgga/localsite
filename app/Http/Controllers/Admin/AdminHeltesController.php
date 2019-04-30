<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Heltes;

class AdminHeltesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results=Heltes::orderBy('id', 'desc')->get();
        return response()->json([ 'success' => $results ]);
    }





    public function destroy($id)
    {
        $ban = Heltes::findOrFail($id);
        Heltes::where('id', $id)->delete();
    }

    public function show($id)
    {
        $info = Heltes::findOrFail($id);
        return response()->json([
            'success' => $info
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $data = json_decode($data, true);

        $validator = Validator::make($data, [
            'name' =>  ['required', Rule::unique('heltes', 'name')->ignore($id)],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $info = Heltes::findOrFail($id);
        $info->name = $data['name'];
        $info->save();

        return response()->json([
            'success' => $info,
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->get('data');

        $data = json_decode($data, true);

        $validator = Validator::make($data, [
            'name' => 'required|unique:heltes',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        $info = new Heltes();
        $info->name = $data['name'];
        $info->save();

        return response()->json([
            'success' => $info,
        ]);
    }
}
