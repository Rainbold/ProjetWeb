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

		<section id="QuestPop">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-3">
						<span class="foc" id="PopLatest"><i class="glyphicon glyphicon-time"></i> Latest</span>
					</div>
					<div class="col-md-3">
						<span id="PopDay"><i class="glyphicon glyphicon-star-empty"></i> Top of the day</span>
					</div>
					<div class="col-md-3">
						<span id="PopWeek"><i class="glyphicon glyphicon-star"></i> Top of the week</span>
					</div>
					<div class="col-md-3">
						<span id="PopMonth"><i class="glyphicon glyphicon-certificate"></i> Top of the month</span>
					</div>
				</div>
			</div>
		</section>

		<section class="QuestTable" id="QuestLatest">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<table class="table">
							<tbody>
								<?php foreach($quest_latest as $quest) { ?>
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

		<section class="QuestTable" id="QuestDay">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<table class="table">
							<tbody>
								<?php foreach($quest_pop_day as $quest) { ?>
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

		<section class="QuestTable" id="QuestWeek">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<table class="table">
							<tbody>
								<?php foreach($quest_pop_week as $quest) { ?>
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

		<section class="QuestTable" id="QuestMonth">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<table class="table">
							<tbody>
								<?php foreach($quest_pop_month as $quest) { ?>
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