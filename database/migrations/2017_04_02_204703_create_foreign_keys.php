<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('threads', function(Blueprint $table) {
			$table->foreign('channel_id')->references('id')->on('Channels')
						->onDelete('no action')
						->onUpdate('cascade');
		});
		Schema::table('threads', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('cascade');
		});
		Schema::table('threads', function(Blueprint $table) {
			$table->foreign('answer_id')->references('id')->on('messages')
						->onDelete('no action')
						->onUpdate('cascade');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('no action')
						->onUpdate('cascade');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->foreign('thread_id')->references('id')->on('threads')
						->onDelete('no action')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('threads', function(Blueprint $table) {
			$table->dropForeign('threads_channel_id_foreign');
		});
		Schema::table('threads', function(Blueprint $table) {
			$table->dropForeign('threads_user_id_foreign');
		});
		Schema::table('threads', function(Blueprint $table) {
			$table->dropForeign('threads_answer_id_foreign');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->dropForeign('messages_user_id_foreign');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->dropForeign('messages_thread_id_foreign');
		});
	}
}