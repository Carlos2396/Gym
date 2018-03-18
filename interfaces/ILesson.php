<?php

	interface ILesson{
		public static function get($id);
		public static function all();
	    public function save();
	    public function update();
	    public function delete();
	}

?>