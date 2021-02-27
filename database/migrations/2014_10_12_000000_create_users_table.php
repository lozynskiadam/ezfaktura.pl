<?php

use App\Dictionaries\CoreDictionary;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('api_key', 36)->unique();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('nip', 10);
            $table->string('name', 255)->default('');
            $table->string('postcode', 10)->default('');
            $table->string('city', 255)->default('');
            $table->string('address', 255)->default('');
            $table->string('logo')->default(CoreDictionary::DEFAULT_LOGO_PATH);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
