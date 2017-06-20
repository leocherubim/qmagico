<?php

namespace QMagico\Http\Controllers\Api;

use Illuminate\Http\Request;
use QMagico\Http\Controllers\Controller;
use QMagico\Entities\Answer;

class AnswersController extends Controller
{

    /**
     * @Answer
     */
    private $answerModel;

    public function __construct(Answer $answerModel)
    {
        $this->answerModel = $answerModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // Order By Desc
        $answers = $this->answerModel
            ->with('user')
            ->where('parent_id', '=', null)
            ->where('question_id', '=', $id)
            ->orderBy('created_at', 'desc')->get();

        return $answers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->answerModel->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
