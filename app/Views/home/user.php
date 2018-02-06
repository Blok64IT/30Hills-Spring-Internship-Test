<div class="user-info-friend">
	<div id="user-left">
		<div class="user-friends-header">
			<p>Current User</p>
		</div>
		<div class="user-info">
			<p><?php echo $data['user']->firstName . ' ' . $data['user']->surname; ?> <span><?php echo $data['user']->age . ' ' . $data['user']->gender; ?></span></p>
		</div>
		
		<div class="user-friends-header">
			<p>User Direct Friends</p>
		</div>

		<div class="user-friends">
			<?php foreach($data['userFriends'] as $userFriend) : ?>
				<div class="user-friend">
					<a href="<?php echo BASE_ROOT; ?>/home/user/<?php echo $userFriend->friend_id; ?>"><?php echo $userFriend->firstName . ' ' . $userFriend->surname; ?></a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div id="user-right">
		<div class="user-friends-header">
			<p>Friends Of Friends</p>
		</div>

		<?php foreach($data['friendsOfFriends'] as $FoF) : ?>
			<div class="user-friend u-fof">
				<a href="<?php echo BASE_ROOT; ?>/home/user/<?php echo $FoF->user_id; ?>"><?php echo $FoF->firstName . ' ' . $FoF->surname; ?></a>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<div id="all-users">
	<a href="<?php echo BASE_ROOT; ?>/home/users">See All Users</a>
</div>