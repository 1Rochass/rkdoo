<?php
class View 
{
	public function generate($bundleName, $view, $data=null)
	{
		require "../src/" . $bundleName . "/views/" . $view;
	}
}