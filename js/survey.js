var whichQuestion = 0;
var questions = [{question: "How old are you?", 
				         W: "8-12", A: "13-17", S: "18-21", D: "21+", answer: undefined },
			   	 {question: "What's your favorite food?",
			   	 		 W: "Pizza", A: "Burritos", S: "Ice Cream", D: "Steak", answer: undefined },	
				 {question: "Your ideal date?",
				 		 W: "Long walks on the beach", 
				 		 A: "Golfing", S: "Dinner and a movie", 
				 		 D: "Ice Skating", answer: undefined }]

document.body.onload = function() { parseQuestion(questions[whichQuestion]); }

function parseQuestion(question) {
	$("#question").html(question.question);
	$("#wAnswer").html(question.W);
	$("#aAnswer").html(question.A);
	$("#sAnswer").html(question.S);
	$("#dAnswer").html(question.D);
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
	var letters = ["w", "a", "s", "d"];

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
	var letters = ["w", "a", "s", "d"];
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
		questions[whichQuestion++].answer = answer;

		if (whichQuestion < questions.length) {
			parseQuestion(questions[whichQuestion]);
		}
		else {
			getResults();
		}
	}
}

function getResults() {
	if (whichQuestion == questions.length) {
		questions.forEach(function(question) {
			console.log(question.answer);
		})
	}
}

$(document).ready(function() {
	$(document).keydown(getAnswer);
})
