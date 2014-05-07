		<section class="QuestTable">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="col-md-10 col-md-offset-1">
						<br/>
						<br/>
						<form action="<?php echo site_url(array('index.php', 'ask', 'add')); ?>" method="post" role="form">
							<div class="form-group">
								<label>Title</label>
								<input class="form-control" type="text" name="title" value=""/>
							</div>
							<div class="form-group">
								<label>Question</label>
								<textarea name="answer" class="form-control" rows="8" required></textarea>
							</div>
							<input type="hidden" name="id_quest" value="-1" />
							<button type="submit" class="btn btn-success">Submit</button>
						</form>
						<br/>
						<br/>
					</div>
				</div>
			</div>
		</section>