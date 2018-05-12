<?php
/**
 * File: PostTag.php
 * Author: 小滕<616896861@qq.com>
 * Date: 2018/5/12 18:44
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
 * @Table(name="post_tag")
 */
class PostTag extends Model
{

    /**
     * @Column(name="post_id")
     * @var int|null
     */
    private $postId;

    /**
     * @Column(name="tag_id")
     * @var int|null
     */
    private $tagId;

    /**
     * @return int|null
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @return int|null
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * @param int|null $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    /**
     * @param int|null $tagId
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;
    }

}