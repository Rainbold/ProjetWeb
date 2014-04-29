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
							</div>
							<div class="col-md-9">
								<p>
									<?php if(exists($answer)) echo nl2br($answer['ans']->text); ?>
								</p>
							</div>
							<div style="clear: both;"></div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>