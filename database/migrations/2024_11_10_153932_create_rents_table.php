<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->string("email");
            $table->unsignedBigInteger("car_id");
            $table->date("rent_start");
            $table->date("rent_end")->nullable();
            $table->integer("km")->nullable();
            $table->integer("all_price")->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("car_id")->references("id")->on("cars")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
