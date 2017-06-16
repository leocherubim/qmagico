<?php

namespace QMagico\Http\Controllers;

use Illuminate\Http\Request;
use QMagico\Entities\Forum;
use Illuminate\Auth\AuthManager as Auth;
use QMagico\Services\ForumService;
use QMagico\Http\Requests\ForumRequest;

class ForumsController extends Controller
{

    /**
     * @Forum
     */
    private $forumModel;

    /**
     * @ForumService
     */
    private $forumService;

    public function __construct(Forum $forumModel, ForumService $forumService)
    {
        $this->forumModel = $forumModel;
        $this->forumService = $forumService;
    }

    /**
     * Display initial home application.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $forums = $this->forumModel->paginate(20);

        return view('forums.home', compact('forums'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = $this->forumModel->paginate(15);

        return view('forums.index', compact('forums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \QMagico\Http\Requests\ForumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRequest $request, Auth $auth)
    {
        // register forum
        $this->forumService->registerForum($request->all(), $auth->user());

        return redirect()->route('forum.index');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currentForum = $this->forumModel->find($id);

        return view('forums.edit', compact('currentForum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForumRequest $request, $id)
    {
        // update forum
        $this->forumService->updateForum($request->all(), $id);

        return redirect()->route('forum.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // remove forum
        $this->forumModel->destroy($id);

        return redirect()->route('forum.index');
    }
}
