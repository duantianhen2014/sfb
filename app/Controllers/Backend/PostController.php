<?php

namespace App\Controllers\Backend;

use App\Models\Entity\PostTag;
use App\Models\Entity\Tag;
use Exception;
use App\Models\Entity\Post;
use Swoft\Db\Db;
use Swoft\Db\Query;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Response;
use Swoft\Log\Log;

/**
 * @Controller(prefix="/backend/post")
 */
class PostController
{

    /**
     * @RequestMapping(route="/backend/post", method={RequestMethod::GET})
     * @return array
     */
    public function index(): array
    {
        $paginate = Post::getPaginateData([], ['created_at' => 'desc']);
        return [
            'data' => $paginate->data->toArray(),
            'meta' => [
                'total' => $paginate->total,
                'current_page' => $paginate->page,
                'page_size' => $paginate->pageSize,
            ],
        ];
    }

    /**
     * @RequestMapping(route="/backend/post", method={RequestMethod::POST})
     */
    public function store(Request $request, Response $response)
    {
        $data = Post::validateData($request);

        $result = (new Post)->fill($data)->save()->getResult();
        if (! $result) {
            throw new Exception('帖子创建失败', 500);
        }

        // TAG关联
        $tagIds = array_flip(array_flip($request->input('tags', [])));
        $manyRelationData = array_map(function ($value) use ($result) {
            return [
                'post_id' => $result,
                'tag_id' => $value,
            ];
        }, $tagIds);
        PostTag::batchInsert($manyRelationData)->getResult();

        return $response->json(['code' => 200]);
    }

    /**
     * @RequestMapping(route="{postId}", method={RequestMethod::GET})
     * @param Response $response
     * @param $postId
     * @return mixed
     */
    public function show(Response $response, $postId)
    {
        $post = Post::findById($postId)->getResult();
        if (! $post) {
            return $response->json(['msg' => '帖子不存在', 'code' => 404]);
        }
        return $post->toArray();
    }

    /**
     * @RequestMapping(route="{postId}", method={RequestMethod::PUT})
     * @param Request $request
     * @param Response $response
     * @param $postId
     *
     * @throws \Exception
     * @return mixed
     */
    public function update(Request $request, Response $response, $postId)
    {
        $data = Post::validateData($request);
        $post = Post::findById($postId)->getResult();
        if (! $post) {
            return $response->json(['msg' => '帖子不存在', 'code' => 404]);
        }
        $result = $post->fill($data)->update()->getResult();
        if ($result) {

            // TAG更新
            PostTag::query()->where('post_id', $post->getId())->delete()->getResult();
            $tagIds = array_flip(array_flip($request->input('tags', [])));
            $manyRelationData = array_map(function ($value) use ($post) {
                return [
                    'post_id' => $post->getId(),
                    'tag_id' => $value,
                ];
            }, $tagIds);
            PostTag::batchInsert($manyRelationData)->getResult();


            return $response->json(['code' => 200]);
        }
        throw new Exception('帖子编辑失败', 500);
    }

    /**
     * @RequestMapping(route="{postId}", method={RequestMethod::DELETE})
     * @param Response $response
     * @param $postId
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(Response $response, $postId)
    {
        $post = Post::findById($postId)->getResult();
        if (! $post) {
            return $response->json(['msg' => '帖子不存在', 'code' => 404]);
        }

        PostTag::query()->where('post_id', $post->getId())->delete()->getResult();
        $post->delete()->getResult();

        return $response->json(['code' => 200]);
    }

}
