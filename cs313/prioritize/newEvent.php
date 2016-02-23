<div class="center-content col l10 m10 s12">
	<div class="card-panel teal lighten-1">
		<div class="card-content">
			<h3 class="white-text">Create an Event</h3>
		</div>
	</div>
	<div class="card-panel">
		<div class="card-content">
			<form>
				<div class="input-field">
					<input id="event-name" type="text" class="validate">
					<label for="event-name">Event Name</label>
				</div>
				<div class="input-field">
					<textarea id="description" class="materialize-textarea"></textarea>
					<label for="description">Description</label>
				</div>
				<input type="checkbox" class="filled-in" id="schedule-for-me" checked="checked" />
				<label for="schedule-for-me">Schedule for me</label>

				<div id="when-to-schedule"><?php include ("scheduleForMeMenu.php") ?></div>

				<div class="center-btn">
					<a id="add-btn" class="waves-effect waves-light blue lighten-2 btn">Add Event</a>
					<a id="cancel-btn" class="waves-effect waves-light red lighten-2 btn">Cancel Creation</a>
				</div>
			</form>
		</div>
		</div>
</div>
<script type="text/javascript" src="js/newEvent.js"></script>