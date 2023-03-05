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
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('category_id')->nullable()->constrained('categories')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->string('drag_name');
            $table->decimal('rate');
            $table->decimal('total_price');
            // $table->date('bougthdate');
            $table->integer('quantity');
            $table->longText('description');

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
        Schema::dropIfExists('goods');
    }
};
