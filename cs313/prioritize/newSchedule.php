<div class="center-content col l10 m10 s12">
	<div class="card-panel teal lighten-1">
		<div class="card-content">
			<h3 class="white-text">Create Your Schedule</h3>
		</div>
	</div>
	<div class="card-panel">
		<div class="card-content">
			<form>
				<div class="input-field">
					<input id="schedule-name" type="text" class="validate">
					<label for="schedule-name">Schedule Name</label>
				</div>
				<div class="row">
					<span id="day-start" class="col">When does your day start?</span>
					<div class="input-field col l2 m2 s12">
						<select id="start-hour">
							<option value="00">00</option>
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
						<label>Hour</label>
					</div>
					<div class="input-field col l2 m2 s12">
						<select id="start-min">
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>
						</select>
						<label>min</label>
					</div>
					<div class="input-field col l2 m2 s12">
						<select id="start-AM-PM">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
						<label>AM/PM</label>
					</div>
				</div>
				<div class="row">
					<span id="day-end" class="col">When does your day end?</span>
					<div class="input-field col l2 m2 s12">
						<select id="end-hour">
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
						<label>Hour</label>
					</div>
					<div class="input-field col l2 m2 s12">
						<select id="end-min">
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>
						</select>
						<label>min</label>
					</div>
					<div class="input-field col l2 m2 s12">
						<select id="end-AM-PM">
							<option value="AM">AM</option>
							<option value="PM">PM</option>
						</select>
						<label>AM/PM</label>
					</div>
				</div>
				<div class="center-btn">
					<a id="add-btn" class="waves-effect waves-light blue lighten-2 btn">Add Schedule</a>
					<a id="cancel-btn" class="waves-effect waves-light red lighten-2 btn">Cancel Creation</a>
				</div>
			</form>
		</div>
		</div>
</div>
<script type="text/javascript" src="js/newSchedule.js"></script>