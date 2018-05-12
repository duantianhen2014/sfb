<?php
/**
 * File: Post.php
 * Author: 小滕<616896861@qq.com>
 * Date: 2018/5/12 15:17
 */


namespace App\Models\Entity;

use App\Foundations\Models\EasyTrait;
use Overtrue\Pinyin\Pinyin;
use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Model;
use Swoft\Db\Types;
use Swoft\Http\Message\Server\Request;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;

/**
 * @Entity()
 * @Table(name="posts")
 */
class Post extends Model
{
    use EasyTrait;

    const IS_SHOW_ABLE = 1;
    const IS_SHOW_DISABLE = -1;

    const IS_DRAFT_ABLE = 1;
    const IS_DRAFT_DISABLE = -1;

    /**
     * @Id()
     * @Column(name="id", type=Types::INT)
     * @var int|null
     */
    private $id;

    /**
     * @Column(name="category_id", type=Types::INT)
     * @var int|null
     */
    private $categoryId;

    /**
     * @Column(name="title", type=Types::STRING)
     * @var string|null
     */
    private $title;

    /**
     * @Column(name="slug", type=Types::STRING)
     * @var string|null
     */
    private $slug;

    /**
     * @Column(name="origin_content", type=Types::STRING)
     * @var string|null
     */
    private $originContent;

    /**
     * @Column(name="html_content", type=Types::STRING)
     * @var string|null
     */
    private $htmlContent;

    /**
     * @Column(name="seo_keywords", type=Types::STRING)
     * @var string|null
     */
    private $seoKeywords;

    /**
     * @Column(name="seo_description", type=Types::STRING)
     * @var string|null
     */
    private $seoDescription;

    /**
     * @Column(name="is_draft", type=Types::INT)
     * @var int|null
     */
    private $isDraft;

    /**
     * @Column(name="is_show", type=Types::INT)
     * @var int|null
     */
    private $isShow;

    /**
     * @Column(name="created_at", type=Types::INT)
     * @var int|null
     */
    private $createdAt;

    /**
     * @Column(name="updated_at", type=Types::INT)
     * @var int|null
     */
    private $updatedAt;

    /**
     * @Column(name="published_at", type=Types::INT)
     * @var int|null
     */
    private $publishedAt;

    /**
     * @param int|null $id
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param int|null $categoryId
     * @return Post
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @param null|string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param null|string $slug
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @param null|string $originContent
     * @return Post
     */
    public function setOriginContent($originContent)
    {
        $this->originContent = $originContent;
        return $this;
    }

    /**
     * @param null|string $htmlContent
     * @return Post
     */
    public function setHtmlContent($htmlContent)
    {
        $this->htmlContent = $htmlContent;
        return $this;
    }

    /**
     * @param null|string $seoKeywords
     * @return Post
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;
        return $this;
    }

    /**
     * @param null|string $seoDescription
     * @return Post
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;
        return $this;
    }

    /**
     * @param int|null $isDraft
     * @return Post
     */
    public function setIsDraft($isDraft)
    {
        $this->isDraft = $isDraft;
        return $this;
    }

    /**
     * @param int|null $isShow
     * @return Post
     */
    public function setIsShow($isShow)
    {
        $this->isShow = $isShow;
        return $this;
    }

    /**
     * @param int|null $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @param int|null $updatedAt
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param int|null $publishedAt
     * @return Post
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return null|string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return null|string
     */
    public function getOriginContent()
    {
        return $this->originContent;
    }

    /**
     * @return null|string
     */
    public function getHtmlContent()
    {
        return $this->htmlContent;
    }

    /**
     * @return null|string
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * @return null|string
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * @return int|null
     */
    public function getIsDraft()
    {
        return $this->isDraft;
    }

    /**
     * @return int|null
     */
    public function getIsShow()
    {
        return $this->isShow;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return int|null
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    public static function getData(Request $request)
    {
        $data = [
            'categoryId' => $request->input('categoryId'),
            'title' => $request->input('title'),
            'slug' => $request->input('slug', ''),
            'originContent' => $request->input('originContent'),
            'seoKeywords' => $request->input('seoKeywords'),
            'seoDescription' => $request->input('seoDescription'),
            'isDraft' => $request->input('isDraft', self::IS_SHOW_DISABLE),
            'isShow' => $request->input('isShow', self::IS_DRAFT_DISABLE),
            'updatedAt' => time(),
            'publishedAt' => $request->input('publishedAt', time()),
        ];
        if ('POST' === $request->getMethod()) {
            $data['createdAt'] = time();
        }
        if ($data['originContent']) {
            $data['htmlContent'] = (new \Parsedown)->setBreaksEnabled(true)->text($data['originContent']);
        }
        if (! $data['slug'] && $data['title']) {
            $slug = implode('-', (new Pinyin)->convert($data['title']));
            $data['slug'] = $slug;
        }
        return $data;
    }

    public static function validateData(Request $request)
    {
        $data = self::getData($request);
        $fields = [
            'categoryId' => '请选择分类',
            'title' => '请输入标题',
            'originContent' => '请输入帖子内容',
            'seoKeywords' => '请输入SEO关键字',
            'seoDescription' => '请输入SEO描述',
        ];
        foreach ($fields as $field => $message) {
            if (! (isset($data[$field]) && $data[$field])) {
                throw new \Exception($message, 406);
            }
        }
        return $data;
    }

}