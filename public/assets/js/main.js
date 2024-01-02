(function () {
	"use strict";


	const select = (el, all = false) => {
		el = el.trim()
		if (all) {
			return [...document.querySelectorAll(el)]
		} else {
			return document.querySelector(el)
		}
	}


	const on = (type, el, listener, all = false) => {
		let selectEl = select(el, all)
		if (selectEl) {
			if (all) {
				selectEl.forEach(e => e.addEventListener(type, listener))
			} else {
				selectEl.addEventListener(type, listener)
			}
		}
	}


	const onscroll = (el, listener) => {
		el.addEventListener('scroll', listener)
	}


	let navbarlinks = select('#navbar .scrollto', true)
	const navbarlinksActive = () => {
		let position = window.scrollY + 200
		navbarlinks.forEach(navbarlink => {
			if (!navbarlink.hash) return
			let section = select(navbarlink.hash)
			if (!section) return
			if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
				navbarlink.classList.add('active')
			} else {
				navbarlink.classList.remove('active')
			}
		})
	}
	window.addEventListener('load', navbarlinksActive)
	onscroll(document, navbarlinksActive)


	const scrollto = (el) => {
		let header = select('#header')
		let offset = header.offsetHeight

		if (!header.classList.contains('header-scrolled')) {
			offset -= 16
		}

		let elementPos = select(el).offsetTop
		window.scrollTo({
			top: elementPos - offset,
			behavior: 'smooth'
		})
	}

	let selectHeader = select('#header')
	if (selectHeader) {
		let headerOffset = selectHeader.offsetTop
		let nextElement = selectHeader.nextElementSibling
		const headerFixed = () => {
			if ((headerOffset - window.scrollY) <= 0) {
				selectHeader.classList.add('fixed-top')
				nextElement.classList.add('scrolled-offset')
			} else {
				selectHeader.classList.remove('fixed-top')
				nextElement.classList.remove('scrolled-offset')
			}
		}
		window.addEventListener('load', headerFixed)
		onscroll(document, headerFixed)
	}


	let backtotop = select('.back-to-top')
	if (backtotop) {
		const toggleBacktotop = () => {
			if (window.scrollY > 100) {
				backtotop.classList.add('active')
			} else {
				backtotop.classList.remove('active')
			}
		}
		window.addEventListener('load', toggleBacktotop)
		onscroll(document, toggleBacktotop)
	}


	on('click', '.mobile-nav-toggle', function (e) {
		select('#navbar').classList.toggle('navbar-mobile')
		this.classList.toggle('bi-list')
		this.classList.toggle('bi-x')
	})


	on('click', '.navbar .dropdown > a', function (e) {
		if (select('#navbar').classList.contains('navbar-mobile')) {
			e.preventDefault()
			this.nextElementSibling.classList.toggle('dropdown-active')
		}
	}, true)


	on('click', '.scrollto', function (e) {
		if (select(this.hash)) {
			e.preventDefault()

			let navbar = select('#navbar')
			if (navbar.classList.contains('navbar-mobile')) {
				navbar.classList.remove('navbar-mobile')
				let navbarToggle = select('.mobile-nav-toggle')
				navbarToggle.classList.toggle('bi-list')
				navbarToggle.classList.toggle('bi-x')
			}
			scrollto(this.hash)
		}
	}, true)


	window.addEventListener('load', () => {
		if (window.location.hash) {
			if (select(window.location.hash)) {
				scrollto(window.location.hash)
			}
		}
	});


	let heroCarouselIndicators = select("#hero-carousel-indicators")
	let heroCarouselItems = select('#heroCarousel .carousel-item', true)

	heroCarouselItems.forEach((item, index) => {
		(index === 0) ?
			heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "' class='active'></li>" :
			heroCarouselIndicators.innerHTML += "<li data-bs-target='#heroCarousel' data-bs-slide-to='" + index + "'></li>"
	});


	new Swiper('.clients-slider', {
		speed: 400,
		loop: true,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false
		},
		slidesPerView: 'auto',
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true
		},
		breakpoints: {
			320: {
				slidesPerView: 2,
				spaceBetween: 40
			},
			480: {
				slidesPerView: 3,
				spaceBetween: 60
			},
			640: {
				slidesPerView: 4,
				spaceBetween: 80
			},
			992: {
				slidesPerView: 6,
				spaceBetween: 120
			}
		}
	});


	window.addEventListener('load', () => {
		let portfolioContainer = select('.portfolio-container');
		if (portfolioContainer) {
			let portfolioIsotope = new Isotope(portfolioContainer, {
				itemSelector: '.portfolio-item'
			});

			let portfolioFilters = select('#portfolio-flters li', true);

			on('click', '#portfolio-flters li', function (e) {
				e.preventDefault();
				portfolioFilters.forEach(function (el) {
					el.classList.remove('filter-active');
				});
				this.classList.add('filter-active');

				portfolioIsotope.arrange({
					filter: this.getAttribute('data-filter')
				});

			}, true);
		}

	});


	const portfolioLightbox = GLightbox({
		selector: '.portfolio-lightbox'
	});


	new Swiper('.portfolio-details-slider', {
		speed: 400,
		loop: true,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true
		}
	});

	//REGISTRATION 
	document.addEventListener('DOMContentLoaded', function () {
		const elements = {
			stepperItems: document.querySelectorAll('.stepper-item'),
			agreeCheckbox: document.getElementById('agreeCheckbox'),
			previousButton: document.getElementById('previousButton'),
			continueButton: document.getElementById('nextButton'),
			submitButton: document.getElementById('submitButton'),
			


			step1Content: document.getElementById('step1Content'),
			step2Content: document.getElementById('step2Content'),
			step3Content: document.getElementById('step3Content'),
			step4Content: document.getElementById('step4Content'),
			step5Content: document.getElementById('step5Content'),

			// Grades and Semesters
			incomingGradeSelect: document.getElementById('incomingGrade'),
			currentProgram: document.getElementById('currentProgram'),
			// currentProgram: document.getElementById('currentCourse'),

			gradesText: document.getElementById('gradesText'),
			grade3Gwa: document.getElementById('grade3Gwa'),
			grade4Gwa: document.getElementById('grade4Gwa'),
			grade5Gwa: document.getElementById('grade5Gwa'),
			grade6Gwa: document.getElementById('grade6Gwa'),
			grade8Gwa: document.getElementById('grade8Gwa'),
			grade9Gwa: document.getElementById('grade9Gwa'),
			grade10Gwa: document.getElementById('grade10Gwa'),

			// Grade 11 Semesters
			grade11Sem: document.getElementById('grade11Sem'),
			grade11SemSelect: document.getElementById('grade11SemSelect'),
			gr11FirstSem: document.getElementById('g11FirstSem'),
			gr11SecondSem: document.getElementById('g11SecondSem'),
			gr11ThirdSem: document.getElementById('g11ThirdSem'),
			gr11FourthSem: document.getElementById('g11FourthSem'),

			// School Choices and Course Choices
			reportCard: document.getElementById('reportCard'),
			schoolApplicationText: document.getElementById('schoolApplicationText'),
			schoolChoice1: document.getElementById('schoolChoice1'),
			schoolChoice2: document.getElementById('schoolChoice2'),
			schoolChoice3: document.getElementById('schoolChoice3'),
			courseChoice1: document.getElementById('courseChoice1'),
			courseChoice2: document.getElementById('courseChoice2'),
			courseChoice3: document.getElementById('courseChoice3'),

			// Grade 12 Semesters
			grade12Sem: document.getElementById('grade12Sem'),
			grade12SemSelect: document.getElementById('grade12SemSelect'),
			gr12FirstSem: document.getElementById('g12FirstSem'),
			gr12SecondSem: document.getElementById('g12SecondSem'),
			gr12ThirdSem: document.getElementById('g12ThirdSem'),
			gr12FourthSem: document.getElementById('g12FourthSem'),

			// First Year College Semesters
			firstYearSem: document.getElementById('firstYearSem'),
			firstYearSemSelect: document.getElementById('firstYearSemSelect'),
			firstYearFirstSem: document.getElementById('firstYearFirstSem'),
			firstYearSecondSem: document.getElementById('firstYearSecondSem'),
			firstYearThirdSem: document.getElementById('firstYearThirdSem'),
			firstYearFourthSem: document.getElementById('firstYearFourthSem'),

			// First Year College Semesters
			secondYearSem: document.getElementById('secondYearSem'),
			secondYearSemSelect: document.getElementById('secondYearSemSelect'),
			secondYearFirstSem: document.getElementById('secondYearFirstSem'),
			secondYearSecondSem: document.getElementById('secondYearSecondSem'),
			secondYearThirdSem: document.getElementById('secondYearThirdSem'),
			secondYearFourthSem: document.getElementById('secondYearFourthSem'),

			// Monthly Household
			householdSelect: document.getElementById('householdSelect'),
			householdInfoFields: document.getElementById('householdInfoFields'),
			householdSections: document.getElementById('householdSections'),
			totalMonthlyIncomeLabel: document.querySelector('label[for="totalMonthlyIncome"]'),
			totalMonthlyIncomeField: document.getElementById('totalMonthlyIncomeField')

		};

		const errorMessage = document.querySelector('#error-message');

		const displayErrorMessage = () => {
			errorMessage.style.display = 'block';
		};

		
		const currentStep = document.querySelector('.stepper-item.current');
        const currentIndex = Array.from(elements.stepperItems).indexOf(currentStep);
        elements.previousButton.style.display = currentIndex === 0 ? 'none' : 'block';
        elements.continueButton.style.display = currentIndex === 0 ? 'block' : 'none';
        elements.submitButton.style.display = 'none'; 

        elements.previousButton.addEventListener('click', function () {
            const currentStep = document.querySelector('.stepper-item.current');
            const currentIndex = Array.from(elements.stepperItems).indexOf(currentStep);

            if (currentIndex > 0) {
                const previousStep = elements.stepperItems[currentIndex - 1];
                if (previousStep) {
                    currentStep.classList.remove('current');
                    previousStep.classList.add('current');
                    handleStepTransition(currentIndex - 1);
                    window.scrollTo(0, 0);
                }
            }

            handleStepperNumberColors(currentIndex - 1);
            displayStepContent(currentIndex - 1);

            elements.previousButton.style.display = currentIndex === 1 ? 'none' : 'block';

            if (currentIndex === 1) {
                elements.continueButton.style.display = 'block'; 
            }

            elements.submitButton.style.display = 'none'; 
        });

		
		elements.continueButton.addEventListener('click', function () {
            const currentStep = document.querySelector('.stepper-item.current');
            const currentIndex = Array.from(elements.stepperItems).indexOf(currentStep);    
			if (currentIndex === 0 && !elements.agreeCheckbox.checked) {
                displayErrorMessage();
                return;
            }

            if (currentIndex < elements.stepperItems.length - 1) {
                const nextStep = elements.stepperItems[currentIndex + 1];
                if (nextStep) {
                    currentStep.classList.remove('current');
                    nextStep.classList.add('current');
                    handleStepTransition(currentIndex + 1);
                    window.scrollTo(0, 0);
                }
            }

			handleStepperNumberColors(currentIndex + 1);
            displayStepContent(currentIndex + 1);

            elements.previousButton.style.display = 'block';
            // elements.continueButton.textContent = currentIndex === elements.stepperItems.length - 2 ? 'Submit' : 'Next';

            if (currentIndex === 0) {
                elements.continueButton.style.display = 'none'; 
            } else if (currentIndex === elements.stepperItems.length - 2) {
                elements.submitButton.style.display = 'block'; 
            }
        });


		const handleStepperNumberColors = (currentIndex) => {
			elements.stepperItems.forEach((item, index) => {
				const stepperNumber = item.querySelector('.stepper-number');
				if (item.classList.contains('done')) {
					stepperNumber.style.backgroundColor = '#518630';
					stepperNumber.innerHTML = '<i class="fas fa-check"></i>';
					stepperNumber.style.color = '#fff';
				} else if (index === currentIndex) {
					stepperNumber.style.backgroundColor = '#518630';
					stepperNumber.innerHTML = (index + 1).toString();
					stepperNumber.style.color = '#fff';
				} else {
					stepperNumber.style.backgroundColor = '#D9D9D9';
					stepperNumber.innerHTML = (index + 1).toString();
					stepperNumber.style.color = '#000';
				}
			});
		};

		const displayStepContent = (currentIndex) => {
			const stepsContent = [
				elements.step1Content,
				elements.step2Content,
				elements.step3Content,
				elements.step4Content,
				elements.step5Content
			];

			elements.stepperItems.forEach((item, index) => {
				const stepContent = stepsContent[index];
				if (index === currentIndex) {
					item.classList.add('current');
					stepContent.style.display = 'block';
				} else {
					item.classList.remove('current');
					stepContent.style.display = 'none';
				}
			});
		};


		const toggleElement = (element, displayValue) => {
			element.style.display = displayValue;
		};

		const handleStepTransition = (currentIndex) => {
			const { step1Content, step2Content, step3Content, step4Content, step5Content, stepperItems } = elements;

			switch (currentIndex) {
				case 0:
					toggleElement(step1Content, 'block');
					toggleElement(step2Content, 'none');
					toggleElement(step3Content, 'none');
					toggleElement(step4Content, 'none');
					toggleElement(step5Content, 'none');
					break;
				case 1:
					toggleElement(step1Content, 'none');
					toggleElement(step2Content, 'block');
					toggleElement(step3Content, 'none');
					toggleElement(step4Content, 'none');
					toggleElement(step5Content, 'none');
					break;
				case 2:
					toggleElement(step1Content, 'none');
					toggleElement(step2Content, 'none');
					toggleElement(step3Content, 'block');
					toggleElement(step4Content, 'none');
					toggleElement(step5Content, 'none');
					break;
				case 3:
					toggleElement(step1Content, 'none');
					toggleElement(step2Content, 'none');
					toggleElement(step3Content, 'none');
					toggleElement(step4Content, 'block');
					toggleElement(step5Content, 'none');
					break;
				case 4:
					toggleElement(step1Content, 'none');
					toggleElement(step2Content, 'none');
					toggleElement(step3Content, 'none');
					toggleElement(step4Content, 'none');
					toggleElement(step5Content, 'block');
					break;
				default:
					break;
			}

			stepperItems.forEach((item, index) => {
				const stepperNumber = item.querySelector('.stepper-number');
				if (index < currentIndex) {
					stepperNumber.style.backgroundColor = '#D9D9D9';
					item.classList.add('done');
				} else if (index === currentIndex) {
					stepperNumber.style.backgroundColor = '#518630';
					item.classList.remove('done');
				} else {
					stepperNumber.style.backgroundColor = '#518630';
					item.classList.remove('done');
				}
			});
		};


		const toggleGradeElements = () => {
			const selectedGrade = elements.incomingGradeSelect.value;
			const gradeElements = {
				'GradeSeven': ['gradesText', 'grade3Gwa', 'grade4Gwa', 'grade5Gwa', 'reportCard'],
				'GradeEight': ['gradesText', 'grade4Gwa', 'grade5Gwa', 'grade6Gwa', 'reportCard'],
				'GradeNine': ['gradesText', 'grade5Gwa', 'grade6Gwa', 'grade7Gwa', 'reportCard'],
				'GradeTen': ['gradesText', 'grade6Gwa', 'grade7Gwa', 'grade8Gwa', 'reportCard'],
				'GradeEleven': ['gradesText', 'grade7Gwa', 'grade8Gwa', 'grade9Gwa', 'reportCard'],
				'GradeTwelve': ['currentProgram', 'gradesText', 'grade8Gwa', 'grade9Gwa', 'grade10Gwa', 'reportCard'],
				'FirstYear': ['currentProgram','gradesText', 'grade9Gwa', 'grade10Gwa', 'grade11Sem', 'schoolApplicationText', 'schoolChoice1', 'schoolChoice2', 'schoolChoice3', 'courseChoice1', 'courseChoice2', 'courseChoice3'],
				'SecondYear': ['currentProgram','gradesText', 'grade10Gwa', 'grade11Sem', 'grade12Sem'],
				'ThirdYear': ['currentProgram','gradesText', 'grade11Sem', 'grade12Sem', 'firstYearSem'],
				'FourthYear': ['currentProgram','gradesText', 'grade12Sem', 'firstYearSem', 'secondYearSem'],
			};

			const hideAllElements = () => {
				const allElements = Object.values(gradeElements).flat().concat(['g11FirstSem', 'g11SecondSem', 'g11ThirdSem', 'g11FourthSem',
					'g12FirstSem', 'g12SecondSem', 'g12ThirdSem', 'g12FourthSem', 'firstYearFirstSem', 'firstYearSecondSem', 'firstYearThirdSem', 'firstYearFourthSem',
					'secondYearFirstSem', 'secondYearSecondSem', 'secondYearThirdSem', 'secondYearFourthSem']);
				allElements.forEach(elementId => {
					const element = document.getElementById(elementId);
					if (element) {
						element.style.display = 'none';
					}
				});
			};

			hideAllElements();

			if (gradeElements[selectedGrade]) {
				gradeElements[selectedGrade].forEach(elementId => {
					const element = document.getElementById(elementId);
					if (element) {
						element.style.display = 'block';
					}
				});
			}
		};
		elements.incomingGradeSelect.addEventListener('change', function () {
			elements.grade11SemSelect.value = '';
			elements.grade12SemSelect.value = '';
			elements.firstYearSemSelect.value = '';
			elements.secondYearSemSelect.value = '';

			toggleGradeElements();
		});

		//Grade 11 SEMESTER     
		elements.grade11SemSelect.addEventListener('change', function () {
			const { grade11SemSelect, gr11FirstSem, gr11SecondSem, gr11ThirdSem, gr11FourthSem, reportCard } = elements;
			const selectedSem = grade11SemSelect.value;

			[gr11FirstSem, gr11SecondSem, gr11ThirdSem, gr11FourthSem, reportCard].forEach(element => {
				element.style.display = 'none';
			});

			const semesterOptions = {
				'TwoSem': [gr11FirstSem, gr11SecondSem, reportCard],
				'ThreeSem': [gr11FirstSem, gr11SecondSem, gr11ThirdSem, reportCard],
				'FourSem': [gr11FirstSem, gr11SecondSem, gr11ThirdSem, gr11FourthSem, reportCard]
			};

			const selectedSemesterElements = semesterOptions[selectedSem];
			if (selectedSemesterElements) {
				selectedSemesterElements.forEach(element => {
					element.style.display = 'block';
				});
			}
		});

		//Grade 12 SEMESTER   
		elements.grade12SemSelect.addEventListener('change', function () {
			const { grade12SemSelect, gr12FirstSem, gr12SecondSem, gr12ThirdSem, gr12FourthSem, reportCard } = elements;
			const selectedSem = grade12SemSelect.value;

			[gr12FirstSem, gr12SecondSem, gr12ThirdSem, gr12FourthSem, reportCard].forEach(element => {
				element.style.display = 'none';
			});

			const semesterOptions = {
				'g12TwoSem': [gr12FirstSem, gr12SecondSem, reportCard],
				'g12ThreeSem': [gr12FirstSem, gr12SecondSem, gr12ThirdSem, reportCard],
				'g12FourSem': [gr12FirstSem, gr12SecondSem, gr12ThirdSem, gr12FourthSem, reportCard]
			};

			const selectedSemesterElements = semesterOptions[selectedSem];
			if (selectedSemesterElements) {
				selectedSemesterElements.forEach(element => {
					element.style.display = 'block';
				});
			}
		});

		//FIRST YR SEMESTER   
		elements.firstYearSemSelect.addEventListener('change', function () {
			const { firstYearSemSelect, firstYearFirstSem, firstYearSecondSem, firstYearThirdSem, firstYearFourthSem, reportCard } = elements;
			const selectedSem = firstYearSemSelect.value;

			[firstYearFirstSem, firstYearSecondSem, firstYearThirdSem, firstYearFourthSem, reportCard].forEach(element => {
				element.style.display = 'none';
			});

			const semesterOptions = {
				'firstYearTwoSem': [firstYearFirstSem, firstYearSecondSem, reportCard],
				'firstYearThreeSem': [firstYearFirstSem, firstYearSecondSem, firstYearThirdSem, reportCard],
				'firstYearFourSem': [firstYearFirstSem, firstYearSecondSem, firstYearThirdSem, firstYearFourthSem, reportCard]
			};

			const selectedSemesterElements = semesterOptions[selectedSem];
			if (selectedSemesterElements) {
				selectedSemesterElements.forEach(element => {
					element.style.display = 'block';
				});
			}
		});

		//SECOND YR SEMESTER   
		elements.secondYearSemSelect.addEventListener('change', function () {
			const { secondYearSemSelect, secondYearFirstSem, secondYearSecondSem, secondYearThirdSem, secondYearFourthSem, reportCard } = elements;
			const selectedSem = secondYearSemSelect.value;

			[secondYearFirstSem, secondYearSecondSem, secondYearThirdSem, secondYearFourthSem, reportCard].forEach(element => {
				element.style.display = 'none';
			});

			const semesterOptions = {
				'secondYearTwoSem': [secondYearFirstSem, secondYearSecondSem, reportCard],
				'secondYearThreeSem': [secondYearFirstSem, secondYearSecondSem, secondYearThirdSem, reportCard],
				'secondYearFourSem': [secondYearFirstSem, secondYearSecondSem, secondYearThirdSem, secondYearFourthSem, reportCard]
			};

			const selectedSemesterElements = semesterOptions[selectedSem];
			if (selectedSemesterElements) {
				selectedSemesterElements.forEach(element => {
					element.style.display = 'block';
				});
			}
		});

		elements.agreeCheckbox.addEventListener('change', function () {
			if (elements.agreeCheckbox.checked) {
				errorMessage.style.display = 'none';
			}
		});

		//Monthly Household 
		householdSelect.addEventListener('change', function () {
			const selectedValue = parseInt(householdSelect.value);

			householdSections.innerHTML = "";

			if (selectedValue >= 1 && selectedValue <= 10) {
				totalMonthlyIncomeField.style.display = 'block';

				for (let i = 1; i <= selectedValue; i++) {
					const div = document.createElement("div");
					div.classList.add("household-section");

					div.innerHTML = `
									<h5 style="font-weight: bold; margin-top: 20px;">Household Employed ${i}</h5>
									<div class="row">
											<div class="col-md-6">
													<div class="form-group">
															<label for="name${i}">Name <span style="color: red; font-size: 12px; font-weight: normal;">*</span></label>
															<input type="text" class="form-control" name="name${i}" id="name${i}" placeholder="" required>
													</div>
													
													<div class="form-group">
															<label for="relationship${i}">Relationship <span style="color: red; font-size: 12px; font-weight: normal;">*</span></label>
															<input type="text" class="form-control" name="relationship${i}" id="relationship${i}" placeholder="" required>
													</div>
											</div>
											<div class="col-md-6">
													<div class="form-group">
															<label for="occupation${i}">Occupation <span style="color: red; font-size: 12px; font-weight: normal;">*</span></label>
															<input type="text" class="form-control" name="occupation${i}" id="occupation${i}" placeholder="" required>
													</div>
													
													<div class="form-group">
															<label for="monthlyIncome${i}">Monthly Income <span style="color: red; font-size: 12px; font-weight: normal;">*</span></label>
															<input type="number" class="form-control" name="monthlyIncome${i}" id="monthlyIncome${i}" placeholder="" required>
													</div>
											</div>
									</div>
							`;

					householdSections.appendChild(div);
				}
			} else {
				totalMonthlyIncomeField.style.display = 'none';
			}
		});
	});
})()

document.addEventListener('input', function (event) {
    if (event.target && event.target.id.startsWith('monthlyIncome')) {
        calculateTotalIncome();
    }
});

function calculateTotalIncome() {
    const totalMonthlyIncomeField = document.getElementById('totalMonthlyIncome');
    const monthlyIncomeFields = document.querySelectorAll('[id^="monthlyIncome"]');
    
    let totalIncome = 0;

    monthlyIncomeFields.forEach(field => {
        const income = parseFloat(field.value) || 0;
        totalIncome += income;
    });

    totalMonthlyIncomeField.value = totalIncome.toFixed(2);
}



