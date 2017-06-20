<?php

namespace QMagico\Http\Controllers\Api;

use Illuminate\Http\Request;
use QMagico\Http\Controllers\Controller;
use QMagico\Entities\Answer;
use Gate;

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $answer = $this->answerModel->find($id);

        // check user permission
        if (Gate::denies('answer', $answer)) {
            abort(403, 'Unauthorized action.');
        }

        $answer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $answer = $this->answerModel->find($id);

        // check user permission
        if (Gate::denies('answer', $answer)) {
            abort(403, 'Unauthorized action.');
        }

        $answer->delete();
    }
}
