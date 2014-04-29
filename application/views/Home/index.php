		<?php if( !$this->session->userdata('logged_in') ) { ?>

		<section id="SignUp">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-4 col-md-offset-2">
						<p>Ask anything.<br/>
						Understand everything.</p>
					</div>
					<div class="col-md-4">
						<form class="form-signin" role="form" action="<?php echo site_url(); ?>" method="post">
					        <input name="pseudo" type="text" class="form-control" placeholder="Pseudonym" required>
					        <input name="email" type="email" class="form-control" placeholder="Email address" required>
					        <input name="password" type="password" class="form-control" placeholder="Password" required>
					        <button class="btn btn-lg btn-primary btn-block" name="submitForm" value="formSignUp" type="submit">Sign up</button>
      					</form>
					</div>
				</div>
			</div>
		</section>

		<?php } else { ?>

		<section id="UserInfo" class="QuestTable">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="padding col-md-4 col-md-offset-2">
						<span> Hello <span class="UserInfoPseudo" style="background-color: #<?php echo $this->session->userdata('color'); ?>"><?php echo $this->session->userdata('pseudo'); ?></span> !</span>
					</div>
					<div class="col-md-2">
						<span> Karma Received </span>
						<p>12<i class="glyphicon glyphicon-arrow-up" style="color: #ffc600"></i> 7<i class="glyphicon glyphicon-arrow-down" style="color: #00C0ff"></i> &nbsp;&nbsp;&nbsp;5<i class="glyphicon glyphicon-heart" style="color: #ff3333; font-size:0.8em"></i></p>
					</div>
					<div class="col-md-2">
						<span> Karma Given </span>
						<p>12<i class="glyphicon glyphicon-arrow-up" style="color: #ffc600"></i> 7<i class="glyphicon glyphicon-arrow-down" style="color: #00C0ff"></i> &nbsp;&nbsp;&nbsp;5<i class="glyphicon glyphicon-heart" style="color: #ff3333; font-size:0.8em"></i></p>
					 </div>
				</div>
			</div>
		</section>

		<section id="QuestUser">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-6">
						<span class="foc" id="UserUnanswered"><i class="glyphicon glyphicon-eye-close"></i> Unanswered questions</span>
					</div>
					<div class="col-md-6">
						<span id="UserQuest"><i class="glyphicon glyphicon-user"></i> My questions</span>
					</div>
				</div>
			</div>
		</section>

		<section class="QuestTable QuestUserTableJS" id="QuestUnanswered">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<table class="table">
							<tbody>
								<?php
									if(isset($user_unanswered) && !empty($user_unanswered)) 
									foreach($user_unanswered as $quest) { ?>
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
		</section>

		<section class="QuestTable QuestUserTableJS" id="QuestUserPers">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<table class="table">
							<tbody>
								<?php  
									if(isset($user_quest) && !empty($user_quest))
									foreach($user_quest as $quest) { ?>
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
		</section>

		<section id="QuestPop">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-4">
						<span class="foc" id="PopLatest"><i class="glyphicon glyphicon-time"></i> Latest</span>
					</div>
					<div class="col-md-4">
						<span id="PopWeek"><i class="glyphicon glyphicon-star"></i> Top of the week</span>
					</div>
					<div class="col-md-4">
						<span id="PopMonth"><i class="glyphicon glyphicon-certificate"></i> Top of the month</span>
					</div>
				</div>
			</div>
		</section>

		<section class="QuestTable QuestPopTableJS" id="QuestLatest">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<table class="table">
							<tbody>
								<?php
									if(isset($quest_latest) && !empty($quest_latest)) 
									foreach($quest_latest as $quest) { ?>
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
		</section>

		<section class="QuestTable QuestPopTableJS" id="QuestWeek">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<table class="table">
							<tbody>
								<?php  
									if(isset($quest_pop_week) && !empty($quest_pop_week))
									foreach($quest_pop_week as $quest) { ?>
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
		</section>

		<section class="QuestTable QuestPopTableJS" id="QuestMonth">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<table class="table">
							<tbody>
								<?php  
									if(isset($quest_pop_month) && !empty($quest_pop_month))
									foreach($quest_pop_month as $quest) { ?>
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
		</section>

		<? } ?>