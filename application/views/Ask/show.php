		<section class="QuestTable">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<h2><?php if(exists($quest)) echo $quest->title; ?></h2>
						<div class="QuestBody row-fluid">
							<div class="col-md-2 avatarCont text-center">
								&nbsp;
								<?php if(exists($user)) { ?>
									<span class="UserInfoPseudo" style="background-color: #<?php echo $user->color; ?>"><?php echo $user->pseudo; ?></span>
								<?php } ?>
								<br/>
								<br/>
								<div class="arrows">
									<p class="glyphicon glyphicon-arrow-up arrowUp"></p>
									<p>123</p>
									&nbsp;<p class="glyphicon glyphicon-arrow-down arrowDown"></p>
								</div>
								<div class="text-center">
									<p><?php if(exists($quest)) echo date('d/m/Y H:i', $quest->date); ?></p>
									<?php if($this->session->userdata('id') == $quest->author_id) { ?>
										<a href=""><i class="glyphicon glyphicon-pencil"></i></a>
										<a href="<?php echo site_url(array('index.php', 'ask', 'del', $quest->id)); ?>"><i class="glyphicon glyphicon-remove"></i></a>
									<?php } ?>
								</div>
								<br/>
							</div>
							<div class="col-md-10">
								<p>
									<?php if(exists($quest)) echo nl2br($quest->text); ?>
								</p>
							</div>
							<div style="clear: both;"></div>
						</div>
						
						<button type="submit" class="btn btn-info pull-right formToggle">Answer</button>
						
						<div style="clear: both;"></div>

						<div class="row-fluid">
							<div class="col-md-8 col-md-offset-2 text-right">
								<form action="<?php echo site_url(array('index.php', 'ask', 'add', $quest->id)); ?>" method="post" role="form">
									<textarea name="answer" rows="8" required></textarea>
									<input type="hidden" name="id_quest" value="<?php echo $quest->id; ?>" />
									<button type="submit" class="btn btn-success">Submit</button>
								</form>
							</div>
						</div>

						<div style="clear: both;"><br/></div>

						<?php foreach($answers as $answer) { ?>
						<div class="QuestBody row-fluid">
							<div class="col-md-2 avatarCont text-center">
								&nbsp;
								<?php if(exists($answer['user'])) { ?>
									<span class="UserInfoPseudo" style="background-color: #<?php echo $answer['user']->color; ?>"><?php echo $answer['user']->pseudo; ?></span>
								<?php } ?>
								<br/>
								<br/>
								<div class="arrows">
									<p class="glyphicon glyphicon-arrow-up arrowUp"></p>
									<p>123</p>
									&nbsp;<p class="glyphicon glyphicon-arrow-down arrowDown"></p>
								</div>
								<div class="text-center">
									<p><?php echo date('d/m/Y H:i', $answer['ans']->date); ?></p>
									<?php if($this->session->userdata('id') == $answer['ans']->author_id) { ?>
										<a href=""><i class="glyphicon glyphicon-pencil"></i></a>
										<a href="<?php echo site_url(array('index.php', 'ask', 'del', $answer['ans']->id)); ?>"><i class="glyphicon glyphicon-remove"></i></a>
									<?php } ?>
								</div>
								<br/>
							</div>
							<div class="col-md-10">
								<p>
									<?php if(exists($answer)) echo nl2br($answer['ans']->text); ?>
								</p>
								
								<?php if(exists($answer['rep']['answers'])) { ?>
									<br/><br/><br/><br/>
									
									<?php
										foreach ($answer['rep']['answers'] as $key => $ans) {
											$user = $answer['rep']['users'][$key];
									?>
										<div class="panel-group" id="accordion">
											<div class="panel panel-default">
												<div class="panel-heading">
													<div class="panel-title">
														<div class="pull-left">
															<a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $ans->id; ?>">
																5 - <?php echo $user->pseudo; ?>
															</a>
															<i class="glyphicon glyphicon-arrow-up arrowUp" style="font-size:0.8em;"></i>
															<i class="glyphicon glyphicon-arrow-down arrowDown" style="font-size:0.8em;"></i>
														</div>
														<div class="pull-right">
															<?php echo date('d/m/Y H:i', $ans->date); ?>
															<?php if($this->session->userdata('id') == $ans->author_id) { ?>
																<a href=""><i class="glyphicon glyphicon-pencil"></i></a>
																<a href="<?php echo site_url(array('index.php', 'ask', 'del', $ans->id)); ?>"><i class="glyphicon glyphicon-remove"></i></a>
															<?php } ?>
														</div>
														<div style="clear: both;"></div>
													</div>
												</div>
												<div id="collapse_<?php echo $ans->id; ?>" class="panel-collapse collapse">
													<div class="panel-body">
														<?php echo $ans->text; ?>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
								<?php } ?>
							</div>
							<div style="clear: both;"></div>
						</div>
						
						<button type="submit" class="btn btn-info pull-right formToggle">Answer</button>
						
						<div style="clear: both;"></div>

						<div class="row-fluid">
							<div class="col-md-8 col-md-offset-2 text-right">
								<form action="<?php echo site_url(array('index.php', 'ask', 'add', $quest->id)); ?>" method="post" role="form">
									<textarea name="answer" rows="8" required></textarea>
									<input type="hidden" name="id_quest" value="<?php echo $answer['ans']->id; ?>" />
									<button type="submit" class="btn btn-success">Submit</button>
								</form>
							</div>
						</div>

						<div style="clear: both;"><br/></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>