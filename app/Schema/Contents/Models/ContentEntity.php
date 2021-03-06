<?php
/**
 * ContentEntity.php
 *
 * @copyright Chongyi <xpz3847878@163.com>
 * @link      https://insp.top
 */

namespace App\Schema\Contents\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ContentEntity
 *
 * @property int $id
 * @property int $content_id
 * @property Content $content
 *
 * @package App\Schema\Contents\Models
 */
abstract class ContentEntity extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }
}