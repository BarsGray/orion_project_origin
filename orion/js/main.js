jQuery(function ($) {



	// ++++++++++++++++++++++++++++ fancybox gallery ++++++++++++++++++++++++++++++++++++++++++++
	// ++++++++++++++++++++++++++++ popup ++++++++++++++++++++++++++++++++++++++++++++ 
	Fancybox.bind('[data-fancybox="gallery"]', {
		Galleries: {
			ignoreDuplicates: true,
		},
		placeFocusBack: false,
	});

	Fancybox.bind("[data-fancybox]", {
		zoomEffect: false,
		dragToClose: false,
	});
	// ++++++++++++++++++++++++++++ fancybox gallery ++++++++++++++++++++++++++++++++++++++++++++
	// ++++++++++++++++++++++++++++ popup ++++++++++++++++++++++++++++++++++++++++++++




	// ++++++++++++++++++++++++++++ tubs ++++++++++++++++++++++++++++++++++++++++++++
	const tubs_row = document.querySelector('.catalog_tubs_row');
	const btn_prev = document.querySelector('.catalog_tubs_btn_prev');
	const btn_next = document.querySelector('.catalog_tubs_btn_next');


	tubs_row.addEventListener('wheel', (e) => {
		e.preventDefault();
		tubs_row.scrollBy({ left: e.deltaY });
	});

	btn_prev.onclick = () => {
		tubs_row.scrollBy({ left: -150 });
	};
	btn_next.onclick = () => {
		tubs_row.scrollBy({ left: 150 });
	};

	function updadteBtn() {
		const scrollLeft = tubs_row.scrollLeft;
		const maxScroll = tubs_row.scrollWidth - tubs_row.clientWidth;

		btn_prev.disabled = scrollLeft <= 0;
		btn_next.disabled = scrollLeft >= maxScroll - 3;
	}

	tubs_row.addEventListener('scroll', updadteBtn);

	updadteBtn();
	// ++++++++++++++++++++++++++++ tubs ++++++++++++++++++++++++++++++++++++++++++++




	// ++++++++++++++++++++++++++++ carusel ++++++++++++++++++++++++++++++++++++++++++++

	const swiper = new Swiper('.swiper', {
		loop: true,
		slidesPerView: 3,
		centeredSlides: true,
		slidesPerGroup: 1,
		pagination: {
			el: '.carusel__pagination',
			// dynamicBullets: true,
			clickable: true,
		},
		navigation: {
			nextEl: '.carusel__next',
			prevEl: '.carusel__prev',
		},
		breakpoints: {
			// 1001: {
			// 	slidesPerView: 3,
			// },
			640: {
				slidesPerView: 3,
				slidesPerGroup: 1,

			},
			300: {
				centeredSlides: false,
				slidesPerView: 1,
				slidesPerGroup: 1,

			},
		},
	});
	// ++++++++++++++++++++++++++++ carusel ++++++++++++++++++++++++++++++++++++++++++++



	// ++++++++++++++++++++++++++++ menu, popup ++++++++++++++++++++++++++++++++++++++++++++

	const menuButton = document.querySelector('.burger_menu_btn');
	const svgMenuButton = document.querySelector('.burger_menu_btn .ham');
	const headerMenu = document.querySelector('.row_menu');
	const overlay = document.querySelector('.overlay');

	const popupBox = document.querySelector('.popup_box');
	const getKonsultacia = document.querySelector('.row_menu .header_btn');
	const closeKonsultacia = document.querySelector('.popup_btn_close');


	function openMenu() {
		document.querySelector('body').classList.toggle('scroll-nane');

		menuButton.classList.toggle('burger_menu_btn--active');
		svgMenuButton.classList.toggle('active');
		headerMenu.classList.toggle('row_menu--visible');
		overlay.classList.toggle('overlay--visible');
	}

	// function openPopap() {
	// 	overlay.classList.toggle('overlay--visible');
	// 	popupBox.classList.toggle('popup_box--active');
	// 	menuButton.classList.toggle('burger_menu_btn--disable');

	// 	if (menuButton.closest('.burger_menu_btn--active')) {
	// 		openMenu();
	// 	}

	// 	if (popupBox.closest('.popup_box--active')) {
	// 		closeKonsultacia.addEventListener('click', openPopap, true);
	// 	} else {
	// 		closeKonsultacia.removeEventListener('click', openPopap);
	// 	}
	// }

	function overlayReset() {
		document.querySelector('body').classList.remove('scroll-nane');
		menuButton.classList.remove('burger_menu_btn--active');
		svgMenuButton.classList.remove('active');
		headerMenu.classList.remove('row_menu--visible');
		overlay.classList.remove('overlay--visible');
		// popupBox.classList.remove('popup_box--active');
		// menuButton.classList.remove('burger_menu_btn--disable');
	}

	overlay.addEventListener('click', overlayReset);

	menuButton.addEventListener('click', openMenu);
	// getKonsultacia.addEventListener('click', openPopap);
	// ++++++++++++++++++++++++++++ menu, popup ++++++++++++++++++++++++++++++++++++++++++++



	// ++++++++++++++++++++++++++++ validate input  ++++++++++++++++++++++++++++++++++++++++++++

	const phoneInput = document.getElementById('tel');

	// При фокусе, если поле пустое, подставляем префикс
	phoneInput.addEventListener('focus', () => {
		if (!phoneInput.value) {
			phoneInput.value = '+7 ';
		}
	});

	// При потере фокуса, если в поле только префикс, очищаем его для показа плейсхолдера
	phoneInput.addEventListener('blur', () => {
		if (phoneInput.value === '+7 ') {
			phoneInput.value = '';
		}
	});

	phoneInput.addEventListener('input', (e) => {
		let input = e.target.value.replace(/\D/g, ''); // Удаляем все нецифры
		let formatted = '';

		// Если первая цифра 7 или 8, убираем её, чтобы начать заново с +7
		if (['7', '8', '9'].includes(input[0])) {
			if (input[0] === '9') input = '7' + input;
			input = input.substring(1);
		}

		formatted = '+7 ';

		if (input.length > 0) {
			formatted += '(' + input.substring(0, 3);
		}
		if (input.length >= 4) {
			formatted += ') ' + input.substring(3, 6);
		}
		if (input.length >= 7) {
			formatted += '-' + input.substring(6, 8);
		}
		if (input.length >= 9) {
			formatted += '-' + input.substring(8, 10);
		}

		e.target.value = formatted;
	});

	// Запрещаем удалять +7 вручную и ставим его при фокусе
	phoneInput.addEventListener('keydown', (e) => {
		if (e.target.value.length <= 4 && e.keyCode === 8) {
			e.preventDefault();
		}
	});


	const form = document.querySelector('form');

	form.addEventListener('submit', (e) => {
		if (phoneInput.value.length < 18) {
			alert('Пожалуйста, введите номер телефона полностью');
			e.preventDefault(); // Останавливает отправку формы
		}
	});
});
// ++++++++++++++++++++++++++++ validate input  ++++++++++++++++++++++++++++++++++++++++++++









