'use strict'

/*
* ------------------------Global variables-----------------------------
*/

const ROOTS = getComputedStyle(document.documentElement)
const HOVERTIME = getNumber( ROOTS.getPropertyValue('--hover-time') )
const ANIMTIME = getNumber( ROOTS.getPropertyValue('--anim-time') )
let isAnimating = false
let curMobile = isMobile()
let curSlider = innerWidth <= 650 ? true : false

/*
* ------------------------Init-----------------------------
*/
//------------------------Header-----------------------------
const header = document.querySelector('.header')
let menuBtn = ''
if (header) menuBtn = header.querySelector('.menu-button')
const menu = document.querySelector('.menu__popup')

//------------------------Stiky-----------------------------
let headerHeight = ''
if (header) headerHeight = getHeaderHeight()

//------------------------Scroll animation-----------------------------
const scrollElems = document.querySelectorAll('.js-anim')

//------------------------Running clients-----------------------------
let mouseX = 0
let mouseY = 0

//------------------------UFO animation-----------------------------
let isRayAnimating = false

//------------------------Functions-----------------------------
if (header) {
	headerBackgroundColor()
	svgStrokeInit()
	navCurSection()
	navCurFeatures()
	logoAnimInit()
	anchorLinksInit()
	stickyBehaviour()
	mainscreenRectInit()
	heartInit()
	runClientsInit()
	wavesInit()
	parallax()
	sliderInit()
	teamCardTilte()
	cactusInit()
	ufoRayInit()

	window.addEventListener('load', () => {
		scrollAnimations()
	})
	document.addEventListener('scroll', () => {
		headerBackgroundColor()
		scrollAnimations()
		navCurSection()
		navCurFeatures()
		requestAnimationFrame(() => stickyBehaviour())
		parallax()
	})
	window.addEventListener('resize', ()=>{
		changeDevice()
		isSlider()
	})
}

function changeDevice() {
	if ( curMobile != isMobile() ) {
		curMobile = !curMobile

		// ---------------------
		headerHeight = getHeaderHeight()
	}
}

/*
* ------------------------Header-----------------------------
*/

function headerBackgroundColor() {
	const mainArrow = document.querySelector('.mainscreen__link')

	if (pageYOffset > 0) {
		header.classList.add('fill')

		mainArrow.classList.remove('visible')
	}
	else {
		header.classList.remove('fill')

		mainArrow.classList.add('visible')
	}
}

if (header) {
	menuBtn.addEventListener('click', () => {
		if (isAnimating) return
		isAnimating = true
		setTimeout(() => isAnimating = false, HOVERTIME)

		menu.classList.add('show')
	})
	menu.addEventListener('click', (e) => {
		if (isAnimating) return
		isAnimating = true
		setTimeout(() => isAnimating = false, HOVERTIME)

		if (!e.target.closest('.popup__body')) {
			menu.classList.remove('show')
		}
	})
}

/*
* ------------------------Scroll animations-----------------------------
*/

function scrollAnimations() {
	const offset = innerHeight / 10

	scrollElems.forEach((elem) => {
		const elemValues = elem.getBoundingClientRect()

		if (elemValues.top + offset < innerHeight && elemValues.bottom - headerHeight - offset > 0) {
			elem.classList.add('animated')
			setTimeout(() => elem.classList.add('ready'), ANIMTIME)
		}
		else {
			elem.classList.remove('ready')
			elem.classList.remove('animated')
		}
	})
}

function svgStrokeInit() {
	const stokes = document.querySelectorAll('.svg__stroke')

	stokes.forEach((stroke) => {
		const strokeLegth = Math.ceil(stroke.getTotalLength())
		stroke.style.strokeDasharray = `${strokeLegth}px`
		stroke.style.strokeDashoffset = `${strokeLegth}px`
	})
		
}

/*
* ------------------------Nav current section-----------------------------
*/

