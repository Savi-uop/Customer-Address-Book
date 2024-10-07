<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\CustomerResource;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('customers')->get();
        // return ProjectResource::collection($projects);
        // $projects = Project::paginate(10); // Adjust the number of items per page as needed
        $allCustomers = Customer::all(); // Fetch all customers for the dropdown
        return view('projects.index', compact('projects', 'allCustomers'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'customers' => 'required|array', // Validate that customers are provided
            'customers.*' => 'exists:customers,id', // Validate each customer ID exists
        ]);

        // Create the project
        $project = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);

        // Attach customers to the project
        $project->customers()->attach($validated['customers']);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'customers' => 'required|array',
                'customers.*' => 'exists:customers,id', // Ensure each customer ID exists
            ]);

            // Find the project and update it
            $project = Project::findOrFail($id);
            $project->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);

            // Sync customers (update relationship)
            $project->customers()->sync($validated['customers']);

            return response()->json(['message' => 'Project updated successfully.'], 200);
        } catch (\Exception $e) {
            \Log::error('Failed to update project: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update project. Please try again.'], 500);
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->customers()->detach(); // Detach related customers
            $project->delete(); // Delete the project
    
            return response()->json(['message' => 'Project deleted successfully.']);
        } catch (\Exception $e) {
            \Log::error('Failed to delete project: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete project. Please try again.'], 500);
        }
    }

}
