<?php

namespace App\Core;

class App
{
	protected $controller = 'home';
	protected $method = 'users';
	protected $params = [];

	public function __construct()
	{
		$url = $this->parseUrl();

		if (file_exists('../app/controllers/' . $url[0] . '.php'))
		{
			$this->controller = $url[0];
			unset($url[0]);
		}

		/**
		 * Ime klase/kontrollera zajedno sa nemespace-ovima
		 */
		$class = '\\App\\Controllers\\' . $this->controller;
		$this->controller = new $class();

		if (isset($url[1]))
		{
			if (method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		/**
		 * [$this->params] parametri koji se prosledju metodi
		 * @array_values koristimo jer unset-ujemo kontroler i metodu iz array-a a onda ukoliko imamo argumente oni ostaju sa index-ima 2, 3, 4 itd i zelimo da ih
		 * pomocu array_values promenimo da im index-i pocinju od 0
		 */
		$this->params = $url ? array_values($url) : [];

		/**
		 * @call_user_func_array poziva funkciju unutar kontroler-a i prosledje joj parametre
		 * 1. argument - niz (1. ime klase, 2. ime metode u toj klasi)
		 * 2. argument - niz parametri
		 */
		call_user_func_array([$this->controller, $this->method], $this->params);

	}

	protected function parseUrl()
	{
		if (isset($_GET['url']))
		{
			/**
			 * @rtrim sklanja zadnji slash sa desne strane npr home/index/ -> home/index (po defaultu ako nista ne stavimo sklanja prazna polja),
			 * da nismo ovo uradili dobili bi jos jedan clan niza koji bi bio prazan jer je slash na kraju a nema iza njega nista
			 * @filter_var [FILTER_SANITIZE_URL] sklanja sve nezodvoljene karaktere u URL-u
			 * @explode ['/'] pretvara string u niz i deli ga sa /
			 *
			 * array (size=2)
  			 *	0 => string 'home' (length=4)
  			 *	1 => string 'index' (length=5)
			 */
			return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}
