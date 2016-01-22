var whichQuestion = 0;
var questions = undefined;
var letters = ["w", "a", "s", "d"];

document.body.onload = function() { 
	$.getJSON("../json/questions.json").done(function(response) {
		questions = response['questions'];
		$.get("checkResults.php", function(data, status) {
			if (status == "success" && data) {
				getResults();
			}
			else {
				parseQuestion(questions[whichQuestion]);
			}
		});
	})
}

function parseQuestion(question) {
	$("#question").html(question.question);
	$("#wAnswer").html(question.w);
	$("#aAnswer").html(question.a);
	$("#sAnswer").html(question.s);
	$("#dAnswer").html(question.d);
}

function getAnswer(e) {
	var answer = 0;

	switch(e.which) {
    	case 87: // W
    	selectAnswer("w");
    	break;

    	case 65: // A
    	selectAnswer("a");
    	break;

    	case 83: // S
    	selectAnswer("s");
    	break;

    	case 68: // D
    	selectAnswer("d");
    	break;

    	case 13: // Return
    	hitReturn();
    	break;
    }
}

function hitReturn() {
	var answer = undefined;
	var lightBlue = "#98dafc";
	var grey = "#2B303B";

	letters.forEach(function(letter) {
		if ($("#" + letter).css("background-color") == "rgb(152, 218, 252)") {
			answer = letter;
			$("#" + letter).css({"background" : grey, "color" : lightBlue});
		}
	})

	if (answer) {
		answerQuestion(answer);
		$("#instructions").html("Make your choice using the WASD keys on your keyboard");
	}
	else {
		$("#instructions").html("Please make a selection using WASD before moving on");
	}
}

function selectAnswer(letter) {
	var lightBlue = "#98DAFC";
	var grey = "#2B303B";

	letters.forEach(function(letter) {
		$("#" + letter).css({"background" : grey, "color" : lightBlue});
	})

	$("#" + letter).css({"background" : lightBlue, "color" : grey});

	$("#instructions").html("Confirm your selection by hitting the enter key");
}

function answerQuestion(answer) {
	if (answer && whichQuestion < questions.length) {
		sendResults(answer);

		if (++whichQuestion < questions.length) {
			parseQuestion(questions[whichQuestion]);
		}
		else {
			getResults();
		}
	}
}

function sendResults(answer) {
	$.post("addResult.php",
	{
		letter: answer,
		questionNumber: whichQuestion
	});
}

function getResults() {
	$.getJSON("../json/results.json").done(function(response) {
		var results = "<h1>Results</h1>" + "<div class=\"result\">";

		for (var i = 0; i < questions.length; ++i) {
			var totalVotes = 0;

			for (var j = 0; j < letters.length; ++j) {
				totalVotes += response["results"][i][letters[j]];
			}

			if (i % 2 === 0 && i != 0) {
				results += "</div><div class=\"result\">";
			}

			results += 
			"<h3>" + questions[i]["question"] + "</h3><br />";
			for (var j = 0; j < letters.length; ++j) {
				results +=
				"<h4>" + questions[i][letters[j]] +
				"</h4>";
				results += "&nbsp;&nbsp;&nbsp;" +
					calculateResults(response["results"][i][letters[j]],
										totalVotes);
			}
		}

		results += "</div>"

		$("#survey").html(results);

		$(".bar_wrapper").hide().fadeIn({queue: false, duration: 2000});
		$(".bar_wrapper").animate({ left: 0 }, 800);
	})
}

function calculateResults(letter, totalVotes) {
	var bar = "";
	var percent = 0;

	percent = letter / totalVotes * 100;

	bar += "<div class=\"bar_wrapper\">";

	for (var i = 0; i < percent / 10; ++i) {
		bar += "<div class=\"bar\"></div>";
	}

	//bar += "&nbsp;&nbsp;" + (Math.floor(percent * 100) / 100) + 
			//"%</div></br>"

			bar += "&nbsp;&nbsp;&nbsp;" 
				 + Math.floor(percent * 100) / 100 
				 + "%</div></br>";

	return bar;
}

$(document).ready(function() {
	$(document).keydown(getAnswer);
})
