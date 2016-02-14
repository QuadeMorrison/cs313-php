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
				<div classe="card-content">How long do you want to schedule for?</div>
				<div class="input-field" class="col l6 m6 s12">
					<div class="input-field col l5 m6 s12">
						<select id="hour">
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
							<option value="13">13</option>
							<option value="14">14</option>
							<option value="15">15</option>
							<option value="16">16</option>
							<option value="17">17</option>
							<option value="18">18</option>
							<option value="19">19</option>
							<option value="20">20</option>
							<option value="21">21</option>
							<option value="22">22</option>
							<option value="23">23</option>
						</select>
						<label>Hour</label>
					</div>
					<div class="input-field col l6 m6 s12">
						<select id="min">
							<option value="00">00</option>
							<option value="15">15</option>
							<option value="30">30</option>
							<option value="45">45</option>
						</select>
						<label>min</label>
					</div>
				</div>
				<div class="center-btn">
					<a id="add-btn" class="waves-effect waves-light blue lighten-2 btn">Add Event</a>
					<a id="cancel-btn" class="waves-effect waves-light red lighten-2 btn">Cancel Creation</a>
				</div>
			</form>
		</div>
		</div>
</div>
<script type="text/javascript" src="js/newEvent.js"></script>