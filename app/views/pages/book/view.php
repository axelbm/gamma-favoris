<div class="row">
	<div class="col-sm-8">
		<div class="heading">
			<h2><?php echo $book->Title(); ?>
			<small>Par <a href="<?php echo WEBROOT.'user/profil/'.$book->Creator(); ?>"><?php echo $usersname[$book->Creator()]; ?></a></small></h2>
			<p><span class="glyphicon glyphicon-time"></span> Posté le <?php echo $book->PublicationDate(); ?></p>
			
			<?php
			$form = $this->form("action");

			$form->start();
			?>
				<button type="submit" class="btn btn-info <?php echo empty($user)? 'disabled' : ''; ?>" value="follow" name="action"><span class="glyphicon glyphicon-paperclip"></span> 
					<?php echo $link['following'] ? 'Se désabonner' : 'S\'abonner' ?>
				</button>
				<div class="btn-group">
					<button type="submit" class="btn btn-<?php echo $link['dislike'] ? 'danger' : 'default'; ?> <?php echo empty($user)? 'disabled' : ''; ?>" value="dislike" name="action"><span class="glyphicon glyphicon-thumbs-down"></span>
					</button>
					<button type="submit" class="btn btn-<?php echo $link['like'] ? 'success' : 'default'; ?> <?php echo empty($user)? 'disabled' : ''; ?>" value="like" name="action"><span class="glyphicon glyphicon-thumbs-up"></span>
					</button>
				</div>
			<?php 
			$form->end();
			?>
		</div>
		<hr>
		<div class="body">
			<p><?php echo $book->Description(); ?></p>
			<?php if($pagescount){ ?>
			<hr>
			<a class="btn btn-primary <?php echo empty($user)? 'disabled' : ''; ?>" href="<?php echo WEBROOT.'book/read/'.$book->ID(); ?>">
				<?php echo empty($link['progression']) ? 'Commencer à lire' : 'Continuer'; ?> 
				<span class="glyphicon glyphicon-chevron-right"></span></a>
			<br>
			<br>
			<?php } ?>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="list-group">
			<a class="list-group-item" data-toggle="tooltip" title="<?php echo $stats['rate'].'% des '.$stats['total'].' notes sont positives.'; ?>">
				<span class="text-primary">Note</span>: 
				<span style="color:#FFB300;">
				<?php for ($i=0; $i < $stats['stars']; $i++): ?>
					<span class="glyphicon glyphicon-star"></span>
				<?php endfor;
				for ($i=0; $i < 5-$stats['stars']; $i++):?>
					<span class="glyphicon glyphicon-star-empty"></span>
				<?php endfor ?>
				</span>
			</a>
			<p href="#" class="list-group-item">
				<span class="text-primary">Nombre de pages</span>: <?php echo $pagescount; ?>
			</p>
			<a href="#" class="list-group-item">
				<span class="text-primary">Langue</span>: <?php echo 'Français'; ?>
			</a>
			<a href="#" class="list-group-item">
				<span class="text-primary">Categorie</span>: <?php echo $book_category; ?>
			</a>
			<div class="list-group-item">
				<span class="text-primary">Contributeur</span>: 
				<?php foreach ($contributor as $key => $member): ?>
					<a role="button" class="btn btn-primary btn-xs" href="<?php echo WEBROOT.'user/profil/'.$member; ?>"><?php echo $usersname[$member]; ?></a>
				<?php endforeach ?>
			</div>
		</div>

		<a role="button" class="btn btn-success btn-block <?php echo empty($user)? 'disabled' : ''; ?>" href="<?php echo WEBROOT.'book/edit/'.$book->ID(); ?>">
			<span class="glyphicon glyphicon-plus-sign"></span> Éditer ce livre</a>
	</div>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>