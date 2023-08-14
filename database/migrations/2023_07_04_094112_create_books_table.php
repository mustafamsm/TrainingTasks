<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
           $table->string('name_en',150);
            $table->string('name_ar',150);
            $table->string('author');
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('image');
            $table->date('publication');
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->decimal('price');

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
        Schema::dropIfExists('books');
    }
};
