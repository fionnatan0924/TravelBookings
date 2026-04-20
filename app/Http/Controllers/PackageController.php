<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)->get();
        return view('packages.index', compact('packages'));
    }

    public function show($id)
    {
        $package = Package::with('destination')->findOrFail($id);
        return view('packages.show', compact('package'));
    }

    public function search(Request $request)
    {
        $query = Package::where('is_active', true);

        if ($request->destination) {
            $query->where('name', 'like', '%' . $request->destination . '%');
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        $packages = $query->get();

        return view('packages.index', compact('packages'));
    }
}