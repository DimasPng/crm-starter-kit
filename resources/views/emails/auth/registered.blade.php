@section('page-style')
 <link rel="stylesheet" href="{{asset('assets/vendor/css/emails/registration-email.css')}}">
@endsection


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="email-wrapper d-flex flex-column justify-content-center align-items-center text-center">
  <div class="container">
    <h1 class="mb-4">Спасибо за регистрацию!</h1>
    <p class="mb-4">Для завершения регистрации и активации вашего аккаунта, пожалуйста, подтвердите вашу электронную почту, нажав на кнопку ниже:</p>
    <a href="{{$url}}" class="btn btn-primary">Подтвердить Email</a>
    <p class="mt-4">Если вы не создавали аккаунт, просто проигнорируйте это письмо.</p>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
