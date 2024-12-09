<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDiseasesSymptomsCertaintyForeignKeyToCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diseases_symptoms', function (Blueprint $table) {
            $table->dropForeign('diseases_symptoms_certainty_id_foreign');

            $table->foreign('certainty_id')
                ->references('id')
                ->on('certainties')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diseases_symptoms', function (Blueprint $table) {
            $table->dropForeign('diseases_symptoms_certainty_id_foreign');

            $table->foreign('certainty_id')
                ->references('id')
                ->on('symptoms');
        });
    }
}
