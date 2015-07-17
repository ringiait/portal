<nav class="navbar navbar-inverse">

	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">[Ringi Portal]</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
			<?php
				foreach($parents as $pid) {
					$tmp = $menuArr[$pid];
					$p_active = ($pid == $currMenuItem) ? 'active' : '';
					$child_i = 0;
					if(in_array($pid, array_keys($child))) {
						$child_i++;
						echo '<li class="dropdown">';
							echo '<a href="'.$tmp->links.''.$tmp->id.'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true">';
								echo ''.$tmp->title.'<span class="caret"></span>';
							echo '</a>';
							echo '<ul class="dropdown-menu">';
							foreach($child[$pid] as $cid) {
								$c_tmp = $menuArr[$cid];
								$c_active = ($c_tmp->id == $currMenuItem) ? 'active' : '';
								echo '<li class=" '.$c_active.'"><a href="'.$c_tmp->links.''.$c_tmp->id.'">'.$c_tmp->title.'</a></li>';
							}
							echo ($child_i == count($child[$pid])) ? '' : '<li role="separator" class="divider"></li>';
							echo '</ul>';
						echo '</li>';
					}
					else{
						echo  '<li class=" '.$p_active.'"><a href="'.$tmp->links.''.$tmp->id.'">'.$tmp->title.'</a></li>';
					}
				}
			?>

			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<!-- can add js de chay duoc dropdow -->