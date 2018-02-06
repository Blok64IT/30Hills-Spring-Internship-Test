<?php

namespace App\Controllers;

use App\Core\Controller;

class Home extends Controller
{
	/**
	 *Metoda za unosenje  podataka iz JSON fajla u bazu - POKRECE SE SAMO JEDNOM
	 */
	public function insertAllUsers()
	{
		$insertAllUsersModel = $this->model("Insert");

		$insertAllUsersModel->insertAllUsers();
	}

	/**
	 * home/users
	 * Prikaz svih korisnika (users)
	 */
	public function users()
	{
		$userModel = $this->model("User");
		$users = $userModel->getAllUsers();

		$this->view('_template/_header');

		$this->view('home/users', [
			'users' => $users
		]);

		$this->view('_template/_footer');
	}

	/**
	 *Provera da li u bazi postoji korisnik sa naznacenim ID-em i da li je tip INT $userId
	 * Prikaz podataka  izabranog  korisnika (user-a)
	 * @param  [int] $userId [ID user-a]
	 */
	public function user($userId = 1)
	{
		$validator = $this->validator();

		if (!$validator->vaidateUserId($userId))
		{
			$this->view('_template/_header');

			$this->view('error/404', [
				'errorMessage' => "User doesn't exist"
			]);

			$this->view('_template/_footer');
			die();
		}

		$userModel = $this->model("User");

		$user = $userModel->getUser($userId);
		$userFriends = $userModel->getUserFriends($userId);
		$friendsOfFriends = $userModel->getFriendsOfFriends($userId);

		$this->view('_template/_header');

		$this->view('home/user', [
			'user' => $user,
			'userFriends' => $userFriends,
			'friendsOfFriends' => $friendsOfFriends
		]);

		$this->view('_template/_footer');

	}

}
