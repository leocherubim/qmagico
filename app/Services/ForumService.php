<?php

namespace QMagico\Services;

use QMagico\Entities\User;
use QMagico\Entities\Forum;

class ForumService
{
	/**
     * @Forum
     */
    private $forumModel;

    public function __construct(Forum $forumModel)
    {
        $this->forumModel = $forumModel;
    }

    /**
     * @return void
     */
	public function registerForum(array $data, User $admin)
	{
		$adminUserId = $admin->id;
		// datas with admin user
		$data['user_id'] = $adminUserId;

		// register forum
		$this->forumModel->create($data);
	}

    /**
     * @return Forum
     */
    public function updateForum(array $data, $id)
    {
        // current forum
        $forum = $this->forumModel->find($id);
        // update forum
        $forum->update($data);

        return $forum;
    }

}