<div id="title" class="index"></div>
<div id="transparent-bg"></div>
<header>
	</ul>

	<nav>
		<div class="teal lighten-1 nav-wrapper">
			<a id="logo" href="#" class="brand-logo">Prioritizer</a>
			<ul id="nav-mobile" class="right">
				<li id="welcome" class="hide-on-med-and-down">Welcome back</li>
				<li>
					 <!-- Dropdown Trigger -->
					 <a class='dropdown-button' href='#' data-activates='user-drop'><?php echo $_SESSION['user']; ?></a>

					 <!-- Dropdown Structure -->
					 <ul id='user-drop' class='dropdown-content'>
					 	<li><a id="log-out" href="#!">Log Out</a></li>
					 </ul>
				</li>
			</ul>
	<ul id="slide-out" class="side-nav fixed">
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
		</div>
	</nav>
</header>
<main>
  <div id="creationWizard">
   <div id="row-wrapper" class="row">
   </div>
  </div>
<div id="events" class="row">
</div>
<a id="newEvent" class="btn-floating btn-large tooltipped waves-effect waves-light red"
	data-position="top" data-delay="50" data-tooltip="Add an Event">
	<i class="material-icons">add</i>
</a>
</main>
<script class="index" type="text/javascript" src="js/index.js"></script>