function navCurSection() {
	const navs = document.querySelectorAll('.nav')
	const sections = document.querySelectorAll('.section')
	let isFinding = false

	sections.forEach((section) => {
		if (isFinding) return
		const sectionValues = section.getBoundingClientRect()

		if (-sectionValues.top + headerHeight < sectionValues.height) {
			navs.forEach((nav) => {
				const links = nav.querySelectorAll('.anchor-link')

				links.forEach((link) => {
					if (link.href.split('#')[1] === section.id) {
						if (!link.classList.contains('active')) {
							nav.querySelector('.active') ? nav.querySelector('.active').classList.remove('active') : ''
							link.classList.add('active')
						}
					}
				})
			})

			isFinding = true
		}
	})
}

/*
* ------------------------Features nav-----------------------------
*/

function navCurFeatures() {
	const section = document.querySelector('.features')
	const featuresNav = section.querySelector('.features__nav')
	const featuresCounter = section.querySelector('.features__counter')
	const cards = section.querySelectorAll('.features__card')
	let isFinding = false

	cards.forEach((card) => {
		if (isFinding) return

		const cardValues = card.getBoundingClientRect()

		if (-cardValues.top + headerHeight < cardValues.height) {
			const navLinks = featuresNav.querySelectorAll('.anchor-link')
			const counterLinks = featuresCounter.querySelectorAll('.anchor-link')

			navLinks.forEach((link) => {
				if (link.href.split('#')[1] === card.id) {
					if (!link.parentNode.classList.contains('active')) {
						featuresNav.querySelector('.active') ? featuresNav.querySelector('.active').classList.remove('active') : ''
						link.parentNode.classList.add('active')
					}
				}
			})
			counterLinks.forEach((link) => {
				if (link.href.split('#')[1] === card.id) {
					if (!link.parentNode.classList.contains('active')) {
						featuresCounter.querySelector('.active') ? featuresCounter.querySelector('.active').classList.remove('active') : ''
						link.parentNode.classList.add('active')
					}
				}
			})

			isFinding = true
		}
	})
}

/*
* ------------------------Logo anim-----------------------------
*/

function logoAnimInit() {
	const logos = document.querySelectorAll('.logo')

	logos.forEach((logo) => logo.addEventListener('click', () => logoAnim(logo)))
	headerLogo()
}
function logoAnim(logo) {
	const hexagon = logo.querySelector('.logo__hexagon')
	if (hexagon.classList.contains('animating')) return

	hexagon.classList.add('animating')

	setTimeout(() => hexagon.classList.remove('animating'), ANIMTIME)
}
function headerLogo() {
	const headerLogo = document.querySelector('.header__logo')
	const mainLogo = document.querySelector('.mainscreen__logo')
	const footerLogo = document.querySelector('.footer__logo')

	let status = false
	const config = { attributes: true, attributeFilter: ['class'], childList: false, subtree: false }

	const observerMain = new MutationObserver(() => {
		if (
			!mainLogo.classList.contains('animated') &&
			!footerLogo.classList.contains('animated') &&
			!status
		) {
			status = true
			headerLogo.classList.add('animated')
		}
		else if (mainLogo.classList.contains('animated') && status) {
			status = false
			headerLogo.classList.remove('animated')
		}
	})
	const observerFooter = new MutationObserver(() => {
		if (
			!mainLogo.classList.contains('animated') &&
			!footerLogo.classList.contains('animated') &&
			!status
		) {
			status = true
			headerLogo.classList.add('animated')
		}
		else if (footerLogo.classList.contains('animated') && status) {
			status = false
			headerLogo.classList.remove('animated')
		}
	})

	observerMain.observe(mainLogo, config)
	observerFooter.observe(footerLogo, config)
}

/*
* ------------------------Anchor links-----------------------------
*/

