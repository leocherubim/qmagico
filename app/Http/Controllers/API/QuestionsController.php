<?php

namespace QMagico\Http\Controllers\Api;

use Illuminate\Http\Request;
use QMagico\Http\Controllers\Controller;
use QMagico\Entities\Question;

class QuestionsController extends Controller
{
    /**
     * @Question
     */
    private $questionModel;

    public function __construct(Question $questionModel)
    {
        $this->questionModel = $questionModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Order By Desc
        $questions = $this->questionModel->with('user')->orderBy('created_at', 'desc')->get();

        return $questions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->questionModel->create($request->all());
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
        $question = $this->questionModel->find($id);
        $question->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = $this->questionModel->find($id);
        $question->delete();
    }
}
