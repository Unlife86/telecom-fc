// Avoid `console` errors in browsers that lack a console.
(function($) {
	$.fn.sliderB = function (options) {
		var settings = $.extend({
			arrItems: this,
			nextButton: null,
			preButton: null,
			step: 3,
			duration: 1000,
			delay: 300
		}, options||{});
		settings.current = 0;
		function goSlide(index) {
			var widthSlide = -1*(parseFloat($(settings.arrItems[0]).width()) + parseFloat($(settings.arrItems[0]).css("paddingLeft")) + parseFloat($(settings.arrItems[0]).css("paddingRight")));
			var slider = $(settings.arrItems[0]).parents(".slider");
			slider.animate({left: widthSlide*index},settings.delay);
			settings.current = index;
		}
		function goControl(index, classC) {
			if (classC == settings.nextButton) {
				if ($(settings.preButton).hasClass("hidden")) $(settings.preButton).removeClass("hidden");
				if (settings.current == settings.arrItems.length - settings.step) $(settings.nextButton).addClass("hidden");
				
			} else {
				if ($(settings.nextButton).hasClass("hidden")) $(settings.nextButton).removeClass("hidden");
				if (settings.current == 0) $(settings.preButton).addClass("hidden");
			}
		}
		$(settings.nextButton).click(function() {
			goSlide(settings.current + 1);
			goControl(settings.current, settings.nextButton);
		});	
		$(settings.preButton).click(function() {
			goSlide(settings.current - 1);
			goControl(settings.current, settings.preButton);
		});
	}
	$.fn.add_table = function (season, control, options) {
		var settings = $.extend({"team_name": true, "plays": true, "win": true, "dead_heat": true, "lose": true, "scored": true, "missing": true, "points": true}, options||{});
		var table_html = this;
		function p_in_table(personA, personB) {
			if (personB.points != personA.points) { return personB.points - personA.points;
			} else if (personB.win != personA.win) { return personB.win - personA.win;
			} else if (personB.scored != personA.scored) { return personB.scored - personA.scored;}
		}
		function render_table(tour_idx) {
			var ap_html, balls;
			tour_idx = parseInt(tour_idx || season.length - 1);
			$("caption h3", table_html).text((tour_idx + 1).toString() + " тур");
			season[tour_idx].table.sort(p_in_table);
			season[tour_idx].table.forEach(function(item, i) {
				ap_html = "<td>"+ (i+1) +"</td>";
				for (var key in settings) {
					if (settings[key] === true) {
						if (key == "scored") { balls = item[key].toString() + "-";
						} else if (key == "missing") { balls = balls + item[key]; ap_html = ap_html + "<td>"+ balls +"</td>";
						} else { ap_html = ap_html + "<td>"+ item[key].toString() +"</td>";}
					}
				}
				$("tbody", table_html).append("<tr>"+ ap_html +"</tr>");
			});
		}
		function clear_table() { $("tbody tr", table_html).remove(); }
		$(control).click(function() {
			var tour_idx = $(this).parent().attr("data-item");
			clear_table(); render_table(tour_idx);
		});
		render_table();
	} 
	$.fn.add_list = function (season, control, options) {
		var settings = $.extend({
			"date_match": "<p class='countdown-period'>$$</p><p class='countdown-amount bg-black white-text'>$$</p>",
			"home_name": "<strong class='text-uppercase'>$$</strong>",
			"home_logo": "<img src='img/logo/$$.png' class='img-responsive' alt='$$'>",
			"score": "<span class='h3'>$$-$$</span>",
			"guests_logo": "<img src='img/logo/$$.png' class='img-responsive' alt='$$'>",
			"guests_name": "<strong class='text-uppercase'>$$</strong>"
		}, options||{});
		var table_html = this;
		function render_list(tour_idx) {
			var ap_html, arr_str;
			tour_idx = tour_idx || season.length - 1;
			season[tour_idx].matches.forEach(function(item, i) {
				for (var key in settings) {
					if (settings[key] !== false) {
						arr_str = settings[key].split('$$');
						switch (key) {
							case "date_match":
							ap_html = "<td>" + (arr_str[0] + item.date[1] + arr_str[1] + item.date[0]+ arr_str[2]) + "</td>";
							break;
							case "home_name":
							ap_html = ap_html + "<td>" + (arr_str[0] + item.home[0][0] + arr_str[1]) + "</td>";
							break;
							case "home_logo":
							ap_html =  ap_html + "<td>" + (arr_str[0] + item.home[0][1] + arr_str[1] + item.home[0][1] + arr_str[2]) + "</td>";
							break;
							case "score":
							ap_html = ap_html + "<td>" + (arr_str[0] + item.home[1] + arr_str[1] + item.guests[1] + arr_str[2]) + "</td>";
							break;
							case "guests_logo":
							ap_html = ap_html + "<td>" + (arr_str[0] + item.guests[0][1] + arr_str[1] + item.guests[0][1] + arr_str[2]) + "</td>";
							break;
							case "guests_name":
							ap_html = ap_html + "<td>" + (arr_str[0] + item.guests[0][0] + arr_str[1]) + "</td>";
							break;
						}
					}
				}
				$("tbody", table_html).append("<tr>"+ ap_html +"</tr>");
				ap_html = null;
			});
		}
		function clear_list() { $("tbody tr", table_html).remove(); }
		$(control).click(function() {
			var tour_idx = $(this).parent().attr("data-item"); //console.log(tour_idx);
			clear_list(); render_list(tour_idx);
		});
		render_list();
	}	
})(jQuery);

