<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'messages', function ( Blueprint $table ) {
			$table->increments( 'id' );

			$table->string( 'mes_id' );
			$table->text( 'title' );
			$table->boolean( 'isDeleted' );

			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop( 'messages' );
	}
}
