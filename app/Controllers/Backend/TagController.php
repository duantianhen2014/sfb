<?php

namespace App\Controllers\Backend;

use App\Models\Entity\Tag;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Response;
use Swoole\Mysql\Exception;

/**
 * @Controller(prefix="/backend/tag")
 */
class TagController
{
    /**
     * @RequestMapping(route="/backend/tag", method={RequestMethod::GET})
     *
     * @return array
     */
    public function index(): array
    {
        $tags = tag::findAll()->getResult();
        return $tags ? $tags->toArray() : [];
    }

    /**
     *
     * @RequestMapping(route="/backend/tag", method={RequestMethod::POST})
     *
     * @param Request $request
     * @param Response $response
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function store(Request $request, Response $response)
    {
        $data = Tag::validateData($request);
        $result = (new Tag)->fill($data)->save()->getResult();
        if ($result) {
            return $response->json(['code' => 200]);
        }
        throw new Exception('标签创建失败', 500);
    }

    /**
     * @RequestMapping(route="{tagId}", method={RequestMethod::GET})
     *
     * @param Response $response
     * @param $tagId
     *
     * @return mixed
     */
    public function show(Response $response, $tagId)
    {
        $tag = Tag::findById($tagId)->getResult();
        if (! $tag) {
            return $response->json(['msg' => '标签不存在', 'code' => 404]);
        }
        return $tag->toArray();
    }

    /**
     * @RequestMapping(route="{tagId}", method={RequestMethod::PUT})
     *
     * @param Request $request
     * @param Response $response
     * @param $tagId
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function update(Request $request, Response $response, $tagId)
    {
        $data = Tag::validateData($request);
        $tag = Tag::findById($tagId)->getResult();
        if (! $tag) {
            return $response->json(['msg' => '标签不存在', 'code' => 404]);
        }
        $result = $tag->fill($data)->update()->getResult();
        if ($result) {
            return $response->json(['code' => 200]);
        }
        throw new Exception('标签编辑失败', 500);
    }

    /**
     * @RequestMapping(route="{tagId}", method={RequestMethod::DELETE})
     *
     * @param Response $response
     * @param $tagId
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function destroy(Response $response, $tagId)
    {
        $tag = Tag::findById($tagId)->getResult();
        if (! $tag) {
            return $response->json(['msg' => '标签不存在', 'code' => 404]);
        }
        $result = $tag->delete()->getResult();
        if ($result) {
            return $response->json(['code' => 200]);
        }
        throw new Exception('标签删除失败', 500);
    }

}
