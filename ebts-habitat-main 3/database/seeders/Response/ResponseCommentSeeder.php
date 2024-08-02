<?php

namespace Database\Seeders\Response;


use App\Domains\Auth\Models\User;
use App\Domains\Common\Models\Comment;
use App\Domains\Common\Services\CommentService;
use App\Domains\Responses\Models\Response;
use Database\Seeders\Traits\DisableForeignKeys;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

/**
 * Class ResponseCommentTableSeeder.
 */
class ResponseCommentSeeder extends Seeder
{
    use DisableForeignKeys;


    protected $commentService;
    protected $faker;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->faker = Faker::create('es_ES');
    }

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        if (app()->environment(['local', 'testing'])) {
            for ($i = 0; $i < 100; $i++) {
                $this->addTestResponseComment(1, 4);
            }
        }

        $this->enableForeignKeys();
    }

    private function addTestResponseComment($response_id, $user_id)
    {
        $response = Response::where('id', $response_id)->firstOrFail();
        $author = User::where('id', $user_id)->firstOrFail();
        $data['content'] = $this->faker->realText(200);
        $this->commentService->store($author, $response, $data);
    }
}
