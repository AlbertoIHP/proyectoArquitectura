<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Timestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });


        Schema::table('articles', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });


        Schema::table('assistances', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('buildings', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('calendars', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('expenses', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });


        Schema::table('maintainers', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('maintenances', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('payments', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('reservations', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('roles', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('shift_types', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });

        Schema::table('spaces', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });


        Schema::table('spacetypes', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });


        Schema::table('users', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });


        Schema::table('workers', function (Blueprint $table) {
            
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
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
