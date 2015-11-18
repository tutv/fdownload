<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserXesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'user_xes', function ( Blueprint $table ) {
			$table->increments( 'id' );

			$table->string( 'unique_id' );
			$table->string( 'name' );
			$table->string( 'email' );
			$table->string( 'pass' );

			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'user_xes' );
	}
}
