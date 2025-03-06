<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectorMakeModel;

class ProjectorMakeModelController extends Controller
{
    public function index()
    {
        $projectors = ProjectorMakeModel::all();
        
        return view('admin.pages.projectors', compact('projectors'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required',
            'model.*' => 'required'
        ]);

        $make = $request->input('make');
        $models = $request->input('model');

        foreach ($models as $model) {
            ProjectorMakeModel::create([
                'make' => $make,
                'model' => $model,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'make' => 'required',
            'model' => 'required'
        ]);

        $projector = ProjectorMakeModel::find($id);
        $projector->update([
            'make' => $request->make,
            'model' => $request->model
        ]);

        return response()->json(['success' => true]);
    }
    public function destroy($id)
    {
        $projector = ProjectorMakeModel::find($id);
        if ($projector) {
            $projector->delete();
            return redirect()->route('admin.projectors.index')->with('success', 'Record deleted successfully');
        } else {
            return redirect()->route('admin.projectors.index')->with('error', 'Record not found');
        }
    }
}
