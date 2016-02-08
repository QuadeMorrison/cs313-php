function loadPage(data, status) {
	var currentTitle = '.' + $('#title').attr('class').split()[0]; // get page name
	$(currentTitle + "[src]").remove(); // find script tag with current page name and remove it
	$('#main').html(data); // replace page with new page

	var newTitle = $('#title').attr('class').split()[0]; // get new page name
	$(currentTitle + ":first").attr({"class": newTitle, 
								  "href": "css/" + newTitle + ".css"}); // replace css
}