$(document).ready(function () {
    $('#loginForm').validate({
      rules: {
          email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
        },
        captcha: {
          required: true
        },
      },
      messages: {
        email: {
          required: "Please enter email",
          email: "Please enter email"
        },
        password: {
          required: "Please provide a password",
        },
        captcha: {
          required: "Please enter captcha",
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