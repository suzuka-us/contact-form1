<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('last_name')->after('id');
            $table->string('first_name')->after('last_name');
            $table->string('gender')->after('first_name');
            $table->string('address')->after('tel');
            $table->string('building')->nullable()->after('address');
            $table->unsignedBigInteger('category_id')->after('building');

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