function anchorLinksInit() {
	const anchorLinks = document.querySelectorAll('.anchor-link')
	anchorLinks.forEach((anchorLink)=>anchorLink.addEventListener('click', (e)=>anchor(e, anchorLink)))
}
function anchor(e, link) {
	e.preventDefault()
	let offset = link.dataset.offset ? innerHeight / link.dataset.offset : 0
	let elementId = link.href
	elementId = elementId.split('#')[1]

	let element = document.querySelector(`#${elementId}`)
	if (elementId === 'features') {
		element = element.querySelector('.features__body')
		offset = innerHeight / 5
	} 
	const toElement = element.getBoundingClientRect().top + pageYOffset - offset - headerHeight

	if (menu.classList.contains('show')) menu.classList.remove('show')
	window.scrollTo({top: toElement, behavior: 'smooth'})
}

/*
* ------------------------Stiky-----------------------------
*/

function stickyBehaviour() {
	if ( isMobile() ) return

	const stickyContainers = document.querySelectorAll('.sticky__container')

	stickyContainers.forEach((container)=>{
		const item = container.querySelector('.sticky')
		let itemTop = item.getBoundingClientRect().top
		let itemBot = item.getBoundingClientRect().bottom
		let containerTop = container.getBoundingClientRect().top
		let containerBot = container.getBoundingClientRect().bottom

		if (itemTop <= headerHeight ) {
			item.classList.add('fixed')

			if (itemBot >= containerBot) item.classList.add('bot')
			if (itemTop < containerTop) item.classList.remove('fixed')
		}
		else {
			item.classList.remove('bot')
		}
	})
}

/*
* ------------------------Mainscreen rectangle animation-----------------------------
*/

function mainscreenRectInit() {
	const list = document.querySelector('.mainscreen__list')
	const listItems = list.querySelectorAll('.mainscreen__list-item')

	let i = 0

	mainscreenRectAnim(listItems, i)
}
function mainscreenRectAnim(listItems, i) {
	document.documentElement.style.setProperty('--mainscreen-rect-pos', `${listItems[i].offsetTop}px`)

	i++
	i = i === listItems.length ? 0 : i
	requestAnimationFrame(() => setTimeout(
		() => mainscreenRectAnim(listItems, i), 2000 + HOVERTIME
	))
}

/*
* ------------------------Trajectory robot's heart-----------------------------
*/

function heartInit() {
	const robot = document.querySelector('.intro__robot')
	const robotHeart = robot.querySelector('.robot__heart')
	const robotTrack = robot.querySelector('.robot__trajectory')

	const delay = 300
	const timeoutRepeat = 1000

	let finished = false
	let status = false
	robotHeart.offset = robotTrack.getPointAtLength(robotTrack.getTotalLength()).x
	robotHeart.height = robotHeart.getBBox().height

	const config = { attributes: true, attributeFilter: ['class'], childList: false, subtree: false }

	const observer = new MutationObserver(() => {
		if (robot.classList.contains('ready') && !status) {
			status = true
			heartPrepare(robotHeart, robotTrack)
			anim.start(2000)
		}
		else if (!robot.classList.contains('ready') && status) {
			status = false
			anim.finish()
		}
	})

	observer.observe(robot, config)

	const anim = {
		start: function(duration) {
			finished = false
			this.duration = duration
			this.tZero = Date.now()

			heartPrepare(robotHeart, robotTrack)
			this.run()
		},
	    
		run: function() {
			if (finished) return
			let perc = Math.min((Date.now() - this.tZero) / this.duration, 1)
	        
			if (perc < 1) {
				requestAnimationFrame(() => this.run())
			} else {
				this.restart()
			}
	        
			heartMove(robotHeart, robotTrack, perc)
		},
	    
		restart: function() {
			setTimeout(() => {
				heartFadeout(robotHeart)
				setTimeout(() => this.start(this.duration), timeoutRepeat + ANIMTIME)
			}, delay)
		},

		finish: function() {
			finished = true
			heartFadeout(robotHeart)
		}
	}
}
function heartPrepare(heart, track) {
	heart.classList.remove('transition')
	const p = track.getPointAtLength(0)
	heart.setAttribute(
		"transform",
		`translate(${p.x - heart.offset}, ${p.y - (heart.height / 2)})`
	)
	heart.style.opacity = 1
	heart.style.visibility = 'visible'
}
function heartMove(heart, track, perc) {
	const p = track.getPointAtLength(perc * track.getTotalLength())
	heart.setAttribute(
		"transform",
		`translate(${p.x - heart.offset}, ${p.y - (heart.height / 2)})`
	)
}
function heartFadeout(heart) {
	heart.classList.add('transition')
	heart.style.opacity = 0
	heart.style.visibility = 'hidden'
}

