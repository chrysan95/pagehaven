<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // name
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('author');
            $table->string('publisher');
            $table->integer('price');
            $table->integer('number_of_pages'); // jumlah halaman
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // untuk upload foto buku
            $table->timestamps();
        });
    }

};
