<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Arr; // ★ 追加

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryIds = Category::pluck('id')->all();
        if (empty($categoryIds)) {
            // 念のため：カテゴリが無ければ何もしない
            return;
        }

        // ダミー35件（カテゴリは指定5件からランダム割当）
        Contact::factory()
            ->count(35)
            ->make() // まだDBに保存しない
            ->each(function ($contact) use ($categoryIds) {
                $contact->category_id = Arr::random($categoryIds); // ★ 修正
                $contact->save(); // DBに保存
            });
    }
}
