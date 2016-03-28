@extends('layouts.lavorum')

@section('title', 'Home')

@section('content')
	
<?php
	foreach ($posts as $post) {
		$post_id = $post->post_id;
		$user = $post->username;
		$topic = $post->topic;
		$date = $post->post_created;
		//var_dump($date);
		//$date = DateTime::createFromFormat('Y-m-d H:M:s');
		$adate = strtotime($date);
		$date = date('Y-m-d H:i', $adate);
		?>
		<div class="post_div">
			<div>
				<span><a class="user"><?=$user;?></a></span>
				<span><?=$date?></span>
			</div>
			<div><a href="lavorum/view/<?=$post_id?>" class="post" title="<?=$date;?>"><?=$topic;?></a></div>
		</div>
		<?php
	}
?>

@stop