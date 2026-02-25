

@php
use App\Helpers\GlobalHelper;
@endphp

@include('betro.all_element.header')

<body class="layout-1" data-luno="theme-black">
  <!-- start: sidebar -->
@include('betro.all_element.sidebar')
  <!-- start: body area -->
  <div class="wrapper">
    <!-- start: page header -->
   @include('betro.all_element.navbar')
    <!-- start: page toolbar -->
    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      @include('betro.all_element.cadre')
    </div>
    <!-- start: page body -->
    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        <div class="row g-3 row-deck">


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Paramètres du compte</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row">
                            <!-- Formulaire de changement d'email -->
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h5>Changer l'adresse email</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.parametres.update-email') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="email">Nouvelle adresse email</label>
                                                <input type="email" class="form-control" id="email" 
                                                       name="email" value="{{ old('email', $admin->email) }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Mettre à jour l'email</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulaire de changement de mot de passe -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Changer le mot de passe</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.parametres.update-password') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="password">Nouveau mot de passe</label>
                                                <input type="password" class="form-control" id="password" 
                                                       name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                                                <input type="password" class="form-control" id="password_confirmation" 
                                                       name="password_confirmation" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Mettre à jour le mot de passe</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


     




        </div> <!-- .row end -->
      </div>
    </div>
    <!-- start: page footer -->
    @include('betro.all_element.footer')


{{-- 
 <!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Test Paiement Paystack</title>
</head>
<body>
  <h2>Test de paiement Paystack</h2>
  <form id="paymentForm">
    <input type="email" id="email" placeholder="Email" required />
    <input type="number" id="amount" placeholder="Montant (CFA)" required />
    <button type="submit">Payer</button>
  </form>

  <script src="https://js.paystack.co/v1/inline.js"></script>
  <script>
    const form = document.getElementById('paymentForm');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = document.getElementById('email').value;
      const amount = document.getElementById('amount').value * 100;

      const handler = PaystackPop.setup({
        key: 'pk_live_c691043830d08dcf86075ba549126af43c3b1fa9',
        email: email,
        amount: amount,
        currency: 'XOF',
        callback: function(response) {
          alert('Paiement réussi. Référence: ' + response.reference);
        },
        onClose: function() {
          alert('Transaction annulée.');
        }
      });

      handler.openIframe();
    });
  </script>
</body>
</html> --}}
