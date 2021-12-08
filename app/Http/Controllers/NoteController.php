<?php

namespace App\Http\Controllers;

use StdClass;
use Validator;
use StatusCode;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $httpCode = 200;

        $take = isset($request->take) ? $request->take : 5;
        $skip = isset($request->skip) ? $request->skip : 0;

        // Validate the request
        $validator = Validator::make(
            array(
                'take'  => $take,
                'skip'  => $skip,
            ),
            array(
                'take' => 'numeric',
                'skip' => 'numeric',
            )
        );

        // Run the validation
        if ($validator->fails()) {
            $errorMessage = $validator->messages()->first();

            return response()->json([
                'code'    => StatusCode::ValidationError,
                'message' => $errorMessage,
                'data' => null,
            ], $httpCode);
        }

        $notes = Note::whereNotNull('note_id');

        $_notes = clone $notes;

        $notes->take($take);
        $notes->skip($skip);

        $totalData = $_notes->count();
        $listOfData = $notes->get();

        $returnedData = new StdClass;
        $returnedData->total_records = $totalData;
        $returnedData->returned_records = count($listOfData);
        $returnedData->records = $listOfData;

        return response()->json([
            'code'    => StatusCode::RequestOk,
            'message' => 'success',
            'data'    => $returnedData,
        ], $httpCode);
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
        $httpCode = 200;
        $userId = 0;

        // Validate the request
        $validator = Validator::make(
            array(
                'title' => $request->title,
                'note'  => $request->note,
            ),
            array(
                'title' => 'required',
                'note'  => 'required',
            ),
            array(
            )
        );

        // Run the validation
        if ($validator->fails()) {
            $errorMessage = $validator->messages()->first();

            return response()->json([
                'code'    => StatusCode::ValidationError,
                'message' => $errorMessage,
                'data' => null,
            ], $httpCode);
        }

        // Insert data
        $newNote = new Note();
        $newNote->user_id = $userId;
        $newNote->title = $request->title;
        $newNote->note = $request->note;
        $newNote->save();

        return response()->json([
            'code'    => StatusCode::RequestOk,
            'message' => 'success',
            'data'    => $newNote,
        ], $httpCode);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function show(Notes $notes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function edit(Notes $notes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notes $notes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $notes)
    {
        //
    }
}
