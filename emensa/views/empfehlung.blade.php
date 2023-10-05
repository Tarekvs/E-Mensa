@extends(".examples.layout.m4_7d_layout")

@section("title", "E-Mensa")
@section('content')

    <!--
- Praktikum DBWT. Autoren:
- Jonas, Gühler, 3263987
- Tarek, von Seckendorff, 3533712
-->
    <div class="titel">Empfehlen Sie uns ein schmackhaftes Gericht</div>
        <form action="Wunschgericht" method="post">

          <label for="name">Ihr Name</label> <br>
          <input type="text" maxlength="50" id="name" name="name" placeholder="Name"> <br>

          <label for="email">Bitte Email eingeben</label> <br>
          <input type="email" maxlength="50" id="email" name="email" required placeholder="Email"> <br>

          <label for="Gname">Name des Gerichts</label> <br>
          <input type="text" maxlength="50" id="Gname" name="Gname" required placeholder="Gericht"> <br>

          <label for="Gbeschreibung">Beschreibung des Gerichts</label> <br>
          <input type="text" maxlength="200" id="Gbeschreibung" name="Gbeschreibung" required placeholder="Beschreibung">
          <br>

          <input type="submit" value="Gericht wünschen">
        </form>
@endsection