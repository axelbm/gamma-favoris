
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>                        
			</button>
			<a class="navbar-brand" href="<?php echo WEBROOT ?>"><span class="glyphicon glyphicon-home"></span> <?=$m["home"]?></a>
		</div>

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				
			</ul>

			
			
			<ul class="nav navbar-nav navbar-right">
				<?php if(empty($user)){ ?>
					<li><a href="<?php echo WEBROOT.'user/signup/' ?>"><span class="glyphicon glyphicon-user"></span> <?=$m["signup"]?></a></li>
					<li><a href="" data-toggle="modal" data-target="#connection_modal"><span class="glyphicon glyphicon-log-in"></span> <?=$m["login"]?></a></li>
				<?php 
				}else{  ?>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo WEBROOT ?>">
							<b><?=$user->Username()?></b> 
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo WEBROOT.'user/profil/'; ?>"><?=$m["profile"]?></a></li>
							<li><a href="<?php echo WEBROOT.'user/edit/'; ?>"><?=$m["edit"]?></a></li>
							<li class="divider"></li>
							<li><a href="<?php echo WEBROOT.'user/logout/'; ?>"><?=$m["logout"]?></a></li>
						</ul>
					</li>
				<?php } ?>
			</ul>

		</div>
	</div>
</nav>