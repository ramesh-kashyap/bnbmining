$(document).ready(function() {
	
	if ($('.shop').length) {
		timerFull();
	}
	$(".get-shop").on('click',function(e) {
		let text = $(this).data('text');
		let id = $(this).data('id');
		let name = $(this).data('item');
		let price = $(this).data('price');
		let avaible = $(this).data('avaible');
		let timer = $(this).data('timer');
		let error = $(this).data('error');
		let balance = 1*$('.crystal__count').text();
		
		if (balance < price ) {
			alert(error, null, true, 'error');
		}
		else {
			alert('<p>'+text + ' ' + name + '</p><a class="main-btn main-btn_green mb-0 get-shop-confirm" data-balance="'+ balance +'" data-timer="'+ timer +'"  data-avaible="' + avaible + '" data-price="' + price + '"  data-id='+ id + ' >Confirm</a>');
		}
		return false;
	});

	$(document).on('click',".get-shop-confirm", function(){
		let id = $(this).data('id');
		let price = $(this).data('price');
		let avaible = $(this).data('avaible') - 1;
		let timer = $(this).data('timer');
		let balance = $(this).data('balance');

		
		$.ajax({
			type: 'POST',
			url: 'ajax',
			dataType: 'json',
			data: {
				'module': 'bonuses',
				'do': 'buy',
				'id': id
			},
			success:
				function (ex) {
					if (ex.result == undefined)
						alert(ex.error, null, true, 'error');
					else {

						$('.shop__item--'+id).addClass('active');
						if (!avaible) {
							$('.shop__item--'+id).find('.shop__btn').addClass('d-none');
							
							if (timer) {
								$('.shop__item--'+id).find('.shop__timer').removeClass('d-none');
							}
						}

						$('.crystal__count').text( balance - price );
						alert('Successful purchase', null, true, 'success');
					}
				}
		});
		
		return false;
	});


	$(".get-bonus").on('click',function(e) {
		let text = $(this).data('text');
		let current = $('.bonuses .current');
		let next =  $('.bonuses .next');
		let name = $(this).data('item');
		$.ajax({
			type: 'POST',
			url: 'ajax',
			dataType: 'json',
			data: {
				'module': 'bonuses',
				'do': 'take'
			},
			success:
				function (ex) {
					if (ex.result == undefined) {
						alert(ex.error);
					}
					else {
						alert(text);
						next.find('.timer').data('time',ex.result); 
						timer();
						if (name == "H-Crystal") {
							let balance  = 1*$('.crystal__count').text();
							$('.crystal__count').animateNumbers(balance, balance + 1, 200, null, 0);
						}
						current.removeClass('has-bonus').addClass('complited');
						next.addClass('has-progress');
					}
				}
		});
		return false;
	});

	$('.open-bonus').on('click', function() {
		$('body').addClass("modal-open");
		let name = $(this).data('name');
		let img = $(this).data('img');
		let id = $(this).data('id');
		let box = $(this).data('box');
		$('.modal-name').text('');
		$('.modal-img').html('');
		$('.modal-id').text('');
		$('.modal-box').text('');
		$('.modal-name').text(name);
		$('.modal-img').html(img);
		$('.modal-id').text(id);
		let prizeList = prizes[box];
		$('.modal-size').text(prizeList.length);
		$('.modal-box').text(box);
		let wheel = $("#wheel");
    wheel.html('');  
    wheel.removeClass();  
    wheel.addClass('wheel');  
    wheel.addClass('sub-' + prizeList.length);  
		wheel.addClass('sub-box-' + box);  
		
    for(let i = 0; i < prizeList.length; i++) {
        let sector = $('<div class="sector" data-value="' + (i+1) + '"></div>');
        let prize = $('<div class="prize"></div>').html('<div>' + prizeList[i] + '</div>');
        sector.append(prize);
        wheel.append(sector);
    }
		return false;
	});

	$('.close-modal').on('click', function() {
			$('body').removeClass("modal-open");
			$('#wheel').removeAttr('style');
			return false;
	});

	$(document).on('click','#spin', function(){
		let oid = $('.modal-id').text();
		let size = $('.modal-size').text();
		let box = $('.modal-box').text();
		let prizeGrid = prizesGrid[box];
		$.ajax({
			type: 'POST',
			url: 'ajax',
			dataType: 'json',
			data: {
				'module': 'bonuses',
				'do': 'open',
				'id': oid
			},
			success:
				function (ex) {
					if (ex.result == undefined) {
						alert(ex.error);
					}
					else {
						let oper = ex.result;
						let result = prizeGrid[oper[1]][oper[2]];
						let totalSectors = size;
						let rotation = 360 / totalSectors;
						let totalRotation = 5 * 360 - (rotation * (result - 1));
						$("#wheel").css("transform", 'rotate(' + totalRotation + 'deg)');
						text="<p>You receive "+ prizes[box][result - 1]+'</p><a class="main-btn main-btn_orange mb-0"  href="/lootbox">Confirm</a>';
						setTimeout(function() {
							alert(text,'/lootbox');
						}, 5000);
					}
				}
		});
	});

	$.fn.animateNumbers = function (start, stop, duration, ease, number = 2, delay = 0) {
		return this.each(function () {
			var $this = $(this);
			$({ Counter: start }).stop(true, true).delay(delay).animate({ Counter: stop }, {
				duration: duration == undefined ? 1000 : duration,
				easing: ease == undefined ? "swing" : ease,
				step: function () {
					$this.text(number_format(this.Counter, number, '.', ','));
				},
				complete: function () {
					$this.text(number_format(stop, number, '.', ','));
				}
			});
		});
	};

});


