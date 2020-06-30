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
				required: "Please enter mobile number",
			},
			profile_image: {
				required: "Please upload profile image",
			},
			company_name: {
				required: "Please enter company name",
			},
			address: {
				required: "Please enter company address",
			},
			contact_number: {
				required: "Please enter contact number",
			},
			website: {
				required: "Please enter website url",
			},
			city: {
				required: "Please enter city",
			},
			state: {
				required: "Please enter state",
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