/*
* ------------------------Running clients-----------------------------
*/

function runClientsInit() {
	const section = document.querySelector('.clients')

	section.addEventListener('mousemove', (e) => clientsMouse(e))
	runClients(section)
}
function clientsMouse(e) {
	if (e.sourceCapabilities.firesTouchEvents) return

	mouseX = e.clientX
	mouseY = e.clientY
}
function runClients(section) {
	const r = 30
	const coef = 1.05
	const threshold = 2
	const maxOffset = 75

	const elements = section.querySelectorAll('.clients__img')

	elements.forEach((elem) => {
		let isTouched = false
		const elemPos = elem.getBoundingClientRect()

		// TOP offset
		if (mouseY < elemPos.bottom && Math.abs(mouseY - elemPos.top) < r) {
			let elemX = closestPoint(mouseX, elemPos.left, elemPos.right)
			
			if (isInsideCircle(elemX, elemPos.top, mouseX, mouseY, r)) {
				let diff = isInsideCircle(mouseX, elemPos.top, mouseX, mouseY, r)
				diff.y = diff.y < 0 ? -diff.y + r : diff.y
				let offsetX = diff.x + getTranslateX(elem)
				let offsetY = diff.y + getTranslateY(elem)
				offsetX = Math.abs(offsetX) > maxOffset ? maxOffset : offsetX
				offsetY = Math.abs(offsetY) > maxOffset ? maxOffset : offsetY

				requestAnimationFrame(() => elem.style.transform = `translate(${offsetX}px, ${offsetY}px)`)
				isTouched = true
			}
		}
		// RIGHT offset
		if (mouseX > elemPos.left && Math.abs(mouseX - elemPos.right) < r) {
			let elemY = closestPoint(mouseY, elemPos.top, elemPos.bottom)

			if (isInsideCircle(elemPos.right, elemY, mouseX, mouseY, r)) {
				let diff = isInsideCircle(elemPos.right, elemY, mouseX, mouseY, r)
				diff.x = diff.x > 0 ? -diff.x - r : diff.x
				let offsetX = diff.x + getTranslateX(elem)
				let offsetY = diff.y + getTranslateY(elem)
				offsetX = Math.abs(offsetX) > maxOffset ? maxOffset : offsetX
				offsetY = Math.abs(offsetY) > maxOffset ? maxOffset : offsetY

				requestAnimationFrame(() => elem.style.transform = `translate(${offsetX}px, ${offsetY}px)`)
				isTouched = true
			}
		}
		// BOTTOM offset
		if (mouseY > elemPos.top && Math.abs(mouseY - elemPos.bottom) < r) {
			let elemX = closestPoint(mouseX, elemPos.left, elemPos.right)

			if (isInsideCircle(elemX, elemPos.bottom, mouseX, mouseY, r)) {
				let diff = isInsideCircle(mouseX, elemPos.bottom, mouseX, mouseY, r)
				diff.y = diff.y > 0 ? -diff.y - r : diff.y
				let offsetX = diff.x + getTranslateX(elem)
				let offsetY = diff.y + getTranslateY(elem)
				offsetX = Math.abs(offsetX) > maxOffset ? maxOffset : offsetX
				offsetY = Math.abs(offsetY) > maxOffset ? maxOffset : offsetY

				requestAnimationFrame(() => elem.style.transform = `translate(${offsetX}px, ${offsetY}px)`)
				isTouched = true
			}
		}
		// LEFT offset
		if (mouseX < elemPos.right && Math.abs(mouseX - elemPos.left) < r) {
			let elemY = closestPoint(mouseY, elemPos.top, elemPos.bottom)

			if (isInsideCircle(elemPos.left, elemY, mouseX, mouseY, r)) {
				let diff = isInsideCircle(elemPos.left, elemY, mouseX, mouseY, r)
				diff.x = diff.x < 0 ? -diff.x + r : diff.x
				let offsetX = diff.x + getTranslateX(elem)
				let offsetY = diff.y + getTranslateY(elem)
				offsetX = Math.abs(offsetX) > maxOffset ? maxOffset : offsetX
				offsetY = Math.abs(offsetY) > maxOffset ? maxOffset : offsetY

				requestAnimationFrame(() => elem.style.transform = `translate(${offsetX}px, ${offsetY}px)`)
				isTouched = true
			}
		}

		if (!isTouched) {
			let x = getTranslateX(elem) / coef
			let y = getTranslateY(elem) / coef
			x = x < threshold ? 0 : x
			y = y < threshold ? 0 : y
			x = Math.max(x, threshold + 1)
			y = Math.max(y, threshold + 1)

			elem.style.transform = `translate(${x}px, ${y}px)`
		}
	})

	requestAnimationFrame(() => runClients(section))
}
function clientHomeostasis(section) {
	const coef = 1.1
	const elements = section.querySelectorAll('.clients__img')

	elements.forEach((elem) => {
		if (getTranslateX(elem) + getTranslateY(elem) !== 0) {
			let x = getTranslateX(elem) / coef
			let y = getTranslateY(elem) / coef
			x = x < 5 ? 0 : x
			y = y < 5 ? 0 : y

			elem.style.transform = `translate(${x}px, ${y}px)`

			// elem.style.transform = 'translate(0, 0)'
		}
	})

	requestAnimationFrame(() => clientHomeostasis(section))
}
function closestPoint(ePoint, more, less) {
	if (ePoint < more) return more
	if (ePoint > less) return less

	return ePoint
}
function isInsideCircle(elemX, elemY, cX, cY, r) {
	let line = {}
	line.x = elemX - cX
	line.y = elemY - cY
	const dist = Math.sqrt(Math.pow(line.x, 2) + Math.pow(line.y, 2))

	if (dist < r) {
		const sin = line.y / dist
		const cos = line.x / dist
		let diff = {}
		diff.vec = r - dist
		diff.x = diff.vec * cos
		diff.y = diff.vec * sin
		return diff
	}
	else {
		return false
	}
}

