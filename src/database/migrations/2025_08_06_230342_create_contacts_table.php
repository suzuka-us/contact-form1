<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->string('last_name');
            $table->string('first_name');
            $table->string('gender');
            $table->string('address');
            $table>string('tel');

            $table->string('building');
            $table->unsignedBigInteger('category_id');


           
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'last_name',
                'first_name',
                'gender',
                'address',
                'building',
                'category_id'
            ]);
        });
    }
};