function timer() {
	$('.timer').each(function() {
		let timerElem = $(this);
		let timeLeft = parseInt(timerElem.data('time'), 10);
		setInterval(function() {
			if (timeLeft <= 0) {
				timerElem.text("00:00:00");
				return;
			}
			timerElem.text(formatTime(timeLeft));
			timeLeft--;
		}, 1000);
	});
}	

function timerFull() {
	$('.timer').each(function() {
		let timerElem = $(this);
		let timeLeft = parseInt(timerElem.data('time'), 10);
		setInterval(function() {
			if (timeLeft <= 0) {
				timerElem.text("0d 0h 0m 0s");
				return;
			}
			timerElem.text(formatTimeFull(timeLeft));
			timeLeft--;
		}, 1000);
	});
}	

function formatUnixTime(unixTimestamp) {
	let date = new Date(unixTimestamp * 1000);
	let hours = date.getUTCHours().toString().padStart(2, '0');
	let minutes = date.getUTCMinutes().toString().padStart(2, '0');
	let seconds = date.getUTCSeconds().toString().padStart(2, '0');
	return `${hours}:${minutes}:${seconds}`;
}

function formatTime(seconds) {
	let hours = Math.floor(seconds / 3600);
	seconds -= hours * 3600;
	let minutes = Math.floor(seconds / 60);
	seconds -= minutes * 60;

	hours = hours.toString().padStart(2, '0');
	minutes = minutes.toString().padStart(2, '0');
	seconds = seconds.toString().padStart(2, '0');

	return `${hours}:${minutes}:${seconds}`;
}

function formatTimeFull(seconds) {
	let days = Math.floor(seconds / (3600 * 24));
	seconds -= days * 3600 * 24;
	let hours = Math.floor(seconds / 3600);
	seconds -= hours * 3600;
	let minutes = Math.floor(seconds / 60);
	seconds -= minutes * 60;
	hours = hours.toString().padStart(2, '0');
	minutes = minutes.toString().padStart(2, '0');
	seconds = seconds.toString().padStart(2, '0');
	return days + 'd ' + hours + 'h '+ minutes + 'm ' + seconds + 's';
}




function number_format(number, decimals, decPoint, thousandsSep) {

	number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
	var n = !isFinite(+number) ? 0 : +number
	var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
	var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
	var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
	var s = ''

	var toFixedFix = function (n, prec) {
		if (('' + n).indexOf('e') === -1) {
			return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
		} else {
			var arr = ('' + n).split('e')
			var sig = ''
			if (+arr[1] + prec > 0) {
				sig = '+'
			}
			return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
		}
	}

	s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || ''
		s[1] += new Array(prec - s[1].length + 1).join('0')
	}

	return s.join(dec)
}
