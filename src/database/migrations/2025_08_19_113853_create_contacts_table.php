<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->comment('カテゴリーID')
                  ->constrained()
                  ->restrictOnDelete();
            $table->string('first_name', 255)->comment('氏名（名）');
            $table->string('last_name', 255)->comment('氏名（姓）');
            $table->tinyInteger('gender')->comment('性別コード');
            $table->string('email', 255)->comment('Eメール');
            $table->string('tel', 255)->comment('電話番号');
            $table->string('address', 255)->comment('住所');
            $table->string('building', 255)->nullable()->comment('建物');
            $table->text('detail')->comment('詳細');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
