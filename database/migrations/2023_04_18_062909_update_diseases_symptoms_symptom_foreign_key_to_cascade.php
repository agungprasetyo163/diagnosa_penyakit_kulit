<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDiseasesSymptomsSymptomForeignKeyToCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diseases_symptoms', function (Blueprint $table) {
            $table->dropForeign('diseases_symptoms_symptom_id_foreign');

            $table->foreign('symptom_id')
                ->references('id')
                ->on('symptoms')
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
            $table->dropForeign('diseases_symptoms_symptom_id_foreign');

            $table->foreign('symptom_id')
                ->references('id')
                ->on('symptoms');
        });
    }
}
