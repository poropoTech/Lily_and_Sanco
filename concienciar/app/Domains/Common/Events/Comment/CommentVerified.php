<?php

namespace App\Domains\Common\Events\Comment;

use App\Domains\Common\Models\Comment;
use Illuminate\Queue\SerializesModels;

/**
 * Class CommentVerified.
 */
class CommentVerified
{
    use SerializesModels;

    /**
     * @var
     */
    public $comment;

    /**
     * @param $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}