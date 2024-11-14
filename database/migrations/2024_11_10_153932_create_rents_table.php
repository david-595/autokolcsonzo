<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * A migráció futtatása.
     */
    public function up(): void
    {
        // Létrehozza a 'rents' táblát az adatbázisban.
        Schema::create('rents', function (Blueprint $table) {
            $table->id(); // Automatikusan növekvő egyedi azonosító.
            $table->string("email"); // Az ügyfél email címe.
            $table->unsignedBigInteger("car_id"); // Az autó azonosítója.
            $table->date("rent_start"); // A bérlés kezdési dátuma.
            $table->date("rent_end")->nullable(); // A bérlés befejezési dátuma, lehet NULL (opcionális).
            $table->integer("km")->nullable(); // A megtett kilométerek száma, lehet NULL.
            $table->integer("all_price")->nullable(); // Az összesített ár, lehet NULL.
            $table->softDeletes(); // Soft delete oszlop, amely lehetővé teszi a rekord "törlését" anélkül, hogy végleg eltávolítaná.
            $table->timestamps(); // Létrehozza a created_at és updated_at oszlopokat.

            // Külső kulcs létrehozása a 'car_id' mezőhöz, ami a 'cars' táblában található 'id' mezőre hivatkozik.
            // Ha egy kapcsolódó autó törlődik, a hozzá tartozó bérlés is törlődik (cascade).
            $table->foreign("car_id")->references("id")->on("cars")->onDelete("cascade");
        });
    }

    /**
     * A migráció visszavonása.
     */
    public function down(): void
    {
        // Törli a 'rents' táblát, ha létezik.
        Schema::dropIfExists('rents');
    }
};
