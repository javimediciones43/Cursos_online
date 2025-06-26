<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::with('category', 'creator')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validated([
            'title' => 'required|string|max:255',
            'desription' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $course = Course::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'category_id'=> $request->category_id,
            'created_by'=> $request->user()->id
        ]);

        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Course::with('category', 'creator')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validated([
            'title'=> 'required|string|max:255',
            'description'=> 'nullable|string',
            'category_id'=> 'required|exists:categories,id'
        ]);

        $course->update($request->all());
        return response()->json ($course,0);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return response()->json([
            'message'=> 'Curso eliminado'       
        ]);
    }
}
