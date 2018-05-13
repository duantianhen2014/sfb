<?php

namespace App\Controllers\Backend;

use App\Models\Entity\PostTag;
use App\Models\Entity\Tag;
use Exception;
use App\Models\Entity\Post;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Response;

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
        $data = $paginate->data->toArray();
        // 计算帖子与标签的关系，最后计算结构如下：
        // {"34":["1","2","3"],"35":["1","2","3"]}
        // {post_id: [tag_id, tag_id]}
        $postIds = array_map(function ($post) {
            return $post['id'];
        }, $data);
        $postTagRelation = PostTag::query()->whereIn('post_id', $postIds)->get()->getResult();
        $postHasManyTags = [];
        $tagIds = [];
        foreach ($postTagRelation as $item) {
            $postHasManyTags[$item['postId']][] = $tagIds[] = $item['tagId'];
        }
        // 预读所有需要的TAG，最后结构如下：
        // {tag_id:tag, tag_id: tag}
        $tagsTemp = Tag::query()->whereIn('id', $tagIds)->get()->getResult();
        $tags = [];
        foreach ($tagsTemp as $tagTempItem) {
            $tags[$tagTempItem['id']] = $tagTempItem;
        }

        // 整合数据
        foreach ($data as $key => $postDataItem) {
            if (isset($postHasManyTags[$postDataItem['id']]) && $postHasManyTags[$postDataItem['id']]) {
                $data[$key]['tags'] = array_map(function ($tagId) use ($tags) {
                    return $tags[$tagId];
                }, $postHasManyTags[$postDataItem['id']]);
            } else {
                $data[$key]['tags'] = [];
            }
        }

        $paginate->data = $data;
        return $paginate->toArray();
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
        $post = $post->toArray();

        $relationData = PostTag::findAll(['post_id' => $postId])->getResult();
        if ($relationData) {
            $tagIds = array_map(function ($v) {
                return $v['tagId'];
            }, $relationData->toArray());
            $tags = Tag::query()->whereIn('id', $tagIds)->get()->getResult();
        }
        $post['tags'] = $tags ?? [];
        return $post;
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
