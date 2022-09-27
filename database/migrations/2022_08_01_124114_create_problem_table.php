<?php

use App\Models\User;
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
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('status');
            $table->string('title');
            $table->text('detail');
            $table->string('location');
            $table->foreignIdFor(\App\Models\Department::class); //response department
            $table->foreignIdFor(User::class)->nullable(); // response user
            $table->string('picture_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problems');
    }
};
