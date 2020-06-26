$(document).ready(function () {
	$('#registrationForm').validate({
		rules: {
			email_address: {
				required: true,
				email: true,
			},
			first_name: {
				required: true,
			},
			middle_name: {
				required: true,
			},
			last_name: {
				required: true
			},
			mobile_number: {
				required: true
			},
			email_address: {
				required: true
			},
			profile_image: {
				required: true
			},
			company_name: {
				required: true
			},
			address: {
				required: true
			},
			state: {
				required: true
			},
			city: {
				required: true
			},
			pincode: {
				required: true
			},
			contact_number: {
				required: true
			},
			fax: {
				required: true
			},
			website: {
				required: true
			},
		},
		messages: {
			email_address: {
				required: "Please enter email",
				email_address: "Please enter email"
			},
			first_name: {
				required: "Please enter first name",
			},
			middle_name: {
				required: "Please enter middle name",
			},
			last_name: {
				required: "Please enter last name",
			},
			mobile_number: {
				required: "Please enter last name",
			},
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.mb-3').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});
});