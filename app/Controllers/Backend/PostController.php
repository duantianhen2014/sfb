<?php

namespace App\Controllers\Backend;

use App\Models\Entity\Post;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Response;
use Swoole\Mysql\Exception;

/**
 * @Controller(prefix="/backend/post")
 */
class PostController
{
    /**
     * @RequestMapping(route="/backend/post", method={RequestMethod::GET})
     * @return array
     */
    public function index(Request $request): array
    {
        $page = $request->input('page', 1);
        $pageSize = $request->input('page_size', 10);
        $startLocation = ($page - 1) * $pageSize;

        $posts = Post::findAll([], [
            'limit' => $pageSize,
            'offset' => $startLocation,
            'orderby' => ['created_at' => 'desc']
        ])->getResult();

        $posts = $posts ? $posts->toArray() : [];
        return $posts;
    }

    /**
     * @RequestMapping(route="/backend/post", method={RequestMethod::POST})
     */
    public function store(Request $request, Response $response)
    {
        $data = Post::validateData($request);
        $result = (new Post)->fill($data)->save()->getResult();
        if ($result) {
            return $response->json(['code' => 200]);
        }
        throw new Exception('帖子创建失败', 500);
    }

    /**
     * @RequestMapping(route="{postId}", method={RequestMethod::GET})
     * @param Request $request
     * @param Response $response
     * @param $postId
     * @return mixed
     */
    public function show(Request $request, Response $response, $postId)
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
            return $response->json(['code' => 200]);
        }
        throw new Exception('帖子编辑失败', 500);
    }

    /**
     * @RequestMapping(route="{postId}", method={RequestMethod::DELETE})
     * @param Request $request
     * @param Response $response
     * @param $postId
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(Request $request, Response $response, $postId)
    {
        $post = Post::findById($postId)->getResult();
        if (! $post) {
            return $response->json(['msg' => '帖子不存在', 'code' => 404]);
        }
        $result = $post->delete()->getResult();
        if ($result) {
            return $response->json(['code' => 200]);
        }
        throw new Exception('帖子删除失败', 500);
    }

}
