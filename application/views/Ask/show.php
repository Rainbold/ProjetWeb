		<section class="QuestTable">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<h2><?php if(exists($quest)) echo $quest->title; ?></h2>
						<div class="QuestBody row-fluid">
							<div class="col-md-2 avatarCont">
								<div class="pseudo" style="color:#<?php if(exists($user)) echo $user->color; ?>"><b><?php if(exists($user)) echo $user->pseudo; ?></b></div>
								<div class="arrows">
									<p class="glyphicon glyphicon-arrow-up arrowUp"></p>
									<p>123</p>
									&nbsp;<p class="glyphicon glyphicon-arrow-down arrowDown"></p>
								</div>
								<div class="text-center">
									<a href=""><i class="glyphicon glyphicon-pencil"></i></a>
									<a href=""><i class="glyphicon glyphicon-remove"></i></a>
								</div>
								<br/>
							</div>
							<div class="col-md-9">
								<p>
									<?php if(exists($quest)) echo nl2br($quest->text); ?>
								</p>
							</div>
							<div style="clear: both;"></div>
						</div>
						<?php foreach($answers as $answer) { ?>
						<div class="QuestBody row-fluid">
							<div class="col-md-2 avatarCont">
								<div class="pseudo" style="color:#<?php if(exists($answer['user'])) echo $answer['user']->color; ?>"><b><?php if(exists($user)) echo $user->pseudo; ?></b></div>
								<div class="arrows">
									<p class="glyphicon glyphicon-arrow-up arrowUp"></p>
									<p>123</p>
									&nbsp;<p class="glyphicon glyphicon-arrow-down arrowDown"></p>
								</div>
								<div class="text-center">
									<a href=""><i class="glyphicon glyphicon-pencil"></i></a>
									<a href=""><i class="glyphicon glyphicon-remove"></i></a>
								</div>
								<br/>
							</div>
							<div class="col-md-9">
								<p>
									<?php if(exists($answer)) echo nl2br($answer['ans']->text); ?>
								</p>
								<?php if(exists($answer['rep']['answers'])) { ?>
								<br/><br/><br/><br/>

								
								<?php foreach ($answer['rep'] as $ans) { ?>
								<div class="panel-group" id="accordion">
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
													
												</a>
											</h4>
										</div>
										<div id="collapseOne" class="panel-collapse collapse in">
											<div class="panel-body">
												<?php echo $ans[0]; ?>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>
								<?php } ?>
							</div>
							<div style="clear: both;"></div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>