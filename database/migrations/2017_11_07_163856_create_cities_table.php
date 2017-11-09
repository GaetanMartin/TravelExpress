<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('city');
            $table->enum('state', ['AB','AK','AL','AR','AZ','BC','CA','CO','CT','DE','FL','GA','HI','IA','ID','IL','IN','KS','KY','LA','MA','MB','MD','ME','MI','MN','MO','MS','MT','NB','NC','ND','NE','NH','NJ','NL','NM','NS','NT','NU','NV','NY','OH','OK','ON','OR','PA','PE','QC','RI','SC','SD','SK','TN','TX','UT','VA','VT','WA','WI','WV','WY','YT']);
            $table->enum('country', ['US', 'CA']);
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
