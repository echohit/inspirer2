<?php
/**
 * ContentCategory.php
 *
 * @copyright Chongyi <xpz3847878@163.com>
 * @link      https://insp.top
 */

namespace App\Schema\Contents\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContentCategory
 *
 * @property int               $id
 * @property string            $name
 * @property string            $title
 * @property string            $keywords
 * @property string            $description
 * @property Carbon            $created_at
 * @property Carbon            $updated_at
 * @property Content[]         $contents
 * @property int               $parent_id
 * @property ContentCategory   $parent
 * @property ContentCategory[] $children
 * @property string            $node_map
 *
 * @package App\Schema\Contents\Models
 */
class ContentCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'title',
        'description',
        'keywords',
        'parent_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contents()
    {
        return $this->hasMany(Content::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    /**
     * 获取当前内容分类下所有子类
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function depthChildren()
    {
        return $this->newQuery()->where('node_map', 'like', $this->node_map . ',%')->get();
    }
}