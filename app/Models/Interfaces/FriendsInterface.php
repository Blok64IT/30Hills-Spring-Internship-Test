<?php 

namespace App\Models\Interfaces;

interface FriendsInterface
{
	public function getAllUsers();
	public function getUser(int $userId);
	public function getUserFriends(int $userId);
	public function getFriendsOfFriends(int $userId);
}

