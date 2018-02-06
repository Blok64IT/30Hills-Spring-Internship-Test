<div id="users">
	<?php foreach ($data['users'] as $user) : ?>
		<div class="user">
			<a href="<?php echo BASE_ROOT; ?>/home/user/<?php echo $user->user_id; ?>"><?php echo $user->firstName . ' ' . $user->surname; ?> <span><?php echo $user->age . ' ' . $user->gender; ?></span></a>
		</div>
	<?php endforeach; ?>
</div>

