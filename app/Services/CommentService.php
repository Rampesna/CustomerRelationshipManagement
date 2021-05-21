<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentService
{
    private $comment;

    /**
     * @return Comment
     */
    public function getComment(): Comment
    {
        return $this->comment;
    }

    /**
     * @param Comment $comment
     */
    public function setComment(Comment $comment): void
    {
        $this->comment = $comment;
    }

    public function save(Request $request)
    {
        $this->comment->relation_type = $request->relation_type;
        $this->comment->relation_id = $request->relation_id;
        $this->comment->user_id = $request->user_id;
        $this->comment->comment = $request->comment;
        $this->comment->save();

        return $this->comment;
    }
}
