<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RepositoriesTableAddUniqueIndexes extends Migration {

    public function up() {
        Schema::table('repositories', function (Blueprint $table) {
            $table->unique('full_name', 'idx_full_name_unique');
        });
    }

    public function down() {
        Schema::table('repositories', function (Blueprint $table) {
            $table->dropUnique('idx_full_name_unique');
        });
    }

}
