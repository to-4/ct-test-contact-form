<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // クエリビルダ（SQLを構築するためのクラスライブラリ）
use Carbon\Carbon; // 日付操作ライブラリ

/**
 * contact model
 * 
 * お問い合わせ
 * 
 * Corresponding table: contacts
 * 
 * Properties:
 * 
 * @property int $id
 *     主キーID（自動採番）
 * 
 * @property integer $category_id
 *     カテゴリーID
 * 
 * @property varchar(255) $first_name
 *     氏名（名）
 * 
 * @property varchar(255) $last_name
 *     氏名（姓）
 * 
 * @property tinyint $gender
 *     性別コード
 *     1:男性 2:女性 3:その他
 * 
 * @property varchar(255) $email
 *     Eメール
 * 
 * @property varchar(255) $tel
 *     電話番号
 * 
 * @property varchar(255) $address
 *     住所
 * 
 * @property varchar(255)|null $building
 *     建物
 * 
 * @property text $detail
 *     詳細
 * 
 * @property Carbon|null $created_at
 *     タスクが作成された日時（Laravelが自動で管理）
 * 
 * @property Carbon|null $updated_at
 *     タスクが最後に更新された日時（Laravelが自動で管理）
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    /**
     * Get the category that owns the contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
