<?php
/**
 * File: Tag.php
 * Author: 小滕<616896861@qq.com>
 * Date: 2018/5/12 15:28
 */


namespace App\Models\Entity;

use Swoft\Db\Bean\Annotation\Column;
use Swoft\Db\Bean\Annotation\Entity;
use Swoft\Db\Bean\Annotation\Id;
use Swoft\Db\Bean\Annotation\Table;
use Swoft\Db\Model;
use Swoft\Db\Types;

/**
 * @Entity()
 * @Table(name="tags")
 */
class Tag extends Model
{

    /**
     * @Id()
     * @Column(name="id", type=Types::INT)
     * @var int
     */
    private $id;

    /**
     * @Column(name="name", type=Types::STRING)
     * @var string
     */
    private $name;

    /**
     * @Column(name="origin_description", type=Types::STRING)
     * @var string
     */
    private $origin_description;

    /**
     * @Column(name="html_description", type=Types::STRING)
     * @var string
     */
    private $html_description;

    /**
     * @Column(name="seo_keywords", type=Types::STRING)
     * @var string
     */
    private $seo_keywords;

    /**
     * @Column(name="seo_description", type=Types::STRING)
     * @var string
     */
    private $seo_description;

    /**
     * @Column(name="is_show", type=Types::INT)
     * @var int
     */
    private $is_show;

    /**
     * @Column(name="created_at", type=Types::INT)
     * @var int
     */
    private $created_at;

    /**
     * @Column(name="updated_at", type=Types::INT)
     * @var int
     */
    private $updated_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getOriginDescription(): string
    {
        return $this->origin_description;
    }

    /**
     * @return string
     */
    public function getHtmlDescription(): string
    {
        return $this->html_description;
    }

    /**
     * @return string
     */
    public function getSeoKeywords(): string
    {
        return $this->seo_keywords;
    }

    /**
     * @return string
     */
    public function getSeoDescription(): string
    {
        return $this->seo_description;
    }

    /**
     * @return int
     */
    public function getisShow(): int
    {
        return $this->is_show;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->created_at;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): int
    {
        return $this->updated_at;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $origin_description
     */
    public function setOriginDescription(string $origin_description)
    {
        $this->origin_description = $origin_description;
    }

    /**
     * @param string $html_description
     */
    public function setHtmlDescription(string $html_description)
    {
        $this->html_description = $html_description;
    }

    /**
     * @param string $seo_keywords
     */
    public function setSeoKeywords(string $seo_keywords)
    {
        $this->seo_keywords = $seo_keywords;
    }

    /**
     * @param string $seo_description
     */
    public function setSeoDescription(string $seo_description)
    {
        $this->seo_description = $seo_description;
    }

    /**
     * @param int $is_show
     */
    public function setIsShow(int $is_show)
    {
        $this->is_show = $is_show;
    }

    /**
     * @param int $created_at
     */
    public function setCreatedAt(int $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @param int $updated_at
     */
    public function setUpdatedAt(int $updated_at)
    {
        $this->updated_at = $updated_at;
    }

}