/*
* ------------------------Waves-----------------------------
*/

function wavesInit() {
	const minSpeed = 0.2
	const maxSpeed = minSpeed * 2
	const minRefSpeed = 0.4
	const maxRefSpeed = 0.6
	const topWavePoints = [0, 6, 10, 14]
	const topWaveRefers = [4, 8, 12]

	const topWave = document.querySelector('.wave-top__path')
	topWave.path = splitSvgPath(topWave.getAttribute('d'))

	topWave.pointDir = []
	topWave.pointSpeed = []
	topWave.referDir = []
	topWave.referSpeed = []
	topWave.offset = []

	let dir = -1
	for (let i of topWavePoints) {
		topWave.pointDir[i] = dir
		topWave.pointSpeed[i] = Math.random() * (maxSpeed - minSpeed) + minSpeed
		dir = -dir
	}

	topWave.referDir[2] = -1
	topWave.offset[2] = 0
	topWave.referSpeed[2] = Math.random() * (maxRefSpeed - minRefSpeed) + minRefSpeed

	dir = 1
	for (let i of topWaveRefers) {
		topWave.referDir[i] = dir
		topWave.offset[i] = 0
		topWave.referSpeed[i] = Math.random() * (maxRefSpeed - minRefSpeed) + minRefSpeed
		dir = -dir
	}

	const botWavePoints = [1, 7, 11, 15]
	const botWaveRefers = [5, 9, 13]

	const botWave = document.querySelector('.wave-bot__path')
	botWave.path = splitSvgPath(botWave.getAttribute('d'))

	botWave.pointDir = []
	botWave.pointSpeed = []
	botWave.referDir = []
	botWave.referSpeed = []
	botWave.offset = []

	dir = -1
	for (let i of botWavePoints) {
		botWave.pointDir[i] = dir
		botWave.pointSpeed[i] = Math.random() * (maxSpeed - minSpeed) + minSpeed
		dir = -dir
	}

	botWave.referDir[3] = -1
	botWave.offset[3] = 0
	botWave.referSpeed[3] = Math.random() * (maxRefSpeed - minRefSpeed) + minRefSpeed

	dir = 1
	for (let i of botWaveRefers) {
		botWave.referDir[i] = dir
		botWave.offset[i] = 0
		botWave.referSpeed[i] = Math.random() * (maxRefSpeed - minRefSpeed) + minRefSpeed
		dir = -dir
	}

	animWave(topWave, topWavePoints, topWaveRefers)
	animWave(botWave, botWavePoints, botWaveRefers)
}
function animWave(wave, points, refers) {
	const minSpeed = 0.2
	const maxSpeed = minSpeed * 2
	const minRefSpeed = 0.4
	const maxRefSpeed = 0.6

	let deviation = 75
	let minValue = 110
	let maxValue = 150
	if (wave.classList.contains('wave-bot__path')) {
		deviation = 50
		minValue = 30
		maxValue = 70
	}

	for (let i of points) {
		wave.path[i] += wave.pointSpeed[i] * wave.pointDir[i]

		if (wave.path[i] >= maxValue || wave.path[i] <= minValue) {
			wave.path[i] = wave.path[i] > maxValue ? maxValue : minValue

			wave.pointDir[i] = -wave.pointDir[i]
			wave.pointSpeed[i] = Math.random() * (maxSpeed - minSpeed) + minSpeed
		}
	}
	let single = 2
	if (wave.classList.contains('wave-bot__path')) single++

	wave.offset[single] += wave.referSpeed[single] * wave.referDir[single]
	wave.path[single] = wave.path[single - 2] + wave.offset[single]

	if (Math.abs(wave.offset[single]) >= deviation) {
		wave.offset[single] = deviation * wave.referDir[single]

		wave.referDir[single] = -wave.referDir[single]
		wave.referSpeed[single] = Math.random() * (maxRefSpeed - minRefSpeed) + minRefSpeed
	}

	for (let i of refers) {
		wave.offset[i] += wave.referSpeed[i] * wave.referDir[i]
		wave.path[i] = wave.path[i + 2] + wave.offset[i]

		if (Math.abs(wave.offset[i]) >= deviation) {
			wave.offset[i] = deviation * wave.referDir[i]

			wave.referDir[i] = -wave.referDir[i]
			wave.referSpeed[i] = Math.random() * (maxRefSpeed - minRefSpeed) + minRefSpeed
		}
	}

	printWave(wave)
	
	requestAnimationFrame(() => animWave(wave, points, refers))
}
function printWave(wave) {
	if (wave.classList.contains('wave-top__path')) {
		wave.setAttribute(
			'd',
			`M 0 0
			 V ${wave.path[0]}
			 C ${wave.path[1]} ${wave.path[2]} ${wave.path[3]} ${wave.path[4]} ${wave.path[5]} ${wave.path[6]}
			 S ${wave.path[7]} ${wave.path[8]} ${wave.path[9]} ${wave.path[10]}
			 S ${wave.path[11]} ${wave.path[12]} ${wave.path[13]} ${wave.path[14]}
			 V 0
			 H 0 Z`
		)
	}
	else {
		wave.setAttribute(
			'd',
			`M 0 ${wave.path[0]}
			 V ${wave.path[1]}
			 C ${wave.path[2]} ${wave.path[3]} ${wave.path[4]} ${wave.path[5]} ${wave.path[6]} ${wave.path[7]}
			 S ${wave.path[8]} ${wave.path[9]} ${wave.path[10]} ${wave.path[11]}
			 S ${wave.path[12]} ${wave.path[13]} ${wave.path[14]} ${wave.path[15]}
			 V 149
			 H 0 Z`
		)
	}
}

