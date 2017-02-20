/**
 * Created by jobverplanke on 18/01/2017.
 */


if (window.jQuery === undefined) {
	throw new Error('The jQuery library must be initialized for this plugin to work!');
}
// Reset ReCaptcha after request is successful
$(document).ajaxSuccess(function() {
	captchaReset();
});

// Set
var captcha = document.querySelector('.g-recaptcha');

// Get data values
var sitekey = captcha.dataset.sitekey;
var theme = captcha.dataset.theme;
var size = captcha.dataset.size;

// Set empty captcha id
var captchaId = '';

// Set empty array for multiple id's
var captchaIds = [];

/**
 * Callback function
 */
function onloadCallback() {
	// Foreach div with class g-recaptcha is set
	$('.g-recaptcha').each(function() {
		// Get value of attribute id
		captchaId = $(this).attr('id');

		captchaIds[captchaId] =
			grecaptcha.render(captchaId, {
				'sitekey' : sitekey,
				'theme' : theme,
				'size' : size,
				//'callback' : testFunction(captchaId)
			});
	});
}

/**
 * Reset function, reset captcha.
 */
function captchaReset() {
	$('.g-recaptcha').each(function() {
		grecaptcha.reset(captchaIds[captchaId]);
	});
}


// Test function for callback
function testFunction(id) {
	alert('reCaptcha with identifier: ' + id);
}