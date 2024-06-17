<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->integer("id", true, true);
            $table->bigInteger("vn_id", false, true);
            $table->foreign("vn_id")->references("id")->on("vn_urls")->onDelete("cascade");
            $table->string("quote", 1024);
            $table->integer("insert_at", false, true)->default(0)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
