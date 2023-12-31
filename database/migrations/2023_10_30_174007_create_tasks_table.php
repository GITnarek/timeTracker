<?php

use App\Enums\Tasks\PrioritiesEnum;
use App\Enums\Tasks\StatusesEnum;
use App\Enums\Tasks\TypesEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignee_id')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('sysname')->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('status')->default(StatusesEnum::TODO);
            $table->unsignedTinyInteger('priority')->default(PrioritiesEnum::MINOR);
            $table->unsignedTinyInteger('type')->default(TypesEnum::TASK);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('estimated_time')->default(0);
            $table->integer('spent_time')->default(0);
            $table->timestamps();

            $table->foreign('assignee_id')
                ->references('id')
                ->on('users');

            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
