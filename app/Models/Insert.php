<?php

namespace App\Models;

use \PDO;

class Insert
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	/**
	 * Unose se podaci u bazu
	 */
	public function insertAllUsers()
	{
		$file = $this->getJSONFile();

		foreach ($file as $item)
		{
			$user = $this->db->prepare("
				INSERT INTO user
					(usr_id, usr_firstname, usr_surname, age, gender)
				VALUES
					(:id, :firstname, :surname, :age, :gender)
			");

			$user->execute([
				'id' => $item['id'],
				'firstname' => $item['firstName'],
				'surname' => $item['surname'],
				'age' => $item['age'],
				'gender' => $item['gender']
			]);

			if ($item['friends'])
			{
				foreach($item['friends'] as $friend)
				{
					$friends = $this->db->prepare("
						INSERT INTO friend (usr_id, frd_id)
						VALUES (:id, :friend_id)
					");
					$friends->execute([
						'id' => $item['id'],
						'friend_id' => $friend
					]);

					unset($friends);
				}
			}
		}
	}

	/**
	 * Uzimamo JSON fajl i vracamo sadrzaj kao array
	 */
	protected function getJSONFile()
	{
		return json_decode(__DIR__ .file_get_contents('../../Models/data.json'));
	}
}
