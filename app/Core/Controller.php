<?php

namespace App\Core;

use \PDO;
use \App\Config\Database;
use \App\Models\Validation\Validation as Validator;

class Controller extends Database
{
	public function __construct() {}

	/**
	 * Ucitavamo klasu, tj. kontroler
	 * @param $model Ime klase koju ucitavamo
	 * @return [object] Vraca objekat i prosledjuje se konekcija na bazu
	 */
	protected function model($model)
	{
		require_once '../app/Models/' . $model . '.php';

		$model = "\\App\\Models\\" . $model;

		return new $model(parent::getDB());
	}

	/**
	 * Ucitavamo view
	 * Mozemo ucitati ovde odmah header i footer ili rucno u metodi kontrolera
	 * @param  [string] $view  [View gde zelimo da prikazemo podatke]
	 * @param  array  $data  [Podaci koji se prosledjuju u view]
	 * @param  string $title [Ako ucitavamo header i footer u view-u mozemo da prosledimo npr i title za taj dokument]
	 */
	protected function view($view, array $data = [], $title = 'Home')
	{
		#require_once '../app/views/_template/_header.php';
		require_once '../app/Views/' . $view . '.php';
		#require_once '../app/views/_template/_footer.php';
	}

	public function validator()
	{
		require_once '../app/Models/Validation/Validation.php';

		return new Validator(parent::getDB());
	}
}