/*
* ------------------------Parallax-----------------------------
*/

function parallax() {
	const items = document.querySelectorAll('.parallax')

	items.forEach((item) => {
		const section = item.closest('.section')
		const sectionPos = section.getBoundingClientRect()

		if (sectionPos.top - innerHeight > 0 || sectionPos.bottom < 0) return

		const perspective = item.dataset.perspective
		const value = sectionPos.top / perspective

		item.style.transform = `translateY(${value}px)`
	})
}

/*
* ------------------------Slider-----------------------------
*/

function sliderInit() {
	const slider = document.querySelector('.slider')
	const leftBtn = slider.querySelector('.slider__left-button')
	const rightBtn = slider.querySelector('.slider__right-button')
	const items = slider.querySelectorAll('.slider__item')
	const pointBlock = slider.querySelector('.slider__points-block')

	slider.step = 0
	slider.itemsNum = items.length

	for (let i = 0; i < items.length; i++) {
		const node = document.createElement('div')
		node.className = 'slider-point'
		i == 0 ? node.classList.add('focus') : ''
		pointBlock.append(node)
	}

	leftBtn.addEventListener('click', () => moveSlide(slider, -1))
	rightBtn.addEventListener('click', () => moveSlide(slider, 1))
}
function moveSlide(slider, direction) {
	if (isAnimating) return
	isAnimating = true
	setTimeout(() => isAnimating = false, HOVERTIME)

	const tape = slider.querySelector('.slider__tape')

	slider.step += direction
	slider.step = slider.step === slider.itemsNum ? 0 : slider.step
	slider.step = slider.step < 0 ? slider.itemsNum - 1 : slider.step

	updateSliderPoints(slider)
	tape.style.transform = `translateX(-${slider.step * 100}%)`
}

