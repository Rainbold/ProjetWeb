		<section class="QuestTable" id="QuestLatest">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<ul class="nav nav-pills">
						  <li <?php if(isset($cat) && $cat=='latest') echo 'class="active"'; ?> ><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', 'latest')); ?>">Most recent</a></li>
						  <li <?php if(isset($cat) && $cat=='views') echo 'class="active"'; ?> ><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', 'views')); ?>">Most viewed</a></li>
						  <li <?php if(isset($cat) && $cat=='answers') echo 'class="active"'; ?> ><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', 'answers')); ?>">Most answered</a></li>
						  <li <?php if(isset($cat) && $cat=='votes') echo 'class="active"'; ?> ><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', 'votes')); ?>">Top rated</a></li>
						</ul>
						<div class="row-fluid">
							<div class="col-md-10 col-md-offset-1">
								<ul class="pagination">
									<?php if( $page > 1 ) { ?>
								  		<li><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', $cat, $page-1)); ?>">&laquo;</a></li>
								  	<?php } ?>
								  	<li><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', $cat, 1)); ?>">1</a></li>
									<?php
								  		if($nb_pages > 2) {
								  			if($page == 2) {
								  	?>
								  	<li><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', $cat, 2)); ?>">2</a></li>
								  	<?php
								  				if($nb_pages > 3)
								  				{
								  	?>
								  	<li><a href="#">...</a></li>
								  	<?php
								  				}
								  			}
								  			elseif ($page == $nb_pages-1) {
								  				if($nb_pages > 3)
								  				{
								  	?>
								  	<li><a href="#">...</a></li>
								  	<?php
								  	?>
								  	<li><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', $cat, $page)); ?>"><?php echo $page; ?></a></li>
								  	<?php
								  				}
								  			}
								  			else {
									  			if($nb_pages == 3) {
									  	?>
									  	<li><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', $cat, 2)); ?>">2</a></li>
									  	<?php
									  			}
								  				if($nb_pages > 3 && $page > 2 && $page < $nb_pages-1)
								  				{
								  	?>
								  	<li><a href="#">...</a></li>
								  	<li><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', $cat, $page)); ?>"><?php echo $page; ?></a></li>
								  	<li><a href="#">...</a></li>
								  	<?php
								  				}
								  				elseif($nb_pages > 3 && ($page == 1 || $page == $nb_pages))
								  				{
								  	?>
								  	<li><a href="#">...</a></li>
								  	<?php
								  				}
								  			}
								  		}
								  		if($nb_pages > 1) {
								  	?>
								  	<li><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', $cat, $nb_pages)); ?>"><?php echo $nb_pages; ?></a></li>
								  	<?php } if( $page < $nb_pages ) { ?>
								  		<li><a href="<?php echo site_url(array('index.php', 'Ask', 'list_quest', $cat, $page+1)); ?>">&raquo;</a></li>
								  	<?php } ?>
								</ul>
								<table class="table">
									<tbody>
								<?php
									if(isset($data)) 
									foreach($data as $quest) { ?>
									<tr>
										<td class="votes">0<br/>Votes</td>
										<td class="ans"><?php echo $quest->nb_ans; ?><br/>Answers</td>
										<td class="views"><?php echo $quest->nb_views; ?><br/>Views</td>
										<td><?php echo $quest->title; ?></td>
									</tr>
								<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>