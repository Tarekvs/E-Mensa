@extends(".examples.layout.m4_7d_layout")

@section("title", "E-Mensa")
@section('content')
<div id="Newsletter">
         <div id="Kontakt"> <!-- Newsletter Formular -->
                <div class="titel"> Interesse geweckt? Wir informieren Sie!</div>
                <form action="Newsletter" method="post">
                    <div id="formularoben">
                        <div class="name">
                            <label for="name">Ihr Name</label> <br>
                            <input type="text" maxlength="50" id="name" name="name" required placeholder="Name">
                        </div>
                        <div class="email">
                            <label for="email">Email</label> <br>
                            <input type="email" maxlength="50" id="email" name="email" required placeholder="Bitte Email eingeben">
                        </div>
                        <div class="newsletter">
                            <label for="newsletter">Newsletter bitte in:</label> <br>
                            <select name="newsletter" id="newsletter">
                                <option value="1" selected>Deutsch</option>
                                <option value="2" >English</option>
                            </select>
                        </div>
                    </div>
                    <div id="formularunten">
                        <div class="datenschutzbestimmung">
                            <input type="checkbox" id="dshw" name="dshw" value="on" required>
                            <label for="dshw">Datenschutzhinweise gelesen</label>
                        </div>
                        <div class="anmelden">
                            <input type="submit" value="Zum Newsletter anmelden">
                        </div>
                    </div>
                </form>
            </div>

    </div>
</div>
@endsection