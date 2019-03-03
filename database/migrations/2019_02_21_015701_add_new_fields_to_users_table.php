<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 15)->unique()->after('id');
            $table->string('lastname', 15)->unique()->after('username');
            $table->string('firstname', 15)->unique()->after('lastname');
            $table->string('contact')->nullable()->after('email');
            $table->tinyInteger('status')->default(1)->after('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
