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
        Schema::create('drag_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('good_id')
            ->constrained('goods')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignId('stock_id')
            ->constrained('stocks')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            
            $table->decimal('rate');
            $table->date('made_date');
            $table->date('expired_date');
            // $table->boolean('returned')->default(false);
            // $table->boolean('expired_in_stock')->default(false);
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
        Schema::dropIfExists('drag_rates');
    }
};
