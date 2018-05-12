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
     * @var int|null
     */
    private $id;

    /**
     * @Column(name="name", type=Types::STRING)
     * @var string|null
     */
    private $name;

    /**
     * @Column(name="origin_description", type=Types::STRING)
     * @var string|null
     */
    private $originDescription;

    /**
     * @Column(name="html_description", type=Types::STRING)
     * @var string|null
     */
    private $htmlDescription;

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
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getOriginDescription()
    {
        return $this->originDescription;
    }

    /**
     * @return null|string
     */
    public function getHtmlDescription()
    {
        return $this->htmlDescription;
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
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param null|string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param null|string $originDescription
     */
    public function setOriginDescription($originDescription)
    {
        $this->originDescription = $originDescription;
    }

    /**
     * @param null|string $htmlDescription
     */
    public function setHtmlDescription($htmlDescription)
    {
        $this->htmlDescription = $htmlDescription;
    }

    /**
     * @param null|string $seoKeywords
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;
    }

    /**
     * @param null|string $seoDescription
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;
    }

    /**
     * @param int|null $isShow
     */
    public function setIsShow($isShow)
    {
        $this->isShow = $isShow;
    }

    /**
     * @param int|null $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param int|null $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}