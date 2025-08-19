<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // クエリビルダ（SQLを構築するためのクラスライブラリ）
use Carbon\Carbon; // 日付操作ライブラリ

/**
 * category model
 * 
 * お問い合わせの種類
 * 
 * Corresponding table: categories
 * 
 * Properties:
 * 
 * @property int $id
 *     主キーID（自動採番）
 * 
 * @property varchar(255) $content
 *     内容
 * 
 * @property Carbon|null $created_at
 *     タスクが作成された日時（Laravelが自動で管理）
 * 
 * @property Carbon|null $updated_at
 *     タスクが最後に更新された日時（Laravelが自動で管理）
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    /**
     * Get the contacts associated with the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

}
