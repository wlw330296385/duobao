	var score = 0,
				nowitem = 0;
			var lists = [{
				title: "1.你觉得通常“菊花”是比喻什么的？",
				say: [{
					t: "A.老奶奶的笑脸--------D（故做装纯情男）",
					s: 0
				}, {
					t: "B.嘟起来的嘴唇--------B（温情大白男）",
					s: 0
				}, {
					t: "C.揉皱的卫生纸--------C（2货青年）",
					s: 0
				}, {
					t: "D.臀眼--------A（经典阳刚爷们）",
					s: 1
				}, ],
				bg: "img/problem_01.png"
			}, {
				title: "2.当你第一眼看到“干”和“操”这两个多音字时，你脑里的读音是：",
				say: [{
					t: "A.干读第一声、操读第一声--------C（2货青年）",
					s: 0
				}, {
					t: "B.干读第四声、操读第一声--------D（故做装纯情男）",
					s: 0
				}, {
					t: "C.干读第一声、操读第四声--------B（温情大白男）",
					s: 0
				}, {
					t: "D.干读第四声、操读第四声--------A（阳刚纯爷们）",
					s: 1
				}, ],
				bg: "img/problem_01.png"
			}, {
				title: "3.什么样的情景最能勾起你的PAPAPA？",
				say: [{
					t: "A看电影--------B（温情大白男）",
					s: 0
				}, {
					t: "B说情话--------A（阳刚纯爷们）",
					s: 0
				}, {
					t: "C角色扮演--------D（故作装纯男）",
					s: 1
				}, {
					t: "D吵架--------C（2货青年））",
					s: 1
				}, ],
				bg: "img/problem_01.png"
			}, {
				title: "4.他的什么状态更容易引起你的欲望？",
				say: [{
					t: "A楚楚可怜--------A（阳刚纯爷们）",
					s: 1
				}, {
					t: "B干劲儿十足--------D（故作装纯男）",
					s: 1
				}, {
					t: "C卖萌发嗲--------B（温情大白男）",
					s: 2
				}, {
					t: "D痛不欲生--------C（火星变态男排除掉）",
					s: 3
				}, ],
				bg: "img/problem_01.png"
			}, {
				title: "5.你喜欢和TA什么时段爱爱？",
				say: [{
					t: "A清晨--------B（2货青年）",
					s: 0
				}, {
					t: "B睡前--------A（阳刚纯爷们）",
					s: 0
				}, {
					t: "C半夜三点定闹钟--------C（火星变态男排除掉）",
					s: 1
				}, {
					t: "D时段不是问题，视频才是关键--------D（故作装纯男）",
					s: 1
				}, ],
				bg: "img/problem_01.png"
			}];
		
			function bindList(o) {
				if (nowitem == 5) {
					/*show显示hide隐藏*/
				}
				if (nowitem < lists.length) {
					$("#title").html(o.title);
					$("#say").html('');
					$('#picture').attr('src', o.img);
					//         $("#picture").css('display', 'none');
					var says = o.say;
					for (var i = 0; i < says.length; i++) {
						$("#say").append('<div data-score="' + says[i].s + '" onclick="nextitem(this)">' + says[i].t + '</div>');
					}
					$("#p_2").css('background', 'url(' + o.bg + ') no-repeat');
					$("#p_2").css('background-size', '100% 100%');
					
				} else {
					$("#p_2").hide();
					$("#p_3").show();
					//判断分数结果算出分数总和
					var a = showOver();
					$('#num').html(a);
				}
			}
			//进度条
			function nextitem(o) {
				score += parseInt($(o).attr('data-score'));
				nowitem++;
				$("#now").html(nowitem + 1);
				bindList(lists[nowitem]);
				var proVal = nowitem / lists.length * 100;
				$("#pro").css('width', proVal + '%');
			}
			//显示结果页的逻辑处理
			function showOver() {
				var num = 0;
				if (score >= 0 && score <= 2) {
					
					$("#home").attr('src', "img/boy1.png");
					num += 1;
					$('#num').html(num)
				}
				if (score >= 3 && score <= 8) {
				    
					$("#home").attr('src', "img/boy2.png");
					num += 2;
					$('#num').html(num)
				}
				if (score >= 9 && score <= 11) {
					
					$("#home").attr('src', "img/boy3.png");
				
					num += 3;
					$('#num').html(num)
				}
				if (score >= 12 && score <= 15) {
					
					$("#home").attr('src', "img/boy4.png");
					
					num += 4;
					$('#num').html(num)
				}
				
				return score;
			}
			$(function() {
				$("#btn_start").on('click', function() {
					
				    $("#p_1").hide();
					$("#p_4").show();
					//处理P2的题目绑定
				
				})
				
				$("#one").on('click', function() {
					
					$("#p_4").hide();
					$("#p_2").show();
					//处理P2的题目绑定
					score = 0;
					nowitem = 0;
					$("#pro").css('width', 0);
					bindList(lists[0])
				})
				$("#two").on('click', function() {
					
					$("#p_4").hide();
					$("#p_2").show();
					//处理P2的题目绑定
					score = 0;
					nowitem = 0;
					$("#pro").css('width', 0);
					bindList(lists[0])
				})
				
				
				$("#have").on('click', function() {
					//          $(this).hide();
					$('#share').hide();
					$('#logoBox').show();
				})
				$("#btn_next").on('click', function() {
					$('#logoBox').hide();
					$('#share').show();
				})
			})