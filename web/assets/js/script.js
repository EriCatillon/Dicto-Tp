$(document).ready(function(){


	//--------------------------------------------------

	$("#menu_filtre").prepend('<div id="All" class="btn_cat"><div id="All_icon" class="cat_icon"></div><div class="cat_title">Vrac</div></div>');

	var win_height = $(window).height();

	$(".menu_right").css('height', win_height);

	var qsRegex;

	var $container = $('#catalogue');
	
	$container.isotope({
		itemSelector: '.creation_home',
		layoutMode: 'masonry',
		filter: function() {
			return qsRegex ? $(this).text().match( qsRegex ) : true;
		}
	});

	setTimeout(function(){
		$("#catalogue").isotope( 'layout' );
		$(".creation_home").each(function(){
			var img_size = $(this).height()/4;
			$(this).find(".mask_box").css("padding-top",img_size);
		});
	},100);

	var $quicksearch = $('#quicksearch').keyup( debounce( function() {
		if (($('#quicksearch').val())!="") {
			$(".cat_title").removeClass('cat_title_on');
			$(".cat_icon").removeClass('cat_icon_on');
		};
		qsRegex = new RegExp( $quicksearch.val(), 'gi' );
		$container.isotope({
			filter: function() {
				return qsRegex ? $(this).text().match( qsRegex ) : true;
			}
		});
	}, 200 ) );

	function debounce( fn, threshold ) {
		var timeout;
		return function debounced() {
			if ( timeout ) {
				clearTimeout( timeout );
			}
			function delayed() {
				fn();
				timeout = null;
			}
			timeout = setTimeout( delayed, threshold || 100 );
		}
	}

	var $container2 = $('#main_footer');
		// init
		$container2.isotope({
		// options
		itemSelector: '.cols',
		layoutMode: 'masonry'
	});


	$("#Curiosity").on('click', function(){
		$container.isotope({ filter: '.Curiosity' });
		$("#quicksearch").val('');
	});

	$("#Stickers").on('click', function(){
		$container.isotope({ filter: '.Stickers' });
		$("#quicksearch").val('');
	});

	$("#Flyers").on('click', function(){
		$container.isotope({ filter: '.Flyers' });
		$("#quicksearch").val('');
	});

	$("#Affiches").on('click', function(){
		$container.isotope({ filter: '.Affiches' });
		$("#quicksearch").val('');
	});

	$("#CD-Vynile").on('click', function(){
		$container.isotope({ filter: '.CD-Vynile' });
		$("#quicksearch").val('');
	});

	$("#All").on('click', function(){
		$container.isotope({ filter: '*' });
		$("#quicksearch").val('');
	});

});