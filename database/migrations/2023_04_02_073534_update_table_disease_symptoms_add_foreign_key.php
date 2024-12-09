<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableDiseaseSymptomsAddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diseases_symptoms', function (Blueprint $table) {
            $table->foreign('disease_id')->references('id')->on('diseases');
            $table->foreign('symptom_id')->references('id')->on('symptoms');
            $table->foreign('certainty_id')->references('id')->on('certainties');
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
            $table->dropForeign('diseases_symptoms_disease_id_foreign');
            $table->dropForeign('diseases_symptoms_symptom_id_foreign');
            $table->dropForeign('diseases_symptoms_certainty_id_foreign');

            $table->dropIndex('diseases_symptoms_disease_id_foreign');
            $table->dropIndex('diseases_symptoms_symptom_id_foreign');
            $table->dropIndex('diseases_symptoms_certainty_id_foreign');
        });
    }
}
