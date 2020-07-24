<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<img src="{{ $route }}"
alt="captcha image"
style="width:{{ $width }}px;height:{{ $height }}px;"
id = "captchaImg">
<a onclick="refreshcaptcha('{{ $route }}&_='+Math.random());var captcha=document.getElementById('{{ $input_id }}');if(captcha){captcha.focus()}" title="Refresh" class="mt-2" style="cursor:pointer;"><i class="fa fa-refresh" style="font-size:20px;"></i></a>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
function refreshcaptcha(data){
$('#captchaImg').attr('src', data);
}
</script>