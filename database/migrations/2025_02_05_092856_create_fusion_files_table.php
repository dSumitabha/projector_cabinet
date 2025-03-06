<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFusionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fusion_files', function (Blueprint $table) {
            $table->id();
            $table->string('fusion_id'); // For the Fusion_ID field
            $table->string('file_name'); // For the File Name field
            $table->text('file_attachment')->nullable(); // For the File attachment field (Path to file)
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
        Schema::dropIfExists('fusion_files');
    }
}