function updateSliderPoints(slider) {
	const pointBlock = slider.querySelector('.slider__points-block')
	const pointItems = pointBlock.querySelectorAll('.slider-point')
	const curPoint = pointBlock.querySelector('.slider-point.focus')
	
	curPoint.classList.remove('focus')
	pointItems[slider.step].classList.add('focus')
}

function isSlider() {
	if ( curSlider != (innerWidth <= 650 ? true : false) ) {
		curSlider = !curSlider

		if (innerWidth > 650) {
			const slider = document.querySelector('.slider')
			const tape = slider.querySelector('.slider__tape')

			tape.style.transform = ''
			slider.step = 0
			updateSliderPoints(slider)
		}
	}
}

/*
* ------------------------Team card 3d-----------------------------
*/

function teamCardTilte() {
	const teamTape = document.querySelector('.team__slider-tape')
	const cards = teamTape.querySelectorAll('.team-card__img-block')

	const endScale = 1.05
	const namePosX = -30
	const namePosY = -30

	cards.forEach((card) => card.addEventListener('mouseenter', () => {
		if (innerWidth <= 650) return

		card.style.zIndex = '1'
	}))
	cards.forEach((card) => card.addEventListener('mousemove', (e) => {
		if (innerWidth <= 650) return

		const name = card.querySelector('.team__name')

		const rotateX = 6
		const rotateY = 6
		const namePerspective = 1

		const cardPos = card.getBoundingClientRect()
		const cardX = cardPos.left
		const cardY = cardPos.top
		const mouseX = e.clientX - cardX
		const mouseY = e.clientY - cardY
		const cardCenterX = cardPos.width / 2
		const cardCenterY = cardPos.height / 2
		const percentX = (mouseX - cardCenterX) / cardCenterX
		const percentY = (mouseY - cardCenterY) / cardCenterY
		const valueX = rotateX * percentX
		const valueY = rotateY * percentY

		card.style.transform = `rotateY(${valueX}deg) rotateX(${-valueY}deg)`
		name.style.left = `${namePosX + valueX * namePerspective}px`
		name.style.bottom = `${namePosY - valueY * namePerspective}px`
	}))
	cards.forEach((card) => card.addEventListener('mouseleave', () => {
		const name = card.querySelector('.team__name')
		card.style.transform = ''
		card.style.zIndex = ''
		name.style.left = `${namePosX}px`
		name.style.bottom = `${namePosY}px`
	}))
}

