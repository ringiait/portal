<div class="header">
	<?php
		$width = round(1280/count($link_type_arr));
		foreach ($link_type_arr as $lt_id => $lt_title) {
			?>
			<div class="colum-item" style="width: <?=$width?>px">
				<table class="table table-striped" style="margin-bottom: 0px;">
					<tr class="danger">
						<th>#</th>
						<th width="70%">
							<?=$lt_title?>
						</th>
						<th align="left">
							<a href="#">
								<span class="glyphicon glyphicon-plus"></span>
							</a>
						</th>
					</tr>
					<?php
						$i = 0;
						foreach($link_arr[$lt_id] as $link) {	
							$i++
							?>
								<tr class="<?=$link->style_type?>">
									<td>
										<?=$i?>
									</td>
									<td>
										<a rel="nofollow" target="<?=$link->target?>" href="<?=$link->link?>">
											<?=$link->title?>
										</a>
									</td>
									<td>
										<a href="#">
										  <span class="glyphicon glyphicon-pencil"></span>
										</a>
										<a href="#">
											<span class="glyphicon glyphicon-trash"></span>
										</a>
									</td>
								</tr>
							<?php
						}
					?>
				</table>
				
			</div>	
			<?php
		}
	?>
</div>