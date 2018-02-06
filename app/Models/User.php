<?php

namespace App\Models;

use \PDO;

use App\Models\Interfaces\FriendsInterface;

class User implements FriendsInterface
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	public function getAllUsers()
	{
		$users = $this->db->query("
			SELECT
				*
			FROM user
			ORDER BY user.firstName ASC
		");

		$users = $users->fetchAll(PDO::FETCH_OBJ);

		return $users;
	}

	public function getUser(int $userId)
	{
		$user = $this->db->prepare("
			SELECT
				*
			FROM user
			WHERE user_id = :userId
		");

		$user->execute([
			'userId' => $userId
		]);

		$user = $user->fetch(PDO::FETCH_OBJ);

		return $user;
	}

	public function getUserFriends(int $userId)
	{
		$userFriends = $this->db->prepare("
			SELECT
				*
			FROM
				user
				INNER JOIN friend
				ON user.user_id = friend.friend_id
			WHERE friend.user_id = :userId
			ORDER BY user.firstName ASC
		");

		$userFriends->execute([
			"userId" => $userId
		]);

		$userFriends = $userFriends->fetchAll(PDO::FETCH_OBJ);

		return $userFriends;
	}

	public function getFriendsOfFriends(int $userId)
	{
		$friendsOfFriends = $this->db->prepare("
			SELECT
			    distinct u.*
			FROM
			    user u
			    INNER JOIN friend ff ON u.user_id = ff.friend_id
			    INNER JOIN friend f ON ff.user_id = f.friend_id
			WHERE
			    f.user_id = :userId
			    AND u.user_id <> :uid
			    AND ff.friend_id NOT IN
			(SELECT friend_id FROM friend WHERE user_id = :id)
			ORDER BY u.firstName ASC
		");

		$friendsOfFriends->execute([
			'userId' => $userId,
			'uid' => $userId,
			'id' => $userId
		]);

		$friendsOfFriends = $friendsOfFriends->fetchAll(PDO::FETCH_OBJ);

		return $friendsOfFriends;
	}
}
