<?php

namespace App\Controllers\Backend;

use App\Models\Entity\Category;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;
use Swoft\Http\Message\Server\Response;
use Swoole\Mysql\Exception;

/**
 * @Controller(prefix="/backend/category")
 */
class CategoryController
{
    /**
     * @RequestMapping(route="/backend/category", method={RequestMethod::GET})
     *
     * @return array
     */
    public function index(): array
    {
        $categories = Category::findAll()->getResult();
        return $categories ? $categories->toArray() : [];
    }

    /**
     *
     * @RequestMapping(route="/backend/category", method={RequestMethod::POST})
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
        $data = Category::validateData($request);
        $result = (new Category)->fill($data)->save()->getResult();
        if ($result) {
            return $response->json(['code' => 200]);
        }
        throw new Exception('分类创建失败', 500);
    }

    /**
     * @RequestMapping(route="{categoryId}", method={RequestMethod::GET})
     *
     * @param Response $response
     * @param $categoryId
     *
     * @return mixed
     */
    public function show(Response $response, $categoryId)
    {
        $category = Category::findById($categoryId)->getResult();
        if (! $category) {
            return $response->json(['msg' => '分类不存在', 'code' => 404]);
        }
        return $category->toArray();
    }

    /**
     * @RequestMapping(route="{categoryId}", method={RequestMethod::PUT})
     *
     * @param Request $request
     * @param Response $response
     * @param $categoryId
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function update(Request $request, Response $response, $categoryId)
    {
        $data = Category::validateData($request);
        $category = Category::findById($categoryId)->getResult();
        if (! $category) {
            return $response->json(['msg' => '分类不存在', 'code' => 404]);
        }
        $result = $category->fill($data)->update()->getResult();
        if ($result) {
            return $response->json(['code' => 200]);
        }
        throw new Exception('分类编辑失败', 500);
    }

    /**
     * @RequestMapping(route="{categoryId}", method={RequestMethod::DELETE})
     *
     * @param Response $response
     * @param $categoryId
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function destroy(Response $response, $categoryId)
    {
        $category = Category::findById($categoryId)->getResult();
        if (! $category) {
            return $response->json(['msg' => '分类不存在', 'code' => 404]);
        }
        $result = $category->delete()->getResult();
        if ($result) {
            return $response->json(['code' => 200]);
        }
        throw new Exception('分类删除失败', 500);
    }

}