/*
* ------------------------Cactus-----------------------------
*/

function cactusInit() {
	const cactus = document.querySelector('.cactus__container')

	cactus.addEventListener('click', () => cactusAnim(cactus))
}
function cactusAnim(cactus) {
	const cactusBody = cactus.querySelector('.cactus__body')

	cactus.classList.remove('ready')
	cactusBody.classList.add('start')
	setTimeout(() => {
		cactusBody.classList.add('hide')

		setTimeout(() => {
			cactusBody.classList.remove('start', 'hide')

			setTimeout(() => cactus.classList.add('ready'), HOVERTIME)
		}, HOVERTIME + 2500)
	}, HOVERTIME)
}

/*
* ------------------------UFO ray scaning-----------------------------
*/

function ufoRayInit() {
	const duration = 1000
	const leftPos = 0

	const ufo = document.querySelector('.ufo__container')
	const body = ufo.querySelector('.ufo__body')
	const ray = ufo.querySelector('.ufo__ray')
	ray.path = splitSvgPath(ray.getAttribute('d'))
	ray.rightPos = ray.path[6]
	ray.diff = ray.path[4] - ray.rightPos

	body.addEventListener('mouseenter', () => startRay(ray, leftPos, duration))
	body.addEventListener('mouseleave', () => stopRay(ray))
}
function startRay(ray, leftPos, dur) {
	ray.zTime = Date.now()
	isRayAnimating = true

	ray.classList.add('animating')

	moveRay(ray, leftPos, dur, -1)
}
function moveRay(ray, leftPos, dur, dir) {
	const time = Math.min((Date.now() - ray.zTime) / dur, 1)
	let perc = cubikBezier(time)
	if (dir < 0) perc = 1 - perc

	ray.path[6] = (ray.rightPos - leftPos) * perc
	ray.path[4] = ray.path[6] + ray.diff

	printRay(ray)
	if (time === 1) {
		dir = -dir
		ray.zTime = Date.now()
	}
	if (isRayAnimating) {
		requestAnimationFrame(() => moveRay(ray, leftPos, dur, dir))
	}
	else {
		ray.path[6] = ray.rightPos
		ray.path[4] = ray.path[6] + ray.diff

		printRay(ray)
	}
}
function stopRay(ray) {
	isRayAnimating = false
	ray.classList.remove('animating')
}
function printRay(ray) {
	ray.setAttribute(
		'd',
		`M ${ray.path[0]} ${ray.path[1]}
		 L ${ray.path[2]} ${ray.path[3]}
		 L ${ray.path[4]} ${ray.path[5]}
		 H ${ray.path[6]}
		 L ${ray.path[7]} ${ray.path[8]} Z`
	)
}

/*
* ------------------------Common-----------------------------
*/

function getHeaderHeight() {
	const header = document.querySelector('.header')
	return header.clientHeight
}
function getNumber(str){
    return +str.replace(/[^+\d]/g, '') 
}
function getTranslateX(item) {
	const style = window.getComputedStyle(item)
	const matrix = new WebKitCSSMatrix(style.transform)
	return matrix.e
}
function getTranslateY(item) {
	const style = window.getComputedStyle(item)
	const matrix = new WebKitCSSMatrix(style.transform)
	return matrix.f
}
function isMobile() {
	return innerWidth <= 1000 ? true : false
}
function splitSvgPath(item) {
	let arr = item.split(/\s+/)

	arr = arr.filter(item => +item)
	arr = arr.map(item => +item)

	return arr
}
function cubikBezier(t) {
	return -(Math.cos(Math.PI * t) - 1) / 2
}