Array.prototype.shuffle = function() { for (var i = this.length - 1; i > 0; i--) { var num = Math.floor(Math.random() * (i + 1)); var d = this[num]; this[num] = this[i]; this[i] = d; } return this; }
function randomInteger(min, max) { var rand = min - 0.5 + Math.random() * (max - min + 1); rand = Math.round(rand); return rand;}
function lengthMatch(arr) { var len = 0; arr.forEach(function(item) { len = item.length + len; }); return len; }
function in_array(value, array) { for(var i = 1; i < array.length; i++) { if(array[i] == value) return true; } return false; }
//function factorial(n) { return (n != 1) ? n * factorial(n - 1) : 1; }
//function abs_number(n) { if (n < 0) { return n = 0; } else { return n; } }
Array.prototype.match = function (team_list) {
	var json, season = [], team_name, team_idx, team_obj, date_match, monthsList, count_tour, match_count;
	json = this;
	//json.shuffle();
	//count_tour = 18;//actorial(team_list.length) / factorial(team_list.length - 2)) / (team_list.length / 2);
	date_match = new Date('2015-04-15');
	monthsList = ["янв", "февр", "март", "апр", "май", "июнь", "июль", "авг", "сент", "окт", "нбр", "дек"];
	for (var i=0; i < json.length; i++) {
		var tour = {
			"matches": [],
			"table": [],
		}
		for (var j=0; j < team_list.length; j++) {
			if (i == 0) {
				tour.table.push({"team_name": team_list[j][0], "plays": i + 1, "win": 0, "dead_heat": 0, "lose": 0, "scored": 0, "missing": 0, "points": 0});
			} else {
				tour.table.push({ "team_name": team_list[j][0], "plays": i + 1, "win": season[i-1].table[j].win, "dead_heat": season[i-1].table[j].dead_heat, "lose": season[i-1].table[j].lose, "scored": season[i-1].table[j].scored, "missing": season[i-1].table[j].missing, "points": 0 });
			}
		}
		for (var j=0; j< json[i].length; j++) {
			tour.matches.push({
				"date": [date_match.getDate(), monthsList[date_match.getMonth()]],
				"home": [team_list[json[i][j][0]], randomInteger(0, 5)],
				"guests": [team_list[json[i][j][1]], randomInteger(0, 5)]
			});
			if (tour.matches[j].home[1] > tour.matches[j].guests[1]) {
				tour.table[json[i][j][0]].win++; tour.table[json[i][j][1]].lose++;
			} else if (tour.matches[j].home[1] < tour.matches[j].guests[1]) {
				tour.table[json[i][j][1]].win++; tour.table[json[i][j][0]].lose++;
			} else if (tour.matches[j].home[1] == tour.matches[j].guests[1]) {
				tour.table[json[i][j][1]].dead_heat++; tour.table[json[i][j][0]].dead_heat++;
			}
			tour.table[json[i][j][0]].scored = tour.table[json[i][j][0]].scored + tour.matches[j].home[1]; tour.table[json[i][j][1]].missing = tour.table[json[i][j][1]].missing + tour.matches[j].home[1];
			tour.table[json[i][j][1]].scored = tour.table[json[i][j][1]].scored + tour.matches[j].guests[1]; tour.table[json[i][j][0]].missing = tour.table[json[i][j][0]].missing + tour.matches[j].guests[1];
			tour.table[json[i][j][0]].points = (tour.table[json[i][j][0]].win * 3) + tour.table[json[i][j][0]].dead_heat;
			tour.table[json[i][j][1]].points = (tour.table[json[i][j][1]].win * 3) + tour.table[json[i][j][1]].dead_heat;
			date_match.setDate(date_match.getDate() + randomInteger(0, 3));
		}
		tour.matches.shuffle(); season.push(tour); delete tour;
	}
	return season;
}
/*(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}(jQuery));*/

// Place any jQuery/helper plugins in here.
